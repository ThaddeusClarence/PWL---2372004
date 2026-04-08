<x-app-layout>
    <!-- Pastikan desain admin selalu premium dan stabil -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        .admin-font { font-family: 'Plus Jakarta Sans', sans-serif; }
        .stat-card { background: white; border: 1px solid #f0f2f5; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .stat-card:hover { border-color: #4f46e5; transform: translateY(-3px); box-shadow: 0 12px 20px -5px rgba(0, 0, 0, 0.04); }
        .badge { font-weight: 800; text-transform: uppercase; font-size: 0.65rem; border-radius: 8px; }
    </style>

    <div class="admin-font bg-[#fbfcfd] min-h-screen pb-20">
        
        {{-- Dashboard Header --}}
        <div class="bg-white border-b border-gray-100 py-10 mb-10 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
                <div>
                    <span class="text-indigo-600 font-bold text-xs uppercase tracking-[0.2em] mb-2 block">Admin Control Center</span>
                    <h2 class="text-3xl font-black text-gray-900 leading-tight">Analitik Real-Time</h2>
                    <p class="text-gray-400 font-medium mt-1">Pantau performa platform EventMaster Anda hari ini.</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="bg-indigo-50 text-indigo-700 px-4 py-2 rounded-xl text-xs font-bold border border-indigo-100">
                        🛡️ Mode: Administrator Utama
                    </span>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Statistik Utama --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <div class="stat-card p-8 rounded-[32px] flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Pengguna</p>
                        <h3 class="text-3xl font-black text-gray-900">{{ $totalUsers }}</h3>
                    </div>
                    <p class="text-xs font-bold text-green-500 mt-4 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L10 10.586 13.586 7H12z" clip-rule="evenodd"></path></svg>
                        {{ $totalCustomer }} Customer
                    </p>
                </div>

                <div class="stat-card p-8 rounded-[32px] flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Pendapatan</p>
                        <h3 class="text-3xl font-black text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                    </div>
                    <p class="text-xs font-bold text-indigo-500 mt-4 underline">Detail Keuangan</p>
                </div>

                <div class="stat-card p-8 rounded-[32px] flex flex-col justify-between border-2 border-indigo-100 bg-indigo-50/10">
                    <div>
                        <div class="w-12 h-12 bg-indigo-600 text-white rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-indigo-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-indigo-400 uppercase tracking-widest mb-1">Event Aktif</p>
                        <h3 class="text-3xl font-black text-indigo-600">{{ $activeEvents }}</h3>
                    </div>
                    <p class="text-xs font-medium text-indigo-400 mt-4 italic">Berlangsung Saat Ini</p>
                </div>

                <div class="stat-card p-8 rounded-[32px] flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-600 mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5z"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Tiket Terjual</p>
                        <h3 class="text-3xl font-black text-gray-900">{{ $totalTickets }}</h3>
                    </div>
                    <p class="text-xs font-bold text-orange-600 mt-4 flex items-center gap-1">E-Ticket Aktif</p>
                </div>

                <div class="stat-card p-8 rounded-[32px] flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m4 0h1m-5 10h5m-5 4h5m2-24v18a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2z"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Penyelenggara</p>
                        <h3 class="text-3xl font-black text-gray-900">{{ $totalOrganizer }}</h3>
                    </div>
                    <p class="text-xs font-bold text-blue-600 mt-4 flex items-center gap-1">Status: Terverifikasi</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                {{-- Chart Section --}}
                <div class="lg:col-span-2 bg-white p-10 rounded-[40px] border border-gray-100 shadow-sm">
                    <div class="flex justify-between items-center mb-10">
                        <h3 class="text-xl font-black text-gray-900">Pertumbuhan User 📈</h3>
                        <select class="text-xs border-none bg-gray-50 rounded-lg py-2 pl-3 pr-8 font-bold text-gray-500 outline-none">
                            <option>7 Hari Terakhir</option>
                            <option>30 Hari Terakhir</option>
                        </select>
                    </div>
                    <div class="h-[300px] w-full">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="lg:col-span-1 space-y-8">
                    <div class="bg-gray-900 p-10 rounded-[40px] text-white shadow-2xl shadow-indigo-100">
                        <h3 class="text-xl font-black mb-6 leading-tight">Control Center ⚡</h3>
                        <div class="space-y-4">
                        <a href="{{ route('scan.view') }}" class="block w-full text-center bg-indigo-600 hover:bg-white hover:text-indigo-600 py-5 rounded-2xl text-xs font-black uppercase tracking-widest transition shadow-lg active:scale-95">Verify Ticket Scan</a>
                        <a href="{{ route('admin.events.create') }}" class="block w-full text-center bg-white/10 hover:bg-white/20 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition">Buat Event Baru</a>
                        <a href="{{ route('admin.events.index') }}" class="block w-full text-center bg-white/10 hover:bg-white/20 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition">Kelola Semua Event</a>
                        <a href="{{ route('admin.organizers.index') }}" class="block w-full text-center bg-white/10 hover:bg-white/20 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition border-2 border-indigo-500/20">Manajemen Organizer</a>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-[40px] border border-gray-100 text-center">
                        <div class="w-14 h-14 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2 text-lg">Laporan PDF</h4>
                        <p class="text-xs text-gray-400 mb-8 font-medium">Export data pengguna terbaru untuk keperluan pelaporan.</p>
                        
                        @if (Route::has('admin.export.pdf'))
                            <div class="grid grid-cols-2 gap-3 mt-8">
                                <a href="{{ route('admin.export.pdf') }}" class="py-4 text-center border-2 border-red-50 text-red-600 bg-red-50/30 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-red-50 transition">
                                    PDF Report
                                </a>
                                <a href="{{ route('admin.export.excel') }}" class="py-4 text-center border-2 border-emerald-50 text-emerald-600 bg-emerald-50/30 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-emerald-50 transition">
                                    Excel Report
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Recent Users Table --}}
            <div class="mt-12 bg-white rounded-[40px] border border-gray-100 shadow-sm overflow-hidden mb-20">
                <div class="p-10 border-b border-gray-50 flex justify-between items-center">
                    <h3 class="text-2xl font-black text-gray-900 leading-none">Pengguna Terbaru ✨</h3>
                    <button class="text-sm font-bold text-indigo-600 hover:underline">Lihat Semua User</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50/50 text-gray-400 text-[10px] font-black uppercase tracking-[0.2em]">
                                <th class="px-10 py-6">Informasi User</th>
                                <th class="px-10 py-6">Peran Akun</th>
                                <th class="px-10 py-6">Tanggal Bergabung</th>
                                <th class="px-10 py-6">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($recentUsers as $user)
                            <tr class="hover:bg-gray-50/30 transition">
                                <td class="px-10 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-11 h-11 bg-indigo-50 rounded-xl flex items-center justify-center font-bold text-indigo-600 text-xs">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900 leading-tight">{{ $user->name }}</p>
                                            <p class="text-xs text-gray-400 font-medium mt-0.5">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-6">
                                    <span class="badge px-3 py-1.5 {{ $user->role == 'admin' ? 'bg-red-50 text-red-600' : ($user->role == 'organizer' ? 'bg-blue-50 text-blue-600' : 'bg-green-50 text-green-600') }}">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="px-10 py-6">
                                    <p class="text-sm font-bold text-gray-600 leading-none">{{ $user->created_at->format('d M Y') }}</p>
                                    <p class="text-[10px] text-gray-400 font-medium mt-1">{{ $user->created_at->format('H:i') }} WIB</p>
                                </td>
                                <td class="px-10 py-6">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-green-500 shadow-sm shadow-green-200"></div>
                                        <span class="text-xs font-bold text-gray-600">Aktif</span>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-10 py-20 text-center text-gray-300 italic font-medium">Belum ada data pengguna yang terdaftar.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Script Chart.js dengan Desain Gradient --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('salesChart');
            
            // Membuat Gradient untuk Chart
            const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(79, 70, 229, 0.4)');
            gradient.addColorStop(1, 'rgba(79, 70, 229, 0.02)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                    datasets: [{
                        label: 'Registrasi User',
                        data: [0, 0, 0, 0, 1, 3, {{ $totalUsers }}],
                        borderColor: '#4f46e5',
                        borderWidth: 4,
                        fill: true,
                        backgroundColor: gradient,
                        tension: 0.4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#4f46e5',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            grid: { color: '#f5f5f5' },
                            ticks: { 
                                font: { weight: 'bold', family: 'Plus Jakarta Sans' },
                                stepSize: 1
                            }
                        },
                        x: { grid: { display: false } }
                    }
                }
            });
        });
    </script>
</x-app-layout>