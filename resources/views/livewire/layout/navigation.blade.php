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

<<nav x-data="{ open: false }" class="bg-white border-b border-slate-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center">
                        <span class="text-xl font-bold tracking-tight text-slate-900 font-['Outfit'] underline decoration-indigo-600 decoration-2 underline-offset-4">QueueSense</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-10 sm:-my-px sm:ms-16 sm:flex h-full">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="text-[11px] font-bold uppercase tracking-widest text-slate-900 border-b-2 {{ request()->routeIs('dashboard') ? 'border-indigo-600' : 'border-transparent text-slate-400 hover:text-slate-900' }} transition-colors">
                        {{ __('Terminal') }}
                    </x-nav-link>
                    
                    @if(auth()->user()->role === 'admin')
                        <x-nav-link :href="route('admin.agents')" :active="request()->routeIs('admin.agents')" wire:navigate class="text-[11px] font-bold uppercase tracking-widest {{ request()->routeIs('admin.agents') ? 'text-slate-900 border-b-2 border-indigo-600' : 'text-slate-400 hover:text-slate-900' }} transition-colors">
                            {{ __('Staff') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Profile Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-[11px] font-bold uppercase tracking-widest text-slate-400 hover:text-slate-900 transition-colors">
                            {{ auth()->user()->name }}
                            <svg class="ms-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-white border border-slate-100 rounded-lg shadow-xl py-2">
                            <x-dropdown-link :href="route('profile')" wire:navigate class="text-xs font-bold py-2 px-4 text-slate-600 hover:bg-slate-50 hover:text-indigo-600 transition-colors">
                                {{ __('Account Settings') }}
                            </x-dropdown-link>
                            <button wire:click="logout" class="w-full text-start">
                                <x-dropdown-link class="text-xs font-bold py-2 px-4 text-rose-600 hover:bg-rose-50 hover:text-rose-700 transition-colors">
                                    {{ __('Sign Out') }}
                                </x-dropdown-link>
                            </button>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-slate-400 hover:text-slate-900 hover:bg-slate-50 transition-all">
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
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-[11px] font-bold uppercase tracking-widest text-slate-600">
                {{ __('Terminal') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile')" class="text-[11px] font-bold uppercase tracking-widest text-slate-600">
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
