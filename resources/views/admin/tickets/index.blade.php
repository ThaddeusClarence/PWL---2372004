<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-10 flex justify-between items-end">
                <div>
                    <span class="text-indigo-600 font-black tracking-[0.3em] text-[10px] uppercase mb-4 block">Master Data Tiket</span>
                    <h1 class="text-4xl font-black text-gray-900 leading-none">Daftar Seluruh Tiket 🎫</h1>
                    <p class="mt-4 text-gray-500 font-medium">Pantau semua tiket yang telah diterbitkan sistem untuk verifikasi cepat.</p>
                </div>
                <a href="{{ route('scan.view') }}" class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-indigo-100 hover:bg-black transition-all">
                    Buka Scanner
                </a>
            </div>

            <div class="bg-white rounded-[40px] border border-gray-100 shadow-[0_30px_80px_-20px_rgba(0,0,0,0.08)] overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50/50 text-gray-400 text-[10px] font-black uppercase tracking-[0.2em]">
                                <th class="px-10 py-6">Kode Tiket</th>
                                <th class="px-10 py-6">Pemilik</th>
                                <th class="px-10 py-6">Kategori</th>
                                <th class="px-10 py-6">Status</th>
                                <th class="px-10 py-6">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($tickets as $ticket)
                            <tr class="hover:bg-gray-50/30 transition">
                                <td class="px-10 py-6">
                                    <span class="font-black text-indigo-600 tracking-wider text-sm">#{{ $ticket->ticket_code }}</span>
                                </td>
                                <td class="px-10 py-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center font-bold text-gray-400 text-[10px]">
                                            {{ strtoupper(substr($ticket->user->name, 0, 2)) }}
                                        </div>
                                        <p class="font-bold text-gray-900 text-sm">{{ $ticket->user->name }}</p>
                                    </div>
                                </td>
                                <td class="px-10 py-6">
                                    <p class="font-bold text-gray-800 text-sm italic">{{ $ticket->ticketType->event->title }}</p>
                                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $ticket->ticketType->name }}</span>
                                </td>
                                <td class="px-10 py-6">
                                    @if($ticket->is_used)
                                        <span class="px-3 py-1 bg-red-50 text-red-600 rounded-lg text-[10px] font-black uppercase">Sudah Digunakan</span>
                                    @else
                                        <span class="px-3 py-1 bg-green-50 text-green-600 rounded-lg text-[10px] font-black uppercase">Belum Digunakan</span>
                                    @endif
                                </td>
                                <td class="px-10 py-6">
                                    <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST" onsubmit="return confirm('Sobek tiket ini? Data akan dihapus dari sistem.')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-3 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm" title="Sobek Tiket">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-10 py-20 text-center text-gray-300 italic font-medium">Belum ada tiket yang terjual.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($tickets->hasPages())
                <div class="p-10 border-t border-gray-50 bg-gray-50/30">
                    {{ $tickets->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
