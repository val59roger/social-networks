<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return redirect()->route('posts.index');
});

Route::get('/dashboard', [ProfileController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/details', [ProfileController::class, 'updateUserDetails'])->name('profile.updateUserDetails');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    /* Mise en place de la route pour faire afficher les autres user */
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    /* Mise en place de la route pour gérer les likes des posts */
    Route::post('/posts/{post}/like', [PostController::class, 'toggleLike'])->name('posts.like');
    /* Mise en place de la route pour gérer les commentaires des posts */
    Route::post('/posts/{post}/comment', [CommentController::class, 'store'])->middleware('auth');
    /* Mise en place de la route pour éditer les commentaires des posts */
    Route::post('/comments/{comment}/edit', [CommentController::class, 'update'])->middleware('auth');
    /* Mise en place de la route pour supprimer les commentaires des posts */
    Route::delete('/comments/{comment}/delete', [CommentController::class, 'destroy'])->middleware('auth');

    Route::get('/friends', [FriendController::class, 'listeFriends'])->name('friends.liste-friends');

});

Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/my-posts', [PostController::class, 'myPosts'])->name('posts.my-posts');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::patch('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
});


require __DIR__.'/auth.php';
