<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>E-Ticket EventMaster</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f4f7f6; margin: 0; padding: 0; -webkit-font-smoothing: antialiased; }
        .wrapper { width: 100%; table-layout: fixed; background-color: #f4f7f6; padding-bottom: 60px; padding-top: 60px; }
        .main { background-color: #ffffff; margin: 0 auto; width: 100%; max-width: 600px; border-radius: 24px; border-spacing: 0; color: #1a1a1a; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.05); }
        .header { background-color: #4f46e5; padding: 40px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 24px; font-weight: 800; letter-spacing: -0.5px; }
        .content { padding: 40px; }
        .event-title { font-size: 28px; font-weight: 900; margin: 0 0 10px 0; color: #111827; line-height: 1.2; }
        .event-detail { font-size: 14px; color: #6b7280; font-weight: 500; margin-bottom: 30px; }
        .ticket-box { background-color: #f9fafb; border: 2px dashed #e5e7eb; border-radius: 20px; padding: 30px; text-align: center; margin-top: 20px; }
        .qr-code { margin-bottom: 20px; }
        .qr-code img { width: 180px; height: 180px; }
        .ticket-code { font-family: 'Courier New', Courier, monospace; font-size: 20px; font-weight: 800; color: #4f46e5; margin: 10px 0; letter-spacing: 2px; }
        .label { font-size: 10px; font-weight: 800; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; }
        .info-grid { width: 100%; margin-top: 30px; border-top: 1px solid #f3f4f6; padding-top: 20px; }
        .info-item { padding: 10px 0; }
        .footer { text-align: center; padding: 30px; font-size: 12px; color: #9ca3af; }
    </style>
</head>
<body>
    <center class="wrapper">
        <table class="main" width="100%">
            <tr>
                <td class="header">
                    <h1>EVENTMASTER</h1>
                </td>
            </tr>
            <tr>
                <td class="content">
                    <p class="label">Pesanan Berhasil Konfirmasi</p>
                    <h2 class="event-title">{{ $order->event->title }}</h2>
                    <p class="event-detail">{{ \Carbon\Carbon::parse($order->event->date)->format('d F Y') }} • {{ $order->event->location }}</p>

                    <table class="info-grid">
                        <tr>
                            <td width="50%" class="info-item">
                                <p class="label">Nama Pembeli</p>
                                <p style="margin:0; font-weight: 700;">{{ $order->user->name }}</p>
                            </td>
                            <td width="50%" class="info-item">
                                <p class="label">Tipe Tiket</p>
                                <p style="margin:0; font-weight: 700;">{{ $order->tickets->first()->ticketType->name }}</p>
                            </td>
                        </tr>
                    </table>

                    <div class="ticket-box">
                        <p class="label">Scan Tiket Anda</p>
                        <div class="qr-code">
                            <img src="data:image/svg+xml;base64,{{ $qrCode }}" alt="QR Code">
                        </div>
                        <p class="label">Kode Tiket</p>
                        <div class="ticket-code">{{ $order->tickets->first()->ticket_code }}</div>
                    </div>

                    <p style="font-size: 12px; color: #6b7280; text-align: center; margin-top: 30px; line-height: 1.5;">
                        Tunjukkan QR Code ini kepada petugas di lokasi event untuk melakukan verifikasi masuk. 
                        Jangan bagikan email ini kepada orang lain.
                    </p>
                </td>
            </tr>
            <tr>
                <td class="footer">
                    &copy; 2026 EventMaster Platform. Dikirim secara otomatis oleh sistem.
                </td>
            </tr>
        </table>
    </center>
</body>
</html>
