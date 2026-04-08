<x-app-layout>
    <!-- Fallback CDN untuk memastikan semua class Tailwind berjalan -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .dashboard-header { background: white; border-bottom: 1px solid #e2e8f0; }
        .card-shadow { box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06); }
        .btn-primary { background-color: #4f46e5; transition: all 0.2s; }
        .btn-primary:hover { background-color: #4338ca; transform: translateY(-1px); }
    </style>

    <div class="min-h-screen pb-20">
        {{-- Header Section --}}
        <div class="bg-white border-b border-gray-200 py-8 px-4 mb-8">
            <div class="max-w-5xl mx-auto flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-extrabold text-gray-900">Halo, {{ Auth::user()->name }} 👋</h1>
                    <p class="text-sm text-gray-500 mt-1">Selamat datang di pusat manajemen event Anda.</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-indigo-600 uppercase tracking-widest">Customer Akun</p>
                        <p class="text-sm font-medium text-gray-900">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-5xl mx-auto px-4">
            {{-- Available Events for Purchase --}}
            <div class="mb-20">
                <div class="flex justify-between items-end mb-10">
                    <div>
                        <span class="text-indigo-600 font-bold tracking-widest text-xs uppercase mb-2 block">Daftar Event</span>
                        <h2 class="text-3xl font-black text-gray-900 capitalize">Temukan event menarik di sini.</h2>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @forelse($events as $event)
                    <div class="group bg-white rounded-[32px] border border-gray-100 shadow-sm overflow-hidden hover:shadow-2xl hover:shadow-indigo-100/50 transition-all duration-500 hover:-translate-y-2">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ $event->banner ? asset('storage/' . $event->banner) : 'https://images.unsplash.com/photo-1540575861501-7cf05a4b125a?auto=format&fit=crop&q=80&w=800' }}" 
                                 class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                            <div class="absolute top-4 right-4 px-3 py-1 bg-white/90 backdrop-blur-md rounded-full text-[10px] font-black text-indigo-600 shadow-sm uppercase tracking-wider">
                                {{ $event->category }}
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-3 text-gray-900 group-hover:text-indigo-600 transition truncate">{{ $event->title }}</h3>
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-8 h-8 rounded-lg bg-indigo-50 flex flex-col items-center justify-center text-indigo-600 border border-indigo-100">
                                    <span class="text-[8px] font-bold leading-none">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                                    <span class="text-[10px] font-black leading-none">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
                                </div>
                                <span class="text-xs font-bold text-gray-400 italic truncate">{{ $event->location }}</span>
                            </div>
                            <div class="flex justify-between items-center pt-4 border-t border-gray-50">
                                <div>
                                    <span class="text-[10px] font-bold text-gray-300 block">START FROM</span>
                                    <span class="text-lg font-black text-indigo-600">Rp{{ number_format($event->price, 0, ',', '.') }}</span>
                                </div>
                                <a href="{{ route('events.show', $event->id) }}" class="p-4 bg-gray-900 rounded-2xl text-white hover:bg-indigo-600 transition-all active:scale-90">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-3 text-center py-10 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-100">
                        <p class="text-gray-400 font-bold italic">Maaf, belum ada event yang dibuka.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                {{-- Tiket Card --}}
                <div class="bg-white p-8 rounded-3xl border border-gray-100 card-shadow flex items-center justify-between">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Tiket Aktif</h3>
                            <p class="text-xs text-gray-400 font-medium">Siap untuk digunakan</p>
                        </div>
                    </div>
                    <span class="text-4xl font-black text-indigo-600">{{ $activeTicketCount }}</span>
                </div>

                {{-- Riwayat Card --}}
                <div class="bg-white p-8 rounded-3xl border border-gray-100 card-shadow flex items-center justify-between">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Selesai</h3>
                            <p class="text-xs text-gray-400 font-medium">Riwayat event Anda</p>
                        </div>
                    </div>
                    <span class="text-4xl font-black text-gray-300">{{ $usedTicketCount }}</span>
                </div>
            </div>

            @if($tickets->count() > 0)
            <div class="space-y-6">
                <h2 class="text-xl font-black text-gray-900">Tiket Milik Saya</h2>
                @foreach($tickets as $ticket)
                <div class="bg-white rounded-3xl p-6 border border-gray-100 card-shadow flex flex-col md:flex-row items-center justify-between gap-6 transition hover:border-indigo-100">
                    <div class="flex items-center gap-6 w-full md:w-auto">
                        <div class="w-20 h-20 bg-gray-50 rounded-2xl overflow-hidden hidden sm:block">
                            <img src="{{ $ticket->event->banner ? asset('storage/' . $ticket->event->banner) : 'https://images.unsplash.com/photo-1540575861501-7cf05a4b125a?auto=format&fit=crop&q=80&w=200' }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $ticket->event->category }}</span>
                            <h3 class="font-extrabold text-gray-900 text-lg leading-tight">{{ $ticket->event->title }}</h3>
                            <p class="text-xs text-indigo-600 font-bold mt-1">{{ \Carbon\Carbon::parse($ticket->event->date)->format('d M Y') }} • {{ $ticket->ticketType->name }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 w-full md:w-auto justify-between md:justify-end">
                        <div class="text-right">
                            <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest">KODE TIKET</p>
                            <p class="text-sm font-bold text-gray-800 tracking-tighter">{{ $ticket->ticket_code }}</p>
                        </div>
                        <a href="{{ route('checkout.success', $ticket->order_id) }}" class="p-4 bg-indigo-50 text-indigo-600 rounded-2xl hover:bg-indigo-600 hover:text-white transition group">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            {{-- Empty State Content --}}
            <div class="bg-white rounded-[40px] p-16 text-center border border-gray-100 card-shadow">
                <div class="w-20 h-20 bg-gray-50 rounded-3xl flex items-center justify-center mx-auto mb-8">
                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <h2 class="text-2xl font-black text-gray-900 mb-3">Wah, Belum Ada Event Nih!</h2>
                <p class="text-gray-400 font-medium max-w-sm mx-auto mb-10 leading-relaxed">Jangan biarkan harimu membosankan. Temukan berbagai event menarik di sekitarmu sekarang.</p>
                <a href="{{ url('/') }}#explore" class="btn-primary px-12 py-4 text-white font-bold rounded-2xl shadow-lg shadow-indigo-100">
                    Jelajah Event Sekarang
                </a>
            </div>
            @endif
            
            {{-- Promo Section --}}
            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 bg-gray-900 p-10 rounded-[40px] text-white flex flex-col justify-center">
                    <h3 class="text-2xl font-black mb-2">Diskon Khusus Customer Baru!</h3>
                    <p class="text-gray-400 text-sm mb-6">Dapatkan potongan 20% untuk transaksi pertamamu.</p>
                    <div class="flex items-center gap-3">
                        <span class="px-4 py-2 bg-white/10 rounded-xl font-bold text-xs">KODE: FIRSTIKET</span>
                        <button class="text-xs font-bold text-indigo-400 hover:text-indigo-300">Salin Kode</button>
                    </div>
                </div>
                <div class="bg-indigo-600 p-10 rounded-[40px] text-white text-center">
                    <p class="text-4xl font-black mb-2">1.250</p>
                    <p class="text-xs font-bold uppercase tracking-widest opacity-70">Poin Reward</p>
                    <button class="mt-6 w-full py-3 bg-white/20 rounded-2xl text-xs font-bold">Tukar Poin</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
