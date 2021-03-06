<?php

namespace App\Http\Controllers\siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Profil_siswa;
use App\Models\PrestasiSiswa;

class PrestasiController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:siswa');
    }
    public function index()
    {
    	$siswa = Profil_siswa::where('nisn',Auth::user('siswa')->nisn)->first();
    	$prestasis = PrestasiSiswa::where('id_profil_siswa', $siswa->id)->get();
    	return view('siswa.prestasi', compact('siswa', 'prestasis'));
    }
}
