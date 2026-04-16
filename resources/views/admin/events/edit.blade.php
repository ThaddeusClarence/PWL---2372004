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
                <h2 class="text-3xl font-black text-gray-900 leading-tight">Edit Event & Tiket</h2>
                <p class="text-gray-400 font-medium mt-1">Perbarui detail event dan kuota tiket di bawah.</p>
            </div>
        </div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-[40px] border border-gray-100 shadow-sm p-10">
                <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Judul Event</label>
                        <input type="text" name="title" value="{{ $event->title }}" required 
                               class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm focus:ring-4 focus:ring-indigo-50 transition outline-none font-bold text-gray-700">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Kategori</label>
                            <select name="category_id" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm focus:ring-4 focus:ring-indigo-50 transition outline-none font-bold text-gray-700">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ (old('category_id', $event->category_id) == $category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-[10px] font-bold mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3" >Lokasi</label>
                            <input type="text" name="location" value="{{ old('location', $event->location) }}" required 
                                   class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm focus:ring-4 focus:ring-indigo-50 transition outline-none font-bold text-gray-700">
                            @error('location')
                                <p class="text-red-500 text-[10px] font-bold mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Tanggal Event</label>
                            <input type="date" name="date" value="{{ old('date', $event->date) }}" required 
                                   class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm focus:ring-4 focus:ring-indigo-50 transition outline-none font-bold text-gray-700">
                            @error('date')
                                <p class="text-red-500 text-[10px] font-bold mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Jam Mulai</label>
                            <input type="time" name="start_time" value="{{ old('start_time', $event->start_time) }}" required 
                                   class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm focus:ring-4 focus:ring-indigo-50 transition outline-none font-bold text-gray-700">
                            @error('start_time')
                                <p class="text-red-500 text-[10px] font-bold mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Jam Selesai</label>
                            <input type="time" name="end_time" value="{{ old('end_time', $event->end_time) }}" required 
                                   class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm focus:ring-4 focus:ring-indigo-50 transition outline-none font-bold text-gray-700">
                            @error('end_time')
                                <p class="text-red-500 text-[10px] font-bold mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2 bg-indigo-50/50 p-6 rounded-3xl border border-indigo-100/50">
                            <label class="block text-xs font-black text-indigo-600 uppercase tracking-widest mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Tugaskan Organizer (Monitoring)
                            </label>
                            <select name="organizer_id" class="w-full px-6 py-4 bg-white border border-indigo-100 rounded-2xl text-sm focus:ring-4 focus:ring-indigo-50 transition outline-none font-bold text-gray-700">
                                <option value="">-- Tetapkan Organizer --</option>
                                @foreach($organizers as $organizer)
                                    <option value="{{ $organizer->id }}" {{ old('organizer_id', $event->organizer_id) == $organizer->id ? 'selected' : '' }}>
                                        {{ $organizer->name }} ({{ $organizer->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="md:col-span-2">
                             <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Banner</label>
                             <input type="file" name="banner" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                             @error('banner')
                                <p class="text-red-500 text-[10px] font-bold mt-2">{{ $message }}</p>
                             @enderror
                        </div>
                    </div>

                    {{-- MANAJEMEN TIKET --}}
                    <div class="pt-8 border-t border-gray-100">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest flex items-center gap-2">
                                <span class="w-8 h-8 bg-black text-white rounded-lg flex items-center justify-center text-[10px]">TIX</span>
                                Manajemen Kategori Tiket
                            </h3>
                            <button type="button" onclick="addTicketType()" class="px-4 py-2 bg-indigo-50 text-indigo-600 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-indigo-100 transition flex items-center gap-2">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                                TAMBAH TIPE
                            </button>
                        </div>

                        <div id="ticket-container" class="space-y-4">
                            @foreach($event->ticketTypes as $index => $type)
                            <div class="bg-gray-50 p-6 rounded-3xl border border-gray-100 relative group">
                                <input type="hidden" name="ticket_ids[]" value="{{ $type->id }}">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Nama Tiket</label>
                                        <input type="text" name="ticket_names[]" value="{{ old('ticket_names.'.$index, $type->name) }}" required class="w-full px-4 py-3 bg-white border-none rounded-xl text-xs font-bold focus:ring-2 focus:ring-indigo-500 transition">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Harga (Rp)</label>
                                        <input type="number" name="ticket_prices[]" value="{{ old('ticket_prices.'.$index, $type->price) }}" required class="w-full px-4 py-3 bg-white border-none rounded-xl text-xs font-bold focus:ring-2 focus:ring-indigo-500 transition">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Kuota</label>
                                        <input type="number" name="ticket_quotas[]" value="{{ old('ticket_quotas.'.$index, $type->quota) }}" required class="w-full px-4 py-3 bg-white border-none rounded-xl text-xs font-bold focus:ring-2 focus:ring-indigo-500 transition">
                                    </div>
                                </div>
                                <div class="flex justify-between items-center mt-3">
                                    <p class="text-[9px] text-gray-400 italic font-medium">*Tersisa: {{ $type->remaining_quota }} tiket</p>
                                    <button type="button" onclick="this.parentElement.parentElement.remove()" class="w-6 h-6 bg-red-50 text-red-500 rounded-full flex items-center justify-center hover:bg-red-500 hover:text-white transition shadow-sm border border-red-100">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <script>
                        function addTicketType() {
                            const container = document.getElementById('ticket-container');
                            const div = document.createElement('div');
                            div.className = 'bg-gray-50 p-6 rounded-3xl border border-gray-100 relative group animate-in fade-in slide-in-from-top-4 duration-300';
                            div.innerHTML = `
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Nama Tiket</label>
                                        <input type="text" name="ticket_names[]" required class="w-full px-4 py-3 bg-white border-none rounded-xl text-xs font-bold focus:ring-2 focus:ring-indigo-500 transition">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Harga (Rp)</label>
                                        <input type="number" name="ticket_prices[]" required class="w-full px-4 py-3 bg-white border-none rounded-xl text-xs font-bold focus:ring-2 focus:ring-indigo-500 transition">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Kuota</label>
                                        <input type="number" name="ticket_quotas[]" required class="w-full px-4 py-3 bg-white border-none rounded-xl text-xs font-bold focus:ring-2 focus:ring-indigo-500 transition">
                                    </div>
                                </div>
                                <button type="button" onclick="this.parentElement.remove()" class="absolute -top-1 -right-1 w-6 h-6 bg-red-50 text-red-500 rounded-full flex items-center justify-center hover:bg-red-500 hover:text-white transition shadow-sm border border-red-100">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            `;
                            container.appendChild(div);
                        }
                    </script>

                    <div class="pt-10">
                        <button type="submit" class="w-full py-5 bg-indigo-600 text-white font-black rounded-[28px] hover:bg-black transition shadow-xl shadow-indigo-100 text-sm uppercase tracking-widest">
                            SIMPAN SEMUA PERUBAHAN
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
