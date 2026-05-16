<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white leading-tight font-['Outfit'] tracking-tight">
            {{ __('Account Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="p-10 bg-[#161616] border border-white/5 shadow-xl rounded-3xl">
                <div class="max-w-xl">
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            <div class="p-10 bg-[#161616] border border-white/5 shadow-xl rounded-3xl">
                <div class="max-w-xl">
                    <livewire:profile.update-password-form />
                </div>
            </div>

            <div class="p-10 bg-rose-500/[0.03] border border-rose-500/10 shadow-xl rounded-3xl">
                <div class="max-w-xl">
                    <livewire:profile.delete-user-form />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
