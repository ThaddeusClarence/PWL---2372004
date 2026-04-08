<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event->title }} - EventMaster</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .hero-banner { height: 50vh; min-height: 400px; }
        .glass-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); }
    </style>
</head>
<body class="bg-[#fcfcfd] text-[#1a1c21]">

    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-xl font-extrabold tracking-tight text-gray-900 flex items-center gap-2">
                <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5z"></path></svg>
                </div>
                <span>Event<span class="text-indigo-600">Master</span></span>
            </a>
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-bold text-indigo-600">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-gray-700">Masuk</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="hero-banner relative overflow-hidden">
        <img src="{{ $event->banner ? asset('storage/' . $event->banner) : 'https://images.unsplash.com/photo-1540575861501-7cf05a4b125a?auto=format&fit=crop&q=80&w=1600' }}" 
             class="w-full h-full object-cover" alt="{{ $event->title }}">
        <div class="absolute inset-0 bg-gradient-to-t from-[#fcfcfd] via-transparent to-black/20"></div>
    </div>

    <main class="max-w-7xl mx-auto px-6 -mt-32 relative z-10 pb-24">
        <div class="grid lg:grid-cols-3 gap-10">
            {{-- Bagian Detail Event --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-[40px] p-10 shadow-sm border border-gray-100 mb-8">
                    <div class="flex flex-wrap gap-3 mb-6">
                        <span class="px-4 py-1.5 bg-indigo-50 text-indigo-600 rounded-full text-xs font-extrabold uppercase tracking-wider">{{ $event->category }}</span>
                        <span class="px-4 py-1.5 bg-gray-100 text-gray-600 rounded-full text-xs font-extrabold uppercase tracking-wider">{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-6 leading-tight">{{ $event->title }}</h1>
                    
                    <div class="grid sm:grid-cols-2 gap-8 mb-10 py-8 border-y border-gray-50">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <span class="text-xs font-bold text-gray-400 block">LOKASI</span>
                                <span class="text-sm font-bold text-gray-800">{{ $event->location }}</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <span class="text-xs font-bold text-gray-400 block">WAKTU</span>
                                <span class="text-sm font-bold text-gray-800">{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} WIB</span>
                            </div>
                        </div>
                    </div>

                    <h2 class="text-2xl font-bold mb-4 text-gray-900">Deskripsi Event</h2>
                    <div class="prose prose-indigo max-w-none text-gray-600 font-medium leading-relaxed">
                        {!! nl2br(e($event->description)) !!}
                    </div>
                </div>
            </div>

            {{-- Bagian Pilihan Tiket --}}
            <div class="lg:col-span-1">
                <div class="sticky top-24">
                    <div class="bg-gray-900 rounded-[40px] p-8 text-white shadow-2xl shadow-indigo-200/50">
                        <h2 class="text-2xl font-bold mb-6">Pilih Tiket</h2>
                        
                        <form action="{{ route('checkout.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                            
                            <div class="space-y-4 mb-8">
                                @forelse($event->ticketTypes as $type)
                                <label class="block relative cursor-pointer group">
                                    <input type="radio" name="ticket_type_id" value="{{ $type->id }}" class="peer sr-only" required {{ $type->remaining_quota <= 0 ? 'disabled' : '' }}>
                                    <div class="p-6 rounded-3xl border border-white/10 bg-white/5 transition-all peer-checked:bg-white peer-checked:text-gray-900 peer-checked:border-white group-hover:bg-white/10 {{ $type->remaining_quota <= 0 ? 'opacity-40 grayscale cursor-not-allowed' : '' }}">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="font-bold tracking-wide">{{ $type->name }}</span>
                                            <span class="text-xs font-bold text-gray-400 peer-checked:text-indigo-600">{{ $type->remaining_quota }} Tersisa</span>
                                        </div>
                                        <div class="text-xl font-black">
                                            Rp {{ number_format($type->price, 0, ',', '.') }}
                                        </div>
                                    </div>
                                    @if($type->remaining_quota <= 0)
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="bg-red-500 text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest -rotate-6">Habis Terjual</span>
                                    </div>
                                    @endif
                                </label>
                                @empty
                                <div class="text-center py-6 text-gray-500 font-bold italic">
                                    Tiket belum tersedia.
                                </div>
                                @endforelse
                            </div>

                            @auth
                                <button type="submit" class="w-full bg-indigo-600 hover:bg-white hover:text-indigo-600 text-white py-5 rounded-2xl font-black text-lg transition-all shadow-lg active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed" {{ $event->ticketTypes->isEmpty() ? 'disabled' : '' }}>
                                    Beli Tiket Sekarang
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="w-full block text-center bg-white/10 hover:bg-white text-white hover:text-gray-900 py-5 rounded-2xl font-black text-lg transition-all border border-white/10">
                                    Login untuk Membeli
                                </a>
                            @endauth
                        </form>

                        <div class="mt-6 flex items-center gap-3 text-xs font-bold text-gray-400 justify-center">
                            <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.9L10 1.554 17.834 4.9c.42.18.736.56.884 1.01.148.45.158.913.028 1.363l-1.352 4.673c-.234.808-.574 1.57-1.013 2.277a11.14 11.14 0 01-1.636 2.052 11.233 11.233 0 01-2.052 1.636 10.974 10.974 0 01-2.277 1.013L10 19.34a.75.75 0 01-.5 0L8.604 18.92a10.978 10.978 0 01-2.277-1.013 11.23 11.23 0 01-3.688-3.688 11.14 11.14 0 01-1.013-2.277l-1.352-4.673a2.25 2.25 0 01.912-2.373zM10 3.013L3.896 5.617a.75.75 0 00-.31.791l1.352 4.673c.189.65.467 1.272.825 1.848.336.541.745 1.04 1.218 1.488a9.73 9.73 0 001.623 1.295 9.475 9.475 0 001.396.677 9.475 9.475 0 001.396-.677 9.73 9.73 0 001.623-1.295 9.728 9.728 0 001.218-1.488 9.64 9.64 0 00.825-1.848l1.352-4.673a.75.75 0 00-.31-.791L10 3.013zM10 7a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 7zm0 6.5a.875.875 0 100-1.75.875.875 0 000 1.75z" clip-rule="evenodd" /></svg>
                            Jaminan Pembayaran Aman
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white py-12 border-t border-gray-100 mt-24">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-gray-400 text-sm font-bold tracking-wider uppercase">&copy; 2026 EventMaster. Semua Hak Dilindungi.</p>
        </div>
    </footer>
</body>
</html>
