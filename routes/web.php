<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

// Get Method
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route For Posts
Route::resource('posts', PostController::class);
Route::get('/posts-search', [PostController::class, 'search'])->name('posts.search');


