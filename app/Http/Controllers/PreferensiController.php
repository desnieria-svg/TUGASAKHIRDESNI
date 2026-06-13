<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreferensiController extends Controller
{
    public function index()
    {
        return view('pages.preferensi');
    }

    public function simpan(Request $request)
    {
        $tema     = $request->input('tema', 'light');
        $fontSize = $request->input('font_size', 'medium');

        // Baca cookie lama sebagai contoh
        $temaLama = $request->cookie('tema');

        return response()->json([
            'success'   => true,
            'message'   => 'Preferensi berhasil disimpan!',
            'tema'      => $tema,
            'font_size' => $fontSize,
            'tema_lama' => $temaLama,
        ])->cookie('tema', $tema, 60 * 24 * 30)
          ->cookie('font_size', $fontSize, 60 * 24 * 30);
    }
}