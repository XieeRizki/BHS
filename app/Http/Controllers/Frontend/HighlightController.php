<?php
// app/Http/Controllers/Frontend/HighlightController.php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Award;
use App\Models\Highlight;
use App\Models\Post;

class HighlightController extends Controller
{
    public function show(Highlight $highlight)
    {
        abort_unless($highlight->is_active, 404);

        try {
            $awards = Award::active()->ordered()->get();
            if ($awards->isEmpty()) {
                throw new \Exception('No award data');
            }
        } catch (\Throwable $e) {
            $awards = collect([
                ['title' => 'Dedikasi & Partisipasi Pengerahan Massa dalam Gebyar Vaksinasi COVID-19', 'issuer' => 'Kepolisian Resor Sumedang', 'year' => '2022', 'image' => null],
            ]);
        }

        $articles = Post::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(5)
            ->get();

        $contact = (object)['whatsapp' => '62895385703917'];

        return view('pages.layanan', compact('highlight', 'awards', 'articles', 'contact'));
    }
}