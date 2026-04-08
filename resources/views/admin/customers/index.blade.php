<x-app-layout>
    <div class="py-12 bg-[#F8FAFC] min-h-screen font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Header Section --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6 bg-white p-10 rounded-[40px] shadow-sm border border-gray-100">
                <div>
                    <span class="text-indigo-600 font-bold text-xs uppercase tracking-[0.2em] mb-2 block">User Moderation</span>
                    <h2 class="text-4xl font-black text-gray-900 leading-tight tracking-tight">Manajemen Customer 👥</h2>
                    <p class="text-gray-400 font-medium mt-1">Kelola seluruh data pembeli tiket yang terdaftar di platform EventMaster.</p>
                </div>
            </div>

            {{-- Message Alerts --}}
            @if(session('success'))
                <div class="mb-8 p-6 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-[30px] font-bold text-sm flex items-center gap-3 animate-in fade-in slide-in-from-top-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Table Card --}}
            <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 overflow-hidden mb-12">
                <div class="p-8 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                    <h3 class="text-sm font-black text-gray-400 uppercase tracking-widest">Daftar Customer Terdaftar</h3>
                    <span class="px-4 py-1.5 bg-indigo-50 text-indigo-600 rounded-full text-[10px] font-black uppercase tracking-widest">{{ $customers->count() }} Total Accounts</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-gray-400 text-[10px] font-black uppercase tracking-[0.2em] border-b border-gray-50">
                                <th class="px-10 py-6">Customer Profile</th>
                                <th class="px-10 py-6">Join Date</th>
                                <th class="px-10 py-6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($customers as $cust)
                            <tr class="hover:bg-gray-50/80 transition group">
                                <td class="px-10 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center font-black group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                                            {{ strtoupper(substr($cust->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-gray-900 tracking-tight">{{ $cust->name }}</p>
                                            <p class="text-[11px] font-bold text-gray-400">{{ $cust->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-6">
                                    <p class="text-xs font-bold text-gray-600">{{ $cust->created_at->format('d M Y') }}</p>
                                    <p class="text-[10px] text-gray-400 font-medium italic mt-0.5">{{ $cust->created_at->diffForHumans() }}</p>
                                </td>
                                <td class="px-10 py-6 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('admin.customers.show', $cust->id) }}" class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl hover:bg-indigo-600 hover:text-white transition shadow-sm border border-indigo-100 flex items-center gap-2 text-[10px] font-black uppercase tracking-widest">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            Detail & Akun
                                        </a>
                                        <form action="{{ route('admin.customers.destroy', $cust->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun customer ini? Semua data pesanan miliknya juga akan dihapus.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-3 bg-red-50 text-red-500 rounded-2xl hover:bg-red-500 hover:text-white transition shadow-sm border border-red-100 flex items-center gap-2 text-[10px] font-black uppercase tracking-widest">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                Hapus Akun
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="py-24 text-center">
                                    <div class="flex flex-col items-center opacity-30">
                                        <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        <p class="font-black uppercase tracking-widest text-xs">Belum ada customer terdaftar</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
