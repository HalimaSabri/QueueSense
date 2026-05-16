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
    <body class="font-sans antialiased bg-white text-slate-900">
        <div class="min-h-screen flex flex-col sm:justify-center items-center p-6">
            <div class="mb-12">
                <a href="/" wire:navigate class="flex flex-col items-center">
                    <span class="text-2xl font-bold tracking-tight text-slate-900 font-['Outfit'] underline decoration-indigo-600 decoration-2 underline-offset-4">QueueSense</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md border-t border-slate-100 pt-12">
                {{ $slot }}
            </div>

            <div class="mt-12 pt-8 border-t border-slate-50 w-full sm:max-w-md flex justify-center">
                <a href="/" class="text-[10px] font-bold text-slate-400 hover:text-slate-900 uppercase tracking-widest transition-colors flex items-center">
                    <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Public Terminal
                </a>
            </div>
        </div>
    </body>
</html>
