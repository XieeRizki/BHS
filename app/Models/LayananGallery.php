<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananGallery extends Model
{
    protected $fillable = ['layanan_id', 'layanan_kategori_id', 'image', 'order'];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

    public function kategori()
    {
        return $this->belongsTo(LayananKategori::class, 'layanan_kategori_id');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('id');
    }
}
