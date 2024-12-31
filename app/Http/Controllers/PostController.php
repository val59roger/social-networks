<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('posts.create');
    }

    // Enregistrer un nouveau post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Gérer l'image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts_photo', 'public');
        }

        // Créer le post
        Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'date_published' => now(),
        ]);

        return redirect()->route('posts.index')->with('success', 'Publication créée avec succès.');
    }
}


