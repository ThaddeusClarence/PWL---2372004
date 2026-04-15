<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-black text-gray-900">Manajemen Organizer</h2>
                    <p class="text-gray-500 text-sm">Kelola akun penyelenggara event yang terdaftar.</p>
                </div>
                <a href="{{ route('admin.organizers.create') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                    + Tambah Organizer Baru
                </a>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-xl font-bold text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100">
                <div class="p-0">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-xs font-black text-gray-400 uppercase tracking-widest">Nama</th>
                                <th class="px-6 py-4 text-xs font-black text-gray-400 uppercase tracking-widest">Email</th>
                                <th class="px-6 py-4 text-xs font-black text-gray-400 uppercase tracking-widest">Tanggal Bergabung</th>
                                <th class="px-6 py-4 text-xs font-black text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($organizers as $org)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 font-black">
                                            {{ substr($org->name, 0, 1) }}
                                        </div>
                                        <span class="font-bold text-gray-900">{{ $org->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-500">{{ $org->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-400 font-medium italic italic">{{ $org->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-4">
                                        <a href="{{ route('admin.organizers.show', $org->id) }}" class="text-xs font-black text-indigo-500 hover:text-indigo-700 transition tracking-widest uppercase">Lihat Detail</a>
                                        <a href="{{ route('admin.organizers.edit', $org->id) }}" class="text-xs font-black text-amber-500 hover:text-amber-700 transition tracking-widest uppercase">Edit</a>
                                        <form action="{{ route('admin.organizers.destroy', $org->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun organizer ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs font-black text-red-400 hover:text-red-600 transition tracking-widest uppercase flex items-center justify-end gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-400 font-bold italic">Belum ada organizer yang dibuat.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
