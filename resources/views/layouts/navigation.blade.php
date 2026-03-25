<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}">
                        <strong class="text-indigo-600 text-2xl tracking-tighter">Event<span class="text-gray-900">Master</span></strong>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="#" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500 hover:text-indigo-600 transition">Jelajah Event</a>
                    <a href="#" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500 hover:text-indigo-600 transition">Kategori</a>
                    <a href="#" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500 hover:text-indigo-600 transition">Organizer</a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    {{-- JIKA SUDAH LOGIN: Tampilkan Dashboard & Keluar --}}
                    <div class="flex items-center space-x-5">
                        <a href="{{ auth()->user()->role == 'admin' ? route('admin.dashboard') : route('dashboard') }}" 
                           class="text-indigo-600 font-bold text-sm hover:text-indigo-800 transition px-3 py-2 bg-indigo-50 rounded-lg">
                            Ke Dashboard
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-500 hover:text-red-600 text-sm font-medium transition">
                                Keluar
                            </button>
                        </form>
                    </div>
                @else
                    {{-- JIKA BELUM LOGIN: Tampilkan Masuk & Daftar --}}
                    <div class="flex items-center">
                        <a href="{{ route('login') }}" class="text-gray-600 px-3 font-medium hover:text-indigo-600 transition text-sm">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="ml-4 bg-indigo-600 text-white px-5 py-2.5 rounded-lg font-bold hover:bg-indigo-700 shadow-md shadow-indigo-200 transition text-sm">
                            Daftar Sekarang
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>