<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-3xl text-white leading-tight font-['Outfit'] tracking-tighter">
            {{ __('Account Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="p-8 sm:p-12 bg-white/[0.02] backdrop-blur-3xl border border-white/5 shadow-2xl sm:rounded-[3rem] relative overflow-hidden">
                <div class="absolute inset-2 border border-white/[0.01] rounded-[2.5rem] pointer-events-none"></div>
                <div class="max-w-xl relative z-10">
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            <div class="p-8 sm:p-12 bg-white/[0.02] backdrop-blur-3xl border border-white/5 shadow-2xl sm:rounded-[3rem] relative overflow-hidden">
                <div class="absolute inset-2 border border-white/[0.01] rounded-[2.5rem] pointer-events-none"></div>
                <div class="max-w-xl relative z-10">
                    <livewire:profile.update-password-form />
                </div>
            </div>

            <div class="p-8 sm:p-12 bg-rose-500/[0.02] backdrop-blur-3xl border border-rose-500/10 shadow-2xl sm:rounded-[3rem] relative overflow-hidden">
                <div class="absolute inset-2 border border-rose-500/[0.01] rounded-[2.5rem] pointer-events-none"></div>
                <div class="max-w-xl relative z-10">
                    <livewire:profile.delete-user-form />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
