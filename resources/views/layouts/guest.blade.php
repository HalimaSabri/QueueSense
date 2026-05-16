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
    <body class="font-sans antialiased bg-[#0a0a0a] text-slate-300 overflow-hidden">
        <div class="min-h-screen flex flex-col sm:justify-center items-center p-6 relative">
            <div class="relative z-10 mb-12">
                <a href="/" wire:navigate class="flex flex-col items-center group">
                    <div class="w-16 h-16 bg-indigo-600 rounded-2xl flex items-center justify-center border border-white/10 group-hover:bg-indigo-500 transition-colors">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <span class="mt-4 text-2xl font-bold tracking-tight text-white font-['Outfit']">Queue<span class="text-indigo-500">Sense</span></span>
                </a>
            </div>

            <div class="w-full sm:max-w-md bg-[#161616] border border-white/5 shadow-2xl rounded-3xl p-10 relative z-10">
                {{ $slot }}
            </div>

            <div class="mt-10 relative z-10">
                <a href="/" class="text-[10px] font-bold text-slate-600 hover:text-white uppercase tracking-widest transition-colors flex items-center">
                    <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Terminal
                </a>
            </div>
        </div>
    </body>
</html>
