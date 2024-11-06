<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('home', HomeController::class)
    ->name('home');

Route::view('courses/{id}', 'course.single')
    ->name('courses.single');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
