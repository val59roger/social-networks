<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Récupérer la liste des utilisateurs
    public function index()
    {
        return response()->json(User::select('id', 'pseudo', 'email', 'url_profile')->get());
    }

    // Récupérer un utilisateur spécifique avec ses posts
    public function show(User $user)
    {
        return response()->json([
            'user' => $user->only(['id', 'pseudo', 'email', 'url_profile']),
            'posts' => $user->posts()->select('id', 'content', 'created_at')->get()
        ]);
    }
}

