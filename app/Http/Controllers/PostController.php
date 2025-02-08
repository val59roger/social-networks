<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Comment;

class PostController extends Controller
{
    // Afficher la liste des publications (posts) via lastest() pour les afficher de manière aléatoire
    public function index()
    {
        // Récupérer tous les posts sauf ceux de l'utilisateur connecté, en incluant les relations nécessaires
        $posts = Post::with('user', 'likes', 'comments.user')
            ->where('user_id', '!=', Auth::id())  // Exclure les posts de l'utilisateur connecté
            ->inRandomOrder()
            ->get();

        // Ajouter un indicateur pour savoir si l'utilisateur connecté a liké chaque post
        foreach ($posts as $post) {
            $post->userLiked = $post->likes()->where('user_id', Auth::id())->exists();
        }

        return view('posts.index', compact('posts'));
    }


    // Afficher la liste des publications de l'utilisateur connecté
    public function myPosts()
    {
        $user = Auth::user();
        $posts = $user->posts;
        return view('posts.my-posts', compact('posts'));
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
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'date_published' => now(),
        ]);

        return redirect()->route('posts.index')->with('success', 'Publication créée avec succès.');
    }

    // Afficher le formulaire de modification
    public function edit($id)
    {
        /** @var \App\Models\User $user */
        // Récupère le post de l'utilisateur authentifié via la relation "posts"
        $user = Auth::user();
        $post = $user->posts()->findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $validated['image'] = $imagePath;
        }

        $post->update($validated);

        return redirect()->route('posts.my-posts')->with('success', 'Post mis à jour avec succès.');
    }

    // Afficher la page de suppression
    public function destroy($id)
    {
        /** @var \App\Models\User $user */
        // Récupère le post de l'utilisateur authentifié via la relation "posts"
        $user = Auth::user();
        $post = $user->posts()->findOrFail($id);
        $post->delete();

        return redirect()->route('posts.my-posts')->with('success', 'Post supprimé avec succès.');
    }

    // Gérer les likes
    public function show(Post $post)
    {
        // Vérifiez si l'utilisateur a déjà liké ce post
        $userLikedPost = $post->likes()->where('user_id', Auth::id())->exists();

        return view('posts.show', compact('post', 'userLikedPost'));
    }

    public function toggleLike(Post $post)
    {
        // Vérifiez si l'utilisateur a déjà liké ce post
        $like = $post->likes()->where('user_id', Auth::id())->first();

        if ($like) {
            // Si l'utilisateur a déjà liké, on retire le like
            $like->delete();
        } else {
            // Sinon, on ajoute un like
            $post->likes()->create(['user_id' => Auth::id()]);
        }

        return response()->json([
            'likes_count' => $post->likes()->count(),
            'user_liked' => $like ? false : true, // Retourne si l'utilisateur a liké ou pas
        ]);
    }
}


