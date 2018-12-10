<?php

namespace App\Http\Controllers\Android\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Profil_siswa;

class SiswaController extends Controller
{
    public function login(Request $request)
    {
        $credential = [
            'nisn' => $request->nisn,
            'password' => $request->password
        ];

        if (Auth::guard('siswa')->attempt($credential, false)){
        	$profil = Profil_siswa::where('nisn', $request->nisn)->first();
            $data = [
            	'message' => 'Berhasil login',
            	'siswa' => $profil,
            	'kode' => '00'
            ];
        }else{
        	 $data = [
            	'message' => 'Gagal Login',
            	'kode' => '01'
            ];
        }
        return $data;
    }

}
