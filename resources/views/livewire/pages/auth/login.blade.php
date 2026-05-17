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
        <h2 class="text-3xl font-black tracking-tighter text-slate-900 font-['Outfit'] mb-2">Staff Portal</h2>
        <p class="text-slate-500 text-sm font-medium leading-relaxed">Secure access to the professional queue management console.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form wire:submit="login" class="space-y-8">
        <!-- Email Address -->
        <div>
            <label class="block text-[10px] uppercase tracking-[0.2em] font-bold text-slate-400 mb-3">Work Identity</label>
            <input wire:model="form.email" type="email" required autofocus class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-5 text-slate-900 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 transition-all placeholder-slate-300 text-sm" placeholder="email@queuesense.io">
            <x-input-error :messages="$errors->get('form.email')" class="mt-2 text-[10px] font-bold text-rose-500 uppercase tracking-widest" />
        </div>

        <!-- Password -->
        <div>
            <label class="block text-[10px] uppercase tracking-[0.2em] font-bold text-slate-400 mb-3">Access Key</label>
            <input wire:model="form.password" type="password" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-5 text-slate-900 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 transition-all placeholder-slate-300 text-sm" placeholder="••••••••">
            <x-input-error :messages="$errors->get('form.password')" class="mt-2 text-[10px] font-bold text-rose-500 uppercase tracking-widest" />
        </div>

        <!-- Remember Me & Recovery -->
        <div class="flex items-center justify-between">
            <label for="remember" class="inline-flex items-center cursor-pointer group">
                <div class="relative flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox" class="w-5 h-5 rounded-lg border-slate-300 bg-slate-50 text-indigo-600 focus:ring-0 transition-all">
                </div>
                <span class="ms-3 text-[10px] font-bold text-slate-500 group-hover:text-slate-900 uppercase tracking-widest transition-colors">{{ __('Keep Session') }}</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="text-[10px] font-bold text-slate-500 hover:text-indigo-600 transition-colors uppercase tracking-widest" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Recovery') }}
                </a>
            @endif
        </div>

        <button type="submit" class="w-full py-5 bg-white border-2 border-slate-900 text-slate-900 font-bold rounded-2xl shadow-xl shadow-slate-200/50 hover:bg-slate-50 transition-all transform active:scale-[0.98] uppercase tracking-widest text-[11px]">
            Enter Workspace
        </button>
    </form>
</div>
