<?php
// app/Models/Highlight.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Highlight extends Model
{
    protected $fillable = ['title', 'slug', 'short_description', 'content', 'image', 'order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($highlight) {
            if (empty($highlight->slug)) {
                $highlight->slug = Str::slug($highlight->title) . '-' . uniqid();
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug'; // biar route model binding otomatis cari by slug, bukan id
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('id');
    }
}
