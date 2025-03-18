<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\DashboardController;

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

// posts by category
Route::get('/category/{category}', [HomeController::class, 'getPostsByCategory'])->name('getPostsByCategory');

// posts by user
Route::get('/user/{user}', [HomeController::class, 'getPostsByUser'])->name('getPostsByUser');

// posts by post
Route::get('/post/{post}', [HomeController::class, 'post'])->name('post');