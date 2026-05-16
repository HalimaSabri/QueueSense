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

<nav x-data="{ open: false }" class="bg-white/[0.02] backdrop-blur-2xl border-b border-white/5 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
        <div class="flex justify-between h-24">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center group">
                        <div class="w-11 h-11 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-[0_15px_30px_-5px_rgba(79,70,229,0.4)] group-hover:scale-105 transition-all duration-500 border border-indigo-400/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <span class="ms-4 text-2xl font-black tracking-tighter text-white font-['Outfit']">Queue<span class="text-indigo-500">Sense</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-10 sm:-my-px sm:ms-16 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400 hover:text-white transition-colors">
                        {{ __('Terminal') }}
                    </x-nav-link>
                    
                    @if(auth()->user()->role === 'admin')
                        <x-nav-link href="#" class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-500 hover:text-white transition-colors">
                            {{ __('Operations') }}
                        </x-nav-link>
                        <x-nav-link href="#" class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-500 hover:text-white transition-colors">
                            {{ __('Agents') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="56">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-5 py-2.5 bg-white/[0.03] border border-white/10 text-[11px] font-bold uppercase tracking-[0.1em] rounded-full text-slate-300 hover:bg-white/[0.06] hover:border-white/20 transition-all duration-300 focus:outline-none">
                                <span class="relative flex h-2 w-2 mr-3">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                                </span>
                                <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                                <svg class="ms-3 h-4 w-4 text-slate-500 group-hover:text-slate-300 transition-colors" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="bg-[#0f172a] border border-white/10 rounded-2xl overflow-hidden shadow-2xl">
                                <div class="px-6 py-4 border-b border-white/5 bg-white/[0.02]">
                                    <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500 mb-1">Session Active</p>
                                    <p class="text-xs font-bold text-white truncate">{{ auth()->user()->email }}</p>
                                </div>

                                <x-dropdown-link :href="route('profile')" wire:navigate class="text-xs font-bold py-4 px-6 text-slate-300 hover:bg-white/5 hover:text-white transition-colors">
                                    {{ __('Account Settings') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <button wire:click="logout" class="w-full text-start border-t border-white/5">
                                    <x-dropdown-link class="text-xs font-bold py-4 px-6 text-rose-400 hover:bg-rose-500/10 hover:text-rose-300 transition-colors">
                                        {{ __('Terminate Session') }}
                                    </x-dropdown-link>
                                </button>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-3 rounded-2xl text-slate-400 hover:text-white hover:bg-white/5 transition-all duration-300">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#030712] border-t border-white/5 shadow-2xl">
        <div class="pt-4 pb-6 space-y-2 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="rounded-2xl text-slate-400 font-bold uppercase tracking-widest text-[11px] py-4">
                {{ __('Terminal') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-6 pb-8 border-t border-white/5 bg-white/[0.01]">
            <div class="px-8 py-4 mb-4">
                <div class="font-black text-sm text-white font-['Outfit'] tracking-tight" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-bold text-xs text-slate-500 uppercase tracking-widest mt-1">{{ auth()->user()->email }}</div>
            </div>

            <div class="space-y-1 px-4">
                <x-responsive-nav-link :href="route('profile')" wire:navigate class="rounded-2xl text-slate-400 font-bold uppercase tracking-widest text-[11px] py-4">
                    {{ __('Account Settings') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link class="rounded-2xl text-rose-400 font-bold uppercase tracking-widest text-[11px] py-4">
                        {{ __('Terminate Session') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
