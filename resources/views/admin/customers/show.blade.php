<x-app-layout>
    <div class="py-12 bg-[#F8FAFC] min-h-screen font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Back Button --}}
            <a href="{{ route('admin.customers.index') }}" class="inline-flex items-center gap-2 text-indigo-600 font-bold text-xs uppercase tracking-widest mb-8 hover:gap-4 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7 m0 0l7-7 m-7 7h18"></path></svg>
                Kembali ke Daftar Customer
            </a>

            @if(session('success'))
                <div class="mb-8 p-6 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-[30px] font-bold text-sm flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                {{-- Left: User Profile Card --}}
                <div class="lg:col-span-1 space-y-8">
                    <div class="bg-white p-10 rounded-[40px] shadow-sm border border-gray-100 text-center">
                        <div class="w-24 h-24 bg-indigo-600 text-white rounded-[32px] flex items-center justify-center font-black text-3xl mx-auto mb-6 shadow-xl shadow-indigo-100">
                            {{ strtoupper(substr($customer->name, 0, 1)) }}
                        </div>
                        <h2 class="text-2xl font-black text-gray-900 leading-tight">{{ $customer->name }}</h2>
                        <p class="text-gray-400 font-bold text-xs uppercase tracking-widest mt-1">Customer Account</p>
                        
                        <div class="mt-8 pt-8 border-t border-gray-50 space-y-4 text-left">
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Email Address</p>
                                <p class="text-sm font-bold text-gray-900 mt-1">{{ $customer->email }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Join Date</p>
                                <p class="text-sm font-bold text-gray-900 mt-1">{{ $customer->created_at->format('d F Y') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Account Security Card --}}
                    <div class="bg-indigo-900 p-10 rounded-[40px] shadow-xl text-white relative overflow-hidden">
                        <div class="relative z-10">
                            <h3 class="text-lg font-black mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                Password Preview
                            </h3>
                            <div>
                                <p class="text-[10px] font-black text-white/50 uppercase tracking-widest">Account Password</p>
                                @if($customer->password_plain)
                                    <p class="text-2xl font-black tracking-[0.2em] mt-2">{{ $customer->password_plain }}</p>
                                @else
                                    <p class="text-xs font-medium italic text-white/50 mt-2">Hashed (Encrypted Security)</p>
                                    <p class="text-[9px] text-white/40 mt-1 italic leading-relaxed">Gunakan form di bawah untuk mereset agar password terbaca.</p>
                                @endif
                            </div>
                        </div>
                        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                    </div>

                    {{-- NEW: Update Password Form --}}
                    <div class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100">
                        <h4 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Reset Password Customer</h4>
                        <form action="{{ route('admin.customers.password.update', $customer->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="text" name="new_password" placeholder="Ketik Password Baru..." class="w-full px-5 py-3 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-2 focus:ring-indigo-500 transition" required>
                            <button type="submit" class="w-full py-3 bg-gray-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-indigo-600 transition shadow-lg shadow-gray-100">
                                GANTI PASSWORD SEKARANG
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Right: Transaction History --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-8 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                            <h3 class="text-sm font-black text-gray-400 uppercase tracking-widest">Transaction History</h3>
                            <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-widest">{{ $orders->count() }} Total Orders</span>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <tbody class="divide-y divide-gray-50">
                                    @forelse($orders as $order)
                                    <tr class="hover:bg-gray-50/50 transition">
                                        <td class="px-10 py-8">
                                            <p class="text-sm font-black text-gray-900">{{ $order->event->title }}</p>
                                            <p class="text-[10px] font-bold text-gray-400 mt-1 uppercase">ORDER #{{ $order->id }} • {{ $order->created_at->format('d M Y') }}</p>
                                        </td>
                                        <td class="px-10 py-8">
                                            <div class="flex items-center gap-3">
                                                @if($order->status == 'paid')
                                                    <span class="text-emerald-600 text-[10px] font-black uppercase tracking-widest">✅ PAID</span>
                                                @elseif($order->status == 'pending')
                                                    <span class="text-amber-500 text-[10px] font-black uppercase tracking-widest">⏳ PENDING</span>
                                                @else
                                                    <span class="text-red-500 text-[10px] font-black uppercase tracking-widest">❌ FAILED</span>
                                                @endif

                                                {{-- Simulasi Admin --}}
                                                <div class="flex gap-1 ml-4 grayscale opacity-30 hover:grayscale-0 hover:opacity-100 transition-all">
                                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="status" value="paid">
                                                        <button type="submit" class="p-1 hover:bg-emerald-50 text-emerald-600 rounded border border-emerald-100" title="Set to Paid">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="status" value="failed">
                                                        <button type="submit" class="p-1 hover:bg-red-50 text-red-600 rounded border border-red-100" title="Set to Failed">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-10 py-8 text-right">
                                            <p class="text-sm font-black text-gray-900 tabular-nums">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="py-24 text-center">
                                            <p class="font-black uppercase tracking-widest text-[10px] text-gray-300">Belum ada transaksi</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
