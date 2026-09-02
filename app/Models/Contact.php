<?php
// app/Models/Contact.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'phone', 'whatsapp', 'email', 'operational_hours', 'facebook', 'instagram',
    ];
}