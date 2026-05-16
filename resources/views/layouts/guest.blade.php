<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'QueueSense') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#030712] text-slate-200 selection:bg-indigo-500/30 overflow-hidden">
        <div class="min-h-screen flex flex-col sm:justify-center items-center p-6 relative">
            <!-- Dynamic Background -->
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-indigo-500/5 blur-[120px] rounded-full pointer-events-none"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-500/5 blur-[120px] rounded-full pointer-events-none"></div>

            <div class="relative z-10 mb-12">
                <a href="/" wire:navigate class="flex flex-col items-center group">
                    <div class="w-20 h-20 bg-indigo-600 rounded-[1.75rem] flex items-center justify-center shadow-[0_20px_40px_-10px_rgba(79,70,229,0.4)] mb-6 group-hover:scale-105 transition-transform duration-500 border border-indigo-400/20">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <span class="text-3xl font-black tracking-tighter text-white font-['Outfit']">Queue<span class="text-indigo-500">Sense</span></span>
                </a>
            </div>

            <div class="w-full sm:max-w-md bg-white/[0.02] backdrop-blur-3xl border border-white/5 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.5)] overflow-hidden rounded-[3rem] p-12 relative z-10">
                <!-- Decorative Inner Border -->
                <div class="absolute inset-2 border border-white/[0.01] rounded-[2.5rem] pointer-events-none"></div>
                
                <div class="relative z-10">
                    {{ $slot }}
                </div>
            </div>

            <div class="mt-12 relative z-10">
                <a href="/" class="text-[11px] font-bold text-slate-500 hover:text-white uppercase tracking-[0.2em] transition-all flex items-center group">
                    <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Terminal
                </a>
            </div>
        </div>
    </body>
</html>
