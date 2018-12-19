<?php

namespace App\Http\Controllers\Android\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Artikel;

class ArtikelController extends Controller
{
    public function artikel(Request $request)
    {
        $artikels = Artikel::where('status', '1')->get();

        return response()->json([
        	'artikels' => $artikels,
        ]);
    }
}
