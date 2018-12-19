<?php

namespace App\Http\Controllers\Android\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profil_siswa;
use App\Models\Tahun_ajaran;
use App\Models\Kelas_siswa;
use App\Models\Kelas;
use App\Models\Mapel;

class KelasController extends Controller
{
    public function kelasdiikuti(Request $request)
    {
    	$siswa = Profil_siswa::where('nisn',$request->nisn)->first();
		$tahunajaran = Tahun_ajaran::where('status', 'Show')->first();
    	if (!empty($siswa)) {
    		$siswakelass = Kelas_siswa::where('id_siswa', $siswa->id )
			    	->join('kelas', 'kelas_siswas.id_kelas', '=', 'kelas.id')	
                    ->join('kurikulums', 'kelas.id_ta', '=', 'kurikulums.id')
                    ->join('jurusans', 'kelas.id_jurusan', '=', 'jurusans.id')
                    ->join('tingkat_kelas', 'kelas.id_tingkatan_kelas', '=', 'tingkat_kelas.id')
                    ->join('tahun_ajarans', 'kelas.id_ta', '=', 'tahun_ajarans.id')
                    ->select('kelas.*', 'kelas.id as id_kelas','jurusans.jurusan', 'tingkat_kelas.tingkat_kelas', 'kurikulums.kurikulum', 'tahun_ajarans.tahun_ajaran')
			    	->get();
			$data  = [
				'data' => $siswakelass,
				'message' => 'Berhasil Ambil Data', 
				'kode' => '00'
			];
    	}else{
    		$data = [
    			'kode' => '01',
    			'message' => 'Nisn Tidak diketahui'
    		];
    	}
    	
    	return response()->json($data);
    }
    public function kelasid(Request $request)
    {
        $kelas = Kelas::where('id', $request->id_kelas)->first();
        if (!empty($kelas)) {
        	$mapels = Mapel::where('id_tingkat_kelas', $kelas->id_tingkatan_kelas)->get();
	        $data = [
	        	'kelas' => $kelas,
	        	'mapels' => $mapels,
	        	'kode' => '00',
	        	'message' => 'Berhasil Membaca Data'
	        ];
        }else{
	        $data = [
	        	'kode' => '01',
	        	'message' => 'Id Kelas Salah'
	        ];
        }
        
        return response()->json($data);
    }
}
