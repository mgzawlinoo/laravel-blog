<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Frontend\FollowController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\LikeDislikeController;


// Route For Frontend (Public)
Route::get('/', [HomeController::class, 'index'])->name('index');
// posts by category
Route::get('/category/{category}', [HomeController::class, 'getPostsByCategory'])->name('getPostsByCategory');
// posts by user
Route::get('/user/{user}', [HomeController::class, 'getPostsByUser'])->name('getPostsByUser');
// posts by tag
Route::get('/tag/{tag}', [HomeController::class, 'getPostsByTag'])->name('getPostsByTag');
// view post
Route::get('/post/{post}', [HomeController::class, 'post'])->name('post');

// Route For Frontend (Auth)
Route::middleware('auth')->group(function () {
    // like
    Route::post('/like/{post}', [LikeDislikeController::class, 'like'])->name('like');
    // dislike
    Route::post('/dislike/{post}', [LikeDislikeController::class, 'dislike'])->name('dislike');
    // follow
    Route::post('/follow/{user}', [FollowController::class, 'follow'])->name('follow');
    // unfollow
    Route::post('/unfollow/{user}', [FollowController::class, 'unfollow'])->name('unfollow');
    // comment
    Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comments.store');
    // reply
    Route::post('/comments/reply/{comment}', [CommentController::class, 'reply'])->name('comments.reply');
    // posts by following
    Route::get('/following', [HomeController::class, 'getPostsByFollowing'])->name('getPostsByFollowing');
});

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
