<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center group">
                        <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/20 group-hover:bg-indigo-500 transition-colors">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <span class="ms-3 text-2xl font-bold tracking-tight text-slate-900 font-['Outfit']">Queue<span class="text-indigo-600">Sense</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-10 sm:-my-px sm:ms-16 sm:flex h-full">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="text-[11px] font-bold uppercase tracking-widest text-slate-400 hover:text-slate-900 transition-colors border-b-2 border-transparent">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    
                    @if(auth()->user()->role === 'admin')
                        <x-nav-link href="#" class="text-[11px] font-bold uppercase tracking-widest text-slate-400 hover:text-slate-900 transition-colors">
                            {{ __('Analytics') }}
                        </x-nav-link>
                        <x-nav-link href="#" class="text-[11px] font-bold uppercase tracking-widest text-slate-400 hover:text-slate-900 transition-colors">
                            {{ __('Management') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="56">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-5 py-2.5 bg-slate-50 border border-slate-200 text-[11px] font-bold uppercase tracking-widest rounded-full text-slate-600 hover:bg-indigo-50 hover:border-indigo-200 hover:text-indigo-600 transition-all duration-300">
                                <span class="h-2 w-2 rounded-full bg-emerald-500 mr-2.5 shadow-[0_0_8px_rgba(16,185,129,0.5)]"></span>
                                <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-2xl">
                                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Authenticated as</p>
                                    <p class="text-[12px] font-bold text-slate-900 truncate">{{ auth()->user()->email }}</p>
                                </div>

                                <x-dropdown-link :href="route('profile')" wire:navigate class="text-[12px] font-bold py-4 px-6 text-slate-600 hover:bg-slate-50 hover:text-indigo-600">
                                    {{ __('Account Settings') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <button wire:click="logout" class="w-full text-start border-t border-slate-100">
                                    <x-dropdown-link class="text-[12px] font-bold py-4 px-6 text-rose-600 hover:bg-rose-50 hover:text-rose-700">
                                        {{ __('Sign Out') }}
                                    </x-dropdown-link>
                                </button>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-3 rounded-xl text-slate-400 hover:text-slate-900 hover:bg-slate-100 transition-all">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-slate-200">
        <div class="pt-4 pb-6 space-y-2 px-6">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="rounded-xl text-slate-600 font-bold uppercase tracking-widest text-[11px] py-4">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-6 pb-8 border-t border-slate-100 bg-slate-50">
            <div class="px-8 py-4 mb-4">
                <div class="font-bold text-base text-slate-900 font-['Outfit']" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-bold text-[10px] text-slate-400 uppercase tracking-widest mt-1">{{ auth()->user()->email }}</div>
            </div>

            <div class="space-y-1 px-4">
                <x-responsive-nav-link :href="route('profile')" wire:navigate class="rounded-xl text-slate-600 font-bold uppercase tracking-widest text-[11px] py-4">
                    {{ __('Account Settings') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link class="rounded-xl text-rose-600 font-bold uppercase tracking-widest text-[11px] py-4">
                        {{ __('Sign Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
