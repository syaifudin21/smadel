<?php

namespace App\Http\Controllers\Android\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AbsenSiswa;
use App\Models\Profil_siswa;

class AbsenController extends Controller
{
    public function upload(Request $request)
    {
    	if (!empty($request->id_absen)) {
	    	$hadir = AbsenSiswa::find($request->id_absen);
	    	if (!empty($hadir)) {
		        $hadir->fill($request->all());
		    	$hadir->update();

		    	if ($hadir) {
		    		$data = [
			    		'id_absen' => $hadir->id,
			    		'kode' => '00'
			    	];
		    	}else{
		    		$data = [
			    		'kode' => '01'
			    	];
		    	}
	    	}else{
	    		$data = [
		    		'id_absen' => $hadir->id,
		    		'kode' => '01'
		    	];
	    	}
	    	
    	}else{
    		$hadir = new AbsenSiswa;
	        $hadir->fill($request->all());
	    	$hadir->save();

	    	if ($hadir) {
	    		$data = [
		    		'id_absen' => $hadir->id,
		    		'kode' => '00'
		    	];
	    	}else{
	    		$data = [
		    		'kode' => '01'
		    	];
	    	}
    	}
    	return $data;

    }
    public function download(Request $request)
    {
    	$siswa = Profil_siswa::where('nisn',$request->nisn)->first();
    	if (!empty($siswa)) {
	    	$absens = AbsenSiswa::where('nisn', $request->nisn)->get();
    		$data = [
	    		'nisn' => $request->nisn,
	    		'data' => $absens,
	    		'kode' => '00',
	    		'message' => 'Berhasil Ambil Data'
	    	];
	    }else{
    		$data = [
	    		'message' => 'Nisn Tidak Diketahui',
	    		'kode' => '01'
	    	];
    	}
    	return $data;
    }
}
