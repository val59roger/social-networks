<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

