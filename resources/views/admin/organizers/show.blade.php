<x-app-layout>
    <div class="py-12 bg-[#F8FAFC] min-h-screen font-sans">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Navigation Action --}}
            <div class="mb-8">
                <a href="{{ route('admin.organizers.index') }}" class="inline-flex items-center text-sm font-bold text-gray-400 hover:text-indigo-600 transition tracking-widest uppercase gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali Ke Daftar
                </a>
            </div>

            {{-- Main Profile Card --}}
            <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 overflow-hidden">
                <div class="h-32 bg-indigo-600 relative">
                    <div class="absolute -bottom-12 left-12">
                        <div class="w-24 h-24 bg-white rounded-3xl p-1 shadow-xl">
                            <div class="w-full h-full bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 font-black text-4xl">
                                {{ strtoupper(substr($organizer->name, 0, 1)) }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="pt-16 pb-12 px-12">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                        <div>
                            <h2 class="text-3xl font-black text-gray-900 tracking-tight">{{ $organizer->name }}</h2>
                            <p class="text-indigo-600 font-bold text-sm bg-indigo-50 px-3 py-1 rounded-full inline-block mt-2">Organizer Account</p>
                        </div>
                        <div class="flex gap-3">
                            <form action="{{ route('admin.organizers.destroy', $organizer->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-6 py-3 bg-red-50 text-red-600 font-black rounded-2xl hover:bg-red-600 hover:text-white transition shadow-sm border border-red-100 text-xs uppercase tracking-widest">Hapus Akun</button>
                            </form>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mt-12">
                        {{-- Account Info --}}
                        <div class="space-y-6">
                            <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Detail Kredensial</h3>
                            
                            <div class="p-6 bg-gray-50 rounded-3xl border border-gray-100 space-y-4">
                                <div>
                                    <label class="text-[10px] font-black text-gray-300 uppercase block tracking-widest mb-1">Email Address</label>
                                    <p class="text-sm font-bold text-gray-900">{{ $organizer->email }}</p>
                                </div>
                                <div class="pt-4 border-t border-gray-100">
                                    <label class="text-[10px] font-black text-gray-300 uppercase block tracking-widest mb-1">Account Password (Plain)</label>
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-black text-gray-900 tracking-wider">{{ $organizer->password_plain ?? 'Default/Unknown' }}</p>
                                        <span class="text-[9px] font-black text-emerald-500 bg-emerald-50 px-2 py-0.5 rounded italic">Visible for Admin</span>
                                    </div>
                                    <p class="text-[10px] text-gray-400 mt-2 italic">*Password ini disimpan dalam teks asli khusus untuk kebutuhan pemantauan admin.</p>
                                </div>
                                <div class="pt-4 border-t border-gray-100">
                                    <label class="text-[10px] font-black text-gray-300 uppercase block tracking-widest mb-1">Terdaftar Sejak</label>
                                    <p class="text-sm font-bold text-gray-900">{{ $organizer->created_at->format('d M Y, H:i') }} WIB</p>
                                </div>
                            </div>
                        </div>

                        {{-- Stats Overview --}}
                        <div class="space-y-6">
                            <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Performa Penyelenggara</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="p-6 bg-indigo-50/50 rounded-3xl border border-indigo-100 text-center">
                                    <p class="text-3xl font-black text-indigo-600 leading-none">{{ $stats['total_events'] }}</p>
                                    <p class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mt-2">Active Events</p>
                                </div>
                                <div class="p-6 bg-emerald-50/50 rounded-3xl border border-emerald-100 text-center">
                                    <p class="text-3xl font-black text-emerald-600 leading-none">{{ $stats['total_sales'] }}</p>
                                    <p class="text-[10px] font-black text-emerald-400 uppercase tracking-widest mt-2">Tickets Sold</p>
                                </div>
                            </div>
                            <div class="p-8 bg-gray-900 rounded-[30px] text-white">
                                <h4 class="text-sm font-black mb-4">Quick Note 📝</h4>
                                <p class="text-xs text-gray-400 font-medium leading-relaxed italic">Organizer ini tergabung dalam skema premium partner. Memiliki otorisasi untuk membuat event publik dan memantau analitik tiket secara real-time.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
