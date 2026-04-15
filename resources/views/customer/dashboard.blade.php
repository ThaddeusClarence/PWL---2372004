<x-app-layout>
    <!-- Fallback CDN untuk memastikan semua class Tailwind berjalan -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F1F5F9; } /* Latar belakang lebih kontras */
        .dashboard-header { background: white; border-bottom: 2px solid #F1F5F9; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        .card-shadow { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02); }
        .btn-primary { background-color: #4f46e5; transition: all 0.2s; }
        .btn-primary:hover { background-color: #4338ca; transform: translateY(-1px); box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4); }
    </style>

    <div class="min-h-screen pb-20">
        {{-- Header Section --}}
        {{-- Modern Floating Header --}}
        <div class="max-w-7xl mx-auto px-4 mt-8">
            <div class="bg-white border border-gray-100 py-8 px-10 rounded-[32px] shadow-[0_30px_100px_-20px_rgba(0,0,0,0.15)] flex flex-col md:flex-row md:items-center justify-between gap-4">
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

        <div class="max-w-7xl mx-auto px-4 mt-12">
            {{-- Available Events for Purchase --}}
            <div class="mb-20">
                <div class="flex justify-between items-end mb-10">
                    <div>
                        <span class="text-indigo-600 font-bold tracking-widest text-xs uppercase mb-2 block">Daftar Event</span>
                        <h2 class="text-3xl font-black text-gray-900 capitalize">Temukan event menarik di sini.</h2>
                    </div>
                </div>

                <div id="event-container" class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @forelse($events as $index => $event)
                    <div class="event-card group bg-white rounded-[40px] border border-gray-100 shadow-[0_35px_80px_-20px_rgba(0,0,0,0.08)] overflow-hidden hover:shadow-[0_50px_120px_-30px_rgba(79,70,229,0.25)] transition-all duration-500 hover:-translate-y-4 {{ $index >= 3 ? 'hidden' : '' }}">
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

                @if($events->count() > 3)
                <div class="flex justify-center mt-12">
                    <button id="toggle-events-btn" class="px-10 py-4 bg-white border-2 border-indigo-600 text-indigo-600 font-black rounded-[24px] uppercase tracking-widest text-xs hover:bg-indigo-600 hover:text-white transition-all shadow-xl shadow-indigo-100/30">
                        Tampilkan Semua Event
                    </button>
                </div>
                @endif
            </div>

            <script>
                document.getElementById('toggle-events-btn')?.addEventListener('click', function() {
                    const cards = document.querySelectorAll('.event-card');
                    const isExpanded = this.dataset.expanded === 'true';

                    if (isExpanded) {
                        // Tutup (Tampilkan hanya 3)
                        cards.forEach((card, index) => {
                            if (index >= 3) card.classList.add('hidden');
                        });
                        this.innerText = 'Tampilkan Semua Event';
                        this.dataset.expanded = 'false';
                        // Scroll up sedikit agar user tidak bingung
                        document.getElementById('event-container').scrollIntoView({ behavior: 'smooth', block: 'start' });
                    } else {
                        // Buka (Tampilkan semua)
                        cards.forEach(card => card.classList.remove('hidden'));
                        this.innerText = 'Tutup Daftar Event';
                        this.dataset.expanded = 'true';
                    }
                });
            </script>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                {{-- Tiket Card --}}
                <div class="bg-white p-10 rounded-[40px] border border-gray-100 shadow-xl shadow-gray-200/20 flex items-center justify-between group hover:border-indigo-200 transition">
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
                <div class="bg-white p-10 rounded-[40px] border border-gray-100 shadow-xl shadow-gray-200/20 flex items-center justify-between group hover:border-indigo-200 transition">
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
                <div class="bg-white rounded-[40px] p-8 border border-gray-100 shadow-xl shadow-gray-200/30 flex flex-col md:flex-row items-center justify-between gap-6 transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-100/50 hover:border-indigo-100">
                    <div class="flex items-center gap-6 w-full md:w-auto">
                        <div class="w-20 h-20 bg-gray-50 rounded-2xl overflow-hidden hidden sm:block">
                            <img src="{{ $ticket->ticketType->event->banner ? asset('storage/' . $ticket->ticketType->event->banner) : 'https://images.unsplash.com/photo-1540575861501-7cf05a4b125a?auto=format&fit=crop&q=80&w=200' }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $ticket->ticketType->event->category }}</span>
                            <h3 class="font-extrabold text-gray-900 text-lg leading-tight">{{ $ticket->ticketType->event->title }}</h3>
                            <p class="text-xs text-indigo-600 font-bold mt-1">{{ \Carbon\Carbon::parse($ticket->ticketType->event->date)->format('d M Y') }} • {{ $ticket->ticketType->name }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 w-full md:w-auto justify-between md:justify-end">
                        <div class="text-right">
                            <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest">Status / Kode</p>
                            <div class="flex flex-col items-end">
                                @if(!$ticket->is_used)
                                    <span class="text-[9px] font-black text-emerald-600 uppercase tracking-widest bg-emerald-50 px-2 py-0.5 rounded-full mb-1">Siap Digunakan</span>
                                @else
                                    <span class="text-[9px] font-black text-red-500 uppercase tracking-widest bg-red-50 px-2 py-0.5 rounded-full mb-1">Sudah Digunakan</span>
                                @endif
                                <p class="text-sm font-bold text-gray-800 tracking-tighter">{{ $ticket->ticket_code }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('checkout.success', $ticket->order_id) }}" class="p-4 bg-indigo-50 text-indigo-600 rounded-2xl hover:bg-indigo-600 hover:text-white transition group">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                            </a>
                            
                            @if($ticket->is_used)
                            <form action="{{ route('customer.tickets.destroy', $ticket->id) }}" method="POST" onsubmit="return confirm('Buang tiket ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-4 bg-red-50 text-red-600 rounded-2xl hover:bg-red-600 hover:text-white transition" title="Buang Tiket">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
            
            <div class="mt-20 space-y-8">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-black text-gray-900 leading-tight">Riwayat Transaksi</h2>
                </div>

                <div class="bg-white rounded-[40px] border border-gray-100 shadow-[0_40px_100px_-30px_rgba(0,0,0,0.1)] overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-50/50 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-50">
                                    <th class="px-10 py-6">Order Information</th>
                                    <th class="px-10 py-6">Total Price</th>
                                    <th class="px-10 py-6">Transaction Status</th>
                                    <th class="px-10 py-6 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($orders as $order)
                                <tr class="hover:bg-gray-50/30 transition group">
                                    <td class="px-10 py-8">
                                        <div class="flex flex-col">
                                            <p class="text-sm font-black text-gray-900 group-hover:text-indigo-600 transition">{{ $order->event->title }}</p>
                                            <p class="text-[10px] font-bold text-gray-400 mt-1 uppercase tracking-tighter">ORDER #{{ $order->id }} • {{ $order->created_at->format('d M Y') }}</p>
                                            
                                            {{-- Status Penggunaan Tiket --}}
                                            @if($order->status == 'paid' && $order->tickets->where('is_used', true)->isNotEmpty())
                                                <span class="mt-2 text-[9px] font-black text-red-500 uppercase tracking-widest flex items-center gap-1">
                                                    <div class="w-1.5 h-1.5 rounded-full bg-red-500"></div>
                                                    Tiket Sudah Digunakan
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-10 py-8 tabular-nums font-bold text-gray-700 text-sm md:table-cell hidden">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-10 py-8">
                                        @if($order->status == 'paid')
                                            <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-emerald-100">PAID</span>
                                        @elseif($order->status == 'pending')
                                            <span class="px-4 py-1.5 bg-amber-50 text-amber-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-amber-100 animate-pulse">PENDING</span>
                                        @else
                                            <span class="px-4 py-1.5 bg-red-50 text-red-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-red-100">FAILED</span>
                                        @endif
                                    </td>
                                    <td class="px-10 py-8 text-right">
                                        <div class="flex items-center justify-end gap-3">
                                            @if($order->status == 'pending')
                                                <a href="{{ route('checkout.payment', $order->id) }}" class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-black transition-all shadow-xl shadow-indigo-100 active:scale-95">
                                                    Bayar
                                                </a>
                                            @elseif($order->status == 'paid')
                                                <a href="{{ route('customer.ticket.show', $order->id) }}" class="inline-block px-6 py-3 bg-emerald-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-black transition-all shadow-xl shadow-emerald-100 active:scale-95">
                                                    LIHAT TIKET
                                                </a>
                                            @endif

                                            {{-- Tombol Hapus Universal --}}
                                            <form action="{{ route('customer.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Hapus riwayat transaksi ini? Jika tiket belum digunakan, data tiket juga akan hilang.')" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-3 bg-gray-50 text-gray-400 hover:bg-red-500 hover:text-white rounded-xl transition-all shadow-sm" title="Hapus Riwayat">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-10 py-20 text-center opacity-30 italic font-bold uppercase tracking-widest text-xs">Belum ada riwayat transaksi</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
