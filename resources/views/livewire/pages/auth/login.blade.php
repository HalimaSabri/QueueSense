<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="space-y-10">
    <div>
        <h2 class="text-xl font-bold tracking-tight text-slate-900 font-['Outfit'] mb-1">Authenticated Access</h2>
        <p class="text-[11px] font-bold uppercase tracking-widest text-slate-400">Secure Node Entry</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form wire:submit="login" class="space-y-6">
        <!-- Email Address -->
        <div>
            <label class="block text-[10px] uppercase tracking-widest font-bold text-slate-400 mb-2">Work Identity</label>
            <input wire:model="form.email" type="email" required autofocus class="w-full bg-slate-50 border border-slate-100 rounded-lg px-4 py-3 text-slate-900 focus:border-slate-900 focus:ring-0 transition-all text-sm" placeholder="email@queuesense.io">
            <x-input-error :messages="$errors->get('form.email')" class="mt-2 text-[10px] font-bold text-rose-500 uppercase tracking-widest" />
        </div>

        <!-- Password -->
        <div>
            <label class="block text-[10px] uppercase tracking-widest font-bold text-slate-400 mb-2">Access Key</label>
            <input wire:model="form.password" type="password" required class="w-full bg-slate-50 border border-slate-100 rounded-lg px-4 py-3 text-slate-900 focus:border-slate-900 focus:ring-0 transition-all text-sm" placeholder="••••••••">
            <x-input-error :messages="$errors->get('form.password')" class="mt-2 text-[10px] font-bold text-rose-500 uppercase tracking-widest" />
        </div>

        <!-- Remember Me & Recovery -->
        <div class="flex items-center justify-between pt-2">
            <label for="remember" class="inline-flex items-center cursor-pointer group">
                <input wire:model="form.remember" id="remember" type="checkbox" class="w-4 h-4 rounded border-slate-200 bg-slate-50 text-slate-900 focus:ring-0 transition-all">
                <span class="ms-3 text-[10px] font-bold text-slate-400 group-hover:text-slate-900 uppercase tracking-widest transition-colors">{{ __('Keep Session') }}</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="text-[10px] font-bold text-slate-400 hover:text-slate-900 transition-colors uppercase tracking-widest" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Recovery') }}
                </a>
            @endif
        </div>

        <div class="pt-6">
            <button type="submit" class="w-full py-4 bg-white border border-slate-900 text-slate-900 text-[10px] font-bold uppercase tracking-widest rounded-lg hover:bg-slate-50 transition-all">
                Enter Terminal
            </button>
        </div>
    </form>
</div>
