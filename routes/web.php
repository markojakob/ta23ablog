<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/post/{post}', [PublicController::class, 'post'])->name('post');
Route::get('/category/{category}', [PublicController::class, 'category'])->name('category');
Route::get('/user/{user}', [PublicController::class, 'user'])->name('user');





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/post/{post}/like', [PublicController::class, 'like'])->name('like');
    Route::get('/user/{user}/follow', [PublicController::class, 'follow'])->name('follow');
    // Route::get('/admin/posts', [PostController::class, 'index'])->name('posts.index');
    // Route::get('/admin/posts/create', [PostController::class, 'create'])->name('posts.create');
    // Route::post('/admin/posts', [PostController::class, 'store'])->name('posts.store');
    // Route::get('/admin/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    // Route::put('/admin/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    // Route::delete('/admin/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/admin/posts/deleted', [PostController::class, 'deleted'])->name('posts.deleted');
    Route::patch('/admin/posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore');
    Route::delete('/admin/posts/{post}/permadestroy', [PostController::class, 'permaDestroy'])->name('posts.permadestroy');
    Route::resource('/admin/posts', PostController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/admin/tags/deleted', [TagController::class, 'deleted'])->name('tags.deleted');
    Route::patch('/admin/tags/{tag}/restore', [TagController::class, 'restore'])->name('tags.restore');
    Route::delete('/admin/tags/{tag}/permadestroy', [TagController::class, 'permaDestroy'])->name('tags.permadestroy');
    Route::resource('/admin/tags', TagController::class);
});

require __DIR__ . '/auth.php';
