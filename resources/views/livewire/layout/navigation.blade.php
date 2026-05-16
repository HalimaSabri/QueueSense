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

<nav x-data="{ open: false }" class="bg-[#0a0a0a] border-b border-white/5 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center group">
                        <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center justify-center border border-white/10 group-hover:bg-indigo-500 transition-colors">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <span class="ms-3 text-xl font-bold tracking-tight text-white font-['Outfit']">Queue<span class="text-indigo-500">Sense</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-12 sm:flex h-full">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="text-[10px] font-bold uppercase tracking-widest text-slate-500 hover:text-white transition-colors border-b-2 border-transparent">
                        {{ __('Terminal') }}
                    </x-nav-link>
                    
                    @if(auth()->user()->role === 'admin')
                        <x-nav-link href="#" class="text-[10px] font-bold uppercase tracking-widest text-slate-500 hover:text-white transition-colors">
                            {{ __('Operations') }}
                        </x-nav-link>
                        <x-nav-link href="#" class="text-[10px] font-bold uppercase tracking-widest text-slate-500 hover:text-white transition-colors">
                            {{ __('Agents') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 bg-[#161616] border border-white/5 text-[10px] font-bold uppercase tracking-widest rounded-full text-slate-400 hover:text-white hover:border-white/10 transition-all duration-300">
                                <span class="h-1.5 w-1.5 rounded-full bg-indigo-500 mr-2"></span>
                                <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="bg-[#161616] border border-white/10 rounded-xl overflow-hidden shadow-2xl">
                                <div class="px-5 py-3 border-b border-white/5">
                                    <p class="text-[9px] font-bold uppercase tracking-widest text-slate-600 mb-1">Active User</p>
                                    <p class="text-[11px] font-bold text-white truncate">{{ auth()->user()->email }}</p>
                                </div>

                                <x-dropdown-link :href="route('profile')" wire:navigate class="text-[11px] font-bold py-3 px-5 text-slate-400 hover:bg-white/5 hover:text-white">
                                    {{ __('Settings') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <button wire:click="logout" class="w-full text-start border-t border-white/5">
                                    <x-dropdown-link class="text-[11px] font-bold py-3 px-5 text-rose-500 hover:bg-rose-500/10 hover:text-rose-400">
                                        {{ __('Logout') }}
                                    </x-dropdown-link>
                                </button>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-500 hover:text-white transition-all">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#0a0a0a] border-t border-white/5 shadow-2xl">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="rounded-xl text-slate-500 font-bold uppercase tracking-widest text-[10px] py-4">
                {{ __('Terminal') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-6 border-t border-white/5">
            <div class="px-8 py-4 mb-2">
                <div class="font-bold text-sm text-white" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-bold text-[10px] text-slate-600 uppercase tracking-widest mt-1">{{ auth()->user()->email }}</div>
            </div>

            <div class="space-y-1 px-4">
                <x-responsive-nav-link :href="route('profile')" wire:navigate class="rounded-xl text-slate-500 font-bold uppercase tracking-widest text-[10px] py-4">
                    {{ __('Settings') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link class="rounded-xl text-rose-500 font-bold uppercase tracking-widest text-[10px] py-4">
                        {{ __('Logout') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
