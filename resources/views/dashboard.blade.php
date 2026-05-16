<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-3xl text-white leading-tight font-['Outfit'] tracking-tighter">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/[0.02] backdrop-blur-3xl border border-white/5 overflow-hidden shadow-2xl sm:rounded-[2.5rem] relative">
                <div class="absolute inset-2 border border-white/[0.01] rounded-[2rem] pointer-events-none"></div>
                <div class="p-12 text-slate-400 font-light text-lg relative z-10">
                    {{ __("Welcome back to the terminal.") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
