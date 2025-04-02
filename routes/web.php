<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('dashboard');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->name('dashboard');

Volt::route('posts/view/{post}', 'posts.view-post')
    ->name('post.view');

volt::route('about', 'about.view-about')
    ->name('about.view');

Volt::route('posts/create', 'posts.create-post')
    ->middleware(['auth', 'verified'])
    ->name('post.create');

Volt::route('posts/view/{post}/create-comment', 'comments.create-comment')
    ->middleware(['auth', 'verified'])
    ->name('comment.create');

Volt::route('comments/{comment}/edit', 'comments.edit-comment')
    ->middleware(['auth', 'verified'])
    ->name('comment.edit');

Volt::route('search', 'search')
    ->name('search');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
