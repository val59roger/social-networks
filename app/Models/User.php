<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'pseudo',
        'age',
        'email',
        'phone',
        'password',
        'url_profile',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    protected static function booted()
    {
        static::creating(function ($user) {
            $user->date_inscription = now(); // Remplit la colonne avec la date et l'heure actuelles
        });
    }

    // Définir la relation avec users : un utilisateur a plusieurs publications
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Définir la relation avec likes : un utilisateur a plusieurs like
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Définir la relation avec comments : un utilisateur a plusieurs commentaires
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Définir la relation avec follows : un utilisateur a plusieurs followers
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id');
    }

    // Définir la relation avec follows : un utilisateur a plusieurs followeds
    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }
}
