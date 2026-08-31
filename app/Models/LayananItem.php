<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LayananItem extends Model
{
    protected $fillable = [
        'layanan_id', 'title', 'slug', 'price', 'price_unit', 'description',
        'sub_title_1', 'sub_description_1', 'sub_title_2', 'sub_description_2',
        'pdf', 'link_1', 'link_2', 'cover', 'gallery', 'order', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean', 'gallery' => 'array'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            if (empty($item->slug)) {
                $baseSlug = Str::slug($item->title);
                $slug = $baseSlug;
                $i = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $i++;
                }
                $item->slug = $slug;
            }
        });
    }

    public function getRouteKeyName() { return 'slug'; }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

    public function scopeActive($q) { return $q->where('is_active', true); }
    public function scopeOrdered($q) { return $q->orderBy('order')->orderBy('id'); }

    public function getFormattedPriceAttribute(): ?string
    {
        if (!$this->price) return null;
        return 'Rp' . number_format($this->price, 0, ',', '.') . ',-' . ($this->price_unit ?? '');
    }
}