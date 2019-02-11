<?php

namespace App\Http\Controllers\Android\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Profil_siswa;
use App\Models\Artikel;
use App\Fungsi\Firebase;

class SiswaController extends Controller
{
    public function login(Request $request)
    {
        $credential = [
            'nisn' => $request->nisn,
            'password' => $request->password
        ];

        if (Auth::guard('siswa')->attempt($credential, false)){
            $profil = Profil_siswa::where('nisn', $request->nisn)->select('nama_lengkap','nisn','alamat','foto','status')->first();

            if (!empty($request->api_android)) {
                $siswa = Siswa::where('nisn', $request->nisn)->first();

                $cariapi = preg_match("/981098/i",$request->api_android);
                if (empty($cariapi)) {
                    $siswa['id_api_android'] =$siswa->id_api_android.' , '. $request->api_android;
                    $siswa->update();
                }

                //menambahkan nilai api pada profil
                $profil['api_android'] = $request->api_android;

                //mengirim ke firebase
                $firebase = new Firebase();
	
                $data = ["data"=>
                    [
                        "title"=>"Notifikasi Login",
                        "is_background"=>false,
                        "message"=>"Anda Berhasil login menggunakan Android",
                        "image"=>"",
                        "payload"=>["team"=>"Ownner Corp","score"=>"5.6"],
                        "timestamp"=>"2019-01-08 13:22:29"
                    ]
                ];

                // kirim broadcash
                // $profil['response_fb'] = $firebase->sendToTopic('global', $data);

                // kirim perid
                $profil['response_fb'] = $firebase->send($request->api_android, $data);
            }
            
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

    public function logout(Request $request)
    {
        $siswa = Siswa::where('nisn', $request->nisn)->first();

        if (!empty($siswa)) {
            $siswa['id_api_android'] = null;
            $siswa->save();
            $data = [
            	'message' => 'Berhasil logout',
            	'kode' => '00'
            ];
        }else{
            $data = [
            	'message' => 'Gagal logout',
            	'kode' => '01'
            ];
        }
        return response()->json($data);
    }
    public function user(Request $request)
    {
        $user =  Siswa::where('nomor_user', $request->nomor_user)->first();
        if (!empty($user)) {
            $data = [
                'data' => $user,
            	'message' => 'Berhasil Ambil Data User Login',
            	'kode' => '00'
            ];
        }else{
            $data = [
            	'message' => 'Gagal, Nomor User Salah',
            	'kode' => '01'
            ];
        }
        return response()->json($data);
    }
    public function profil(Request $request)
    {
        $user =  Profil_siswa::where('nomor_user', $request->nomor_user)->first();
        if (!empty($user)) {
            $data = [
                'data' => $user,
            	'message' => 'Berhasil Ambil Data Profil',
            	'kode' => '00'
            ];
        }else{
            $data = [
            	'message' => 'Gagal, Nomor User Salah',
            	'kode' => '01'
            ];
        }
        return response()->json($data);
    }

}
