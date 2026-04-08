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
        $tickets = Ticket::where('user_id', $user->id)
            ->with(['ticketType.event'])
            ->latest()
            ->get();
            
        $activeTicketCount = $tickets->where('is_used', false)->count();
        $usedTicketCount = $tickets->where('is_used', true)->count();
        
        // Tambahkan Event Terbaru untuk dibeli oleh Customer
        $events = \App\Models\Event::latest()->take(6)->get();

        // Ambil Riwayat Transaksi (Semua Order)
        $orders = Order::where('user_id', $user->id)->with('event')->latest()->get();

        return view('customer.dashboard', compact('tickets', 'activeTicketCount', 'usedTicketCount', 'events', 'orders'));
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
}
