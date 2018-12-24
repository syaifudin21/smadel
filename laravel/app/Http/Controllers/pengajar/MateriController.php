<?php

namespace App\Http\Controllers\pengajar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Materi;
use App\Models\ListPelajaran;
use App\Models\MapelBab;

class MateriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pengajar');
    }

    public function index()
    {
        $pelajarans = ListPelajaran::where('id_guru', Auth::user('pengajar')->id)
                        ->join('kurikulums', 'list_pelajarans.id_kurikulum', 'kurikulums.id')
                        ->join('jurusans', 'list_pelajarans.id_jurusan', 'jurusans.id')
                        ->join('tingkat_kelas', 'list_pelajarans.id_tk', 'tingkat_kelas.id')
                        ->join('mapels', 'list_pelajarans.id_mapel', 'mapels.id')
                        ->select('mapel', 'kurikulum', 'tingkat_kelas','jurusan', 'list_pelajarans.id')
                        ->paginate(10);
        return view('pengajar.materi', compact('pelajarans'));
    }
    public function listmateri($id_pel)
    {
        $pelajaran = ListPelajaran::where(['list_pelajarans.id'=> $id_pel ,'id_guru'=> Auth::user('pengajar')->id])
                        ->join('kurikulums', 'list_pelajarans.id_kurikulum', 'kurikulums.id')
                        ->join('jurusans', 'list_pelajarans.id_jurusan', 'jurusans.id')
                        ->join('tingkat_kelas', 'list_pelajarans.id_tk', 'tingkat_kelas.id')
                        ->join('mapels', 'list_pelajarans.id_mapel', 'mapels.id')
                        ->select('mapel', 'kurikulum', 'tingkat_kelas','jurusan', 'list_pelajarans.*')
                        ->first();

        $babs = MapelBab::where('id_mapel', $pelajaran->id_mapel)->get();
    	return view('pengajar.materi-list', compact('pelajaran', 'babs'));
    }
    public function materiid($id_materi, $id_pel)
    {
        $materi = Materi::FindOrFail($id_materi);
        $pelajaran = ListPelajaran::where(['list_pelajarans.id'=> $id_pel ,'id_guru'=> Auth::user('pengajar')->id])
                        ->join('kurikulums', 'list_pelajarans.id_kurikulum', 'kurikulums.id')
                        ->join('jurusans', 'list_pelajarans.id_jurusan', 'jurusans.id')
                        ->join('tingkat_kelas', 'list_pelajarans.id_tk', 'tingkat_kelas.id')
                        ->join('mapels', 'list_pelajarans.id_mapel', 'mapels.id')
                        ->select('mapel', 'kurikulum', 'tingkat_kelas','jurusan', 'list_pelajarans.*')
                        ->first();
        return view('pengajar.materi-id', compact('materi', 'pelajaran'));
    }
    public function tambah($id_bab, $id_pel)
    {
        $pelajaran = ListPelajaran::where(['list_pelajarans.id'=> $id_pel ,'id_guru'=> Auth::user('pengajar')->id])
                        ->join('kurikulums', 'list_pelajarans.id_kurikulum', 'kurikulums.id')
                        ->join('jurusans', 'list_pelajarans.id_jurusan', 'jurusans.id')
                        ->join('tingkat_kelas', 'list_pelajarans.id_tk', 'tingkat_kelas.id')
                        ->join('mapels', 'list_pelajarans.id_mapel', 'mapels.id')
                        ->select('mapel', 'kurikulum', 'tingkat_kelas','jurusan', 'list_pelajarans.*')
                        ->first();
    	return view('pengajar.materi-tambah', compact('id_bab','id_pel', 'pelajaran'));
    }
    public function store(Request $request)
    {
        $bab = new Materi();
        $bab->fill($request->all());
        if ($request->hasFile('file')){
            $filenamewithextension = $request->file('file')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $filenametostorefoto = $filename.'_'.uniqid().'.'.$extension;
            // Storage::disk('ftp-materi')->put($filenametostorefoto, fopen($request->file('file'), 'r+'));
            $artikel['file'] = $filenametostorefoto;
        }
        $bab['id_guru'] = Auth::user('pengajar')->id;
        $bab->save();
        return back()->with('success', 'Berhasil menambahkan Bab Mapel');
    }
    public function rubah($id_materi, $id_pel)
    {
        $pelajaran = ListPelajaran::where(['list_pelajarans.id'=> $id_pel ,'id_guru'=> Auth::user('pengajar')->id])
                        ->join('kurikulums', 'list_pelajarans.id_kurikulum', 'kurikulums.id')
                        ->join('jurusans', 'list_pelajarans.id_jurusan', 'jurusans.id')
                        ->join('tingkat_kelas', 'list_pelajarans.id_tk', 'tingkat_kelas.id')
                        ->join('mapels', 'list_pelajarans.id_mapel', 'mapels.id')
                        ->select('mapel', 'kurikulum', 'tingkat_kelas','jurusan', 'list_pelajarans.*')
                        ->first();
        $materi = Materi::find($id_materi);
        return view('pengajar.materi-update', compact('id_bab','id_pel', 'pelajaran', 'materi'));
    }
    
    public function update(Request $request)
    {
        $bab = Materi::find($request->id);
        $bab->fill($request->all());
        if ($request->hasFile('file')){
            $filenamewithextension = $request->file('file')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $filenametostorefoto = $filename.'_'.uniqid().'.'.$extension;
            // Storage::disk('ftp-materi')->put($filenametostorefoto, fopen($request->file('file'), 'r+'));
            $artikel['file'] = $filenametostorefoto;
        }
        $bab->update();

        return back()->with('success','Berhasil Update Bab Mapel');
    }
    public function delete($id)
    {
        Materi::find($id)->delete();
        return back()->with('success','Berhasil Hapus Bab Mapel');
    }
}
