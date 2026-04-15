<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        .admin-font { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    <div class="admin-font bg-[#fbfcfd] min-h-screen pb-20">
        <div class="bg-white border-b border-gray-100 py-10 mb-8">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <a href="{{ route('admin.events.index') }}" class="text-xs font-bold text-gray-400 hover:text-indigo-600 flex items-center gap-2 mb-4 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                    KEMBALI KE DAFTAR
                </a>
                <h2 class="text-3xl font-black text-gray-900 leading-tight">Buat Event Baru</h2>
                <p class="text-gray-400 font-medium mt-1">Lengkapi formulir di bawah untuk mempublikasikan event.</p>
            </div>
        </div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-[40px] border border-gray-100 shadow-sm p-10">
                <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    
                    {{-- Judul & Banner --}}
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Judul Event</label>
                            <input type="text" name="title" required placeholder="Contoh: Konser Musik Harmoni" 
                                   class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm focus:ring-4 focus:ring-indigo-50 transition outline-none font-bold text-gray-700">
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Banner Event</label>
                            <input type="file" name="banner" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition cursor-pointer">
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Deskripsi Event</label>
                        <textarea name="description" rows="4" placeholder="Ceritakan detail event Anda..." 
                                  class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm focus:ring-4 focus:ring-indigo-50 transition outline-none font-medium text-gray-700"></textarea>
                    </div>

                    {{-- Detail Event --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-4">Kategori</label>
                            <select name="category_id" class="w-full px-8 py-5 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-600 text-gray-900 font-bold outline-none transition-all shadow-sm">
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-xs font-bold mt-2 italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Lokasi</label>
                            <input type="text" name="location" required placeholder="Contoh: Convention Center LT 3" 
                                   class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm focus:ring-4 focus:ring-indigo-50 transition outline-none font-bold text-gray-700">
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Tanggal Event</label>
                            <input type="date" name="date" required 
                                   class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm focus:ring-4 focus:ring-indigo-50 transition outline-none font-bold text-gray-700">
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Jam Mulai</label>
                            <input type="time" name="start_time" required 
                                   class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm focus:ring-4 focus:ring-indigo-50 transition outline-none font-bold text-gray-700">
                        </div>
                        <div class="md:col-span-2 bg-indigo-50/50 p-6 rounded-3xl border border-indigo-100/50">
                            <label class="block text-xs font-black text-indigo-600 uppercase tracking-widest mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Tugaskan Organizer (Opsional)
                            </label>
                            <select name="organizer_id" class="w-full px-6 py-4 bg-white border border-indigo-100 rounded-2xl text-sm focus:ring-4 focus:ring-indigo-50 transition outline-none font-bold text-gray-700">
                                <option value="">-- Tetapkan Organizer untuk Monitoring --</option>
                                @foreach($organizers as $organizer)
                                    <option value="{{ $organizer->id }}">{{ $organizer->name }} ({{ $organizer->email }})</option>
                                @endforeach
                            </select>
                            <p class="text-[10px] text-indigo-400 font-bold mt-3 italic">* Organizer yang dipilih dapat memantau penjualan & analitik melalui dashboard mereka.</p>
                        </div>
                    </div>

                    {{-- Ticket Types (Dynamic) --}}
                    <div class="pt-10 border-t border-gray-100">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest">Jenis Tiket</label>
                                <p class="text-[10px] text-gray-400 font-medium">Contoh: VIP, Regular, Early Bird</p>
                            </div>
                            <button type="button" onclick="addTicketType()" class="px-4 py-2 bg-indigo-50 text-indigo-600 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-indigo-100 transition flex items-center gap-2">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                                TAMBAH TIPE
                            </button>
                        </div>
                        
                        <div id="ticket-types-container" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-6 bg-gray-50 rounded-3xl relative">
                                <div>
                                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Nama Tiket</label>
                                    <input type="text" name="ticket_names[]" required placeholder="Reguler" 
                                           class="w-full px-5 py-3 bg-white border-none rounded-xl text-xs focus:ring-2 focus:ring-indigo-500 transition outline-none font-bold text-gray-700 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Harga (Rp)</label>
                                    <input type="number" name="ticket_prices[]" required placeholder="0" 
                                           class="w-full px-5 py-3 bg-white border-none rounded-xl text-xs focus:ring-2 focus:ring-indigo-500 transition outline-none font-bold text-gray-700 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Kuota</label>
                                    <input type="number" name="ticket_quotas[]" required placeholder="100" 
                                           class="w-full px-5 py-3 bg-white border-none rounded-xl text-xs focus:ring-2 focus:ring-indigo-500 transition outline-none font-bold text-gray-700 shadow-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        function addTicketType() {
                            const container = document.getElementById('ticket-types-container');
                            const div = document.createElement('div');
                            div.className = 'grid grid-cols-1 md:grid-cols-3 gap-4 p-6 bg-gray-50 rounded-3xl relative animate-in fade-in slide-in-from-top-4 duration-300';
                            div.innerHTML = `
                                <div>
                                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Nama Tiket</label>
                                    <input type="text" name="ticket_names[]" required placeholder="Contoh: VIP" 
                                           class="w-full px-5 py-3 bg-white border-none rounded-xl text-xs focus:ring-2 focus:ring-indigo-500 transition outline-none font-bold text-gray-700 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Harga (Rp)</label>
                                    <input type="number" name="ticket_prices[]" required placeholder="0" 
                                           class="w-full px-5 py-3 bg-white border-none rounded-xl text-xs focus:ring-2 focus:ring-indigo-500 transition outline-none font-bold text-gray-700 shadow-sm">
                                </div>
                                <div class="relative">
                                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Kuota</label>
                                    <input type="number" name="ticket_quotas[]" required placeholder="0" 
                                           class="w-full px-5 py-3 bg-white border-none rounded-xl text-xs focus:ring-2 focus:ring-indigo-500 transition outline-none font-bold text-gray-700 shadow-sm">
                                    <button type="button" onclick="this.parentElement.parentElement.remove()" class="absolute -top-1 -right-1 w-6 h-6 bg-red-50 text-red-500 rounded-full flex items-center justify-center hover:bg-red-500 hover:text-white transition shadow-sm border border-red-100">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                            `;
                            container.appendChild(div);
                        }
                    </script>

                    <div class="pt-10">
                        <button type="submit" class="w-full py-5 bg-indigo-600 text-white font-black rounded-[28px] hover:bg-indigo-700 transition shadow-xl shadow-indigo-100 text-sm uppercase tracking-widest">
                            Simpan & Publikasikan Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
