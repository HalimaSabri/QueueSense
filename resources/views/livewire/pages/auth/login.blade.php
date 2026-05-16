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

<div class="text-white">
    <div class="mb-10">
        <h2 class="text-3xl font-black tracking-tighter mb-3 font-['Outfit']">Access Terminal</h2>
        <p class="text-slate-500 text-sm font-light tracking-wide">Secure authentication required for workspace access.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form wire:submit="login" class="space-y-8">
        <!-- Email Address -->
        <div>
            <label class="block text-[10px] uppercase tracking-[0.2em] font-bold text-slate-500 mb-3">System Identity</label>
            <div class="relative group">
                <input wire:model="form.email" type="email" required autofocus class="w-full bg-white/[0.03] border border-white/10 rounded-2xl px-5 py-4 text-white focus:border-indigo-500 focus:ring-0 transition-all placeholder-slate-600 text-sm font-medium" placeholder="identity@queuesense.io">
                <div class="absolute inset-0 rounded-2xl bg-indigo-500/5 opacity-0 group-focus-within:opacity-100 transition-opacity pointer-events-none"></div>
            </div>
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label class="block text-[10px] uppercase tracking-[0.2em] font-bold text-slate-500 mb-3">Access Key</label>
            <div class="relative group">
                <input wire:model="form.password" type="password" required class="w-full bg-white/[0.03] border border-white/10 rounded-2xl px-5 py-4 text-white focus:border-indigo-500 focus:ring-0 transition-all placeholder-slate-600 text-sm font-medium" placeholder="••••••••">
                <div class="absolute inset-0 rounded-2xl bg-indigo-500/5 opacity-0 group-focus-within:opacity-100 transition-opacity pointer-events-none"></div>
            </div>
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember" class="inline-flex items-center cursor-pointer group">
                <div class="relative flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox" class="w-5 h-5 rounded-lg border-white/10 bg-white/[0.03] text-indigo-600 shadow-sm focus:ring-0 focus:ring-offset-0 transition-all cursor-pointer" name="remember">
                </div>
                <span class="ms-3 text-[10px] font-bold text-slate-500 group-hover:text-slate-300 uppercase tracking-[0.1em] transition-colors">{{ __('Keep Session Active') }}</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="text-[10px] font-bold text-slate-500 hover:text-white transition-colors uppercase tracking-[0.1em]" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Recovery') }}
                </a>
            @endif
        </div>

        <button type="submit" class="group relative w-full py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-2xl shadow-[0_20px_40px_-10px_rgba(79,70,229,0.4)] transition-all transform active:scale-[0.98] uppercase tracking-[0.2em] text-[11px] overflow-hidden">
            <span class="relative z-10">Authenticate Identity</span>
            <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/10 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000"></div>
        </button>
    </form>
</div>
