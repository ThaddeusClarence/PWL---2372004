<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizerController extends Controller
{
    /**
     * Display the organizer dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        
        // 1. STATS UTAMA
        $totalEvents = \App\Models\Event::where('organizer_id', $user->id)->count();
        
        $totalSalesCount = \App\Models\Ticket::whereHas('ticketType.event', function($query) use ($user) {
            $query->where('organizer_id', $user->id);
        })->count();
        
        $totalRevenue = \App\Models\Order::whereHas('event', function($query) use ($user) {
            $query->where('organizer_id', $user->id);
        })->where('status', 'paid')->sum('total_price');

        // 2. ANALITIK PENJUALAN 7 HARI TERAKHIR
        $salesTrend = \App\Models\Order::whereHas('event', function($query) use ($user) {
            $query->where('organizer_id', $user->id);
        })
        ->where('status', 'paid')
        ->where('created_at', '>=', now()->subDays(6))
        ->selectRaw('DATE(created_at) as date, SUM(total_price) as total')
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get();

        // 3. PERFORMANCE PER EVENT (Daftar Event & Detail Penjualannya)
        $eventPerformance = \App\Models\Event::where('organizer_id', $user->id)
            ->withCount(['tickets' => function($q) {
                $q->whereHas('order', function($o) { $o->where('status', 'paid'); });
            }])
            ->get()
            ->map(function ($event) {
                $revenue = \App\Models\Order::where('event_id', $event->id)
                    ->where('status', 'paid')->sum('total_price');
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'revenue' => $revenue,
                    'tickets_sold' => $event->tickets_count,
                    'quota' => $event->quota,
                    'category' => $event->category
                ];
            });

        // 4. TRANSAKSI TERBARU
        $recentSales = \App\Models\Order::whereHas('event', function($query) use ($user) {
            $query->where('organizer_id', $user->id);
        })->with(['user', 'event'])->latest()->take(5)->get();
        
        return view('organizer.dashboard', compact(
            'totalEvents', 
            'totalSalesCount', 
            'totalRevenue', 
            'recentSales',
            'salesTrend',
            'eventPerformance'
        ));
    }
}
