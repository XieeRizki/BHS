<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Location;
use App\Models\Package;
use Illuminate\Support\Facades\Log;
use Throwable;

class ContactController extends Controller
{
    public function index()
    {
        try {
            $contact = Contact::first() ?? $this->dummyContact();
        } catch (Throwable $e) {
            Log::warning('Contact gagal diambil dari DB, pakai dummy: ' . $e->getMessage());
            $contact = $this->dummyContact();
        }

        try {
            $location = Location::first() ?? $this->dummyLocation();
        } catch (Throwable $e) {
            $location = $this->dummyLocation();
        }

        try {
            $packages = Package::where('is_active', true)->orderBy('order')->get();
            if ($packages->isEmpty()) $packages = $this->dummyPackages();
        } catch (Throwable $e) {
            $packages = $this->dummyPackages();
        }

        return view('pages.contact', compact('contact', 'location', 'packages'));
    }

    /**
     * ====== DATA DUMMY / PLACEHOLDER ======
     * Dipakai sementara selama database belum diisi / lagi dirombak,
     * biar halaman Kontak tetap kelihatan lengkap buat keperluan desain.
     */

    private function dummyContact(): object
    {
        return (object) [
            'phone' => '0813-9494-4133',
            'whatsapp' => '6281394944133',
            'email' => 'info@balonghardi.com',
            'operational_hours' => 'Senin - Sabtu, 06:00 - 22:00',
            'facebook' => null,
            'instagram' => null,
        ];
    }

    private function dummyLocation(): object
    {
        return (object) [
            'address' => 'Pasarean Kelapa Dua No.Blok, Desa Bendungan, Margamukti, Kec. Sumedang Utara, Kabupaten Sumedang, Jawa Barat 45621',
            'maps_url' => 'https://maps.app.goo.gl/HApwsDwtXbhrTFGQ9',
        ];
    }

    private function dummyPackages()
    {
        return collect([
            (object) ['name' => 'Paket Pagi', 'formatted_price' => 'Rp 50.000'],
            (object) ['name' => 'Paket Siang', 'formatted_price' => 'Rp 60.000'],
            (object) ['name' => 'Paket Sore', 'formatted_price' => 'Rp 55.000'],
        ]);
    }
}