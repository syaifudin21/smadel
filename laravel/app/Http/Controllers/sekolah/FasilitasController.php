<?php

namespace App\Http\Controllers\sekolah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use File;
use App\Models\Fasilitas;

class FasilitasController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:sekolah');
    }

    public function index()
    {
        $fasilitases = Fasilitas::all();
        return view('sekolah.fasilitas', compact('fasilitases'));
    }
    public function store(Request $request)
    {
        $fasilitas = new Fasilitas();
        $fasilitas->fill($request->all());
        if ($request->hasFile('foto')){
            $filenamewithextension = $request->file('foto')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $filenametostorefoto = $filename.'_'.uniqid().'.'.$extension;
            Storage::disk('ftp-fasilitas')->put($filenametostorefoto, fopen($request->file('foto'), 'r+'));
            $fasilitas['foto'] = $filenametostorefoto;
        }
        $fasilitas->save();
        return  back()->with('success', 'Berhasil Menambahkan Atribut');
    }
    public function atributid($id)
    {
        $fasilitas = Fasilitas::find($id);
        return view('sekolah.fasilitas-id', compact('fasilitas', 'id'));
    }
    public function edit($id)
    {
        $fasilitas = Fasilitas::find($id);
        return view('sekolah.fasilitas-update', compact('fasilitas', 'id'));
    }
    public function update(Request $request)
    {
        $fasilitas = Fasilitas::find($request->id);
        $fasilitasd = Fasilitas::find($request->id);
        $fasilitas->fill($request->all());
        if ($request->hasFile('foto')){
            $filenamewithextension = $request->file('foto')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $filenametostorefoto = $filename.'_'.uniqid().'.'.$extension;
            Storage::disk('ftp-fasilitas')->delete($fasilitasd->foto);
            Storage::disk('ftp-fasilitas')->put($filenametostorefoto, fopen($request->file('foto'), 'r+'));
            $fasilitas['foto'] = $filenametostorefoto;
        }
        $fasilitas->update();
        return redirect('sekolah/fasilitas');
    }
    public function delete($id)
    {
        $fasilitas = Fasilitas::find($id);
        Storage::disk('ftp-fasilitas')->delete($fasilitas->foto);
        $fasilitas->delete();
        return back()->with('success',' Mata Pelajaran Berhasil Dihapus');
    }
}
