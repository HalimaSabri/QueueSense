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

<div class="text-slate-900">
    <div class="mb-10">
        <h2 class="text-3xl font-extrabold tracking-tight mb-3 font-['Outfit']">Access Terminal</h2>
        <p class="text-slate-600 text-sm">Please authenticate to access the workspace.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form wire:submit="login" class="space-y-8">
        <!-- Email Address -->
        <div>
            <label class="block text-[10px] uppercase tracking-widest font-bold text-slate-600 mb-2">Work Identity</label>
            <input wire:model="form.email" type="email" required autofocus class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-4 text-slate-900 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 transition-all placeholder-slate-300 text-sm" placeholder="identity@queuesense.io">
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label class="block text-[10px] uppercase tracking-widest font-bold text-slate-600 mb-2">Access Key</label>
            <input wire:model="form.password" type="password" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-4 text-slate-900 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 transition-all placeholder-slate-300 text-sm" placeholder="••••••••">
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember" class="inline-flex items-center cursor-pointer group">
                <input wire:model="form.remember" id="remember" type="checkbox" class="w-5 h-5 rounded border-slate-300 bg-slate-50 text-indigo-600 focus:ring-0 transition-all" name="remember">
                <span class="ms-3 text-[10px] font-bold text-slate-600 group-hover:text-slate-600 uppercase tracking-widest transition-colors">{{ __('Keep me active') }}</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="text-[10px] font-bold text-slate-600 hover:text-indigo-600 transition-colors uppercase tracking-widest" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Recovery') }}
                </a>
            @endif
        </div>

        <button type="submit" class="w-full py-5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-500/30 transition-all transform active:scale-[0.98] uppercase tracking-widest text-[11px]">
            Authenticate
        </button>
    </form>
</div>
