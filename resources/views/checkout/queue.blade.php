<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Antrean - EventMaster</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .queue-gradient { background: radial-gradient(circle at top right, #4f46e5 0%, #1e1b4b 100%); }
    </style>
</head>
<body class="queue-gradient min-h-screen flex items-center justify-center p-6 overflow-hidden">

    <div class="max-w-xl w-full bg-white rounded-[48px] p-12 shadow-2xl relative overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute top-0 right-0 p-8 opacity-5">
            <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24"><path d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5z"></path></svg>
        </div>

        <div class="relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 rounded-full text-indigo-600 text-[10px] font-black uppercase tracking-widest mb-8">
                <span class="w-2 h-2 bg-indigo-600 rounded-full animate-ping"></span>
                Sistem Antrean Aktif
            </div>

            <h1 class="text-4xl font-black text-gray-900 mb-4 leading-tight">Mohon Tunggu Sebentar</h1>
            <p class="text-gray-500 font-medium mb-12">Kami sedang memproses permintaan Anda. Jangan memuat ulang halaman ini agar Anda tidak kehilangan posisi di antrean.</p>

            {{-- Queue Tracker --}}
            <div class="bg-gray-50 rounded-[32px] p-8 mb-12 border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Posisi Anda</span>
                    <span class="text-xs font-black text-indigo-600 uppercase tracking-widest" id="status-text">Estimasi: < 1 Menit</span>
                </div>
                
                <div class="relative h-4 bg-gray-200 rounded-full overflow-hidden mb-4">
                    <div id="progress-bar" class="absolute top-0 left-0 h-full bg-indigo-600 transition-all duration-500 ease-out" style="width: 0%"></div>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-2xl font-black text-gray-900">#<span id="queue-number">...</span></span>
                    <span class="text-sm font-bold text-gray-400 italic">Processing...</span>
                </div>
            </div>

            <div class="space-y-4">
                <div class="p-6 bg-emerald-50 rounded-3xl border border-emerald-100 flex items-center gap-4 text-left">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-emerald-600 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Keamanan Terjamin</p>
                        <p class="text-xs font-bold text-emerald-800">Sistem sedang mengamankan tiket Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simulasi Nomor Antrean
        const queueNum = Math.floor(Math.random() * 50) + 1;
        document.getElementById('queue-number').innerText = queueNum;

        let progress = 0;
        const progressBar = document.getElementById('progress-bar');
        const statusText = document.getElementById('status-text');

        const interval = setInterval(() => {
            progress += Math.random() * 15;
            if (progress >= 100) {
                progress = 100;
                clearInterval(interval);
                statusText.innerText = "Siap! Mengalihkan...";
                setTimeout(() => {
                    window.location.href = "{{ route('checkout.payment', $order->id) }}";
                }, 1000);
            }
            progressBar.style.width = progress + '%';
        }, 800);
    </script>
</body>
</html>
