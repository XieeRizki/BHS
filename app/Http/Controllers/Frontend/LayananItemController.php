<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\LayananItem;

class LayananItemController extends Controller
{
    public function show(Layanan $layanan, LayananItem $item)
    {
        abort_unless($item->is_active && $item->layanan_id === $layanan->id, 404);

        $contact = (object) ['whatsapp' => '62895385703917'];

        return view('pages.layanan-item', compact('layanan', 'item', 'contact'));
    }
}