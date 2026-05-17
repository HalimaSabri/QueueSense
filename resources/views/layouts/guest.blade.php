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
    <body class="font-sans antialiased bg-[#f4f6f8] text-slate-900">
        <div class="min-h-screen flex flex-col sm:justify-center items-center p-6 relative">
            <div class="relative z-10 mb-12">
                <a href="/" wire:navigate class="flex flex-col items-center group">
                    <div class="w-16 h-16 bg-[#1c1c1e] rounded-3xl flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <span class="mt-6 text-3xl font-extrabold tracking-tight text-slate-900 font-['Outfit']">QueueSense</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md bg-white border border-gray-200/60 shadow-xl shadow-black/5 rounded-[2.5rem] p-10 md:p-12 relative z-10">
                {{ $slot }}
            </div>

            <div class="mt-12 relative z-10">
                <a href="/" class="text-xs font-bold text-slate-400 hover:text-slate-900 transition-colors flex items-center bg-white px-5 py-3 rounded-full border border-gray-200/60 shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Return to Public View
                </a>
            </div>
        </div>
    </body>
</html>
