<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan EventMaster 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Desain khusus saat dicetak ke kertas atau PDF */
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; padding: 0 !important; }
            .print-container { box-shadow: none !important; border: none !important; width: 100% !important; max-width: none !important; }
        }
    </style>
</head>
<body class="bg-gray-100 p-10">

    <div class="print-container max-w-4xl mx-auto bg-white p-10 shadow-lg border border-gray-200 rounded-sm">
        <div class="border-b-4 border-indigo-600 pb-6 mb-8 flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-black tracking-tighter text-gray-900">EVENT<span class="text-indigo-600">MASTER</span></h1>
                <p class="text-sm text-gray-500 font-medium">Platform Manajemen Event Masa Depan</p>
                <p class="text-xs text-gray-400 mt-1 italic">Capstone Project 2026 - Thaddeus Clarence</p>
            </div>
            <div class="text-right text-sm">
                <h2 class="font-bold text-lg text-gray-800">LAPORAN DATA PENGGUNA</h2>
                <p class="text-gray-500">Tanggal Cetak: {{ now()->format('d F Y') }}</p>
                <p class="text-gray-500">Waktu: {{ now()->format('H:i') }} WIB</p>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4 mb-8">
            <div class="border p-3 rounded">
                <p class="text-[10px] uppercase font-bold text-gray-400">Total Pengguna</p>
                <p class="text-lg font-bold">{{ $recentUsers->count() }} Terdaftar Baru</p>
            </div>
            <div class="border p-3 rounded text-center">
                <p class="text-[10px] uppercase font-bold text-gray-400">Status Sistem</p>
                <p class="text-lg font-bold text-green-600">Aktif</p>
            </div>
            <div class="border p-3 rounded text-right">
                <p class="text-[10px] uppercase font-bold text-gray-400">Dicetak Oleh</p>
                <p class="text-lg font-bold">{{ Auth::user()->name }}</p>
            </div>
        </div>

        <table class="w-full text-left border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-50 text-gray-700 text-xs uppercase tracking-wider">
                    <th class="border border-gray-200 px-4 py-3">Nama Lengkap</th>
                    <th class="border border-gray-200 px-4 py-3">Email</th>
                    <th class="border border-gray-200 px-4 py-3">Peran</th>
                    <th class="border border-gray-200 px-4 py-3">Status</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-600">
                @forelse($recentUsers as $user)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-200 px-4 py-3 font-medium text-gray-900">{{ $user->name }}</td>
                    <td class="border border-gray-200 px-4 py-3">{{ $user->email }}</td>
                    <td class="border border-gray-200 px-4 py-3 font-bold uppercase text-[10px]">{{ $user->role }}</td>
                    <td class="border border-gray-200 px-4 py-3">Aktif</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="border border-gray-200 px-4 py-8 text-center text-gray-400">Tidak ada data untuk ditampilkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-16 flex justify-end">
            <div class="text-center w-48 border-t border-gray-800 pt-2">
                <p class="text-xs font-bold uppercase">Administrator</p>
                <p class="text-[10px] text-gray-400 mt-10">{{ Auth::user()->name }}</p>
            </div>
        </div>

        <div class="no-print mt-10 flex gap-3 justify-center">
            <button onclick="window.print()" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:bg-indigo-700 transition active:scale-95">
                Cetak Ulang (Ctrl + P)
            </button>
            <button onclick="window.close()" class="border border-gray-300 text-gray-600 px-8 py-3 rounded-xl font-bold hover:bg-gray-50 transition">
                Tutup Halaman
            </button>
        </div>
    </div>

    <script>
        window.onload = function() {
            // Memberi sedikit jeda agar CSS ter-load sempurna sebelum dialog print muncul
            setTimeout(() => {
                window.print();
            }, 500);
        }
    </script>
</body>
</html>