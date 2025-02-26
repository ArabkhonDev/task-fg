<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ManageController::class, 'index'])->name('index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/post', [PostController::class, 'index'])->name('manage');
    Route::get('/dashboard', [ManageController::class, 'dashboard'])->name('dashboard');
    Route::resources([
        'users'=> UserController::class,
        'posts'=>PostController::class,
        'categories'=>CategoryController::class,
        'tags'=>TagController::class
    ]);
    Route::get('/posts/filter', [PostController::class, 'filter'])->name('posts.filter');
});


require __DIR__.'/auth.php';
