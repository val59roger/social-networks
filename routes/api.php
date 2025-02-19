<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserSearchController;
use Illuminate\Support\Facades\Route;

// Liste des utilisateurs
Route::get('/users', [UserController::class, 'index']);

// Voir le profil d'un utilisateur avec ses posts
Route::get('/users/{user}', [UserController::class, 'show']);

Route::get('/search/users', [UserSearchController::class, 'searchUsers']);

