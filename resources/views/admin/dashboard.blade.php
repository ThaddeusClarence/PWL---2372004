<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Analitik Real-Time Admin') }}
            </h2>
            <span class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded-full border border-indigo-400">
                Peran: {{ Auth::user()->role == 'admin' ? 'Administrator Utama' : ucfirst(Auth::user()->role) }}
            </span>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</h3>
                    <p class="text-xs text-green-600 mt-2">Pelanggan: {{ $totalCustomer }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500">Total Pendapatan</p>
                    <h3 class="text-2xl font-bold text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                    <p class="text-xs text-blue-600 mt-2">Akumulasi Penjualan</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500">Event Aktif</p>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $activeEvents }}</h3>
                    <p class="text-xs text-gray-400 mt-2">Sedang Berlangsung</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500">Total Penyelenggara</p>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $totalOrganizer }}</h3>
                    <p class="text-xs text-orange-600 mt-2">Mitra Terverifikasi</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-800 mb-4">Tren Registrasi Pengguna (7 Hari Terakhir)</h3>
                    <canvas id="salesChart" height="150"></canvas>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-800 mb-4">Tindakan Cepat</h3>
                    <div class="space-y-3">
                        <button class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition font-medium text-sm">Verifikasi Penyelenggara</button>
                        <button class="w-full border border-gray-200 text-gray-700 py-2 rounded-lg hover:bg-gray-50 transition text-sm">Kelola Semua Pengguna</button>
                        <button class="w-full border border-gray-200 text-gray-700 py-2 rounded-lg hover:bg-gray-50 transition text-sm">Unduh Laporan (Excel)</button>
                    </div>
                </div>
            </div>

            <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800">Daftar Pengguna Terbaru</h3>
                    <span class="text-xs text-gray-500">Menampilkan data dari tabel `users`</span>
                </div>
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                        <tr>
                            <th class="px-6 py-4">Nama Lengkap</th>
                            <th class="px-6 py-4">Alamat Email</th>
                            <th class="px-6 py-4">Peran/Role</th>
                            <th class="px-6 py-4">Status Akun</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        <tr>
                            <td class="px-6 py-4 font-medium">{{ Auth::user()->name }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ Auth::user()->email }}</td>
                            <td class="px-6 py-4 uppercase font-bold text-xs text-indigo-600">{{ Auth::user()->role }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded-md text-xs">Aktif</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                datasets: [{
                    label: 'Registrasi Pengguna Baru',
                    data: [0, 0, 0, 0, 0, 0, {{ $totalUsers }}],
                    backgroundColor: '#4f46e5',
                    borderRadius: 5
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</x-app-layout>