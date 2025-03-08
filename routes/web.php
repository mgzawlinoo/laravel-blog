<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DashboardController;

// Route For Backend
Route::prefix('backend')->name('backend.')->group(function () {
    // For Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    // For Posts
    Route::resource('posts', PostController::class);
    Route::get('/posts-search', [PostController::class, 'search'])->name('posts.search');
});

// Route For Frontend
Route::get('/', [HomeController::class, 'index'])->name('index');

