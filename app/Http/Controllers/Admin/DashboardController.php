<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Post;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\Contact;
use App\Models\Facility;
use App\Models\Stat;
use App\Models\Award;
use App\Models\MediaCoverage;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'layanan_count' => Layanan::active()->count(),
            'berita_count' => Post::whereNotNull('published_at')->count(),
            'testimoni_count' => Testimonial::where('is_active', true)->count(),
            'faq_count' => Faq::count(),
            'fasilitas_count' => Facility::active()->count(),
            'infografis_count' => Stat::active()->count(),
            'penghargaan_count' => Award::count(),
            'liputan_media_count' => MediaCoverage::active()->count(),
        ];

        $layananTanpaItem = Layanan::doesntHave('items')->pluck('title');
        $layananTanpaGaleri = Layanan::doesntHave('galleries')->pluck('title');

        $contact = Contact::first();
        $kontakBelumLengkap = !$contact || !$contact->whatsapp;

        // Modul yang datanya masih kosong total (0 item) — nyakup semua menu "Kelola Konten"
        $emptyModules = collect([
            'Fasilitas' => ['count' => $stats['fasilitas_count'], 'url' => route('admin.facilities.index')],
            'Informasi & Berita' => ['count' => $stats['berita_count'], 'url' => route('admin.informasi.index')],
            'Infografis' => ['count' => $stats['infografis_count'], 'url' => route('admin.stats.index')],
            'Penghargaan' => ['count' => $stats['penghargaan_count'], 'url' => route('admin.awards.index')],
            'Liputan Media' => ['count' => $stats['liputan_media_count'], 'url' => route('admin.media-coverage.index')],
            'Testimoni' => ['count' => $stats['testimoni_count'], 'url' => route('admin.testimonials.index')],
            'FAQ' => ['count' => $stats['faq_count'], 'url' => route('admin.faq.index')],
        ])->filter(fn($m) => $m['count'] === 0);

        

        return view('admin.dashboard', compact(
            'stats', 'layananTanpaItem', 'layananTanpaGaleri', 'kontakBelumLengkap', 'emptyModules'
        ));
    }
}