<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Client\TakeTicket;
use App\Livewire\Client\QueueStatus;

Route::view('/', 'welcome');

// Client routes
Route::get('/client', TakeTicket::class)->name('home');
Route::get('/queue/{ticket}', QueueStatus::class)->name('queue.status');

Route::get('dashboard', function () {
    if (auth()->user()->role === 'admin') return redirect()->route('admin.dashboard');
    if (auth()->user()->role === 'agent') return redirect()->route('agent.dashboard');
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/agent/dashboard', \App\Livewire\Agent\Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('agent.dashboard');

Route::get('/admin/dashboard', \App\Livewire\Admin\Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('admin.dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
