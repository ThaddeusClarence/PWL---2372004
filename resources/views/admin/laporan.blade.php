<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan EventMaster 2026</title>
    <style>
        @page {
            margin: 1cm;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }
        .header {
            border-bottom: 4px solid #4f46e5;
            padding-bottom: 20px;
            margin-bottom: 30px;
            overflow: hidden;
        }
        .logo {
            float: left;
        }
        .logo-text {
            font-size: 24px;
            font-weight: 900;
            letter-spacing: -1px;
            color: #111;
            margin: 0;
        }
        .logo-event { color: #111; }
        .logo-master { color: #4f46e5; }
        .slogan {
            font-size: 10px;
            color: #666;
            margin: 0;
        }
        .capstone {
            font-size: 8px;
            color: #999;
            font-style: italic;
            margin-top: 5px;
        }
        .date-info {
            float: right;
            text-align: right;
        }
        .doc-title {
            font-size: 16px;
            font-weight: bold;
            color: #1f2937;
            margin: 0;
        }
        .date-text {
            color: #6b7280;
            font-size: 10px;
            margin: 2px 0;
        }
        .stats-grid {
            width: 100%;
            margin-bottom: 30px;
            border-spacing: 10px 0;
            margin-left: -10px;
        }
        .stats-card {
            border: 1px solid #e5e7eb;
            padding: 10px;
            border-radius: 4px;
            width: 33.33%;
        }
        .stats-label {
            font-size: 8px;
            text-transform: uppercase;
            font-weight: bold;
            color: #9ca3af;
            margin: 0;
        }
        .stats-value {
            font-size: 14px;
            font-weight: bold;
            color: #111;
            margin: 5px 0 0 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 50px;
        }
        th {
            background-color: #f9fafb;
            color: #4b5563;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            text-align: left;
            padding: 10px 15px;
            border: 1px solid #e5e7eb;
        }
        td {
            padding: 10px 15px;
            border: 1px solid #e5e7eb;
            font-size: 11px;
        }
        .text-bold { font-weight: bold; }
        .role-badge {
            font-size: 8px;
            padding: 2px 6px;
            border-radius: 99px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .role-admin { background-color: #fee2e2; color: #b91c1c; }
        .role-organizer { background-color: #dbeafe; color: #1e40af; }
        .role-customer { background-color: #f3f4f6; color: #374151; }
        .footer {
            margin-top: 50px;
            overflow: hidden;
        }
        .signature-box {
            float: right;
            width: 180px;
            text-align: center;
        }
        .signature-line {
            border-top: 1px solid #111;
            padding-top: 8px;
            margin-top: 60px;
        }
        .signature-title {
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .signature-name {
            font-size: 8px;
            color: #666;
            margin-top: 5px;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <h1 class="logo-text"><span class="logo-event">EVENT</span><span class="logo-master">MASTER</span></h1>
            <p class="slogan">Platform Manajemen Event Masa Depan</p>
            <p class="capstone">Capstone Project 2026 - Thaddeus Clarence</p>
        </div>
        <div class="date-info">
            <h2 class="doc-title">LAPORAN DATA PENGGUNA</h2>
            <p class="date-text">Tanggal Cetak: {{ now()->format('d F Y') }}</p>
            <p class="date-text">Waktu: {{ now()->format('H:i') }} WIB</p>
        </div>
    </div>

    <table class="stats-grid">
        <tr>
            <td class="stats-card">
                <p class="stats-label">Total Pengguna</p>
                <p class="stats-value">{{ $recentUsers->count() }} Terdaftar Baru</p>
            </td>
            <td class="stats-card" style="text-align: center;">
                <p class="stats-label">Status Sistem</p>
                <p class="stats-value" style="color: #059669;">Aktif</p>
            </td>
            <td class="stats-card" style="text-align: right;">
                <p class="stats-label">Dicetak Oleh</p>
                <p class="stats-value">{{ Auth::check() ? Auth::user()->name : 'System' }}</p>
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Peran</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentUsers as $user)
            <tr>
                <td class="text-bold">{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="role-badge @if($user->role == 'admin') role-admin @elseif($user->role == 'organizer') role-organizer @else role-customer @endif">
                        {{ $user->role }}
                    </span>
                </td>
                <td>Aktif</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; color: #999; font-style: italic; padding: 30px;">
                    Tidak ada data untuk ditampilkan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <div class="signature-box">
            <div class="signature-line">
                <p class="signature-title">Administrator Utama</p>
                <p class="signature-name">{{ Auth::check() ? Auth::user()->name : 'Admin System' }}</p>
            </div>
        </div>
    </div>
</body>
</html>