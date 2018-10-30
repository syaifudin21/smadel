<?php

namespace App\Http\Controllers\sekolah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Tahun_ajaran;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Kurikulum;
use App\Models\Kelas_siswa;

class KelasController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:sekolah');
    }
    public function kelas($id_ta)
    {
    	$kelass = Kelas::where('id_ta', $id_ta)->get();
    	$ta = Tahun_ajaran::find($id_ta);
    	$kurikulums = Kurikulum::all();
    	return view('sekolah.kelas', compact('kelass', 'ta', 'kurikulums'));
    }
    public function kelasstore(Request $request)
    {
    	$kurikulum = new Kelas();
        $kurikulum->fill($request->all());
        $kurikulum->save();
        return back()->with('success', 'Berhasil menambahkan Kelas Baru');
    }
    public function kelasid($id)
    {
    	$kelas = Kelas::where('kelas.id',$id)
    				->join('kurikulums', 'kelas.id_ta', '=', 'kurikulums.id')
    				->join('jurusans', 'kelas.id_jurusan', '=', 'jurusans.id')
    				->join('tingkat_kelas', 'kelas.id_tingkatan_kelas', '=', 'tingkat_kelas.id')
    				->join('tahun_ajarans', 'kelas.id_ta', '=', 'tahun_ajarans.id')
    				->select('kelas.*', 'jurusans.jurusan', 'tingkat_kelas.tingkat_kelas', 'kurikulums.kurikulum', 'tahun_ajarans.tahun_ajaran')
    				->first();
    	$kurikulums = Kurikulum::all();
        $mapels = Mapel::where('id_tingkat_kelas', $kelas->id_tingkatan_kelas)->get();
    	return view('sekolah.kelas-id', compact('kelas', 'kurikulums', 'mapels'));
    }
    public function siswakelas($id)
    {
        $kelas = Kelas::find($id);

        $siswakelass = Kelas_siswa::where('id_kelas', $id)
                    ->join('profil_siswas', 'kelas_siswas.id_siswa', '=', 'profil_siswas.id')
                    ->select('profil_siswas.nama_lengkap', 'profil_siswas.alamat', 'profil_siswas.nisn')
                    ->get();
        return view('sekolah.kelas-siswa', compact('kelas','siswakelass'));
    }
    public function kelasupdateid($id)
    {
    	$kelas = Kelas::where('kelas.id',$id)
    				->join('kurikulums', 'kelas.id_ta', '=', 'kurikulums.id')
    				->join('jurusans', 'kelas.id_jurusan', '=', 'jurusans.id')
    				->join('tingkat_kelas', 'kelas.id_tingkatan_kelas', '=', 'tingkat_kelas.id')
    				->join('tahun_ajarans', 'kelas.id_ta', '=', 'tahun_ajarans.id')
    				->select('kelas.*', 'jurusans.jurusan', 'tingkat_kelas.tingkat_kelas', 'kurikulums.kurikulum', 'tahun_ajarans.tahun_ajaran')
    				->first();
    	$kurikulums = Kurikulum::all();
    	return view('sekolah.kelas-update', compact('kelas', 'kurikulums'));
    }
    public function kelasupdate(Request $request)
    {
    	$mapel = Kelas::find($request->id);
        $mapel->fill($request->all());
        $mapel->update();
        return back()->with('success', 'Berhasil Update Kelas');
    }
}
