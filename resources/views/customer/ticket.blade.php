<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        .font-ticket { font-family: 'Plus Jakarta Sans', sans-serif; }
        @media print {
            .no-print { display: none; }
            body { background: white; }
            .ticket-card { box-shadow: none !important; border: 1px solid #eee !important; }
        }
    </style>

    <div class="font-ticket bg-[#F9FAFB] min-h-screen py-12 px-4">
        <div class="max-w-xl mx-auto">
            <div class="flex justify-between items-center mb-8 no-print">
                <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-indigo-600 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                    Kembali ke Dashboard
                </a>
                <button onclick="window.print()" class="px-6 py-2 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl text-xs flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    CETAK TIKET
                </button>
            </div>

            {{-- Digital Ticket Display --}}
            <div class="bg-white rounded-[40px] shadow-[0_40px_100px_-20px_rgba(0,0,0,0.1)] overflow-hidden border border-gray-100 ticket-card">
                {{-- Event Banner Mock --}}
                <div class="h-48 bg-indigo-600 relative flex items-center justify-center overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent z-10"></div>
                    @if($order->event->banner)
                        <img src="{{ asset('storage/' . $order->event->banner) }}" class="absolute inset-0 w-full h-full object-cover">
                    @endif
                    <div class="z-20 text-center px-6">
                        <span class="px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-[10px] font-black text-white uppercase tracking-widest mb-3 inline-block">Official E-Ticket</span>
                        <h1 class="text-2xl font-black text-white leading-tight">{{ $order->event->title }}</h1>
                    </div>
                </div>

                {{-- Ticket Info --}}
                <div class="p-10">
                    <div class="grid grid-cols-2 gap-8 mb-10 pb-8 border-b border-gray-50">
                        <div>
                            <p class="text-[10px] uppercase font-black text-gray-400 tracking-widest mb-1">Tanggal & Waktu</p>
                            <p class="text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($order->event->date)->format('d F Y') }}</p>
                            <p class="text-xs font-medium text-gray-500">{{ $order->event->start_time }} WIB</p>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase font-black text-gray-400 tracking-widest mb-1">Lokasi</p>
                            <p class="text-sm font-bold text-gray-900">{{ $order->event->location }}</p>
                        </div>
                    </div>

                    <div class="flex flex-col items-center justify-center py-10 bg-gray-50 rounded-[32px] border-2 border-dashed border-gray-200">
                        @if($order->tickets->count() > 0)
                            <p class="text-[10px] uppercase font-black text-indigo-600 tracking-[0.3em] mb-6 italic">Scan barcode untuk verifikasi</p>
                            
                            <div class="bg-white p-6 rounded-3xl shadow-xl mb-6">
                                {!! QrCode::size(200)->generate($order->tickets->first()->ticket_code) !!}
                            </div>

                            <div class="text-center">
                                <p class="text-[10px] uppercase font-black text-gray-400 tracking-widest mb-1">Kode Unik Tiket</p>
                                <p class="text-xl font-black text-indigo-600 tracking-[0.2em]">{{ $order->tickets->first()->ticket_code }}</p>
                            </div>
                        @else
                            <div class="text-center p-10">
                                <div class="w-16 h-16 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                </div>
                                <h3 class="text-lg font-black text-gray-900">Tiket Belum Siap</h3>
                                <p class="text-xs text-gray-500 mt-2">Data tiket sedang diproses oleh sistem. Silakan refresh halaman ini dalam beberapa saat.</p>
                            </div>
                        @endif
                    </div>

                    <div class="mt-10 pt-8 border-t border-gray-50 flex justify-between items-center">
                        <div>
                            <p class="text-[10px] uppercase font-black text-gray-400 tracking-widest mb-1">Nama Pemilik</p>
                            <p class="text-sm font-bold text-gray-900">{{ $order->user->name }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] uppercase font-black text-gray-400 tracking-widest mb-1">Jenis Tiket</p>
                            <p class="text-sm font-bold text-gray-900 uppercase">
                                {{ $order->tickets->count() > 0 ? $order->tickets->first()->ticketType->name : 'N/A' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Footer Info --}}
                <div class="bg-gray-900 py-4 px-10 text-center">
                    <p class="text-[10px] font-bold text-white/40 uppercase tracking-widest italic">Validated by EventMaster Ticketing System</p>
                </div>
            </div>

            <p class="text-center text-xs text-gray-400 mt-8 font-medium">
                Saran: Siapkan tangkapan layar (screenshot) tiket ini jika koneksi internet di lokasi event tidak stabil.
            </p>
        </div>
    </div>
</x-app-layout>
