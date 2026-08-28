<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananKategori extends Model
{
    protected $fillable = ['layanan_id', 'name', 'order'];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

    public function galleries()
    {
        return $this->hasMany(LayananGallery::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('id');
    }
}
