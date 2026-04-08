<x-app-layout>
    <div class="py-20 bg-[#F1F5F9] min-h-screen flex items-center justify-center font-sans px-4">
        <div class="max-w-xl w-full">
            
            {{-- Payment Simulation Card --}}
            <div class="bg-white rounded-[60px] shadow-[0_45px_100px_-20px_rgba(0,0,0,0.15)] border border-gray-50 overflow-hidden group animate-in slide-in-from-bottom-10 duration-700">
                
                {{-- Top Status Bar --}}
                <div class="bg-amber-50 px-10 py-4 flex items-center justify-center gap-2 border-b border-amber-100">
                    <div class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></div>
                    <span class="text-[10px] font-black text-amber-600 uppercase tracking-widest">Menunggu Simulasi Pembayaran</span>
                </div>

                <div class="p-12 md:p-16 text-center">
                    {{-- Branding / Logo --}}
                    <div class="w-20 h-20 bg-indigo-600 rounded-3xl flex items-center justify-center mx-auto mb-10 shadow-2xl shadow-indigo-200 rotate-3 group-hover:rotate-0 transition-transform duration-500">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>

                    <h2 class="text-3xl font-black text-gray-900 mb-2 leading-tight uppercase tracking-tighter">Konfirmasi Pembayaran</h2>
                    <p class="text-gray-400 font-medium mb-12">Silakan pilih status pembayaran untuk simulasi sistem.</p>

                    {{-- Invoice Details Section --}}
                    <div class="bg-gray-50 rounded-[40px] p-10 mb-12 border border-gray-100 text-left relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-8 opacity-5">
                            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path></svg>
                        </div>
                        <div class="relative z-10">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total yang Harus Dibayar</p>
                            <h3 class="text-4xl font-black text-gray-900 mb-6 tracking-tighter">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h3>
                            
                            <div class="space-y-3 pt-6 border-t border-gray-200">
                                <div class="flex justify-between items-center text-xs">
                                    <span class="font-bold text-gray-400 uppercase">Order ID</span>
                                    <span class="font-black text-gray-800 tracking-tight">#{{ $order->id }}</span>
                                </div>
                                <div class="flex justify-between items-center text-xs">
                                    <span class="font-bold text-gray-400 uppercase">Event</span>
                                    <span class="font-black text-gray-800 tracking-tight truncate max-w-[150px]">{{ $order->event->title }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons with Simulation Roles --}}
                    <div class="space-y-4">
                        <form action="{{ route('checkout.pay-success', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full py-6 bg-indigo-600 text-white rounded-[24px] font-black text-xs uppercase tracking-[0.2em] shadow-[0_20px_40px_-10px_rgba(79,70,229,0.4)] hover:bg-black transition-all active:scale-95 flex items-center justify-center gap-3">
                                <span>Bayar Sekarang (Simulasi PAID)</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </button>
                        </form>

                        <form action="{{ route('checkout.pay-failed', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full py-6 bg-white text-red-500 border-2 border-red-50 rounded-[24px] font-black text-xs uppercase tracking-[0.2em] hover:bg-red-50 transition-all active:scale-95">
                                Batalkan (Simulasi FAILED)
                            </button>
                        </form>
                    </div>

                    <p class="mt-12 text-[10px] font-bold text-gray-300 uppercase tracking-widest italic">Simulasi ini digunakan untuk memenuhi kriteria Capstone Project</p>
                </div>
            </div>
            
            <a href="{{ route('customer.dashboard') }}" class="mt-10 inline-block text-gray-400 text-xs font-black uppercase tracking-widest hover:text-indigo-600 transition">
                ← Kembali ke Dashboard (Status Tetap PENDING)
            </a>
        </div>
    </div>
</x-app-layout>
