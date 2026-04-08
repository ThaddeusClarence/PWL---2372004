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

class CheckoutController extends Controller
{
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

        DB::beginTransaction();
        try {
            // Create Order (Simulasi Paid)
            $order = Order::create([
                'user_id' => Auth::id(),
                'event_id' => $request->event_id,
                'total_price' => $ticketType->price,
                'status' => 'paid', // Simulasi langsung lunas
            ]);

            // Create Ticket
            $ticketCode = 'EVT-' . strtoupper(Str::random(10));
            Ticket::create([
                'order_id' => $order->id,
                'user_id' => Auth::id(),
                'ticket_type_id' => $ticketType->id,
                'ticket_code' => $ticketCode,
                'is_used' => false,
            ]);

            // Kurangi kuota
            $ticketType->decrement('remaining_quota');

            DB::commit();

            return redirect()->route('checkout.success', $order->id)->with('success', 'Pembelian berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function success(Order $order)
    {
        // Pastikan order milik user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load(['event', 'tickets.ticketType']);
        return view('checkout.success', compact('order'));
    }
}
