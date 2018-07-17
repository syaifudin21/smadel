<?php

namespace App\Http\Controllers\layanan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Foto;
use File;

class FotoController extends Controller
{
    public function store(Request $request)
    {
        $files = $request->file('foto');
	        foreach ($files as $file) {
	            $filenamewithextension = $file->getClientOriginalName();
	            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
	            $extension =$file->getClientOriginalExtension();
	            $filenametostorefoto = $filename.'_'.uniqid().'.'.$extension;
	            $file->move('images/album',$filenametostorefoto);
	            Foto::create([
	                'foto' => $filenametostorefoto,
	                'caption' => $request->caption, 
	                'status_user' => $request->status_user, 
	                'id_user'=> $request->id_user, 
	                'id_album'=> $request->id_album,
	            ]);
	        }
        return  back()->with('success', 'Berhasil Menambahkan Foto');
    }
    public function update(Request $request)
    {
    	$foto = Foto::find($request->id);
        $foto->fill($request->all());
        $foto->update();
        return back()->with('success', 'Berhasil Mengubah Foto');
    }
    public function delete($id)
    {
        $foto = Foto::find($id);
        File::delete('images/album/'.$foto->foto);
        $foto->delete();
        return back()->with('success',' Foto Berhasil Dihapus');
    }
}
