<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        .admin-font { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    <div class="admin-font bg-[#fbfcfd] min-h-screen pb-20">
        <div class="bg-white border-b border-gray-100 py-10 mb-10 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 font-bold text-[10px] uppercase tracking-widest mb-2 flex items-center gap-2 hover:gap-3 transition-all">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Dashboard
                    </a>
                    <h2 class="text-3xl font-black text-gray-900 leading-tight">Manajemen Kategori</h2>
                    <p class="text-gray-400 font-medium mt-1">Kelola daftar kategori yang tersedia untuk event.</p>
                </div>
                <a href="{{ route('admin.categories.create') }}" class="px-8 py-4 bg-indigo-600 text-white rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-black transition-all shadow-xl shadow-indigo-100 active:scale-95">
                    Tambah Kategori Baru
                </a>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="mb-8 p-6 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-3xl flex items-center gap-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                <p class="font-bold text-sm">{{ session('success') }}</p>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-8 p-6 bg-red-50 border border-red-100 text-red-600 rounded-3xl flex items-center gap-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="font-bold text-sm">{{ session('error') }}</p>
            </div>
            @endif

            <div class="bg-white rounded-[40px] border border-gray-100 shadow-[0_30px_80px_-20px_rgba(0,0,0,0.08)] overflow-hidden mb-20">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50/50 text-gray-400 text-[10px] font-black uppercase tracking-[0.2em]">
                                <th class="px-10 py-6">Nama Kategori</th>
                                <th class="px-10 py-6">Slug</th>
                                <th class="px-10 py-6 text-center">Total Event</th>
                                <th class="px-10 py-6 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($categories as $category)
                            <tr class="hover:bg-gray-50/30 transition group">
                                <td class="px-10 py-8">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center font-black text-indigo-600">
                                            {{ strtoupper(substr($category->name, 0, 1)) }}
                                        </div>
                                        <p class="font-bold text-gray-900 group-hover:text-indigo-600 transition">{{ $category->name }}</p>
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    <code class="text-xs bg-gray-100 px-3 py-1.5 rounded-lg text-gray-500 font-bold tracking-tight">{{ $category->slug }}</code>
                                </td>
                                <td class="px-10 py-8 text-center">
                                    <span class="px-4 py-1.5 bg-gray-50 rounded-full text-xs font-black text-gray-600 border border-gray-100">
                                        {{ $category->events_count }} Event
                                    </span>
                                </td>
                                <td class="px-10 py-8">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="p-3 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-3 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition shadow-sm">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-10 py-20 text-center text-gray-300 italic font-medium">Belum ada kategori yang ditambahkan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
