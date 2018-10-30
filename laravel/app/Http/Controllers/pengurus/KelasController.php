<?php

namespace App\Http\Controllers\pengurus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Tahun_ajaran;
use App\Models\Pengajar;
use App\Models\Profil_pengajar;
use App\Models\Kelas_mapel;
use App\Models\Mapel;
use App\Models\Kurikulum;
use App\Models\Kelas_siswa;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pengurus');
    }
    public function index()
    {
        $ta = Tahun_ajaran::where('status', 'Show')->first();
        $kelass = Kelas::where('id_ta',$ta->id)->get();
        return view('pengurus.kelas-all', compact('kelass','ta'));
    }
    public function kelasid($id)
    {
    	$kelas = Kelas::where('kelas.id',$id)
                    ->join('kurikulums', 'kelas.id_ta', '=', 'kurikulums.id')
                    ->join('jurusans', 'kelas.id_jurusan', '=', 'jurusans.id')
                    ->join('tingkat_kelas', 'kelas.id_tingkatan_kelas', '=', 'tingkat_kelas.id')
                    ->join('tahun_ajarans', 'kelas.id_ta', '=', 'tahun_ajarans.id')
                    ->select('kelas.*', 'jurusans.jurusan', 'tingkat_kelas.tingkat_kelas', 'kurikulums.kurikulum', 'tahun_ajarans.tahun_ajaran')
                    ->first();
        $mapels = Mapel::where('id_tingkat_kelas', $kelas->id_tingkatan_kelas)->get();
    	return view('pengurus.kelas', compact('ta', 'kelas', 'mapels'));
    }

    public function siswakelas($id)
    {
        $kelas = Kelas::find($id);

        $siswakelass = Kelas_siswa::where('id_kelas', $id)
                    ->join('profil_siswas', 'kelas_siswas.id_siswa', '=', 'profil_siswas.id')
                    ->select('profil_siswas.nama_lengkap', 'profil_siswas.alamat', 'profil_siswas.nisn')
                    ->get();
        return view('pengurus.kelas-siswa', compact('kelas','siswakelass'));
    }
    public function lihat($id)
    {
        $kelasid = Kelas::where('kelas.id', $id)
                    ->Join('pengajars','kelas.id_guru', '=', 'pengajars.id')
                    ->Join('tahun_ajarans','kelas.id_ta', '=', 'tahun_ajarans.id')
                    ->first();
        $kelasmapel = Kelas_mapel::where('kelas_mapels.id_kelas', $id)
                    ->Join('mapels','kelas_mapels.id_mapel', '=', 'mapels.id')
                    ->select('kelas_mapels.*', 'mapels.mapel')
                    ->get();
        $ta = Tahun_ajaran::all();
        $kelas = Kelas::all();
        $mapels = Mapel::all();
        $guru =  Pengajar::all();
    return view('pengurus.kelas_detail', compact('kelasid', 'id', 'kelasmapel', 'mapels','tahun_ajarans', 'guru', 'kelas', 'ta'));
    }
    // public function update(Request $req)
    // {
    //     Kelas::where('id', $req->id_kelas)
    //     ->update([
    //         'id_ta' => $req->id_ta,
    //         'nama_kelas' => $req->nama_kelas,
    //         'id_guru' => $req->id_guru
    //     ]);
    //     return redirect('/pengurus/kelas/lihat/'. $req->id_kelas)->with('success','Kelas '. $req->nama_kelas. ' Berhasil diupdate');
    // }
    public function delete($id)
    {
        Kelas::where('id', $id)->delete();
        return back()->with('success',' Kelas Berhasil Dihapus');
    }
    public function mapel($id)
    {
        $mapel =  Mapel::all();
        $kelasid = Kelas::where('id', $id)->first();
        $kelasmapel = Kelas_mapel::where('kelas_mapels.id_kelas', $id)
                    ->Join('mapels','kelas_mapels.id_mapel', '=', 'mapels.id')
                    ->select('kelas_mapels.*', 'mapels.mapel')
                    ->get();
        $guru =  Pengajar::all();
        return view('pengurus.kelasmapel', compact('mapel', 'id', 'kelasid', 'kelasmapel', 'guru'));
    }
    public function mapeltambah(Request $req)
    {
        $this->validate($req, [
            'mapel_kelas' => 'required',
            'jam' => 'required',
        ]);

        $mapelkelas = Kelas_mapel::where(['id_kelas'=> $req->id_kelas, 'id_mapel'=>$req->mapel_kelas])->first();
        if ($mapelkelas != null) {
            return back()->with('gagal',' Mata Pelajaran Ada Kesamaan Didalam Kelas');
        }elseif ($mapelkelas == null) {
            Kelas_mapel::create([
                'id_kelas' => $req->id_kelas,
                'jam' => $req->jam,
                'id_guru' => $req->id_guru,
                'id_mapel' => $req->mapel_kelas,
            ]);
            return back()->with('success',' Mata Pelajaran Berhasil Ditambahakan Didalam Kelas');
        }else{
            return back()->with('gagal',' Data Gagal Diproses');
        }
    }
    public function mapelupdate(Request $req)
    {
        $mapel = Kelas_mapel::find($req->id)->first();
        Kelas_mapel::findOrFail($req->id)->
        update([
            'jam' => $req->jam,
            'id_guru' => $req->id_guru,
        ]);
        return back()->with('success',' Mata Pelajaran Berhasil Diupdate Didalam Kelas');
            
    }
    public function mapeldelete($id)
    {
        Kelas_mapel::where('id', $id)->delete();
        return back()->with('success','Mata Pelajaran Dalam Kelas Berhasil Dihapus');
    }
    public function datamapel($id){
        if($id==0){
            $mapel = Kelas_mapel::all();
        }else{
            $mapel = Kelas_mapel::where('id_kelas','=',$id)
                    ->Join('mapels','kelas_mapels.id_mapel', '=', 'mapels.id')
                    ->select('kelas_mapels.*', 'mapels.mapel')
                    ->get();
        }
        return $mapel;
    }
    public function datata($id)
    {
        $ta = Kelas::where('id_ta','=',$id)->get();
        return $ta;
    }
    public function mapelload(Request $req)
    {
        $kelasmapel = Kelas_mapel::where('id_kelas', $req->id_kelas)->get();
        if ($req->action == 'Tambah dan Load Data') {
            foreach ($kelasmapel as $km) {
                $klsmapel = Kelas_mapel::where(['id_kelas'=> $req->kelas,'id_mapel'=> $km->id_mapel])->first();
                if ($klsmapel == null ) {
                    Kelas_mapel::create([
                        'id_kelas' => $req->kelas,
                        'jam' => $km->jam,
                        'id_mapel' => $km->id_mapel,
                    ]);
                }
            }
            return back()->with('success','Mata Pelajaran Dalam Kelas Berhasil Diload dari Kelas Lain');
        } elseif ($req->action == 'Hapus dan Load Data') {
            $klsmapel = Kelas_mapel::where(['id_kelas'=> $req->kelas])->delete();
            foreach ($kelasmapel as $km) {
                if ($klsmapel == null ) {
                    Kelas_mapel::create([
                        'id_kelas' => $req->kelas,
                        'jam' => $km->jam,
                        'id_mapel' => $km->id_mapel,
                    ]);
                }
            }
            return back()->with('success','Mata Pelajaran Dalam Kelas Berhasil Dihapus Dan Disamakan');
        } else {
            dd('sepertinya anda akan menghapus semua');
        }
    }
}
