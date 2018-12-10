<?php

namespace App\Http\Controllers\siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Profil_siswa;
use App\Models\Kelas_siswa;
use App\Models\Tahun_ajaran;
use App\Models\Kelas;
use App\Models\Mapel;

class KelasController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:siswa');
    }
    public function index()
    {
    	$siswa = Profil_siswa::where('nisn',Auth::user('siswa')->nisn)->first();
    	$siswakelass = Kelas_siswa::where('id_siswa', $siswa->id )
			    	->join('kelas', 'kelas_siswas.id_kelas', '=', 'kelas.id')	
                    ->join('kurikulums', 'kelas.id_ta', '=', 'kurikulums.id')
                    ->join('jurusans', 'kelas.id_jurusan', '=', 'jurusans.id')
                    ->join('tingkat_kelas', 'kelas.id_tingkatan_kelas', '=', 'tingkat_kelas.id')
                    ->join('tahun_ajarans', 'kelas.id_ta', '=', 'tahun_ajarans.id')
                    ->select('kelas.*', 'kelas.id as id_kelas','jurusans.jurusan', 'tingkat_kelas.tingkat_kelas', 'kurikulums.kurikulum', 'tahun_ajarans.tahun_ajaran')
			    	->get();
			    	// dd($siswakelass);
		$tahunajaran = Tahun_ajaran::where('status', 'Show')->first();
    	return view('siswa.kelas', compact('siswa', 'siswakelass', 'tahunajaran'));
    }
    public function kelasid($id_kelas)
    {
        $kelas = Kelas::where('id', $id_kelas)->first();
        $mapels = Mapel::where('id_tingkat_kelas', $kelas->id_tingkatan_kelas)->get();
        return view('siswa.kelas-id', compact('kelas', 'mapels'));
    }
}
