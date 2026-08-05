<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 't_post';

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'cover_image',
        'excerpt',
        'content',
        'author_name',
        'is_spotlight',
        'is_featured',
        'published_at',
    ];

    // Casting tipe data agar lebih mudah diakses di Blade
    protected $casts = [
        'is_spotlight' => 'boolean',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Relasi Many-to-One ke tabel categories
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}