<?php

namespace App\Http\Controllers\siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AbsenSiswa;
use App\Models\Profil_siswa;

class AbsenController extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth:siswa');
    }
    public function index()
    {
    	$hadirs = AbsenSiswa::where('nisn', Auth::user('siswa')->nisn)->get();
    	$siswa = Profil_siswa::where('nisn',Auth::user('siswa')->nisn)->first();
    	return view('siswa.absen', compact('siswa', 'hadirs'));
    }
}
