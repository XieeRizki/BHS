<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroImage extends Model
{
    protected $guarded = [];

    // Relasi balik ke Hero
    public function hero()
    {
        return $this->belongsTo(Hero::class, 'hero_id', 'id');
    }
}