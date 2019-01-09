<?php

namespace App\Http\Controllers\pengajar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ListPelajaran;
use App\Models\Soal;
use App\Models\MapelBab;
use App\Models\GambarSoal;
use Alert;

class SoalController extends Controller
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
        return view('pengajar.soal', compact('pelajarans'));
    }
    public function listsoal($id_pel)
    {
        $pelajaran = ListPelajaran::where(['list_pelajarans.id'=> $id_pel ,'id_guru'=> Auth::user('pengajar')->id])
                        ->join('kurikulums', 'list_pelajarans.id_kurikulum', 'kurikulums.id')
                        ->join('jurusans', 'list_pelajarans.id_jurusan', 'jurusans.id')
                        ->join('tingkat_kelas', 'list_pelajarans.id_tk', 'tingkat_kelas.id')
                        ->join('mapels', 'list_pelajarans.id_mapel', 'mapels.id')
                        ->select('mapel', 'kurikulum', 'tingkat_kelas','jurusan', 'list_pelajarans.*')
                        ->first();

        $babs = MapelBab::where('id_mapel', $pelajaran->id_mapel)->get();
        return view('pengajar.soal-list', compact('pelajaran', 'babs'));
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
        $bab = MapelBab::where('id', $id_bab)->select('topik')->first();
        $topiks = explode(', ', $bab->topik);
        return view('pengajar.soal-tambah', compact('id_bab','id_pel', 'pelajaran', 'topiks'));
    }
    public function store(Request $request)
    {
        $soal = new Soal();
        $soal->fill($request->all());
        $soal['topik'] = substr($request->topik,0,-78);
        $soal['id_guru'] = Auth::user('pengajar')->id;
        $soal->save();

        $files = $request->file('gambar');
        if (!empty($files)) {
            foreach ($files as $file) {
                $filenamewithextension = $file->getClientOriginalName();
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $extension =$file->getClientOriginalExtension();
                $filenametostorefoto = $soal->id.'-'.$soal->id_guru.'__'.$filename.'_'.uniqid().'.'.$extension;

                $file->move('images/produk',$filenametostorefoto);
               
                $gambar = new GambarSoal;
                $gambar['id_soal'] = $soal->id;
                $gambar['gambar'] = $filenametostorefoto;
                $gambar->save();
            }
        }
        Alert::success('Soal Anda telah berhasil masuk', 'Berhasil');
        return redirect('pengajar/soal/list/'.$soal->id_list_pelajaran);
    }
    public function soalid($id_soal, $id_pel)
    {
        $pelajaran = ListPelajaran::where(['list_pelajarans.id'=> $id_pel ,'id_guru'=> Auth::user('pengajar')->id])
                        ->join('kurikulums', 'list_pelajarans.id_kurikulum', 'kurikulums.id')
                        ->join('jurusans', 'list_pelajarans.id_jurusan', 'jurusans.id')
                        ->join('tingkat_kelas', 'list_pelajarans.id_tk', 'tingkat_kelas.id')
                        ->join('mapels', 'list_pelajarans.id_mapel', 'mapels.id')
                        ->select('mapel', 'kurikulum', 'tingkat_kelas','jurusan', 'list_pelajarans.*')
                        ->first();
        $soal = Soal::FindOrFail($id_soal);
        return view('pengajar.soal-id', compact('pelajaran', 'soal'));
    }
    public function rubah($id_soal, $id_pel)
    {
        $pelajaran = ListPelajaran::where(['list_pelajarans.id'=> $id_pel ,'id_guru'=> Auth::user('pengajar')->id])
                        ->join('kurikulums', 'list_pelajarans.id_kurikulum', 'kurikulums.id')
                        ->join('jurusans', 'list_pelajarans.id_jurusan', 'jurusans.id')
                        ->join('tingkat_kelas', 'list_pelajarans.id_tk', 'tingkat_kelas.id')
                        ->join('mapels', 'list_pelajarans.id_mapel', 'mapels.id')
                        ->select('mapel', 'kurikulum', 'tingkat_kelas','jurusan', 'list_pelajarans.*')
                        ->first();
        $soal = Soal::FindOrFail($id_soal);
        return view('pengajar.soal-update', compact('pelajaran', 'soal'));
    }
    public function delete($id)
    {
        $hapus = Soal::find($id);

        if ($hapus) {
            $hapus->delete();
            return response()->json([
                'message' => 'Berhasil Hapus',
                'kode' => '00'
            ]);
        }else{
            return response()->json([
                'message' => 'Gagal Hapus',
                'kode' => '01'
            ]);
        }
    }
}
