<x-guest-layout>
    <div class="mb-10 text-center">
        <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-3">Buat Akun Baru</h2>
        <p class="text-gray-500 font-medium italic italic">Bergabung dengan ribuan pecinta event di <span class="text-indigo-600 font-bold tracking-tighter italic">EventMaster</span>.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        {{-- Default Role as Customer --}}
        <input type="hidden" name="role" value="customer">

        {{-- Input Full Name --}}
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="font-bold text-gray-700 ml-1 mb-2" />
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <input id="name" type="text" name="name" :value="old('name')" required autofocus 
                    class="block w-full pl-11 pr-4 py-4 bg-gray-50 border-transparent border-2 rounded-2xl focus:bg-white focus:border-indigo-600 focus:ring-0 transition-all placeholder:text-gray-400 font-medium text-gray-900" 
                    placeholder="Nama sesuai identitas">
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2 ml-1" />
        </div>

        {{-- Input Email --}}
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" class="font-bold text-gray-700 ml-1 mb-2" />
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <input id="email" type="email" name="email" :value="old('email')" required 
                    class="block w-full pl-11 pr-4 py-4 bg-gray-50 border-transparent border-2 rounded-2xl focus:bg-white focus:border-indigo-600 focus:ring-0 transition-all placeholder:text-gray-400 font-medium text-gray-900" 
                    placeholder="nama@email.com">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 ml-1" />
        </div>

        {{-- Input Password --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="password" :value="__('Kata Sandi')" class="font-bold text-gray-700 ml-1 mb-2" />
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <input id="password" type="password" name="password" required 
                        class="block w-full pl-11 pr-4 py-4 bg-gray-50 border-transparent border-2 rounded-2xl focus:bg-white focus:border-indigo-600 focus:ring-0 transition-all placeholder:text-gray-400 font-medium text-gray-900" 
                        placeholder="••••••••">
                </div>
            </div>
            <div>
                <x-input-label for="password_confirmation" :value="__('Konfirmasi')" class="font-bold text-gray-700 ml-1 mb-2" />
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <input id="password_confirmation" type="password" name="password_confirmation" required 
                        class="block w-full pl-11 pr-4 py-4 bg-gray-50 border-transparent border-2 rounded-2xl focus:bg-white focus:border-indigo-600 focus:ring-0 transition-all placeholder:text-gray-400 font-medium text-gray-900" 
                        placeholder="••••••••">
                </div>
            </div>
        </div>
        <x-input-error :messages="$errors->get('password')" class="mt-2 ml-1" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 ml-1" />

        {{-- Submit Button --}}
        <div class="pt-4">
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 rounded-2xl shadow-xl shadow-indigo-100 transition-all active:scale-95 transform motion-safe:hover:-translate-y-0.5 uppercase tracking-widest text-sm">
                {{ __('Daftar Sekarang') }}
            </button>
        </div>

        {{-- Login Link --}}
        <div class="pt-8 text-center border-t border-gray-100">
            <p class="text-sm font-bold text-gray-500">
                Sudah memiliki akun sebelumnya? 
                <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 ml-1 underline decoration-2 decoration-indigo-100 underline-offset-4 transition-all uppercase tracking-tighter">
                    Login di Sini
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>