<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white leading-tight font-['Outfit'] tracking-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#161616] border border-white/5 overflow-hidden shadow-xl rounded-3xl">
                <div class="p-10 text-slate-500 font-medium">
                    {{ __("Access granted. Terminal ready.") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
