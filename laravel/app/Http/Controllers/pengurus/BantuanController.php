<?php

namespace App\Http\Controllers\pengurus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Bantuan;

class BantuanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pengurus');
    }

    public function index()
    {
        $bantuans = Bantuan::where('id_pengurus', Auth::user('pengurus')->id)->get();
        return view('pengurus.bantuan', compact('bantuans'));
    }
    public function store(Request $request)
    {
        $bantuan = new Bantuan();
        $bantuan->fill($request->all());
        if ($request->hasFile('lampiran')){
            $filenamewithextension = $request->file('lampiran')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('lampiran')->getClientOriginalExtension();
            $filenametostorefoto = $filename.'_'.uniqid().'.'.$extension;
            Storage::disk('ftp-bantuan')->put($filenametostorefoto, fopen($request->file('lampiran'), 'r+'));
            $bantuan['lampiran'] = $filenametostorefoto;
        }
        $bantuan['id_pengurus'] = Auth::user('pengurus')->id;
        $bantuan->save();
        return  back()->with('success', 'Berhasil Menambahkan Bantuan');
    }
    public function bantuanid($id)
    {
        $bantuan = Bantuan::find($id);
        return view('pengurus.bantuan-id', compact('bantuan', 'id'));
    }
    public function edit($id)
    {
        $bantuan = Bantuan::find($id);
        return view('pengurus.bantuan-update', compact('bantuan', 'id'));
    }
    public function update(Request $request)
    {
        $bantuan = Bantuan::find($request->id);
        $bantuanh = Bantuan::find($request->id);
        $bantuan->fill($request->all());
        if ($request->hasFile('lampiran')){
            $filenamewithextension = $request->file('lampiran')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('lampiran')->getClientOriginalExtension();
            $filenametostorefoto = $filename.'_'.uniqid().'.'.$extension;
            Storage::disk('ftp-bantuan')->put($filenametostorefoto, fopen($request->file('lampiran'), 'r+'));
            Storage::disk('ftp-bantuan')->delete($bantuanh->lampiran);
            $bantuan['lampiran'] = $filenametostorefoto;
        }
        $bantuan->update();
        return redirect('pengurus/bantuan');
    }
    public function delete($id)
    {
        $bantuan = Bantuan::find($id);
        Storage::disk('ftp-bantuan')->delete($bantuan->lampiran);
        $bantuan->delete();
        return back()->with('success',' Mata Pelajaran Berhasil Dihapus');
    }
    public function tampilkan($id)
    {
        $bantuan = Bantuan::find($id)->update(['status'=> 'Show']);
        return  back()->with('success', 'Berhasil Menampilkan Bantuan (Public)');
    }
    public function sembunyikan($id)
    {
        $bantuan = Bantuan::find($id)->update(['status'=> 'Hidden']);
        return  back()->with('success', 'Berhasil Menyembunyikan Bantuan (Private)');
    }
}
