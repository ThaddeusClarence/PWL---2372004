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
            .premium-card { background: white; border: 1px solid #f0f2f5; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
            .premium-card:hover { border-color: #4f46e5; box-shadow: 0 12px 20px -5px rgba(0, 0, 0, 0.04); }
        </style>
    </head>
    <body class="antialiased bg-[#fbfcfd]">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white border-b border-gray-100 py-10 shadow-sm mb-8">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                            <div>
                                {{ $header }}
                            </div>
                        </div>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
