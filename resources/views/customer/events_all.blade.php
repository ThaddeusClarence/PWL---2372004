<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8FAFC; }
    </style>

    <div class="min-h-screen pb-20">
        {{-- Header --}}
        <div class="bg-white border-b border-gray-100 py-12 mb-12 shadow-sm">
            <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
                <div>
                    <a href="{{ route('customer.dashboard') }}" class="text-xs font-bold text-gray-400 hover:text-indigo-600 flex items-center gap-2 mb-4 transition uppercase tracking-widest">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                        Kembali ke Dashboard
                    </a>
                    <h1 class="text-4xl font-black text-gray-900 leading-tight">Jelajahi Semua Event</h1>
                    <p class="text-gray-400 font-medium mt-1">Temukan daftar lengkap seluruh event, baik yang aktif maupun yang sudah terlaksana.</p>
                </div>
                <div class="bg-indigo-50 px-6 py-4 rounded-3xl border border-indigo-100">
                    <span class="text-lg font-black text-indigo-600">{{ $events->total() }}</span>
                    <span class="text-xs font-bold text-indigo-400 uppercase tracking-widest ml-1">Total Event</span>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6">
            {{-- Search/Filter Simulation --}}
            <div class="mb-12 flex flex-wrap gap-4">
                <div class="flex-1 min-w-[300px] relative">
                    <input type="text" placeholder="Cari judul event atau lokasi..." class="w-full pl-12 pr-6 py-4 bg-white border border-gray-100 rounded-2xl shadow-sm focus:ring-4 focus:ring-indigo-50 outline-none transition font-medium text-gray-700">
                    <svg class="w-5 h-5 absolute left-5 top-1/2 -translate-y-1/2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <button class="px-8 py-4 bg-gray-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-indigo-600 transition shadow-lg active:scale-95">Filter</button>
            </div>

            {{-- Event Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($events as $event)
                @php
                    $isPast = \Carbon\Carbon::parse($event->date)->isPast();
                @endphp
                <div class="group bg-white rounded-[40px] border border-gray-100 shadow-[0_30px_60px_-15px_rgba(0,0,0,0.05)] overflow-hidden hover:shadow-[0_40px_100px_-20px_rgba(79,70,229,0.15)] transition-all duration-500 {{ $isPast ? 'grayscale-[0.5] opacity-80' : '' }}">
                    <div class="relative h-60 overflow-hidden">
                        <img src="{{ $event->banner ? asset('storage/' . $event->banner) : 'https://images.unsplash.com/photo-1540575861501-7cf05a4b125a?auto=format&fit=crop&q=80&w=800' }}" 
                             class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        
                        <div class="absolute top-4 right-4 px-3 py-1 bg-white/90 backdrop-blur-md rounded-full text-[10px] font-black text-indigo-600 shadow-sm uppercase tracking-wider">
                            {{ $event->category }}
                        </div>

                        @if($isPast)
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                            <span class="px-6 py-2 bg-red-500 text-white text-[10px] font-black rounded-full uppercase tracking-[0.2em] -rotate-12 shadow-xl">Event Selesai</span>
                        </div>
                        @endif
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-extrabold mb-3 text-gray-900 group-hover:text-indigo-600 transition truncate">{{ $event->title }}</h3>
                        
                        <div class="flex items-center gap-4 mb-8">
                            <div class="flex flex-col items-center justify-center w-12 h-12 rounded-2xl bg-indigo-50 border border-indigo-100 text-indigo-600">
                                <span class="text-[8px] font-black leading-none uppercase">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                                <span class="text-[14px] font-black leading-none">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest leading-none mb-1">Lokasi</p>
                                <p class="text-xs font-bold text-gray-500 italic truncate max-w-[150px]">{{ $event->location }}</p>
                            </div>
                        </div>

                        <div class="flex justify-between items-center pt-6 border-t border-gray-50">
                            <div>
                                <p class="text-[9px] font-black text-gray-300 uppercase tracking-widest leading-none mb-1">Tiket Mulai</p>
                                <p class="text-xl font-black text-gray-900">Rp{{ number_format($event->price, 0, ',', '.') }}</p>
                            </div>
                            <a href="{{ route('events.show', $event->id) }}" class="p-4 {{ $isPast ? 'bg-gray-100 text-gray-400 pointer-events-none' : 'bg-gray-900 text-white hover:bg-indigo-600' }} rounded-2xl transition-all active:scale-90">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-20">
                {{ $events->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
