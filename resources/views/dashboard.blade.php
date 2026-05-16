<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight font-['Outfit'] tracking-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-slate-200 overflow-hidden shadow-sm rounded-3xl">
                <div class="p-10 text-slate-500 font-medium">
                    {{ __("Welcome to your command center. Everything is ready.") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
