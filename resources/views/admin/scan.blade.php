<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        .admin-font { font-family: 'Plus Jakarta Sans', sans-serif; }
        .scanner-glow { box-shadow: 0 0 20px rgba(79, 70, 229, 0.2); transition: all 0.5s; }
        .scanner-glow:focus-within { box-shadow: 0 0 40px rgba(79, 70, 229, 0.4); transform: scale(1.02); }
        .success-bounce { animation: bounce 0.5s infinite alternate; }
        @keyframes bounce { from { transform: translateY(0); } to { transform: translateY(-5px); } }
    </style>

    <div class="admin-font bg-white min-h-screen py-16 px-6">
        <div class="max-w-2xl mx-auto">
            <div class="text-center mb-16">
                <div class="w-20 h-20 bg-indigo-600 rounded-[30px] flex items-center justify-center mx-auto mb-6 shadow-2xl shadow-indigo-100 rotate-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                </div>
                <h1 class="text-4xl font-black text-gray-900 mb-2">Verifikasi Tiket</h1>
                <p class="text-gray-400 font-medium italic">Gunakan fitur ini untuk validasi kehadiran di lokasi event.</p>
            </div>

            @if(session('success'))
            <div class="mb-10 p-8 bg-emerald-50 rounded-[40px] border border-emerald-100 flex items-center gap-6 animate-in slide-in-from-top-6 duration-500 shadow-sm shadow-emerald-50">
                <div class="w-14 h-14 bg-emerald-500 rounded-full flex items-center justify-center text-white success-bounce">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div>
                    <h3 class="text-xl font-black text-emerald-900">{{ session('success') }}</h3>
                    <p class="text-emerald-700 font-bold text-sm mt-1 uppercase tracking-wider">
                        Atas Nama: <span class="text-gray-900 underline">{{ session('owner_name') }}</span>
                    </p>
                    <p class="text-[10px] font-black text-emerald-600/70 mt-2 uppercase tracking-[0.2em]">
                        Kategori: {{ session('ticket_type') }} • Status: Check-in Berhasil
                    </p>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-10 p-8 bg-red-50 rounded-[40px] border border-red-100 flex items-center gap-6 animate-in slide-in-from-top-6 duration-500 shadow-sm shadow-red-50">
                <div class="w-14 h-14 bg-red-500 rounded-full flex items-center justify-center text-white">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-red-900">{{ session('error') }}</h3>
                    <p class="text-red-700/70 font-medium text-sm mt-1">Mungkin kode salah atau tiket sudah dipakai sebelumnya.</p>
                </div>
            </div>
            @endif

            <div class="bg-gray-50 rounded-[50px] p-12 scanner-glow border border-gray-100">
                <form action="{{ route('scan.perform') }}" method="POST">
                    @csrf
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-6 text-center">Masukkan Kode Tiket di Sini</label>
                    <input type="text" name="ticket_code" required autofocus autocomplete="off" placeholder="EVT-XXXXXXXXXX" 
                           class="w-full text-center px-10 py-8 bg-white border-none rounded-[30px] text-3xl font-black text-gray-800 placeholder-gray-200 focus:ring-8 focus:ring-indigo-100 transition outline-none shadow-inner tracking-widest leading-loose uppercase">
                    
                    <button type="submit" class="mt-10 w-full bg-indigo-600 hover:bg-gray-900 text-white font-black py-6 rounded-[35px] text-lg transition-all shadow-xl shadow-indigo-100 active:scale-95 flex items-center justify-center gap-4 group">
                        <span>VERIFIKASI TIKET</span>
                        <svg class="w-6 h-6 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </button>
                </form>
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-gray-400 hover:text-indigo-600 transition">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
</x-app-layout>
