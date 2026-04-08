<x-app-layout>
    <div class="py-12 bg-[#F8FAFC] min-h-screen font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Header Section --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6 bg-white p-10 rounded-[40px] shadow-sm border border-gray-100">
                <div>
                    <span class="text-amber-600 font-bold text-xs uppercase tracking-[0.2em] mb-2 block">High Demand Management</span>
                    <h2 class="text-4xl font-black text-gray-900 leading-tight tracking-tight">Manajemen Waiting List ⏳</h2>
                    <p class="text-gray-400 font-medium mt-1">Pantau pendaftar antrean untuk event-event yang sudah habis terjual.</p>
                </div>
            </div>

            {{-- Table Card --}}
            <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 overflow-hidden mb-12">
                <div class="p-8 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                    <h3 class="text-sm font-black text-gray-400 uppercase tracking-widest">Daftar Antrean Aktif</h3>
                    <span class="px-4 py-1.5 bg-amber-50 text-amber-600 rounded-full text-[10px] font-black uppercase tracking-widest">{{ $waitingLists->count() }} Users Waiting</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-gray-400 text-[10px] font-black uppercase tracking-[0.2em] border-b border-gray-50 bg-gray-50/30">
                                <th class="px-10 py-6">Customer</th>
                                <th class="px-10 py-6">Target Event</th>
                                <th class="px-10 py-6">Category</th>
                                <th class="px-10 py-6">Date Joined</th>
                                <th class="px-10 py-6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($waitingLists as $list)
                            <tr class="hover:bg-gray-50/50 transition group">
                                <td class="px-10 py-7">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center font-black group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                            {{ strtoupper(substr($list->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-gray-900">{{ $list->user->name }}</p>
                                            <p class="text-[10px] font-bold text-gray-400">{{ $list->user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-7">
                                    <p class="text-sm font-bold text-gray-700">{{ $list->event->title }}</p>
                                </td>
                                <td class="px-10 py-7">
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-[10px] font-black uppercase tracking-wider">
                                        {{ $list->ticket_type_name ?? 'Any Category' }}
                                    </span>
                                </td>
                                <td class="px-10 py-7">
                                    <p class="text-sm font-bold text-gray-500">{{ $list->created_at->format('d M Y, H:i') }}</p>
                                    <p class="text-[10px] text-gray-400 italic">{{ $list->created_at->diffForHumans() }}</p>
                                </td>
                                <td class="px-10 py-7 text-right">
                                    <form action="{{ route('admin.waiting-list.destroy', $list->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-3 bg-red-50 text-red-500 rounded-2xl hover:bg-red-500 hover:text-white transition shadow-sm border border-red-100 flex items-center gap-2 text-[10px] font-black uppercase tracking-widest mx-auto">
                                            Hapus Antrean
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-24 text-center">
                                    <div class="flex flex-col items-center opacity-30">
                                        <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <p class="font-black uppercase tracking-widest text-xs tracking-widest">Belum ada antrean masuk</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Technical Info Card (Queue) --}}
            <div class="bg-indigo-900 rounded-[40px] p-10 text-white relative overflow-hidden">
                <div class="relative z-10 grid md:grid-cols-2 gap-10 items-center">
                    <div>
                        <h3 class="text-2xl font-black mb-4">Status Laravel Queue ⚡</h3>
                        <p class="text-indigo-200 text-sm font-medium leading-relaxed">Sistem antrean background sedang berjalan secara otomatis. Semua tugas pengiriman email tiket dan pemrosesan data berat dilakukan oleh sistem tanpa mengganggu kenyamanan pengguna.</p>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-1 bg-white/10 p-6 rounded-3xl border border-white/10 text-center">
                            <p class="text-[10px] font-black uppercase tracking-widest text-indigo-300 mb-2">Driver Antrean</p>
                            <p class="text-2xl font-black">Database</p>
                        </div>
                        <div class="flex-1 bg-white/10 p-6 rounded-3xl border border-white/10 text-center">
                            <p class="text-[10px] font-black uppercase tracking-widest text-indigo-300 mb-2">Status Pekerjaan</p>
                            <p class="text-2xl font-black">Optimized</p>
                        </div>
                    </div>
                </div>
                <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
            </div>

        </div>
    </div>
</x-app-layout>
