<?php

namespace App\Http\Controllers\Android\Pengurus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengurus;

class PengurusController extends Controller
{
    public function login(Request $request)
    {
        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::guard('pengurus')->attempt($credential, false)){
        	$profil = Pengurus::where('email', $request->email)->first();
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
        return response()->json($data);
    }
}
