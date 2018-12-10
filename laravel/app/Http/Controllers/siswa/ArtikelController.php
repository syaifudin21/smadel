<?php

namespace App\Http\Controllers\siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Artikel;
use App\Models\Profil_siswa;

class ArtikelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:siswa');
    }
    public function index()
    {
        $siswa = Profil_siswa::where('nisn', Auth::user('siswa')->nisn)->first();
        $artikels = Artikel::where(['status_user' => 'Siswa' ,'id_user'=> $siswa->id])->paginate(10);
        return view('siswa.artikel', compact('artikels'));
    }
    public function tambah()
    {
        return view('siswa.artikel-tambah');
    }
    public function edit($id_artikel)
    {
        $artikel = Artikel::find($id_artikel);
        return view('siswa.artikel-edit', compact('artikel'));
    }
    public function store(Request $request)
    {
        $artikel = new Artikel();
        $artikel->fill($request->all());
        if ($request->hasFile('lampiran')){
            $filenamewithextension = $request->file('lampiran')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('lampiran')->getClientOriginalExtension();
            $filenametostorefoto = $filename.'_'.uniqid().'.'.$extension;
            Storage::disk('ftp-artikel')->put($filenametostorefoto, fopen($request->file('lampiran'), 'r+'));
            $artikel['lampiran'] = $filenametostorefoto;
        }
        $artikel['status_user'] = 'Siswa';
        $artikel['id_user'] = Profil_siswa::where('nisn', Auth::user('siswa')->nisn)->first()->id;
        $artikel['slug_judul'] = str_slug($request->judul, '-');
        $artikel->save();
        return  redirect('siswa/artikel/view/'.$artikel->slug_judul)->with('success', 'Berhasil Menambahkan Artikel');
    }
    public function artikelid($slug)
    {
        $artikel = Artikel::where('slug_judul',$slug)->first();
        $articles = Artikel::where('status','Tampil')->get();
        return view('siswa.artikel-id', compact('artikel', 'articles'));
    }
     public function update(Request $request)
    {
        $artikel = Artikel::find($request->id);
        $artikelh = Artikel::find($request->id);
        $artikel->fill($request->all());
        if ($request->hasFile('lampiran')){
            $filenamewithextension = $request->file('lampiran')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('lampiran')->getClientOriginalExtension();
            $filenametostorefoto = $filename.'_'.uniqid().'.'.$extension;
            Storage::disk('ftp-artikel')->put($filenametostorefoto, fopen($request->file('lampiran'), 'r+'));
            Storage::disk('ftp-artikel')->delete($artikelh->lampiran);
            $artikel['lampiran'] = $filenametostorefoto;
        }
        $artikel['id_user'] = Profil_siswa::where('nisn', Auth::user('siswa')->nisn)->first()->id;
        $artikel['slug_judul'] = str_slug($request->judul, '-');
        $artikel->update();

        return  redirect('siswa/artikel/view/'.$artikel->slug_judul)->with('success', 'Berhasil Mengupdate Artikel');
    }
    public function delete($id_artikel)
    {
        $artikel = Artikel::find($id_artikel);
        if (!empty($artikel->lampiran)) {Storage::disk('ftp-artikel')->delete($artikel->lampiran);}
        $artikel->delete();
        return back()->with('success',' Artikel Berhasil Dihapus');
    }
}
