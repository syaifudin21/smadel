<?php

namespace App\Http\Controllers\Android\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Artikel;

class ArtikelController extends Controller
{
    public function artikel(Request $request)
    {
        $artikels = Artikel::where('status', '1')->select('id','judul','text_pembuka','lampiran')->get();

        return response()->json([
        	'artikels' => $artikels,
        ]);
    }
    public function artikelid(Request $request)
    {
        // $artikel = Artikel::find($request->id_artikel);
        $url = 'v1/artikel/'.$request->id_artikel;
    	return response()->json([
        	'url' => $request
        ]);
    }
    public function artikelview($id)
    {
    	$artikel = Artikel::find($id);
        return view('android.artikel-id', compact('artikel'));
    }

}
