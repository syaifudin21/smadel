<?php

namespace App\Http\Controllers\Android\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AbsenSiswa;

class AbsenController extends Controller
{
    public function upload(Request $request)
    {
    	if (!empty($request->id_absen)) {
	    	$hadir = AbsenSiswa::find($request->id_absen);
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
    	# code...
    }
}
