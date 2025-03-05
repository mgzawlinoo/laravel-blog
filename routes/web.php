<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\AboutController;

// Get Method
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about',[AboutController::class, 'index'])->name('about');

// Route For Posts
Route::resource('posts', PostController::class);

// Route For Todos
Route::resource('todos', TodoController::class);
Route::put('/todos/{todo}/status', [TodoController::class, 'status'])->name('todos.status');
Route::get('/todos/search', [TodoController::class, 'search'])->name('todos.search');


// Test Route
// Route::get('/posts', function () {

//     $content = "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quibusdam fugiat ea iusto exercitationem minima vitae quod ullam id voluptate fugit sint perferendis, culpa maiores. Ipsa ratione eum aperiam perferendis pariatur.
//             Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";

//     $list = [
//         'Web Development' => ['PHP', 'Laravel'],
//         'Mobile Development' => ['Kotlin', 'Flutter'],
//         'Desktop Development' => ['C#', 'WPF']
//     ];

//     return view('posts', ['mainCategories' => $list , 'content' => $content]);
// })->name('posts');


// Route For Todos
// Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
// Route::get('/todos/create', [TodoController::class, 'create'])->name('todos.create');
// Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
// // Route::get('/todos/{todo}', [TodoController::class, 'show'])->name('todos.show');
// Route::get('/todos/{todo}/edit', [TodoController::class, 'edit'])->name('todos.edit');

// Route::put('/todos/{todo}', [TodoController::class, 'update'])->name('todos.update');

// Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');


