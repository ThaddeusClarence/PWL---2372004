<x-guest-layout>
    <div class="mb-10 text-center">
        <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-3">Selamat Datang Kembali</h2>
        <p class="text-gray-500 font-medium">Silakan masuk ke akun <span class="text-indigo-600 font-bold">EventMaster</span> Anda</p>
    </div>

    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        {{-- Role Selection for Login Context --}}
        <div class="mb-8">
            <x-input-label :value="__('Masuk Sebagai')" class="font-bold text-gray-700 ml-1 mb-3" />
            <div class="grid grid-cols-3 gap-3">
                <label class="relative flex flex-col p-3 bg-white border-2 rounded-2xl cursor-pointer shadow-sm transition-all hover:border-indigo-500 border-gray-100 has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50 group">
                    <div class="flex items-center justify-between mb-1">
                        <span class="block text-[10px] font-black text-gray-900 uppercase tracking-tighter">Customer</span>
                        <input type="radio" name="role_choice" value="customer" class="w-3 h-3 text-indigo-600 border-gray-300 focus:ring-indigo-500" checked>
                    </div>
                    <span class="text-[9px] text-gray-400 font-medium leading-tight line-clamp-1">Beli Tiket</span>
                </label>

                <label class="relative flex flex-col p-3 bg-white border-2 rounded-2xl cursor-pointer shadow-sm transition-all hover:border-indigo-500 border-gray-100 has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50 group">
                    <div class="flex items-center justify-between mb-1">
                        <span class="block text-[10px] font-black text-gray-900 uppercase tracking-tighter">Organizer</span>
                        <input type="radio" name="role_choice" value="organizer" class="w-3 h-3 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                    </div>
                    <span class="text-[9px] text-gray-400 font-medium leading-tight line-clamp-1">Kelola Event</span>
                </label>

                <label class="relative flex flex-col p-3 bg-white border-2 rounded-2xl cursor-pointer shadow-sm transition-all hover:border-indigo-500 border-gray-100 has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50 group text-center!">
                    <div class="flex items-center justify-between mb-1">
                        <span class="block text-[10px] font-black text-gray-900 uppercase tracking-tighter text-fuchsia-600">Admin</span>
                        <input type="radio" name="role_choice" value="admin" class="w-3 h-3 text-fuchsia-600 border-gray-300 focus:ring-fuchsia-500">
                    </div>
                    <span class="text-[9px] text-gray-400 font-medium leading-tight line-clamp-1">Dashboard Pusat</span>
                </label>
            </div>
        </div>

        {{-- Input Email --}}
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" class="font-bold text-gray-700 ml-1 mb-2" />
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                </div>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                    class="block w-full pl-11 pr-4 py-4 bg-gray-50 border-transparent border-2 rounded-2xl focus:bg-white focus:border-indigo-600 focus:ring-0 transition-all placeholder:text-gray-400 font-medium text-gray-900" 
                    placeholder="nama@email.com">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 ml-1" />
        </div>

        {{-- Input Password --}}
        <div>
            <div class="flex justify-between items-center ml-1 mb-2">
                <x-input-label for="password" :value="__('Kata Sandi')" class="font-bold text-gray-700" />
                @if (Route::has('password.request'))
                    <a class="text-xs text-indigo-600 hover:text-indigo-800 font-bold transition-colors" href="{{ route('password.request') }}">
                        {{ __('Lupa kata sandi?') }}
                    </a>
                @endif
            </div>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <input id="password" type="password" name="password" required 
                    class="block w-full pl-11 pr-4 py-4 bg-gray-50 border-transparent border-2 rounded-2xl focus:bg-white focus:border-indigo-600 focus:ring-0 transition-all placeholder:text-gray-400 font-medium text-gray-900" 
                    placeholder="••••••••">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 ml-1" />
        </div>

        {{-- Remember Me --}}
        <div class="flex items-center justify-between ml-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" name="remember" class="w-5 h-5 rounded-lg border-gray-300 text-indigo-600 focus:ring-indigo-500 transition-all cursor-pointer">
                <span class="ms-3 text-sm font-bold text-gray-500 group-hover:text-gray-700 transition-colors">{{ __('Ingat saya') }}</span>
            </label>
        </div>

        {{-- Submit Button --}}
        <div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 rounded-2xl shadow-xl shadow-indigo-200 transition-all active:scale-95 transform motion-safe:hover:-translate-y-0.5">
                {{ __('Masuk Sekarang') }}
            </button>
        </div>

        {{-- Registration Link --}}
        <div class="pt-6 text-center border-t border-gray-100">
            <p class="text-sm font-bold text-gray-500">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 ml-1 underline decoration-2 decoration-indigo-100 underline-offset-4 transition-all">
                    Daftar Akun Baru
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>