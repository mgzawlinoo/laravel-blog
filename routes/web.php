<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\DashboardController;


// Route For Frontend
Route::get('/', [HomeController::class, 'index'])->name('index');

// posts by category
Route::get('/category/{category}', [HomeController::class, 'getPostsByCategory'])->name('getPostsByCategory');

// posts by user
Route::get('/user/{user}', [HomeController::class, 'getPostsByUser'])->name('getPostsByUser');

// posts by post
Route::get('/post/{post}', [HomeController::class, 'post'])->name('post');

Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');

Route::post('/comments/reply/{comment}', [CommentController::class, 'reply'])->name('comments.reply')->middleware('auth');

// Route For Backend
Route::prefix('backend')->middleware('auth')->name('backend.')->group(function () {
    // For Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    // For Posts
    Route::resource('posts', PostController::class)->withTrashed();

    Route::delete('/posts/{post}/permanent-delete', [PostController::class, 'permanentDelete'])->name('posts.permanentDelete')->withTrashed();
    Route::delete('/posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore')->withTrashed();

    Route::get('/posts-search', [PostController::class, 'search'])->name('posts.search');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/auth.php';
