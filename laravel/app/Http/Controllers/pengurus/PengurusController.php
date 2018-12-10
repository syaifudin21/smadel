<?php

namespace App\Http\Controllers\pengurus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengurus;
use App\Models\Profil_siswa;
use App\Models\Masukkan;
use App\Models\Tahun_ajaran;
use App\Models\Kelas;
use App\Models\Kelas_siswa;
use App\Models\SiswaGugur;
use DB;

class PengurusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pengurus');
    }

    public function index()
    {
        return view('pengurus.dasboard');
    }
    public function profil()
    {
    	$pengurus = Pengurus::findOrFail(Auth::user()->id);
        return view('pengurus.profil', compact('pengurus'));
    }
    public function update(Request $request)
    {
        $pengurus = Pengurus::findOrFail(Auth::user()->id);
        $pengurus->fill($request->all());
        if (Hash::check($request->passwordlama, $pengurus->password)){
            if (!empty($request->passwordbaru)) {
                if ($request->passwordbaru == $request->cpasswordbaru){
                    $passwordbaru = Hash::make($request->passwordbaru);
                    $pengurus['password'] = $passwordbaru;
                }
            }
            $pengurus->update();
            return back()->with('success','Password berhasil diupdate');
        }else{
            return back()->with('gagal', 'Gagal Mengupdate Profil, passtikan password anda yang anda masukkan benar');
        }
        $pengurus->update();
        return back()->with('success','Password berhasil diupdate');

    }
    public function baru()
    {
        $ta = Tahun_ajaran::where('status', 'show')->first();
        $siswas = Profil_siswa::where(['id_ta'=> $ta->id, 'status'=>'Verifikasi Admin'])->get();
        $jurusans = Kelas::where('id_ta', $ta->id)
                ->select('kelas.id_jurusan')
                ->groupBy('id_jurusan')
                ->join('tingkat_kelas', function ($join) {
                    $join->on('kelas.id_tingkatan_kelas', '=', 'tingkat_kelas.id')
                         ->where('tingkat_kelas.status', '=', 'Pertama');
                    })
                ->get();
        $kelass = Kelas::where('id_ta', $ta->id)
                ->join('tingkat_kelas', function ($join) {
                    $join->on('kelas.id_tingkatan_kelas', '=', 'tingkat_kelas.id')
                         ->where('tingkat_kelas.status', '=', 'Pertama');
                    })
                ->select('kelas.kelas', 'tingkat_kelas.status', 'kelas.id', 'kelas.id_tingkatan_kelas')
                ->get();

        return view('pengurus.siswabaru', compact('ta','siswas', 'jurusans', 'kelass'));
    }
    public function siswaprofil($id)
    {
        $siswa = Profil_siswa::find($id);
        return view('pengurus.siswaprofil', compact('siswa'));
    }
    public function siswaupdate(Request $data)
    {
       Validator::make($data->all(), [
            'foto' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'ijazah' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ])->validate();

        $profil = Profil_siswa::findOrFail($data->id);
        $profill = Profil_siswa::findOrFail($data->id);
        $profil->fill($data->all());

        if ($data->hasFile('foto')){
            $filenamewithextension = $data->file('foto')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $data->file('foto')->getClientOriginalExtension();
            $filenametostorefoto = $filename.'_'.uniqid().'.'.$extension;
            File::delete('images/siswa/'.$profill->foto);
            $data->file('foto')->move('images/siswa',$filenametostorefoto);
            $profil['foto'] = $filenametostorefoto;
        }
        if ($data->hasFile('ijazah')){
            $filenamewithextension = $data->file('ijazah')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $data->file('ijazah')->getClientOriginalExtension();
            $filenametostoreijazah = $filename.'_'.uniqid().'.'.$extension;
            File::delete('images/siswa/'.$profill->ijazah);
            $data->file('ijazah')->move('images/siswa',$filenametostoreijazah);
            $profil['ijazah'] = $filenametostoreijazah;
        }

        $profil->update();

        return back()->with('success', 'Berhasil Mengajukan Data');
    }
    public function masukan()
    {
        $masukans = Masukkan::orderBy('created_at', 'desc')->get();
        return view('pengurus.masukan', compact('masukans'));
    }
    public function masukanhapus($id)
    {
        Masukkan::find($id)->delete();
        return back()->with('success',' Saran / Masukkan Berhasil Dihapus');
    }
    public function siswanilaitest(Request $request)
    {
        $profil = Profil_siswa::findOrFail($request->id);
        $profil->fill($request->all());
        $profil->update();
        return back()->with('success', 'Berhasil Menambahkan Nilai');
    }
    public function daftarkelas($id_siswa, $id_kelas, $id_tk)
    {
        $siswa = Kelas_siswa::where(['id_siswa'=> $id_siswa, 'id_tk'=> $id_tk])->first();
        $kelas = Kelas::where('id', $id_kelas)->first();
        if (empty($kelas)) {
            $data = [
                'message' => 'Kelas tidak ditemukan',
                'kode' => '02'
            ];
        }else{
            if (!empty($siswa)) {
                $siswa['id_kelas']= $id_kelas;
                $siswa->update();

                $data = [
                    'message' => 'Berhasil Update siswa kelas',
                    'namakelas' => $kelas->kelas,
                    'kode' => '00'
                ];

            } else {
                Kelas_siswa::where(['id_siswa'=> $id_siswa, 'status'=> 'Daftar'])->delete();

                $dkelas = new Kelas_siswa;
                $dkelas['id_kelas']= $id_kelas;
                $dkelas['id_siswa']= $id_siswa;
                $dkelas['id_tk']= $id_tk;
                $dkelas->save();

                $data = [
                    'message' => 'Berhasil Menambahkan siswa kelas',
                    'namakelas' => $kelas->kelas,
                    'kode' => '00'
                ];
            }
        }
        return $data;
    }
    public function siswagugur($id_siswa, $id_ta)
    {
        $sisgur = new SiswaGugur;
        $sisgur['id_ta'] = $id_ta;
        $sisgur['id_pendaftaran'] = $id_siswa;
        $sisgur['status'] = 'Pendaftaran';
        $sisgur['keterangan'] = 'Gugur dalam pendaftaran';
        $sisgur->save();

        if ($sisgur) {
            $data = [
                'message' => 'Berhasil Penggugurkan siswa ',
                'kode' => '00'
            ];
        } else {
            $data = [
                'message' => 'Gagal Penggugurkan siswa ',
                'kode' => '01'
            ];
        }
        return $data;
    }
    public function batalgugur($id_siswa)
    {
        $sisgur = SiswaGugur::where('id_pendaftaran', $id_siswa)->first();
        if (!empty($sisgur)) {
            $sisgur->delete();
            $data = [
                'message' => 'Berhasil Menghapus Pengguguran siswa ',
                'kode' => '00'
            ];
        } else {
            $data = [
                'message' => 'Gagal Menghapus Pengguguran siswa ',
                'kode' => '01'
            ];
        }
        return $data;
    }
    public function konfirmasipendaftaran()
    {
        $siswas = Profil_siswa::all();

        foreach ($siswas as $siswa) {
            $siswagur = SiswaGugur::where('id_pendaftaran', $siswa->id)->first();
            if (!empty($siswagur)) {
                Profil_siswa::find($siswa->id)->update(['status'=>'Gagal']);
            } else {
                $siswakelas = Kelas_siswa::where('id_siswa', $siswa->id)->first();
                if (!empty($siswakelas)) {
                    $siswakelas->update(['status'=> 'Diterima']);
                    Profil_siswa::find($siswa->id)->update(['status'=>'Diterima', 'diterima_kelas'=> $siswakelas->id_kelas]);
                }else{
                    return back()->with('gagal', 'Gagal melakukan konfirmasi kelas');
                }
            }
        }
        return back()->with('success', 'Berhasil memberitahukan siswa');
    }
    public function siswadaftar()
    {
        $ta = Tahun_ajaran::where('status', 'show')->first();
        $siswas = Profil_siswa::where('id_ta', $ta->id)->where('status', '!=', 'Verifikasi Admin')->get();
        return view('pengurus.siswabaru-daftar', compact('siswas', 'ta'));
    }
    public function verifikasisiswa($id)
    {
        $siswa = Profil_siswa::find($id)->update(['status' => 'Verifikasi Admin']);
        return back()->with('success', 'Berhasil Mengverifikasi Admin');
    }
}
