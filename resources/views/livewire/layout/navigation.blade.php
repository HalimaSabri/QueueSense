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
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center group">
                        <div class="w-10 h-10 bg-[#e2e8f0] rounded-xl flex items-center justify-center shadow-sm border border-slate-300/50">
                            <svg class="w-6 h-6 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <span class="ms-3 text-2xl font-bold tracking-tight text-slate-900 font-['Outfit']">Queue<span class="text-slate-400">Sense</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-12 sm:flex h-full">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="text-[11px] font-bold uppercase tracking-widest {{ request()->routeIs('dashboard') ? 'text-slate-900 border-b-2 border-indigo-600' : 'text-slate-500 hover:text-slate-900' }} transition-colors">
                        {{ __('Terminal') }}
                    </x-nav-link>
                    
                    @if(auth()->user()->role === 'admin')
                        <x-nav-link :href="route('admin.agents')" :active="request()->routeIs('admin.agents')" wire:navigate class="text-[11px] font-bold uppercase tracking-widest {{ request()->routeIs('admin.agents') ? 'text-slate-900 border-b-2 border-indigo-600' : 'text-slate-500 hover:text-slate-900' }} transition-colors">
                            {{ __('Staff Control') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Profile Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 bg-slate-50 border border-slate-200 text-[11px] font-bold uppercase tracking-widest rounded-xl text-slate-700 hover:bg-slate-100 transition-all">
                            {{ auth()->user()->name }}
                            <svg class="ms-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden">
                            <x-dropdown-link :href="route('profile')" wire:navigate class="text-xs font-bold py-4 px-6 text-slate-700 hover:bg-slate-50 hover:text-indigo-600 transition-colors border-b border-slate-50">
                                {{ __('Account Settings') }}
                            </x-dropdown-link>
                            <button wire:click="logout" class="w-full text-start">
                                <x-dropdown-link class="text-xs font-bold py-4 px-6 text-rose-600 hover:bg-rose-50 transition-colors">
                                    {{ __('Sign Out') }}
                                </x-dropdown-link>
                            </button>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-3 rounded-xl text-slate-500 hover:text-slate-900 hover:bg-slate-100 transition-all">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-slate-100">
        <div class="px-6 py-4 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-[11px] font-bold uppercase tracking-widest text-slate-700">
                {{ __('Terminal') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile')" class="text-[11px] font-bold uppercase tracking-widest text-slate-700">
                {{ __('Settings') }}
            </x-responsive-nav-link>
            <button wire:click="logout" class="w-full text-start">
                <x-responsive-nav-link class="text-[11px] font-bold uppercase tracking-widest text-rose-600">
                    {{ __('Sign Out') }}
                </x-responsive-nav-link>
            </button>
        </div>
    </div>
</nav>
