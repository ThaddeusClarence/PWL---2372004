<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelian Berhasil - EventMaster</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .ticket-cut { clip-path: polygon(0 0, 100% 0, 100% 70%, 95% 75%, 100% 80%, 100% 100%, 0 100%, 0 80%, 5% 75%, 0 70%); }
    </style>
</head>
<body class="bg-indigo-600 min-h-screen flex items-center justify-center p-6">

    <div class="max-w-md w-full animate-in fade-in zoom-in duration-500">
        <div class="bg-white rounded-[40px] overflow-hidden shadow-2xl">
            {{-- Bagian Atas: Status --}}
            <div class="bg-emerald-500 p-8 text-center text-white">
                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h1 class="text-2xl font-black mb-1">Pembelian Berhasil!</h1>
                <p class="text-white/80 font-medium">E-Tiket Anda telah siap digunakan.</p>
            </div>

            {{-- Bagian Tengah: Info Tiket --}}
            <div class="p-8 space-y-6">
                <div>
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-1">EVENT</span>
                    <h2 class="text-xl font-bold text-gray-900">{{ $order->event->title }}</h2>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-1">TANGGAL</span>
                        <p class="font-bold text-gray-800">{{ \Carbon\Carbon::parse($order->event->date)->format('d M Y') }}</p>
                    </div>
                    <div>
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-1">WAKTU</span>
                        <p class="font-bold text-gray-800">{{ \Carbon\Carbon::parse($order->event->start_time)->format('H:i') }} WIB</p>
                    </div>
                </div>

                <div class="pt-6 border-t border-dashed border-gray-200">
                    <div class="flex justify-between items-center text-sm font-bold text-gray-500 mb-2">
                        <span>Jenis Tiket</span>
                        <span class="text-gray-900">{{ $order->tickets->first()->ticketType->name }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm font-bold text-gray-500 mb-2">
                        <span>Kode Tiket</span>
                        <span class="text-indigo-600 tracking-tighter">{{ $order->tickets->first()->ticket_code }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm font-bold text-gray-500 mb-2">
                        <span>Metode Bayar</span>
                        <span class="text-gray-900">{{ $order->payment_method }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm font-bold text-gray-500">
                        <span>Total Bayar</span>
                        <span class="text-gray-900 font-extrabold text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- Bagian Bawah: QR Code --}}
            <div class="bg-gray-50 p-8 border-t border-dashed border-gray-200 flex flex-col items-center">
                <div class="bg-white p-4 rounded-3xl shadow-sm mb-4 border border-gray-100">
                    {!! QrCode::size(160)->generate($order->tickets->first()->ticket_code) !!}
                </div>
                <p class="text-xs font-bold text-gray-400 text-center px-6">
                    Tunjukkan QR Code ini kepada pertugas di lokasi event untuk melakukan verifikasi masuk.
                </p>
            </div>
        </div>

        <div class="mt-8 flex flex-col gap-4">
            <a href="{{ route('customer.dashboard') }}" class="w-full bg-white/10 hover:bg-white/20 text-white text-center py-4 rounded-2xl font-black text-sm border border-white/10 transition-all">
                Kembali ke Dashboard
            </a>
            <button onclick="window.print()" class="w-full text-indigo-100 text-xs font-extrabold uppercase tracking-widest hover:text-white transition">
                Cetak atau Simpan PDF
            </button>
        </div>
    </div>

</body>
</html>
