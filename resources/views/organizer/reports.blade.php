<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        .font-report { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    <div class="font-report bg-[#f8fafc] min-h-screen py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Header section --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
                <div>
                    <h2 class="text-3xl font-black text-gray-900 tracking-tight">Financial & Performance Reporting</h2>
                    <p class="text-gray-500 font-medium">Analisis mendalam performa penjualan event Anda.</p>
                </div>
                <div class="flex gap-4">
                    <a href="{{ route('organizer.dashboard') }}" class="px-6 py-3 bg-white border border-gray-200 text-gray-700 font-bold rounded-2xl hover:bg-gray-50 transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('organizer.reports.pdf') }}" class="px-6 py-3 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-black transition shadow-lg shadow-indigo-100 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Export PDF Report
                    </a>
                </div>
            </div>

            {{-- Summary Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
                <div class="bg-white p-8 rounded-[35px] shadow-sm border border-gray-100">
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Total Gross Revenue</p>
                    <h3 class="text-3xl font-black text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                    <div class="mt-4 flex items-center gap-2 text-emerald-600 font-bold text-xs bg-emerald-50 w-fit px-3 py-1 rounded-full">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                        Performance Optima
                    </div>
                </div>
                <div class="bg-white p-8 rounded-[35px] shadow-sm border border-gray-100">
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Total Events Managed</p>
                    <h3 class="text-3xl font-black text-gray-900">{{ $totalEvents }}</h3>
                    <p class="text-gray-400 text-xs font-medium mt-2">Seluruh event yang ditugaskan kepada Anda.</p>
                </div>
                <div class="bg-white p-8 rounded-[35px] shadow-sm border border-gray-100">
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Avg. Revenue / Event</p>
                    <h3 class="text-3xl font-black text-gray-900">Rp {{ number_format($totalEvents > 0 ? $totalRevenue / $totalEvents : 0, 0, ',', '.') }}</h3>
                    <p class="text-gray-400 text-xs font-medium mt-2">Rata-rata pendapatan per kegiatan.</p>
                </div>
            </div>

            {{-- Visual Analytics Section --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
                {{-- Sales Graph --}}
                <div class="lg:col-span-2 bg-white p-8 rounded-[40px] shadow-sm border border-gray-100">
                    <div class="mb-8">
                        <h4 class="text-xl font-black text-gray-900">Transaction Trend</h4>
                        <p class="text-sm text-gray-400 font-medium">Data pendapatan berdasarkan waktu transaksi.</p>
                    </div>
                    <div class="h-[350px]">
                        <canvas id="reportTrendChart"></canvas>
                    </div>
                </div>

                {{-- Event Analytics List --}}
                <div class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100">
                    <h4 class="text-xl font-black text-gray-900 mb-6">Event Performance</h4>
                    <div class="space-y-4">
                        @foreach($eventPerformance as $event)
                        <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs font-black text-gray-900 line-clamp-1">{{ $event->title }}</span>
                                <span class="text-[10px] bg-indigo-600 text-white px-2 py-0.5 rounded-full font-bold uppercase">{{ $event->category }}</span>
                            </div>
                            <div class="flex justify-between items-end">
                                <div>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">Tickets Sold</p>
                                    <p class="text-sm font-black text-indigo-600">{{ $event->tickets_count }} Unit</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">Sub-Revenue</p>
                                    <p class="text-sm font-black text-emerald-600">Rp {{ number_format($event->orders_sum_total_price ?? 0, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Script for Charts --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('reportTrendChart').getContext('2d');
            
            const labels = @json($salesTrend->pluck('date'));
            const data = @json($salesTrend->pluck('total'));

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Gross Revenue',
                        data: data,
                        backgroundColor: '#4f46e5',
                        borderRadius: 10,
                        barThickness: 20
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { borderDash: [5, 5] } },
                        x: { grid: { display: false } }
                    }
                }
            });
        });
    </script>
</x-app-layout>
