<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function listeFriends()
    {
        return view('friends.liste-friends'); // Le fichier blade doit être dans resources/views/friends/index.blade.php
    }
}
