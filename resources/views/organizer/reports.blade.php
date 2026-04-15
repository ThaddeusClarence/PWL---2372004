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
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
                {{-- Sales Graph --}}
                <div class="bg-white p-10 rounded-[45px] shadow-sm border border-gray-100 flex flex-col">
                    <div class="mb-8">
                        <h4 class="text-xl font-black text-gray-900 italic uppercase tracking-tighter">Transaction Growth</h4>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Analisis pertumbuhan pendapatan harian.</p>
                    </div>
                    <div class="h-[300px] w-full">
                        <canvas id="reportTrendChart"></canvas>
                    </div>
                </div>

                {{-- Payment Methods Summary --}}
                <div class="bg-white p-10 rounded-[45px] shadow-sm border border-gray-100 flex flex-col">
                    <div class="mb-8">
                        <h4 class="text-xl font-black text-gray-900 italic uppercase tracking-tighter text-center">Payment Methods</h4>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest text-center">Preferensi cara bayar pembeli.</p>
                    </div>
                    <div class="h-[300px] w-full">
                        <canvas id="reportPaymentChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Event Analytics Full Width --}}
            <div class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100 mb-10">
                <h4 class="text-xl font-black text-gray-900 mb-6 uppercase tracking-widest text-xs italic opacity-50">Per-Event Performance Detail</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($eventPerformance as $event)
                    <div class="p-5 bg-gray-50 rounded-2xl border border-gray-100 hover:border-indigo-100 hover:bg-white transition group">
                        <div class="flex justify-between items-start mb-4">
                            <span class="text-xs font-black text-gray-900 line-clamp-1 group-hover:text-indigo-600 transition">{{ $event->title }}</span>
                        </div>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center text-[10px] font-bold">
                                <span class="text-gray-400 uppercase tracking-tighter">Sold</span>
                                <span class="text-indigo-600">{{ $event->tickets_count }}</span>
                            </div>
                            <div class="flex justify-between items-center text-[10px] font-bold">
                                <span class="text-gray-400 uppercase tracking-tighter">Gross</span>
                                <span class="text-emerald-600">Rp {{ number_format($event->orders_sum_total_price ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    {{-- Script for Charts --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Trend Chart
            const ctxTrend = document.getElementById('reportTrendChart').getContext('2d');
            const labelsTrend = @json($salesTrend->pluck('date_label')->map(fn($d) => date('d M', strtotime($d))));
            const dataTrend = @json($salesTrend->pluck('total_revenue'));

            new Chart(ctxTrend, {
                type: 'line',
                data: {
                    labels: labelsTrend.length > 0 ? labelsTrend : ['No Data'],
                    datasets: [{
                        label: 'Gross Revenue',
                        data: dataTrend.length > 0 ? dataTrend : [0],
                        borderColor: '#4f46e5',
                        borderWidth: 4,
                        fill: false,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            grid: { borderDash: [5, 5] },
                            ticks: { callback: (v) => 'Rp ' + v.toLocaleString(), font: { family: 'Plus Jakarta Sans', weight: 'bold' } }
                        },
                        x: { grid: { display: false }, ticks: { font: { family: 'Plus Jakarta Sans', weight: 'bold' } } }
                    }
                }
            });

            // Payment Distribution Bar Chart (Match Dashboard Style)
            const ctxPayment = document.getElementById('reportPaymentChart').getContext('2d');
            const paymentRawData = @json($paymentStats);
            const targetMethods = ['BCA', 'BNI', 'BRI', 'DANA', 'GoPay'];
            
            const pLabels = targetMethods;
            const pValues = targetMethods.map(m => paymentRawData[m] || 0);

            new Chart(ctxPayment, {
                type: 'bar',
                data: {
                    labels: pLabels,
                    datasets: [{
                        data: pValues,
                        backgroundColor: [
                            'rgba(79, 70, 229, 0.8)', // BCA
                            'rgba(16, 185, 129, 0.8)', // BNI
                            'rgba(59, 130, 246, 0.8)', // BRI
                            'rgba(245, 158, 11, 0.8)', // DANA
                            'rgba(239, 68, 68, 0.8)'   // GoPay
                        ],
                        borderRadius: 12
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { display: false }, ticks: { stepSize: 1, font: { family: 'Plus Jakarta Sans', weight: 'bold' } } },
                        x: { grid: { display: false }, ticks: { font: { family: 'Plus Jakarta Sans', weight: 'bold' } } }
                    }
                }
            });
        });
    </script>
</x-app-layout>
