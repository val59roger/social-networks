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
    /* Mise en place de la route pour éditer les informations de users */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/details', [ProfileController::class, 'updateUserDetails'])->name('profile.updateUserDetails');
    /* Mise en place de la route pour supprimer les users */
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    /* Mise en place de la route pour faire afficher les autres user */
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
    /* Mise en place de la route pour follow un user */
    Route::post('/follow/{user}', [ProfileController::class, 'toggleFollow'])->name('follow.toggle');

    /* Mise en place de la route pour afficher les posts */
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    /* Mise en place de la route pour créer un post */
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    /* Mise en place de la route pour enregistrer un post */
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    /* Mise en place de la route pour gérer les likes des posts */
    Route::post('/posts/{post}/like', [PostController::class, 'toggleLike'])->name('posts.like');
    /* Mise en place de la route pour gérer les commentaires des posts */
    Route::post('/posts/{post}/comment', [CommentController::class, 'store'])->middleware('auth');
    /* Mise en place de la route pour éditer les commentaires des posts */
    Route::post('/comments/{comment}/edit', [CommentController::class, 'update'])->middleware('auth');
    /* Mise en place de la route pour supprimer les commentaires des posts */
    Route::delete('/comments/{comment}/delete', [CommentController::class, 'destroy'])->middleware('auth');


    /* Mise en place de la route pour afficher les amis */
    Route::get('/friends', [FriendController::class, 'listeFriends'])->name('friends.liste-friends');

});

Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/my-posts', [PostController::class, 'myPosts'])->name('posts.my-posts');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::patch('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
});


require __DIR__.'/auth.php';
