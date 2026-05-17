<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-[2rem] text-slate-900 leading-tight font-['Outfit'] tracking-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-[85rem] mx-auto px-6 lg:px-8">
            <div class="bg-white border border-gray-200/60 shadow-sm rounded-[2.5rem]">
                <div class="p-12 text-slate-600 font-medium text-lg">
                    {{ __("Welcome to your command center. Everything is ready.") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
