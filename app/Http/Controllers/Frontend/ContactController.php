<?php
// app/Http/Controllers/Frontend/ContactController.php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        // TODO: nanti kalau tabel `contacts` & `locations` udah jadi,
        // ganti jadi query DB dengan try-catch fallback (pola sama kaya HomeController)
        $contact = (object)[
            'phone' => '(022) 1234-567',
            'whatsapp' => '62895385703917',
            'email' => 'balonghardisumedang@gmail.com',
            'operational_hours' => '08:00 - 20:00',
        ];

        $location = (object)[
            'address' => 'Pasarean Kelapa Dua No.Blok, Desa Bendungan, Margamukti, Kec. Sumedang Utara, Kabupaten Sumedang, Jawa Barat 45621',
        ];

        return view('pages.contact', compact('contact', 'location'));
    }
}