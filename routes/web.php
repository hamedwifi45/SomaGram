<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::controller(PostController::class)->group(function(){
        Route::get('/','index')->name('home');
        Route::get('/posts/create','create')->name('post.create');
        Route::post('/posts/create','store')->name('post.store');
        Route::get('/post/{post:slug}','show')->name('post.show');
        Route::put('/post/{post:slug}/update','update')->name('post.update');
        Route::get('/post/{post:slug}/edit','edit')->name('post.edit');
        Route::delete('/posts/{post:slug}','destroy')->name('posts.destroy');
        Route::get('/explore','explore')->name('explore');
    });
    Route::post('/post/{post:slug}/comment',[CommentController::class,'store'])->name('comment.store');
});

require __DIR__.'/auth.php';
