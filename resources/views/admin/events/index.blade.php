<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        .admin-font { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    <div class="admin-font bg-[#fbfcfd] min-h-screen pb-20">
        <div class="bg-white border-b border-gray-100 py-10 mb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <div>
                    <h2 class="text-3xl font-black text-gray-900 leading-tight">Manajemen Event</h2>
                    <p class="text-gray-400 font-medium mt-1">Daftar semua event yang tersedia di platform.</p>
                </div>
                <a href="{{ route('admin.events.create') }}" class="px-6 py-3 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Event Baru
                </a>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-100 text-green-700 rounded-2xl font-bold flex items-center gap-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-[40px] border border-gray-100 shadow-sm overflow-hidden mb-10">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50/50 text-gray-400 text-[10px] font-black uppercase tracking-[0.2em]">
                                <th class="px-8 py-6">Banner & Judul</th>
                                <th class="px-8 py-6">Kategori</th>
                                <th class="px-8 py-6">Lokasi & Tanggal</th>
                                <th class="px-8 py-6">Kuota & Harga</th>
                                <th class="px-8 py-6">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($events as $event)
                            <tr class="hover:bg-gray-50/30 transition">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-10 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                            @if($event->banner)
                                                <img src="{{ asset('storage/' . $event->banner) }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900 leading-tight">{{ $event->title }}</p>
                                            <p class="text-[10px] text-indigo-500 font-bold uppercase mt-1">ID: #EVENT-{{ $event->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-[10px] font-black uppercase">
                                        {{ $event->category }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-sm font-bold text-gray-700 leading-none">{{ $event->location }}</p>
                                    <p class="text-[10px] text-gray-400 font-bold mt-1 uppercase">{{ $event->date }} | {{ $event->start_time }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-sm font-bold text-gray-700 leading-none">{{ $event->quota }} Tiket</p>
                                    <p class="text-xs text-indigo-600 font-bold mt-1">Rp {{ number_format($event->price, 0, ',', '.') }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.events.edit', $event) }}" class="p-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center text-gray-300 italic font-medium">Belum ada event yang dibuat.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-8 py-6 border-t border-gray-50">
                    {{ $events->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
