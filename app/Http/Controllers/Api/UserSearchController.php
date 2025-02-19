<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserSearchController extends Controller
{
    public function searchUsers(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return response()->json([]);
        }

        // Rechercher les utilisateurs par pseudo ou email (excluant l'utilisateur connecté)
        $users = User::where('pseudo', 'like', "%{$query}%")
            ->take(10)
            ->get(['id', 'pseudo', 'email', 'url_profile']);

        return response()->json($users);
    }
}
