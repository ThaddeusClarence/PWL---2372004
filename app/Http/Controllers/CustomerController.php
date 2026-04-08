<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;

class CustomerController extends Controller
{
    /**
     * Display the customer dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        $tickets = Ticket::where('user_id', $user->id)
            ->with(['event', 'ticketType'])
            ->latest()
            ->get();
            
        $activeTicketCount = $tickets->where('is_used', false)->count();
        $usedTicketCount = $tickets->where('is_used', true)->count();
        
        // Tambahkan Event Terbaru untuk dibeli oleh Customer
        $events = \App\Models\Event::latest()->take(6)->get();

        return view('customer.dashboard', compact('tickets', 'activeTicketCount', 'usedTicketCount', 'events'));
    }
}
