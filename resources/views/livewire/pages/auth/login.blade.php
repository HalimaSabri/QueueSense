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
    <div class="mb-8">
        <h2 class="text-2xl font-black tracking-tight mb-2">Staff Login</h2>
        <p class="text-slate-400 text-sm font-medium">Please enter your credentials to access the workspace.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login" class="space-y-6">
        <!-- Email Address -->
        <div>
            <label class="block text-[10px] uppercase tracking-[0.2em] font-black text-slate-500 mb-2">Email Address</label>
            <input wire:model="form.email" type="email" required autofocus class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-blue-500 focus:ring-0 transition-all placeholder-slate-600" placeholder="admin@queuesense.com">
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label class="block text-[10px] uppercase tracking-[0.2em] font-black text-slate-500 mb-2">Password</label>
            <input wire:model="form.password" type="password" required class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-blue-500 focus:ring-0 transition-all placeholder-slate-600" placeholder="••••••••">
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember" class="inline-flex items-center cursor-pointer">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-white/10 bg-slate-900/50 text-blue-600 shadow-sm focus:ring-0" name="remember">
                <span class="ms-2 text-xs font-bold text-slate-400 uppercase tracking-widest">{{ __('Remember me') }}</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="text-xs font-bold text-slate-500 hover:text-white transition-colors uppercase tracking-widest" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot?') }}
                </a>
            @endif
        </div>

        <button type="submit" class="w-full py-4 bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-black rounded-xl shadow-xl shadow-blue-500/20 transition-all transform active:scale-95 uppercase tracking-[0.2em] text-xs">
            Sign In to Dashboard
        </button>
    </form>
</div>
