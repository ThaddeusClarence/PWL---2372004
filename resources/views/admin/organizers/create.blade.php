<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <a href="{{ route('admin.organizers.index') }}" class="text-indigo-600 font-bold text-xs uppercase tracking-widest hover:text-indigo-800 transition">← KEMBALI KE LIST</a>
                <h1 class="text-3xl font-black text-gray-900 mt-4 tracking-tight">Buat Akun Organizer Baru</h1>
                <p class="text-gray-500 font-medium italic italic">Silakan isi detail login penyelenggara untuk mulai bekerja sama.</p>
            </div>

            <div class="bg-white p-10 rounded-[40px] shadow-2xl shadow-indigo-100 border border-gray-100">
                <form action="{{ route('admin.organizers.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Nama Lengkap Organizer')" class="font-bold text-gray-700 ml-1 mb-2" />
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-600 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <input type="text" name="name" id="name" required 
                                   class="block w-full pl-12 pr-4 py-4 bg-gray-50 border-transparent border-2 rounded-2xl focus:bg-white focus:border-indigo-600 focus:ring-0 transition-all font-medium text-gray-900" 
                                   placeholder="Contoh: Global Event Co.">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2 ml-1" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email Kerja')" class="font-bold text-gray-700 ml-1 mb-2" />
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-600 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <input type="email" name="email" id="email" required 
                                   class="block w-full pl-12 pr-4 py-4 bg-gray-50 border-transparent border-2 rounded-2xl focus:bg-white focus:border-indigo-600 focus:ring-0 transition-all font-medium text-gray-900" 
                                   placeholder="organizer@tiket.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 ml-1" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="password" :value="__('Kata Sandi Default')" class="font-bold text-gray-700 ml-1 mb-2" />
                            <input type="password" name="password" id="password" required 
                                   class="block w-full px-6 py-4 bg-gray-50 border-transparent border-2 rounded-2xl focus:bg-white focus:border-indigo-600 focus:ring-0 transition-all font-medium text-gray-900" 
                                   placeholder="Minimal 8 karakter">
                        </div>
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Konfirmasi Sandi')" class="font-bold text-gray-700 ml-1 mb-2" />
                            <input type="password" name="password_confirmation" id="password_confirmation" required 
                                   class="block w-full px-6 py-4 bg-gray-50 border-transparent border-2 rounded-2xl focus:bg-white focus:border-indigo-600 focus:ring-0 transition-all font-medium text-gray-900" 
                                   placeholder="Ulangi sandi">
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-gray-900 text-white font-black py-5 rounded-2xl shadow-xl shadow-indigo-100 transition-all active:scale-95 transform motion-safe:hover:-translate-y-1 uppercase tracking-widest text-sm">
                            BUAT AKUN ORGANIZER
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
