<?php

namespace App\Http\Controllers\pengurus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Prestasi;
use File;

class PrestasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pengurus');
    }

    public function index()
    {
        $prestasis = Prestasi::all();
        return view('pengurus.prestasi', compact('prestasis'));
    }
    public function store(Request $request)
    {
        $prestasi = new Prestasi();
        $prestasi->fill($request->all());
        if ($request->hasFile('foto')){
            $filenamewithextension = $request->file('foto')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $filenametostorefoto = $filename.'_'.uniqid().'.'.$extension;
            $request->file('foto')->move('images/prestasi',$filenametostorefoto);
            $prestasi['foto'] = $filenametostorefoto;
        }
        $prestasi->save();
        return  back()->with('success', 'Berhasil Menambahkan Prestasi');
    }
    public function prestasiid($id)
    {
        $prestasi = Prestasi::find($id);
        return view('pengurus.prestasi-id', compact('prestasi', 'id'));
    }
    public function edit($id)
    {
        $prestasi = Prestasi::find($id);
        return view('pengurus.prestasi-update', compact('prestasi', 'id'));
    }
    public function update(Request $request)
    {
        $prestasi = Prestasi::find($request->id);
        $prestasih = Prestasi::find($request->id);
        $prestasi->fill($request->all());
        if ($request->hasFile('foto')){
            $filenamewithextension = $request->file('foto')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $filenametostorefoto = $filename.'_'.uniqid().'.'.$extension;
            File::delete('images/prestasi/'.$prestasih->foto);
            $request->file('foto')->move('images/prestasi',$filenametostorefoto);
            $prestasi['foto'] = $filenametostorefoto;
        }
        $prestasi->update();
        return redirect('pengurus/prestasi');
    }
    public function delete($id)
    {
        $prestasi = Prestasi::find($id);
        File::delete('images/prestasi/'.$prestasi->foto);
        $prestasi->delete();
        return back()->with('success',' Mata Pelajaran Berhasil Dihapus');
    }
}
