<x-app-layout>
    <!-- Desain Organizer Dashboard yang Profesional -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        .font-organizer { font-family: 'Plus Jakarta Sans', sans-serif; }
        .stat-card-premium { background: white; border: 1px solid #F1F5F9; transition: all 0.4s; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.05); }
        .stat-card-premium:hover { transform: translateY(-10px); box-shadow: 0 40px 80px -20px rgba(79, 70, 229, 0.12); border-color: #4f46e5; }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #E2E8F0; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #CBD5E1; }
    </style>

    <div class="font-organizer bg-[#F9FAFB] min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Modern Header --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6 bg-white p-8 rounded-[40px] shadow-[0_30px_80px_-20px_rgba(0,0,0,0.1)] border border-gray-100">
                <div>
                    <span class="text-indigo-600 font-bold text-xs uppercase tracking-[0.2em] mb-2 block">Organizer Performance Profile</span>
                    <h2 class="text-4xl font-black text-gray-900 leading-tight tracking-tight">Halo, {{ Auth::user()->name }} Welcome Back 👋</h2>
                    <p class="text-gray-400 font-medium mt-1">Pantau kesuksesan event Anda hari ini melalui dashboard analitik real-time.</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('organizer.reports') }}" class="group relative px-8 py-4 bg-indigo-600 text-white font-black rounded-2xl hover:bg-black transition-all duration-300 shadow-xl shadow-indigo-100 flex items-center gap-3 overflow-hidden">
                        <div class="absolute inset-0 bg-white/10 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                        <svg class="w-5 h-5 z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V5a2 2 0 012-2h2a2 2 0 012 2v12a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        <span class="z-10 text-xs tracking-widest uppercase">Full Reporting</span>
                    </a>
                </div>
                <div class="text-right mr-4 hidden md:block">
                        <p class="text-xs font-bold text-gray-400 uppercase">Status Partner</p>
                        <p class="text-sm font-black text-emerald-600">Terverifikasi ✓</p>
                    </div>
                </div>
            </div>

            {{-- Statistik Utama (Visual Identik Admin) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                
                {{-- Total Pendapatan (Emerald) --}}
                <div class="stat-card-premium p-8 rounded-[32px] flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Pendapatan</p>
                        <h3 class="text-3xl font-black text-gray-900 leading-tight tracking-tight">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                    </div>
                    <p class="text-[10px] font-bold text-emerald-600 mt-4 uppercase tracking-[0.2em] italic underline">Detail Keuangan</p>
                </div>

                {{-- Tiket Terjual (Orange) --}}
                <div class="stat-card-premium p-8 rounded-[32px] flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-600 mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5z"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Tiket Terjual</p>
                        <h3 class="text-3xl font-black text-gray-900 leading-tight tracking-tight">{{ $totalSalesCount }}</h3>
                    </div>
                    <p class="text-[10px] font-bold text-orange-600 mt-4 uppercase tracking-[0.2em]">E-Ticket Aktif</p>
                </div>

                {{-- Event Managed (Indigo) --}}
                <div class="stat-card-premium p-8 rounded-[32px] flex flex-col justify-between border-2 border-indigo-100 bg-indigo-50/10">
                    <div>
                        <div class="w-12 h-12 bg-indigo-600 text-white rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-indigo-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-indigo-400 uppercase tracking-widest mb-1">Event Managed</p>
                        <h3 class="text-3xl font-black text-indigo-600 leading-tight tracking-tight">{{ $totalEvents }}</h3>
                    </div>
                    <p class="text-[10px] font-bold text-indigo-400 mt-4 uppercase tracking-[0.2em] italic">Active Records</p>
                </div>

                {{-- Engagement (Gray/Dark) --}}
                <div class="bg-gray-900 p-8 rounded-[32px] shadow-sm flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 bg-white/10 text-white rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1 italic">Average Performance</p>
                        <h3 class="text-3xl font-black text-white leading-tight tracking-tight">{{ $totalEvents > 0 ? round($totalSalesCount / $totalEvents, 1) : 0 }}</h3>
                    </div>
                    <p class="text-[10px] font-bold text-white/40 mt-4 uppercase tracking-[0.2em]">Sales / Event Rate</p>
                </div>
            </div>

            {{-- Charts & Performance Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mb-12">
                {{-- Sales Trend Chart --}}
                <div class="lg:col-span-2 bg-white p-10 rounded-[40px] shadow-[0_30px_100px_-20px_rgba(0,0,0,0.08)] border border-gray-100 relative group overflow-hidden">
                    <div class="flex justify-between items-center mb-10 z-10 relative">
                        <div>
                            <h3 class="text-xl font-black text-gray-900">Analitik Penjualan (7 Hari)</h3>
                            <p class="text-xs text-gray-400 font-medium mt-1">Tren pendapatan harian dari seluruh event aktif.</p>
                        </div>
                        <div class="flex items-center gap-2">
                             <div class="w-2 h-2 rounded-full bg-indigo-600 animate-pulse"></div>
                             <span class="text-[10px] font-black text-indigo-600 uppercase tracking-widest">LIVE DATA</span>
                        </div>
                    </div>
                    <div class="h-[400px] w-full relative">
                        <canvas id="organizerTrendChart"></canvas>
                        @if($salesTrend->isEmpty())
                            <div class="absolute inset-0 flex items-center justify-center pointer-events-none bg-white/50 z-20">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] text-center">Menunggu Data Penjualan Baru...</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Payment Distribution Chart --}}
                <div class="lg:col-span-1 bg-white p-10 rounded-[40px] shadow-[0_30px_100px_-20px_rgba(0,0,0,0.08)] border border-gray-100 relative group overflow-hidden">
                    <div class="flex justify-between items-center mb-10 z-10 relative">
                        <div>
                            <h3 class="text-xl font-black text-gray-900">Pilihan Pembayaran</h3>
                            <p class="text-xs text-gray-400 font-medium mt-1">Metode yang paling sering digunakan pembeli.</p>
                        </div>
                        <div class="flex items-center gap-2">
                             <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                             <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">DISTRIBUSI</span>
                        </div>
                    </div>
                    <div class="h-[400px] w-full relative flex items-center justify-center">
                        <canvas id="paymentMethodChart"></canvas>
                        @if($paymentDistribution->isEmpty())
                            <div class="absolute inset-0 flex items-center justify-center pointer-events-none bg-white/50 z-20">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] text-center">Belum Ada Data Pembayaran...</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Event Performance Overview Full Width --}}
            <div class="bg-white p-10 rounded-[40px] shadow-sm border border-gray-100 mb-12">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-xl font-black text-gray-900 leading-tight">Performa Event Analytics</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pr-4">
                    @foreach($eventPerformance as $eventPerf)
                    <div class="p-6 bg-gray-50 rounded-3xl group hover:bg-indigo-50 transition duration-300 border border-transparent hover:border-indigo-100">
                        <div class="flex justify-between items-start mb-3">
                            <h4 class="text-sm font-black text-gray-900 group-hover:text-indigo-600 line-clamp-1 transition">{{ $eventPerf['title'] }}</h4>
                            <span class="text-[9px] font-black text-gray-400 opacity-50">#E{{ $eventPerf['id'] }}</span>
                        </div>
                        <div class="flex items-center gap-4 text-[10px] font-bold text-gray-500 uppercase tracking-tighter">
                            <span class="flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-indigo-600"></span> {{ $eventPerf['tickets_sold'] }} Tiket</span>
                            <span class="flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Rp {{ number_format($eventPerf['revenue'], 0, ',', '.') }}</span>
                        </div>
                        <div class="mt-4 w-full bg-gray-200 h-1.5 rounded-full overflow-hidden">
                            @php $percent = $eventPerf['quota'] > 0 ? ($eventPerf['tickets_sold'] / $eventPerf['quota'] * 100) : 0 @endphp
                            <div class="bg-indigo-600 h-full rounded-full transition-all duration-1000" style="width: {{ $percent }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Recent Sales Table - Premium Look --}}
            <div class="bg-white rounded-[40px] border border-gray-100 shadow-[0_40px_120px_-30px_rgba(0,0,0,0.12)] overflow-hidden mb-20">
                <div class="p-10 border-b border-gray-50 flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-black text-gray-900 leading-tight">Penjualan Terbaru ✨</h3>
                        <p class="text-xs text-gray-400 font-medium mt-1 italic italic italic">Daftar transaksi 5 pemesanan terakhir.</p>
                    </div>
                    <a href="{{ route('organizer.reports') }}" class="text-xs font-black text-indigo-600 uppercase tracking-widest hover:underline px-4 py-2 bg-indigo-50 rounded-xl transition">See All Transactions</a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 text-gray-400 text-[10px] font-black uppercase tracking-[0.2em]">
                                <th class="px-10 py-6">Buyer Identity</th>
                                <th class="px-10 py-6">Event Context</th>
                                <th class="px-10 py-6">Timestamp</th>
                                <th class="px-10 py-6 text-right">Revenue</th>
                                <th class="px-10 py-6 text-center">Execution Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($recentSales as $sale)
                            <tr class="hover:bg-gray-50 transition group">
                                <td class="px-10 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-white border border-gray-100 rounded-2xl flex items-center justify-center text-gray-400 font-black shadow-sm group-hover:border-indigo-200 transition">
                                            {{ strtoupper(substr($sale->user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-gray-900 group-hover:text-indigo-600 transition tracking-tighter">{{ $sale->user->name }}</p>
                                            <p class="text-[10px] font-bold text-gray-400 opacity-70">{{ $sale->user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-6">
                                    <p class="text-sm font-black text-gray-700 tracking-tighter line-clamp-1">{{ $sale->event->title }}</p>
                                    <span class="text-[9px] font-black text-gray-400 bg-gray-100 px-2 py-0.5 rounded italic">#ORDER_{{ $sale->id }}</span>
                                </td>
                                <td class="px-10 py-6">
                                    <p class="text-xs font-bold text-gray-600 leading-none italic italic">{{ $sale->created_at->format('d M Y') }}</p>
                                    <p class="text-[10px] font-medium text-gray-400 mt-1 italic italic italic">{{ $sale->created_at->format('H:i') }} WIB</p>
                                </td>
                                <td class="px-10 py-6 text-sm font-black text-gray-900 text-right tabular-nums">
                                    Rp {{ number_format($sale->total_price, 0, ',', '.') }}
                                </td>
                                <td class="px-10 py-6 text-center">
                                    <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 rounded-xl text-[10px] font-black uppercase tracking-widest border border-emerald-100 shadow-sm shadow-emerald-50">
                                        {{ $sale->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-24 text-center text-gray-300 font-black italic tracking-widest uppercase text-xs">Belum Ada Transaksi Tercatat</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Dashboard Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- TREND LINE CHART ---
            const ctxTrend = document.getElementById('organizerTrendChart').getContext('2d');
            const gradientTrend = ctxTrend.createLinearGradient(0, 0, 0, 300);
            gradientTrend.addColorStop(0, 'rgba(79, 70, 229, 0.4)');
            gradientTrend.addColorStop(1, 'rgba(79, 70, 229, 0)');

            const labelsTrend = @json($salesTrend->pluck('date')->map(fn($d) => date('d M', strtotime($d))));
            const dataTrend = @json($salesTrend->pluck('total'));

            new Chart(ctxTrend, {
                type: 'line',
                data: {
                    labels: labelsTrend.length > 0 ? labelsTrend : ['No Data'],
                    datasets: [{
                        label: 'Penjualan Daily',
                        data: dataTrend.length > 0 ? dataTrend : [0],
                        borderColor: '#4f46e5',
                        borderWidth: 4,
                        fill: true,
                        backgroundColor: gradientTrend,
                        tension: 0.45,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#4f46e5',
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 9,
                        pointHoverBorderWidth: 4,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { grid: { display: false }, ticks: { font: { weight: 'bold', family: 'Plus Jakarta Sans', size: 10 } } },
                        y: { 
                            beginAtZero: true, 
                            grid: { color: '#F3F4F6', borderDash: [5, 5] },
                            ticks: { 
                                font: { weight: 'bold', family: 'Plus Jakarta Sans', size: 10 },
                                callback: function(value) { return 'Rp ' + value.toLocaleString(); }
                            }
                        }
                    }
                }
            });

            // --- PAYMENT DISTRIBUTION CHART ---
            const ctxPayment = document.getElementById('paymentMethodChart').getContext('2d');
            const paymentLabels = @json($paymentDistribution->pluck('payment_method_clean'));
            const paymentData = @json($paymentDistribution->pluck('count'));

            new Chart(ctxPayment, {
                type: 'doughnut',
                data: {
                    labels: paymentLabels.length > 0 ? paymentLabels : ['Belum Ada Data'],
                    datasets: [{
                        data: paymentData.length > 0 ? paymentData : [1],
                        backgroundColor: ['#4f46e5', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899'],
                        borderWidth: 0,
                        hoverOffset: 20
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: { 
                            position: 'bottom',
                            labels: {
                                font: { family: 'Plus Jakarta Sans', weight: 'bold', size: 10 },
                                usePointStyle: true,
                                padding: 20
                            }
                        },
                        tooltip: {
                            cornerRadius: 12,
                            padding: 12,
                            titleFont: { family: 'Plus Jakarta Sans', weight: 'bold' },
                            bodyFont: { family: 'Plus Jakarta Sans' }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
