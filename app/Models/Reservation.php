<?php
// app/Models/Reservation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'package_name',
        'message',
        'status',
    ];

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}