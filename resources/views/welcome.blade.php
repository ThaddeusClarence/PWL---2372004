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
                <span class="text-xl font-extrabold tracking-tight text-gray-900">Event<span class="text-indigo-600">Master</span></span>
            </div>
            
            <div class="hidden md:flex items-center space-x-10 text-sm font-semibold text-gray-600">
                <a href="#explore" class="hover:text-indigo-600 transition-colors">Jelajah</a>
                <a href="#" class="hover:text-indigo-600 transition-colors">Kategori</a>
                <a href="#" class="hover:text-indigo-600 transition-colors">Organizer</a>
            </div>

            <div class="flex items-center gap-6">
                @if (Route::has('login'))
                    @auth
                        {{-- Tampilan saat user sudah Login --}}
                        <div class="flex items-center gap-5">
                            <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition">Dashboard</a>
                            
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-sm font-bold text-gray-500 hover:text-red-600 transition">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    @else
                        {{-- Tampilan saat user belum Login --}}
                        <a href="{{ route('login') }}" class="text-sm font-bold text-gray-700 hover:text-indigo-600 transition">Login</a>
                        <a href="{{ route('register') }}" class="bg-gray-900 text-white px-6 py-3 rounded-full text-sm font-bold hover:bg-indigo-600 transition-all shadow-xl shadow-gray-200 active:scale-95">
                            Register
                        </a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <header class="hero-gradient pt-24 pb-32 px-6 relative overflow-hidden">
        <div class="absolute top-20 right-[10%] w-64 h-64 bg-indigo-500/20 rounded-full blur-[80px] animate-pulse"></div>
        <div class="absolute bottom-10 left-[5%] w-80 h-80 bg-purple-500/20 rounded-full blur-[100px]"></div>

        <div class="max-w-7xl mx-auto text-center relative z-10">
            <div class="inline-flex items-center gap-2 py-2 px-4 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-indigo-200 text-xs font-bold uppercase tracking-widest mb-10">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-400"></span>
                </span>
                Capstone Project 2026
            </div>

            <h1 class="text-5xl md:text-8xl font-[900] text-white leading-[1.1] tracking-tight mb-8">
                Kelola Event Jadi <br> <span class="text-gradient">Jauh Lebih Mudah</span>
            </h1>

            <p class="text-indigo-100/80 text-lg md:text-xl max-w-2xl mx-auto mb-14 leading-relaxed font-medium">
                Satu ekosistem untuk <span class="text-white">Admin</span>, <span class="text-white">Organizer</span>, dan <span class="text-white">Customer</span>. Bangun pengalaman event tak terlupakan dalam hitungan klik.
            </p>

            <div class="flex flex-col sm:flex-row justify-center items-center gap-6">
                <a href="#explore" class="w-full sm:w-auto bg-white text-indigo-900 px-10 py-5 rounded-2xl font-extrabold text-lg hover:shadow-[0_20px_50px_rgba(255,255,255,0.2)] transition-all hover:-translate-y-1 active:scale-95">
                    Temukan Event
                </a>
                <a href="{{ route('register') }}" class="w-full sm:w-auto bg-indigo-500/20 backdrop-blur-xl text-white border border-white/30 px-10 py-5 rounded-2xl font-extrabold text-lg hover:bg-white/10 transition-all active:scale-95">
                    Daftar Organizer
                </a>
            </div>
        </div>
    </header>

    <section id="explore" class="py-32 max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-6">
            <div class="max-w-xl">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight">Satu Platform,<br>Ekosistem Lengkap.</h2>
            </div>
            <p class="text-gray-500 text-lg max-w-sm font-medium">
                Didesain khusus menggunakan teknologi terkini untuk memastikan keamanan dan kenyamanan transaksi Anda.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="group bg-white p-10 rounded-[40px] border border-gray-100 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] hover:shadow-[0_30px_60px_-15px_rgba(79,70,229,0.15)] transition-all duration-500">
                <div class="w-16 h-16 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-10 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                </div>
                <h3 class="text-2xl font-bold mb-4">Admin Hub</h3>
                <p class="text-gray-500 leading-relaxed font-medium">Kontrol penuh verifikasi organizer dan pantau aliran dana secara transparan dalam satu dashboard pusat.</p>
            </div>

            <div class="group bg-white p-10 rounded-[40px] border border-gray-100 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] hover:shadow-[0_30px_60px_-15px_rgba(16,185,129,0.15)] transition-all duration-500">
                <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-10 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
                <h3 class="text-2xl font-bold mb-4">Powerful Tools</h3>
                <p class="text-gray-500 leading-relaxed font-medium">Buka akses ke fitur analitik penjualan tiket dan manajemen kuota real-time untuk organizer profesional.</p>
            </div>

            <div class="group bg-white p-10 rounded-[40px] border border-gray-100 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] hover:shadow-[0_30px_60px_-15px_rgba(249,115,22,0.15)] transition-all duration-500">
                <div class="w-16 h-16 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-10 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold mb-4">Seamless Booking</h3>
                <p class="text-gray-500 leading-relaxed font-medium">Customer dapat memilih tiket VIP atau Reguler dengan proses checkout yang instan dan aman.</p>
            </div>
        </div>
    </section>

    <footer class="bg-gray-50 py-20 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-8">
            <div>
                <span class="text-2xl font-black tracking-tighter">EVENT<span class="text-indigo-600">MASTER</span></span>
                <p class="text-gray-400 text-sm mt-2 font-medium">Platform Manajemen Event Masa Depan</p>
            </div>
            <div class="text-gray-400 text-sm font-semibold">
                &copy; 2026 Thaddeus Clarence. Capstone Project 2372004.
            </div>
        </div>
    </footer>

</body>
</html>