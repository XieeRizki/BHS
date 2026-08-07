<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string|null $title
 * @property string|null $subtitle
 * @property string|null $button_text
 * @property string|null $button_link
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\HeroImage> $images
 * @property-read int|null $images_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hero newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hero newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hero query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hero whereButtonLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hero whereButtonText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hero whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hero whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hero whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hero whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hero whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hero whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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