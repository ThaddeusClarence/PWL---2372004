<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-extrabold text-gray-900">Buat Akun Baru</h2>
        <p class="mt-2 text-sm text-gray-600">Pilih tipe akun Anda untuk mulai menggunakan EventMaster</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label :value="__('Daftar Sebagai')" class="font-semibold mb-2" />
            <div class="grid grid-cols-2 gap-4">
                
                <label class="relative flex flex-col p-4 bg-white border-2 rounded-xl cursor-pointer shadow-sm transition-all hover:border-indigo-500 border-gray-200 has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50 group">
                    <div class="flex items-center justify-between mb-2">
                        <span class="block text-sm font-bold text-gray-900 uppercase">Customer</span>
                        <input type="radio" name="role" value="customer" class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" checked>
                    </div>
                    <span class="text-xs text-gray-500 italic leading-relaxed">Saya ingin mencari dan membeli tiket event</span>
                </label>

                <label class="relative flex flex-col p-4 bg-white border-2 rounded-xl cursor-pointer shadow-sm transition-all hover:border-indigo-500 border-gray-200 has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50 group">
                    <div class="flex items-center justify-between mb-2">
                        <span class="block text-sm font-bold text-gray-900 uppercase">Organizer</span>
                        <input type="radio" name="role" value="organizer" class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                    </div>
                    <span class="text-xs text-gray-500 italic leading-relaxed">Saya ingin membuat dan mengelola event</span>
                </label>

            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="font-semibold" />
            <x-text-input id="name" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="text" name="name" :value="old('name')" required autofocus placeholder="Nama sesuai identitas" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Alamat Email')" class="font-semibold" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="email" name="email" :value="old('email')" required placeholder="user@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata Sandi')" class="font-semibold" />
            <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="password" name="password" required placeholder="Minimal 8 karakter" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="font-semibold" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="password" name="password_confirmation" required placeholder="Ulangi kata sandi" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-8">
            <x-primary-button class="w-full justify-center py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg transition-all shadow-md">
                {{ __('DAFTAR SEKARANG') }}
            </x-primary-button>
        </div>

        <div class="mt-6 text-center border-t pt-6">
            <p class="text-sm text-gray-600">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:text-indigo-500">Masuk di sini</a>
            </p>
        </div>
    </form>
</x-guest-layout>