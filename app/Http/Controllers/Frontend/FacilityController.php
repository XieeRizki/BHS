<?php
// app/Http/Controllers/Frontend/FacilityController.php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Facility;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::active()->ordered()->get();
        return view('pages.facilities', compact('facilities'));
    }
}