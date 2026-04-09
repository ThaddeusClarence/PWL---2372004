<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\Order;
use App\Models\Event;
use App\Models\WaitingList;

class CustomerController extends Controller
{
    /**
     * Display the customer dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Ambil Riwayat Transaksi (Semua Order)
        $orders = Order::where('user_id', $user->id)
            ->with(['event', 'tickets.ticketType'])
            ->latest()
            ->get();

        // Ambil statistik tiket (opsional untuk dashboard)
        $tickets = Ticket::where('user_id', $user->id)->get();
        $activeTicketCount = $tickets->where('is_used', false)->count();
        $usedTicketCount = $tickets->where('is_used', true)->count();

        // Ambil daftar event untuk dibeli (Pindah dari Front Page)
        $events = Event::latest()->get();

        return view('customer.dashboard', compact('orders', 'events', 'activeTicketCount', 'usedTicketCount', 'tickets'));
    }

    public function showTicket(Order $order)
    {
        // Pastikan hanya pemilik yang bisa melihat
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Pastikan status sudah PAID
        if ($order->status !== 'paid') {
            return redirect()->route('customer.dashboard')->with('error', 'Tiket belum tersedia sebelum pembayaran lunas.');
        }

        $order->load(['event', 'tickets.ticketType', 'user']);
        return view('customer.ticket', compact('order'));
    }

    public function joinWaitingList(Request $request, Event $event)
    {
        $existing = WaitingList::where('user_id', Auth::id())
            ->where('event_id', $event->id)
            ->first();

        if ($existing) {
            return back()->with('error', 'Anda sudah terdaftar di Waiting List untuk event ini.');
        }

        WaitingList::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'ticket_type_name' => $request->ticket_type_name
        ]);

        return back()->with('success', 'Berhasil! Anda telah masuk ke dalam Waiting List. Kami akan hubungi Anda jika tiket tersedia kembali.');
    }
    public function orderDestroy(Order $order)
    {
        // Pastikan order milik user yang login
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Hapus tiket terkait dulu baru hapus ordernya
        $order->tickets()->delete();
        $order->delete();

        return back()->with('success', 'Riwayat transaksi berhasil dihapus.');
    }

    public function ticketDestroy(Ticket $ticket)
    {
        // Pastikan tiket milik user yang login
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }

        $ticket->delete();

        return back()->with('success', 'Tiket berhasil dibuang.');
    }
}
