<?php
// app/Models/Layanan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Layanan extends Model
{
    
    protected $fillable = [
    'title', 'slug', 'hero_subtitle', 'section_subtitle',
    'short_description', 'content', 'services', 'gallery',
    'showcase_title', 'showcase_subtitle', 'showcase_items',
    'video_url', 'bg_image',
    'qr_shopeefood', 'qr_gofood', 'qr_badge_text', 'qr_title',
    'cta_title', 'cta_subtitle',
    'image', 'order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'services' => 'array',
        'gallery' => 'array',
        'showcase_items' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($layanan) {
            if (empty($layanan->slug)) {
                $layanan->slug = Str::slug($layanan->title) . '-' . uniqid();
            }
        });
    }

    public function getVideoEmbedUrlAttribute(): ?string
{
    if (!$this->video_url) return null;

    preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([a-zA-Z0-9_-]{11})/', $this->video_url, $matches);

    if (isset($matches[1])) {
        return 'https://www.youtube.com/embed/' . $matches[1];
    }

    return $this->video_url;
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

    public function kategoris()
    {
    return $this->hasMany(LayananKategori::class)->orderBy('order')->orderBy('id');
    }

    public function galleries()
    {
        return $this->hasMany(LayananGallery::class)->orderBy('order')->orderBy('id');
    }
}
