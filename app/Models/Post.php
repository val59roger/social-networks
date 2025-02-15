<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'date_pusblished',
        'user_id',
    ];

    protected $casts = [
        'date_published' => 'datetime',
    ];


    // Définir la relation inverse : une publication appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Définir la relation avec likes : un posts a plusieurs like
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Définir la relation avec comments : un posts a plusieurs commentaires
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    protected static function booted()
    {
        static::deleting(function ($post) {
            // Construit le chemin complet vers l'image
            $imagePath = public_path('posts_photos/' . $post->image);

            // Supprime l'image associée si elle existe
            if ($post->image && file_exists($imagePath)) {
                unlink($imagePath);
            }
        });
    }


}

