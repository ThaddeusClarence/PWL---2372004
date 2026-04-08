<x-app-layout>
    <!-- Desain Organizer Dashboard yang Profesional -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        .font-organizer { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    <div class="font-organizer bg-[#F9FAFB] min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Modern Header --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6 bg-white p-8 rounded-[40px] shadow-sm border border-gray-100">
                <div>
                    <span class="text-indigo-600 font-bold text-xs uppercase tracking-[0.2em] mb-2 block">Organizer Performance Profile</span>
                    <h2 class="text-4xl font-black text-gray-900 leading-tight tracking-tight">Halo, {{ Auth::user()->name }} Welcome Back 👋</h2>
                    <p class="text-gray-400 font-medium mt-1">Pantau kesuksesan event Anda hari ini melalui dashboard analitik real-time.</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="text-right mr-4 hidden md:block">
                        <p class="text-xs font-bold text-gray-400 uppercase">Status Partner</p>
                        <p class="text-sm font-black text-emerald-600">Terverifikasi ✓</p>
                    </div>
                    <button class="px-8 py-4 bg-gray-900 text-white font-black rounded-2xl hover:bg-black transition-all shadow-xl active:scale-95 flex items-center gap-2 uppercase text-xs tracking-widest">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                        Create Event
                    </button>
                </div>
            </div>

            {{-- Stats Grid with Dynamic Colors --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <div class="bg-indigo-600 p-8 rounded-[40px] shadow-2xl shadow-indigo-100 flex flex-col justify-between group overflow-hidden relative">
                    <div class="z-10 relative">
                        <p class="text-xs font-bold text-indigo-100 uppercase tracking-widest mb-1 opacity-80 italic">Penghasilan Total</p>
                        <h3 class="text-3xl font-black text-white leading-none">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                    </div>
                    <div class="mt-8 z-10 relative">
                        <span class="text-[10px] font-black bg-white/20 text-white px-3 py-1 rounded-full uppercase italic">Payout Available</span>
                    </div>
                    <div class="absolute -right-4 -bottom-4 opacity-10 group-hover:scale-110 transition duration-500">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[40px] border border-gray-100 shadow-sm flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5z"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Tiket Konfirmasi</p>
                        <h3 class="text-3xl font-black text-gray-900">{{ $totalSalesCount }}</h3>
                    </div>
                    <p class="text-[10px] font-bold text-blue-500 mt-4 uppercase">View Sales Report ➔</p>
                </div>

                <div class="bg-white p-8 rounded-[40px] border border-gray-100 shadow-sm flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 bg-pink-50 text-pink-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-pink-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Event Managed</p>
                        <h3 class="text-3xl font-black text-gray-900">{{ $totalEvents }}</h3>
                    </div>
                    <p class="text-[10px] font-bold text-pink-500 mt-4 uppercase">My Events ➔</p>
                </div>

                <div class="bg-gray-900 p-8 rounded-[40px] shadow-sm flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 bg-white/10 text-white rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1 italic">Engagement</p>
                        <h3 class="text-3xl font-black text-white">{{ $totalEvents > 0 ? round($totalSalesCount / $totalEvents, 1) : 0 }}</h3>
                    </div>
                    <p class="text-[10px] font-bold text-white/40 mt-4 uppercase tracking-[0.2em]">Avg Sales/Event</p>
                </div>
            </div>

            {{-- Charts & Performance Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mb-12">
                {{-- Sales Trend Chart --}}
                <div class="lg:col-span-2 bg-white p-10 rounded-[40px] shadow-sm border border-gray-100 relative group overflow-hidden">
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
                    <div class="h-[320px] w-full">
                        <canvas id="organizerTrendChart"></canvas>
                    </div>
                </div>

                {{-- Event Performance Overview --}}
                <div class="lg:col-span-1 bg-white p-10 rounded-[40px] shadow-sm border border-gray-100 flex flex-col">
                    <h3 class="text-xl font-black text-gray-900 mb-8 leading-tight">Performa Event 📊</h3>
                    <div class="space-y-6 flex-1 overflow-y-auto max-h-[350px] pr-2 custom-scrollbar">
                        @foreach($eventPerformance as $eventPerf)
                        <div class="p-5 bg-gray-50 rounded-3xl group hover:bg-indigo-50 transition duration-300">
                            <div class="flex justify-between items-start mb-3">
                                <h4 class="text-sm font-black text-gray-900 group-hover:text-indigo-600 line-clamp-1 transition">{{ $eventPerf['title'] }}</h4>
                                <span class="text-[10px] font-black text-gray-400 italic">ID#{{ substr(md5($eventPerf['title']), 0, 4) }}</span>
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
                    <a href="{{ route('admin.export.excel') }}" class="mt-8 block text-center py-4 w-full bg-indigo-600 text-white font-black rounded-2xl text-[10px] uppercase tracking-widest hover:bg-black transition shadow-lg">
                        Generate Excel Report
                    </a>
                </div>
            </div>

            {{-- Recent Sales Table - Premium Look --}}
            <div class="bg-white rounded-[40px] border border-gray-100 shadow-sm overflow-hidden mb-20">
                <div class="p-10 border-b border-gray-50 flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-black text-gray-900 leading-tight">Penjualan Terbaru ✨</h3>
                        <p class="text-xs text-gray-400 font-medium italic mt-1 italic italic">Daftar transaksi 5 pemesanan terakhir.</p>
                    </div>
                    <button class="text-xs font-black text-indigo-600 uppercase tracking-widest hover:underline px-4 py-2 bg-indigo-50 rounded-xl transition">See All Transactions</button>
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
            const ctx = document.getElementById('organizerTrendChart').getContext('2d');
            
            // Prepare Gradient
            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(79, 70, 229, 0.4)');
            gradient.addColorStop(1, 'rgba(79, 70, 229, 0)');

            // Data from Backend
            const labels = @json($salesTrend->pluck('date')->map(fn($d) => date('d M', strtotime($d))));
            const data = @json($salesTrend->pluck('total'));

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels.length > 0 ? labels : ['No Data'],
                    datasets: [{
                        label: 'Penjualan Daily',
                        data: data.length > 0 ? data : [0],
                        borderColor: '#4f46e5',
                        borderWidth: 4,
                        fill: true,
                        backgroundColor: gradient,
                        tension: 0.45,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#4f46e5',
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 9,
                        pointHoverBorderWidth: 4,
                        cubicInterpolationMode: 'monotone'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#111827',
                            padding: 12,
                            titleFont: { size: 14, family: 'Plus Jakarta Sans', weight: 'bold' },
                            bodyFont: { size: 13, family: 'Plus Jakarta Sans' },
                            cornerRadius: 12,
                            displayColors: false
                        }
                    },
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
        });
    </script>
</x-app-layout>
