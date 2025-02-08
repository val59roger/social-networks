<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate(['content' => 'required|string']);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $postId,
            'content' => $request->content,
        ]);

        return response()->json([
            'message' => 'Commentaire ajouté avec succès',
            'comment' => [
                'user_id' => $comment->user->id, // ID de l'utilisateur
                'user' => Auth::user()->pseudo, // Nom de l'utilisateur
                'user_profile' => Auth::user()->url_profile, // URL de la photo de profil
                'content' => $comment->content, // Le texte du commentaire
            ],
        ]);
    }

    public function update(Request $request, Comment $comment)
    {
        // Vérifier si l'utilisateur est bien l'auteur
        if (Auth::id() !== $comment->user_id) {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }

        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment->content = $request->content;
        $comment->save();

        return response()->json(['updatedContent' => $comment->content]);
    }

    public function destroy(Comment $comment)
    {
        // Vérifier si l'utilisateur est bien l'auteur
        if (Auth::id() !== $comment->user_id) {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }

        $comment->delete();

        return response()->json(['success' => true]);
    }

}

