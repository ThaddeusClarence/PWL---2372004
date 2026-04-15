<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\TicketType;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendTicketMail;
use App\Jobs\SendTicketJob;

class CheckoutController extends Controller
{
    /**
     * Langkah 1: Buat Pesanan (Pending)
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'ticket_type_id' => 'required|exists:ticket_types,id',
        ]);

        $ticketType = TicketType::findOrFail($request->ticket_type_id);
        
        // Cek kuota
        if ($ticketType->remaining_quota <= 0) {
            return back()->with('error', 'Maaf, tiket sudah habis terjual!');
        }

        // Buat Order dengan status PENDING
        $order = Order::create([
            'user_id' => Auth::id(),
            'event_id' => $request->event_id,
            'total_price' => $ticketType->price,
            'status' => 'pending', // Awalnya pending
        ]);

        // Simpan ticket_type_id di session sementara untuk proses pembayaran
        session(['pending_ticket_type_id' => $ticketType->id]);

        return redirect()->route('checkout.payment', $order->id);
    }

    /**
     * Langkah 2: Halaman Simulasi Pembayaran
     */
    public function payment(Order $order)
    {
        if ($order->user_id !== Auth::id() || $order->status !== 'pending') {
            return redirect()->route('customer.dashboard');
        }

        return view('checkout.payment', compact('order'));
    }

    /**
     * Langkah 3: Simulasi Sukses (Paid)
     */
    public function paySuccess(Order $order)
    {
        if ($order->status !== 'pending') return back();

        DB::beginTransaction();
        try {
            $order->update([
                'status' => 'paid',
                'payment_method' => $request->payment_method ?? 'Unknown',
            ]);

            $ticketTypeId = session('pending_ticket_type_id');
            $ticketType = TicketType::findOrFail($ticketTypeId);

            // Buat Tiket setelah dibayar
            Ticket::create([
                'order_id' => $order->id,
                'user_id' => Auth::id(),
                'ticket_type_id' => $ticketTypeId,
                'ticket_code' => 'EVT-' . strtoupper(Str::random(10)),
                'is_used' => false,
            ]);

            // Kurangi kuota
            $ticketType->decrement('remaining_quota');

            // KIRM KE ANTRIAN (QUEUE)
            SendTicketJob::dispatch($order);

            DB::commit();
            return redirect()->route('checkout.success', $order->id)->with('success', 'Pembayaran Berhasil! Tiket diterbitkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses tiket: ' . $e->getMessage());
        }
    }

    /**
     * Langkah 4: Simulasi Gagal (Failed)
     */
    public function payFailed(Order $order)
    {
        if ($order->status !== 'pending') return back();

        $order->update(['status' => 'failed']);
        return redirect()->route('customer.dashboard')->with('error', 'Pembayaran Gagal atau Dibatalkan.');
    }

    public function success(Order $order)
    {
        if ($order->user_id !== Auth::id() || $order->status !== 'paid') {
            return redirect()->route('customer.dashboard');
        }

        $order->load(['event', 'tickets.ticketType']);
        return view('checkout.success', compact('order'));
    }
}
