<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        .admin-font { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    <div class="admin-font bg-[#fbfcfd] min-h-screen pb-20">
        <div class="bg-white border-b border-gray-100 py-10 mb-10 shadow-sm">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <a href="{{ route('admin.categories.index') }}" class="text-indigo-600 font-bold text-[10px] uppercase tracking-widest mb-2 flex items-center gap-2 hover:gap-3 transition-all">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar
                </a>
                <h2 class="text-3xl font-black text-gray-900 leading-tight">Edit Kategori</h2>
                <p class="text-gray-400 font-medium mt-1">Perbarui nama kategori yang sudah ada.</p>
            </div>
        </div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-[40px] border border-gray-100 shadow-[0_30px_80px_-20px_rgba(0,0,0,0.08)] p-10">
                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="space-y-8">
                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-4">Nama Kategori</label>
                            <input type="text" name="name" 
                                   class="w-full px-8 py-5 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-600 text-gray-900 font-bold placeholder:text-gray-300 transition-all shadow-sm"
                                   placeholder="Contoh: Musik, Seminar, Workshop"
                                   required value="{{ old('name', $category->name) }}">
                            @error('name')
                                <p class="text-red-500 text-xs font-bold mt-2 italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-6 border-t border-gray-50 flex justify-end">
                            <button type="submit" class="px-10 py-5 bg-indigo-600 text-white rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-black transition-all shadow-xl shadow-indigo-100 active:scale-95">
                                Perbarui Kategori
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
