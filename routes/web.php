<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Client\TakeTicket;
use App\Livewire\Client\QueueStatus;

Route::view('/', 'welcome');

// Client routes
Route::get('/client', TakeTicket::class)->name('home');
Route::get('/queue/{ticket}', QueueStatus::class)->name('queue.status');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
