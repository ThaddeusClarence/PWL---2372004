<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'EventMaster') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        
        <!-- Scripts (Vite Fallback with CDN) -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Plus Jakarta Sans', 'sans-serif'],
                        },
                    },
                },
            }
        </script>

        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            .auth-bg { background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #312e81 100%); position: relative; overflow: hidden; }
            .bg-blob { position: absolute; filter: blur(80px); opacity: 0.4; z-index: 0; animation: blob-float 20s infinite alternate; }
            @keyframes blob-float {
                0% { transform: translate(0, 0) scale(1); }
                100% { transform: translate(100px, 50px) scale(1.1); }
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-10 sm:pt-0 auth-bg">
            <!-- Decorative Blobs -->
            <div class="bg-blob w-96 h-96 bg-indigo-600 rounded-full -top-20 -left-20"></div>
            <div class="bg-blob w-80 h-80 bg-purple-600 rounded-full -bottom-20 -right-20 animate-delay-2000"></div>
            <div class="bg-blob w-64 h-64 bg-indigo-400 rounded-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 opacity-10"></div>

            <div class="relative z-10 w-full flex flex-col items-center">
                <div class="mb-10">
                    <a href="/" class="flex flex-col items-center group">
                        <div class="w-20 h-20 bg-white/10 backdrop-blur-2xl rounded-[32px] flex items-center justify-center border border-white/20 shadow-2xl transition-all duration-500 group-hover:scale-110 group-hover:rotate-6">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5z"></path></svg>
                        </div>
                        <span class="mt-6 text-white text-3xl font-black tracking-tighter">Event<span class="text-indigo-400">Master</span></span>
                    </a>
                </div>

                <div class="w-full sm:max-w-lg px-12 py-16 bg-white/95 backdrop-blur-xl rounded-[60px] shadow-[0_32px_64px_-16px_rgba(0,0,0,0.3)] overflow-hidden mb-12 border border-white/20">
                    {{ $slot }}
                </div>
                
                <p class="text-white/40 text-xs font-bold tracking-widest uppercase mb-12">&copy; 2026 EventMaster. Capstone Project.</p>
            </div>
        </div>
    </body>
</html>
