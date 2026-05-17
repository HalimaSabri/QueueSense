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

<nav x-data="{ open: false }" class="bg-[#1c1c1e] text-white w-72 h-full flex flex-col justify-between shrink-0 z-50">
    <div class="px-8 py-10">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center group mb-14">
            <div class="w-12 h-12 bg-white rounded-[1rem] flex items-center justify-center shadow-lg">
                <svg class="w-7 h-7 text-[#1c1c1e]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <span class="ms-4 text-3xl font-bold tracking-tight text-white font-['Outfit']">Queue<span class="text-gray-400">Sense</span></span>
        </a>

        <!-- Navigation Links -->
        <div class="flex flex-col space-y-3">
            <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center px-5 py-4 text-sm font-bold uppercase tracking-widest rounded-2xl transition-all {{ request()->routeIs('dashboard') ? 'bg-white text-[#1c1c1e]' : 'text-gray-400 hover:text-white hover:bg-white/10' }}">
                <svg class="w-5 h-5 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                {{ __('Dashboard') }}
            </a>
            
            @if(auth()->user() && auth()->user()->role === 'admin')
                <a href="{{ route('admin.agents') }}" wire:navigate class="flex items-center px-5 py-4 text-sm font-bold uppercase tracking-widest rounded-2xl transition-all {{ request()->routeIs('admin.agents') ? 'bg-white text-[#1c1c1e]' : 'text-gray-400 hover:text-white hover:bg-white/10' }}">
                    <svg class="w-5 h-5 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    {{ __('Staff Control') }}
                </a>
            @endif
        </div>
    </div>

    <!-- User Section -->
    <div class="p-8 border-t border-white/10 relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
        
        <!-- Dropdown Menu (Opens Upwards) -->
        <div x-show="open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95 translate-y-2"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-2"
             class="absolute z-50 bottom-full left-8 mb-4 w-56"
             style="display: none;"
             @click="open = false">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden ring-1 ring-black/5">
                <a href="{{ route('profile') }}" wire:navigate class="block text-xs font-bold py-4 px-6 text-slate-700 hover:bg-slate-50 hover:text-[#1c1c1e] transition-colors border-b border-slate-100">
                    {{ __('Account Settings') }}
                </a>
                <button wire:click="logout" class="w-full text-start block text-xs font-bold py-4 px-6 text-rose-600 hover:bg-rose-50 transition-colors">
                    {{ __('Sign Out') }}
                </button>
            </div>
        </div>

        <!-- Trigger Button -->
        <button @click="open = ! open" class="flex items-center w-full p-2.5 bg-white/5 rounded-[1.25rem] hover:bg-white/10 transition-all text-left group">
            <div class="w-12 h-12 rounded-[1rem] bg-white text-[#1c1c1e] flex items-center justify-center font-bold text-xl group-hover:scale-105 transition-transform">
                @if(auth()->user()) {{ substr(auth()->user()->name, 0, 1) }} @else ? @endif
            </div>
            <div class="ml-4">
                <p class="text-sm font-bold text-white leading-tight">@if(auth()->user()) {{ auth()->user()->name }} @else User @endif</p>
                <p class="text-[10px] uppercase tracking-widest text-gray-400 font-semibold mt-0.5">@if(auth()->user()) {{ auth()->user()->role }} @else Guest @endif</p>
            </div>
            <svg class="ml-auto w-5 h-5 text-gray-400 transition-transform" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
        </button>
    </div>
</nav>
