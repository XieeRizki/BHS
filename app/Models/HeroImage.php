<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $hero_id
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Hero $hero
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroImage query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroImage whereHeroId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class HeroImage extends Model
{
    protected $guarded = [];

    // Relasi balik ke Hero
    public function hero()
    {
        return $this->belongsTo(Hero::class, 'hero_id', 'id');
    }
}