<?php
// app/Http/Controllers/Frontend/HighlightController.php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Highlight;

class HighlightController extends Controller
{
    public function show(Highlight $highlight)
    {
        abort_unless($highlight->is_active, 404);

        return view('pages.highlight-show', compact('highlight'));
    }
}