<?php
// app/Models/MediaCoverage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MediaCoverage active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MediaCoverage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MediaCoverage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MediaCoverage ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MediaCoverage query()
 * @mixin \Eloquent
 */
class MediaCoverage extends Model
{
    protected $table = 'media_coverages';

    protected $fillable = [
        'name',
        'logo',
        'url',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Buat query di HomeController biar rapi
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('id');
    }
}