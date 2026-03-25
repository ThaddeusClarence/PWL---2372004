<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventMaster - Platform Manajemen Event & Tiket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <span class="text-2xl font-bold text-indigo-600 tracking-tight">EventMaster</span>
                </div>
                
                <div class="hidden md:flex space-x-8 font-medium">
                    <a href="#explore" class="text-gray-600 hover:text-indigo-600 transition">Jelajah Event</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600 transition">Kategori</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600 transition">Organizer</a>
                </div>

                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-indigo-600 font-semibold hover:underline">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-sm text-gray-500 hover:text-red-600">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 font-medium hover:text-indigo-600">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-medium hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all active:scale-95">
                                    Daftar Sekarang
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <header class="relative bg-indigo-900 pt-32 pb-24 px-4 overflow-hidden">
        <div class="max-w-7xl mx-auto relative z-10 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-indigo-500/20 text-indigo-300 text-sm font-medium mb-5 border border-indigo-500/30">
                Capstone Project 1
            </span>
            <h1 class="text-5xl md:text-7xl font-extrabold text-white mb-8 tracking-tight">
                Kelola Event Jadi <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">Lebih Mudah</span>
            </h1>
            <p class="text-indigo-100 text-lg md:text-xl max-w-2xl mx-auto mb-12 leading-relaxed">
                Platform ticketing All-in-One untuk Admin, Organizer, dan Customer. Dari pembuatan event hingga scan QR Code tiket.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-5">
                <a href="#explore" class="bg-indigo-500 text-white px-10 py-4 rounded-2xl font-bold text-lg hover:bg-indigo-400 shadow-xl shadow-indigo-500/20 transition-all">
                    Cari Event
                </a>
                <a href="{{ route('register') }}" class="bg-white/10 backdrop-blur-md text-white border border-white/20 px-10 py-4 rounded-2xl font-bold text-lg hover:bg-white/20 transition-all">
                    Jadi Organizer
                </a>
            </div>
        </div>
        
        <div class="absolute top-0 right-0 -mr-24 -mt-24 w-128 h-128 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 -ml-24 -mb-24 w-128 h-128 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
    </header>

    <section id="explore" class="py-24 max-w-7xl mx-auto px-4">
        <div class="text-center mb-20">
            <h2 class="text-4xl font-bold text-gray-900">Satu Platform, Tiga Peran</h2>
            <p class="text-gray-500 mt-4 text-lg">Didesain khusus untuk memenuhi kebutuhan ekosistem event.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-10">
            <div class="group bg-white p-10 rounded-3xl shadow-sm border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gray-800">Admin Panel</h3>
                <p class="text-gray-600 leading-relaxed">Kelola kategori, verifikasi organizer, dan pantau seluruh transaksi platform secara real-time.</p>
            </div>

            <div class="group bg-white p-10 rounded-3xl shadow-sm border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gray-800">Organizer Tools</h3>
                <p class="text-gray-600 leading-relaxed">Buat event, atur kuota tiket, dan analisis performa penjualan dengan grafik yang interaktif.</p>
            </div>

            <div class="group bg-white p-10 rounded-3xl shadow-sm border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                <div class="w-14 h-14 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-orange-600 group-hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gray-800">Customer Experience</h3>
                <p class="text-gray-600 leading-relaxed">Pesan tiket VIP/Reguler dengan mudah, bayar instan, dan terima e-ticket ber-QR Code di email.</p>
            </div>
        </div>
    </section>

    <footer class="bg-white border-t border-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <span class="text-xl font-bold text-indigo-600">EventMaster</span>
                <p class="text-sm text-gray-400 mt-1">Sistem Manajemen Event Terintegrasi</p>
            </div>
            <div class="text-gray-500 text-sm">
                &copy; 2026 Capstone Project 2372004 - Thaddeus Clarence
            </div>
        </div>
    </footer>

</body>
</html>