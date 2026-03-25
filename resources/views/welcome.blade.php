<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventMaster - Transformasi Manajemen Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; scroll-behavior: smooth; }
        .glass-nav { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(229, 231, 235, 0.5); }
        .hero-gradient { background: radial-gradient(circle at top right, #4f46e5, #312e81, #0f172a); }
        .text-gradient { background: linear-gradient(to right, #818cf8, #c084fc, #fb7185); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    </style>
</head>
<body class="bg-[#fcfcfd] text-[#1a1c21]">

    <nav class="glass-nav sticky top-0 z-[100]">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5z"></path></svg>
                </div>
                <a href="{{ url('/') }}" class="text-xl font-extrabold tracking-tight text-gray-900">Event<span class="text-indigo-600">Master</span></a>
            </div>
            
            <div class="hidden md:flex items-center space-x-10 text-sm font-semibold text-gray-600">
                <a href="#explore" class="hover:text-indigo-600 transition-colors">Jelajah</a>
                <a href="#" class="hover:text-indigo-600 transition-colors">Kategori</a>
                <a href="#" class="hover:text-indigo-600 transition-colors">Organizer</a>
            </div>

            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        {{-- NAVIGASI SAAT LOGIN --}}
                        <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : url('/dashboard') }}" 
                           class="text-sm font-bold text-indigo-600 py-2 px-4 bg-indigo-50 rounded-lg border border-indigo-100 hover:bg-indigo-100 transition">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-bold text-gray-500 hover:text-red-600 transition">Keluar</button>
                        </form>
                    @else
                        {{-- NAVIGASI SAAT LOGOUT (GUEST) --}}
                        <a href="{{ route('login') }}" class="text-sm font-bold text-gray-700 hover:text-indigo-600 transition">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-gray-900 text-white px-6 py-2.5 rounded-full text-sm font-bold hover:bg-indigo-600 transition shadow-lg active:scale-95">Daftar</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <header class="hero-gradient pt-24 pb-32 px-6 relative overflow-hidden">
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <div class="inline-flex items-center gap-2 py-2 px-4 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-indigo-200 text-xs font-bold uppercase mb-10">
                Capstone Project 2026
            </div>
            <h1 class="text-5xl md:text-8xl font-[900] text-white leading-[1.1] mb-8">
                Kelola Event Jadi <br> <span class="text-gradient">Jauh Lebih Mudah</span>
            </h1>
            <p class="text-indigo-100/80 text-lg md:text-xl max-w-2xl mx-auto mb-14 font-medium">
                Satu ekosistem untuk Admin, Organizer, dan Customer. Bangun pengalaman event tak terlupakan dalam hitungan klik.
            </p>
            <div class="flex justify-center">
                <a href="#explore" class="w-full sm:w-auto bg-white text-indigo-900 px-12 py-5 rounded-2xl font-extrabold text-lg hover:shadow-xl transition-all hover:-translate-y-1">
                    Temukan Event Sekarang
                </a>
            </div>
        </div>
    </header>

    <section id="explore" class="py-32 max-w-7xl mx-auto px-6 text-center md:text-left">
        <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-6">
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900">Satu Platform,<br>Ekosistem Lengkap.</h2>
            <p class="text-gray-500 text-lg max-w-sm font-medium">Didesain khusus untuk memastikan keamanan dan kenyamanan transaksi Anda.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-10 rounded-[40px] border border-gray-100 shadow-sm hover:border-indigo-100 transition">
                <h3 class="text-2xl font-bold mb-4 text-indigo-600">Admin Hub</h3>
                <p class="text-gray-500 font-medium">Kontrol penuh verifikasi organizer dan pantau aliran dana secara transparan.</p>
            </div>
            <div class="bg-white p-10 rounded-[40px] border border-gray-100 shadow-sm hover:border-emerald-100 transition">
                <h3 class="text-2xl font-bold mb-4 text-emerald-600">Powerful Tools</h3>
                <p class="text-gray-500 font-medium">Akses analitik penjualan tiket dan manajemen kuota real-time.</p>
            </div>
            <div class="bg-white p-10 rounded-[40px] border border-gray-100 shadow-sm hover:border-orange-100 transition">
                <h3 class="text-2xl font-bold mb-4 text-orange-600">Seamless Booking</h3>
                <p class="text-gray-500 font-medium">Proses checkout instan untuk tiket VIP maupun Reguler.</p>
            </div>
        </div>
    </section>

    <footer class="bg-gray-50 py-20 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <span class="text-2xl font-black">EVENT<span class="text-indigo-600">MASTER</span></span>
            <p class="text-gray-400 text-sm mt-4">&copy; 2026 Thaddeus Clarence. Capstone Project 2372004.</p>
        </div>
    </footer>
</body>
</html>