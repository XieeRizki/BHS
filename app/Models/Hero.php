<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    // Mengizinkan semua kolom diisi (mass assignment)
    protected $guarded = [];

    // Relasi untuk memanggil $hero->images di file Blade
    public function images()
    {
        return $this->hasMany(HeroImage::class, 'hero_id', 'id');
    }

    // Kalau nanti butuh tabel stats, relasinya disiapkan saja dulu
    public function stats()
    {
        // Return dummy atau relasi (kalau tabel stats sudah dibuat nanti)
        return $this->hasMany(HeroStat::class, 'hero_id', 'id');
    }
}