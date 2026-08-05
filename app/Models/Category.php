<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 't_category';

    protected $fillable = [
        'name',
        'slug',
    ];

    // Relasi One-to-Many ke tabel posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}