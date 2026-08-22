<?php
// app/Http/Controllers/Frontend/LayananController.php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Award;
use App\Models\Layanan;
use App\Models\Post;

class LayananController extends Controller
{
    public function show(Layanan $layanan)
    {
        abort_unless($layanan->is_active, 404);

        try {
            $awards = Award::active()->ordered()->get();
            if ($awards->isEmpty()) {
                throw new \Exception('No award data');
            }
        } catch (\Throwable $e) {
            $awards = collect([]);
        }

        $articles = Post::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(5)
            ->get();

        $contact = (object)['whatsapp' => '62895385703917'];

        return view('pages.layanan', compact('layanan', 'awards', 'articles', 'contact'));
    }
}