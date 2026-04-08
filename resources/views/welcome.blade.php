<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventMaster - Solusi Manajemen Event Premium</title>
    <!-- CSS & Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; scroll-behavior: smooth; }
        .text-prime { color: #1a1c21; }
        .bg-soft { background-color: #fbfcfd; }
        .glass-nav { background: rgba(251, 252, 253, 0.8); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(229, 231, 235, 0.5); }
        .hero-gradient { background: radial-gradient(circle at 50% 50%, #eff6ff 0%, #fbfcfd 100%); }
        .feature-card { background: white; border: 1px solid #f0f2f5; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 20px 50px -12px rgba(0, 0, 0, 0.05); }
        .feature-card:hover { transform: translateY(-12px); border-color: #4f46e5; box-shadow: 0 40px 80px -15px rgba(79, 70, 229, 0.15); }
        .btn-premium { background: #1a1c21; color: white; transition: all 0.3s; }
        .btn-premium:hover { background: #4f46e5; transform: scale(1.02); box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.3); }
    </style>
</head>
<body class="bg-soft text-prime selection:bg-indigo-100 selection:text-indigo-900 overflow-x-hidden">

    <!-- Navbar -->
    <nav class="glass-nav sticky top-0 z-[100] px-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center h-24">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5z"></path></svg>
                </div>
                <span class="text-2xl font-black tracking-tight text-gray-900 border-none bg-none">Event<span class="text-indigo-600">Master</span></span>
            </div>

            <div class="hidden md:flex gap-12 text-sm font-bold text-gray-400">
                <a href="#features" class="hover:text-indigo-600 transition tracking-wide uppercase text-[10px]">Layanan</a>
                <a href="#process" class="hover:text-indigo-600 transition tracking-wide uppercase text-[10px]">Alur Kerja</a>
                <a href="#" class="hover:text-indigo-600 transition tracking-wide uppercase text-[10px]">Hubungi Kami</a>
            </div>

            <div class="flex gap-4 items-center">
                @auth
                    <div class="flex items-center gap-4 bg-gray-50 border border-gray-100 p-1.5 rounded-2xl pl-5 shadow-sm">
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest hidden md:inline">{{ Auth::user()->name }}</span>
                        <div class="flex gap-1">
                            <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : (Auth::user()->role === 'organizer' ? route('organizer.dashboard') : route('customer.dashboard')) }}" class="btn-premium px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="p-2.5 bg-white text-gray-400 hover:text-red-500 rounded-xl transition-all border border-transparent hover:border-red-100 italic" title="Keluar">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-3 text-xs font-black text-gray-400 hover:text-indigo-600 transition uppercase tracking-widest">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-premium px-8 py-3 rounded-xl text-xs font-black uppercase tracking-widest">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient pt-32 pb-40 px-6 relative overflow-hidden">
        {{-- Elegant Decorative Elements --}}
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-indigo-50 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/3 opacity-50"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-blue-50 rounded-full blur-[120px] translate-y-1/2 -translate-x-1/3 opacity-50"></div>

        <div class="max-w-4xl mx-auto text-center relative z-10 space-y-10">
            <span class="inline-block py-2 px-6 rounded-full bg-indigo-50 border border-indigo-100 text-indigo-500 text-[10px] font-black uppercase tracking-[0.2em]">
                Premium Management 2026
            </span>
            <h1 class="text-6xl md:text-8xl font-black text-gray-900 leading-[1.05] tracking-tight">
                Standar Baru <br> <span class="italic font-serif text-indigo-600">Ekosistem</span> Event.
            </h1>
            <p class="text-gray-500 text-lg md:text-xl font-medium max-w-2xl mx-auto leading-relaxed">
                Platform terintegrasi yang dirancang untuk menghadirkan pengalaman manajemen event yang mulus, aman, dan berkelas dunia bagi anda.
            </p>
            <div class="flex justify-center gap-6 pt-6">
                @auth
                    <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : (Auth::user()->role === 'organizer' ? route('organizer.dashboard') : route('customer.dashboard')) }}" class="btn-premium px-12 py-5 rounded-2xl font-black text-sm uppercase tracking-widest">Buka Dashboard</a>
                @else
                    <a href="{{ route('register') }}" class="btn-premium px-12 py-5 rounded-2xl font-black text-sm uppercase tracking-widest">Daftar Akun Baru</a>
                @endauth
                <a href="#features" class="px-12 py-5 bg-white border border-gray-100 rounded-2xl font-black text-sm text-gray-400 hover:border-indigo-600 hover:text-indigo-600 transition-all uppercase tracking-widest">Eksplorasi</a>
            </div>
        </div>
    </section>

    <!-- Logo Cloud / Social Proof -->
    <section class="py-16 border-y border-gray-100 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <p class="text-center text-[10px] font-black text-gray-300 uppercase tracking-[0.3em] mb-10">Dipercaya Oleh Berbagai Institusi</p>
            <div class="flex flex-wrap justify-center gap-16 md:gap-24 opacity-30 grayscale items-center text-3xl font-serif font-bold text-gray-900 pointer-events-none">
                <span>UNIVERSITY</span>
                <span>EVENT.CO</span>
                <span>GLOBAL TECH</span>
                <span>DIGITAL.ID</span>
            </div>
        </div>
    </section>

    <!-- Explore Events Section -->
    <section id="explore" class="py-32 px-6 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-end mb-20">
                <div class="max-w-2xl">
                    <span class="text-indigo-600 font-black tracking-[0.2em] text-[10px] uppercase mb-4 block italic">Tersedia Sekarang</span>
                    <h2 class="text-5xl font-black text-gray-900 leading-tight">Jelajahi Event <br> <span class="text-indigo-600 italic font-serif">Pilihan</span> Terbaik.</h2>
                </div>
                <p class="text-gray-400 font-medium max-w-sm mb-2 text-sm leading-relaxed italic">Temukan pengalaman tak terlupakan dari berbagai kategori event premium yang kami kurasi khusus untuk anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @forelse($events as $event)
                <div class="group bg-white rounded-[40px] border border-gray-100 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.08)] overflow-hidden hover:shadow-[0_40px_100px_-20px_rgba(79,70,229,0.2)] transition-all duration-700 hover:-translate-y-4">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ $event->banner ? asset('storage/' . $event->banner) : 'https://images.unsplash.com/photo-1540575861501-7cf05a4b125a?auto=format&fit=crop&q=80&w=800' }}" 
                             class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        <div class="absolute top-6 right-6 px-4 py-1.5 bg-white/90 backdrop-blur-md rounded-full text-[10px] font-black text-indigo-600 shadow-sm uppercase tracking-widest">
                            {{ $event->category }}
                        </div>
                    </div>
                    <div class="p-10">
                        <h3 class="text-2xl font-black mb-4 text-gray-900 group-hover:text-indigo-600 transition tracking-tight">{{ $event->title }}</h3>
                        <div class="flex items-center gap-4 mb-8">
                            <div class="px-3 py-1 bg-indigo-50 rounded-xl text-indigo-600 text-[10px] font-black uppercase tracking-widest whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
                            </div>
                            <span class="text-xs font-bold text-gray-300 italic truncate">{{ $event->location }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-8 border-t border-gray-50">
                            <div>
                                <span class="text-[9px] font-black text-gray-300 block uppercase tracking-widest">Mulai Dari</span>
                                <span class="text-xl font-black text-gray-900 tracking-tighter">Rp{{ number_format($event->price, 0, ',', '.') }}</span>
                            </div>
                            <a href="{{ route('events.show', $event->id) }}" class="w-14 h-14 bg-gray-900 rounded-2xl text-white flex items-center justify-center hover:bg-indigo-600 transition-all active:scale-90 shadow-lg shadow-gray-100 group-hover:rotate-12">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 py-20 bg-white rounded-[40px] border-2 border-dashed border-gray-100 text-center">
                    <p class="text-gray-300 font-black uppercase tracking-[0.2em] italic">Belum ada event yang tersedia saat ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="features" class="py-32 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-end mb-24 gap-8">
                <div class="max-w-xl">
                    <span class="text-indigo-600 font-black tracking-[0.2em] text-[10px] uppercase mb-4 block">Layanan Kami</span>
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 leading-tight">Memberikan yang Terbaik Untuk Event Anda.</h2>
                </div>
                <p class="text-gray-400 font-medium max-w-sm mb-2 text-sm leading-relaxed">Kami menggabungkan teknologi modern dengan kemudahan penggunaan untuk hasil yang maksimal.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-10">
                <div class="feature-card p-12 rounded-[40px]">
                    <h3 class="text-xl font-black mb-4">Aksesibilitas</h3>
                    <p class="text-sm text-gray-500 font-medium leading-relaxed">System berbasis cloud yang dapat diakses dari mana saja, kapan saja, memberikan anda kendali penuh.</p>
                </div>
                <div class="feature-card p-12 rounded-[40px] border-indigo-100">
                    <h3 class="text-xl font-black mb-4 text-indigo-600">Keamanan</h3>
                    <p class="text-sm text-gray-500 font-medium leading-relaxed">Setiap tiket dilengkapi dengan enkripsi unik untuk mencegah duplikasi dan memastikan keaslian.</p>
                </div>
                <div class="feature-card p-12 rounded-[40px]">
                    <h3 class="text-xl font-black mb-4">Efisiensi</h3>
                    <p class="text-sm text-gray-500 font-medium leading-relaxed">Proses pendaftaran hingga verifikasi di lokasi dilakukan secara otomatis untuk menghemat waktu anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Integration Section -->
    <section id="process" class="py-32 px-6 bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-20 items-center">
            <div class="space-y-10">
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tight leading-tight">Proses Modern Untuk <br>Hasil yang <span class="text-indigo-600">Efisien.</span></h2>
                <div class="space-y-8">
                    <div class="flex gap-6">
                        <div class="w-12 h-12 rounded-full border-2 border-indigo-600 text-indigo-600 flex items-center justify-center font-black shrink-0">1</div>
                        <div>
                            <h4 class="font-bold text-gray-900 mb-1">Inisialisasi Data</h4>
                            <p class="text-sm text-gray-400 font-medium">Buat event anda dengan detail lengkap hanya dalam beberapa menit.</p>
                        </div>
                    </div>
                    <div class="flex gap-6">
                        <div class="w-12 h-12 rounded-full border-2 border-gray-100 text-gray-300 flex items-center justify-center font-black shrink-0">2</div>
                        <div>
                            <h4 class="font-bold text-gray-400 mb-1">Manajemen Penjualan</h4>
                            <p class="text-sm text-gray-300 font-medium italic italic">Pantau setiap tiket yang terjual secara real-time melalui dashboard.</p>
                        </div>
                    </div>
                    <div class="flex gap-6">
                        <div class="w-12 h-12 rounded-full border-2 border-gray-100 text-gray-300 flex items-center justify-center font-black shrink-0">3</div>
                        <div>
                            <h4 class="font-bold text-gray-400 mb-1">Verifikasi Peserta</h4>
                            <p class="text-sm text-gray-300 font-medium">Scan QR peserta di lokasi dengan aplikasi pemindai kami yang cepat.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-indigo-50 p-16 rounded-[60px] border border-indigo-100">
                 <div class="bg-white p-10 rounded-[40px] shadow-2xl shadow-indigo-100 space-y-6">
                     <div class="flex gap-2">
                         <div class="w-3 h-3 rounded-full bg-red-400"></div>
                         <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                         <div class="w-3 h-3 rounded-full bg-emerald-400"></div>
                     </div>
                     <div class="space-y-4 pt-4">
                         <div class="h-4 w-3/4 bg-gray-50 rounded-full"></div>
                         <div class="h-4 w-full bg-gray-50 rounded-full"></div>
                         <div class="h-4 w-1/2 bg-gray-50 rounded-full"></div>
                     </div>
                     <div class="pt-8 border-t border-gray-50 flex justify-between items-center">
                         <div class="w-24 h-10 bg-indigo-600 rounded-xl"></div>
                         <div class="w-12 h-12 bg-gray-50 rounded-full"></div>
                     </div>
                 </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-32 px-6">
        <div class="max-w-4xl mx-auto rounded-[60px] bg-gray-900 p-16 text-center space-y-10 border border-white/10 shadow-2xl">
            <h2 class="text-4xl md:text-5xl font-black text-white px-2 leading-tight">Siap Untuk Meningkatkan <br>Pengalaman Event Anda?</h2>
            <p class="text-gray-400 font-medium text-lg max-w-xl mx-auto leading-relaxed">Bergabunglah dengan ratusan penyelenggara event yang telah mempercayakan sistem mereka kepada kami.</p>
            <div class="pt-4 flex justify-center gap-6">
                <a href="{{ route('register') }}" class="bg-white text-gray-900 px-12 py-5 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-indigo-600 hover:text-white transition-all">Daftar Akun Gratis</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-20 px-6 bg-white border-t border-gray-50">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-10">
            <div class="flex items-center gap-3">
                <span class="text-2xl font-black tracking-tight text-gray-900">Event<span class="text-indigo-600">Master</span></span>
            </div>
            <p class="text-gray-300 text-[10px] font-black uppercase tracking-[0.3em]">&copy; 2026 Thaddeus Clarence. All Rights Reserved.</p>
            <div class="flex gap-12 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                <a href="#" class="hover:text-indigo-600 transition">Kebijakan</a>
                <a href="#" class="hover:text-indigo-600 transition">Ketentuan</a>
                <a href="#" class="hover:text-indigo-600 transition">Privasi</a>
            </div>
        </div>
    </footer>

</body>
</html>