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
        // 2. TREN PENJUALAN (7 Hari Terakhir)
        $salesTrend = \App\Models\Order::query()
            ->join('events', 'orders.event_id', '=', 'events.id')
            ->where('events.organizer_id', $user->id)
            ->where('orders.status', 'paid')
            ->selectRaw('DATE(orders.created_at) as date_label, SUM(orders.total_price) as total_revenue')
            ->groupBy('date_label')
            ->orderBy('date_label', 'ASC')
            ->get();

        // 3. STATISTIK METODE PEMBAYARAN (Bar Chart)
        $paymentStats = \App\Models\Order::query()
            ->join('events', 'orders.event_id', '=', 'events.id')
            ->where('events.organizer_id', $user->id)
            ->where('orders.status', 'paid')
            ->selectRaw('orders.payment_method, COUNT(*) as count')
            ->groupBy('orders.payment_method')
            ->get()
            ->pluck('count', 'payment_method');

        // 4. PERFORMANCE PER EVENT (Daftar Event & Detail Penjualannya)
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

        // 5. TRANSAKSI TERBARU
        $recentSales = \App\Models\Order::whereHas('event', function($query) use ($user) {
            $query->where('organizer_id', $user->id);
        })
        ->with(['user', 'event'])
        ->latest()
        ->take(5)
        ->get();

        return view('organizer.dashboard', compact(
            'totalEvents', 
            'totalSalesCount', 
            'totalRevenue', 
            'recentSales',
            'salesTrend',
            'eventPerformance',
            'paymentStats'
        ));
    }

    /**
     * Display the detailed reporting page.
     */
    public function reports()
    {
        $user = Auth::user();

        // Data yang sama dengan dashboard tapi lebih detail untuk reporting
        $totalEvents = \App\Models\Event::where('organizer_id', $user->id)->count();
        $totalRevenue = \App\Models\Order::whereHas('event', function($query) use ($user) {
            $query->where('organizer_id', $user->id);
        })->where('status', 'paid')->sum('total_price');

        $eventPerformance = \App\Models\Event::where('organizer_id', $user->id)
            ->withCount(['tickets' => function($q) {
                $q->whereHas('order', function($o) { $o->where('status', 'paid'); });
            }])
            ->withSum(['orders' => function($q) {
                $q->where('status', 'paid');
            }], 'total_price')
            ->get();

        // 1. TREN PENJUALAN (Semua Data)
        $salesTrend = \App\Models\Order::query()
            ->join('events', 'orders.event_id', '=', 'events.id')
            ->where('events.organizer_id', $user->id)
            ->where('orders.status', 'paid')
            ->selectRaw('DATE(orders.created_at) as date_label, SUM(orders.total_price) as total_revenue')
            ->groupBy('date_label')
            ->orderBy('date_label', 'ASC')
            ->get();

        // 2. STATISTIK METODE PEMBAYARAN
        $paymentStats = \App\Models\Order::query()
            ->join('events', 'orders.event_id', '=', 'events.id')
            ->where('events.organizer_id', $user->id)
            ->where('orders.status', 'paid')
            ->selectRaw('orders.payment_method, COUNT(*) as count')
            ->groupBy('orders.payment_method')
            ->get()
            ->pluck('count', 'payment_method');

        return view('organizer.reports', compact('totalEvents', 'totalRevenue', 'eventPerformance', 'salesTrend', 'paymentStats'));
    }

    /**
     * Export the report to PDF.
     */
    public function exportPdf()
    {
        $user = Auth::user();
        
        $totalEvents = \App\Models\Event::where('organizer_id', $user->id)->count();
        $totalRevenue = \App\Models\Order::whereHas('event', function($query) use ($user) {
            $query->where('organizer_id', $user->id);
        })->where('status', 'paid')->sum('total_price');

        $eventPerformance = \App\Models\Event::where('organizer_id', $user->id)
            ->withCount(['tickets' => function($q) {
                $q->whereHas('order', function($o) { $o->where('status', 'paid'); });
            }])
            ->withSum(['orders' => function($q) {
                $q->where('status', 'paid');
            }], 'total_price')
            ->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('organizer.reports-pdf', compact(
            'user', 
            'totalEvents', 
            'totalRevenue', 
            'eventPerformance'
        ));

        return $pdf->download('Financial_Report_Organizer_' . $user->name . '.pdf');
    }
}
