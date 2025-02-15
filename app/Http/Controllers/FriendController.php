<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FriendController extends Controller
{
    public function listeFriends()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user(); // Récupère l'utilisateur connecté

        // Récupérer les amis avec leurs posts
        $friends = $user->follows()->with('posts')->get();

        // Récupérer les utilisateurs non suivis (sauf soi-même)
        $suggestions = User::whereNotIn('id', $user->follows()->pluck('followed_id')) // Correction ici
            ->where('id', '!=', $user->id)
            ->inRandomOrder()
            ->take(5)
            ->get();

        return view('friends.liste-friends', compact('friends', 'suggestions'));
    }
}
