<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}">
                        <strong class="text-indigo-600 text-xl">EventMaster</strong>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="#" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500">Jelajah Event</a>
                    <a href="#" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500">Kategori</a>
                    <a href="#" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500">Organizer</a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                {{-- PAKSA TAMPILKAN LOGIN/REGISTER JIKA DI HALAMAN UTAMA --}}
                @if (Request::is('/'))
                    <a href="{{ route('login') }}" class="text-gray-700 px-3 font-medium hover:text-indigo-600 transition">Masuk</a>
                    <a href="{{ route('register') }}" class="ml-4 bg-indigo-600 text-white px-4 py-2 rounded-md font-medium hover:bg-indigo-700 shadow-sm transition">
                        Daftar
                    </a>
                @else
                    {{-- JIKA BUKAN DI HALAMAN UTAMA, GUNAKAN LOGIKA LOGIN NORMAL --}}
                    @auth
                        <a href="{{ auth()->user()->role == 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="text-indigo-600 font-bold px-3">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-500 hover:text-red-600 px-3 transition">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 px-3 font-medium">Masuk</a>
                        <a href="{{ route('register') }}" class="ml-4 bg-indigo-600 text-white px-4 py-2 rounded-md font-medium">Daftar</a>
                    @endauth
                @endif
            </div>
        </div>
    </div>
</nav>