<?php

namespace App\Http\Controllers\siswa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Profil_siswa;
use App\Models\Pengumuman;
use App\Models\Siswa;
use App\Models\Bantuan;
use App\Models\Forum;
use App\Models\ForumChat;
use App\Models\PrestasiSiswa;
use App\Models\Kelas;
use App\Models\Artikel;
use App\Models\Tahun_ajaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Kelas_siswa;
use App\Models\Mapel;
use Alert;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:siswa');
    }

    public function index()
    {
    	$siswa = Profil_siswa::where('nisn',Auth::user('siswa')->nisn)->first();
    	if ($siswa->status != 'Diterima') {
    		return redirect('siswa/daftar');
    	}
        $siswakelas = Kelas_siswa::where(['id_siswa'=> $siswa->id, 'kelas_siswas.status' => 'Diterima'])->first();
        
        $kelas = Kelas::where('kelas.id',$siswakelas->id_kelas)
                    ->join('kurikulums', 'kelas.id_ta', '=', 'kurikulums.id')
                    ->join('jurusans', 'kelas.id_jurusan', '=', 'jurusans.id')
                    ->join('tingkat_kelas', 'kelas.id_tingkatan_kelas', '=', 'tingkat_kelas.id')
                    ->join('tahun_ajarans', 'kelas.id_ta', '=', 'tahun_ajarans.id')
                    ->select('kelas.*', 'jurusans.jurusan', 'tingkat_kelas.tingkat_kelas', 'kurikulums.kurikulum', 'tahun_ajarans.tahun_ajaran')
                    ->first();
        $mapels = Mapel::join('tingkat_kelas', 'mapels.id_tingkat_kelas','=', 'tingkat_kelas.id')
                    ->join('jurusans', 'tingkat_kelas.id_jurusan', '=', 'jurusans.id')
                    ->join('kurikulums', 'jurusans.id_kurikulum', '=', 'kurikulums.id')
                    ->join('jenis_mapels', 'mapels.id_jenis_mapel', '=', 'jenis_mapels.id')
                    ->where(['mapels.id_tingkat_kelas'=> $kelas->id_tingkatan_kelas])
                    ->select('mapels.mapel', 'mapels.deskripsi','jurusans.jurusan', 'kurikulums.kurikulum', 'jenis_mapels.jenis_mapel', 'tingkat_kelas.status as status_tingkatan')
                    ->get();
        $artikels = Artikel::where(['status_user' => 'Siswa' ,'id_user'=> $siswa->id])->paginate(10);
        $pengumumans = Pengumuman::where('objek', 'Siswa')->get();

        return view('siswa.home', compact('pengumumans','siswa','siswakelas', 'kelas', 'mapels', 'artikels'));
    }
    public function baru()
    {
    	$siswa = Profil_siswa::where('nisn',Auth::user('siswa')->nisn)->first();
    	if ($siswa->status == 'Diterima') {
            return redirect('siswa');
        }
        $pengumumans = Pengumuman::where('objek', 'Siswa Baru')->get();
        $prestasis = PrestasiSiswa::where('id_profil_siswa', $siswa->id)->get();
        $ta = Tahun_ajaran::where('status', 'Show')->first();
        $jurusans = Kelas::where('id_ta', $ta->id)
                ->select('kelas.id_jurusan')
                ->groupBy('id_jurusan')
                ->join('tingkat_kelas', function ($join) {
                    $join->on('kelas.id_tingkatan_kelas', '=', 'tingkat_kelas.id')
                         ->where('tingkat_kelas.status', '=', 'Pertama');
                    })
                ->get();
        // dd($jurusans);
        return view('siswa.baru', compact('siswa', 'pengumumans', 'prestasis', 'jurusans','ta'));
    }
    public function daftar()
    {
        $siswa = Profil_siswa::where('nisn',Auth::user('siswa')->nisn)->first();
        
        $pengumumans = Pengumuman::where('objek', 'Siswa Baru')->get();
        $prestasis = PrestasiSiswa::where('id_profil_siswa', $siswa->id)->get();
        $ta = Tahun_ajaran::where('status', 'Show')->first();
        $jurusans = Kelas::where('id_ta', $ta->id)
                ->select('kelas.id_jurusan')
                ->groupBy('id_jurusan')
                ->join('tingkat_kelas', function ($join) {
                    $join->on('kelas.id_tingkatan_kelas', '=', 'tingkat_kelas.id')
                         ->where('tingkat_kelas.status', '=', 'Pertama');
                    })
                ->get();
        // dd($jurusans);
        return view('siswa.siswa-daftar', compact('siswa', 'pengumumans', 'prestasis', 'jurusans','ta'));
    }
    public function verifikasisiswa($nisn)
    {
        $siswa = Profil_siswa::where('nisn',Auth::user('siswa')->nisn)->first();
        if ($siswa->nisn == $nisn) {
            $siswa['status'] = 'Verifikasi Siswa';
            $siswa->update();
            return back()->with('suwccess', 'Anda telah berhasil mengkonfirmasi data anda silahkan melakukan proses selanjunya');
        }else{
            return back()->with('gagal', 'Ada Kesalahan Sistem yang terjadi silahkan laporkan pada sekertariat tentang BUG ini');
        }
    }
    public function profil()
    {
        $siswa = Profil_siswa::where('nisn', Auth::user('siswa')->nisn)->first();
        return view('siswa.profil', compact('siswa'));
    }
    public function akun()
    {
        return view('siswa.akun');
    }
    public function akunupdate(Request $request)
    {
        $user = Siswa::find(Auth::user('siswa')->id);
        // dd(Auth::user('siswa')->password);
        if (Hash::check($request->passwordlama,  $user->password)){
            if ($request->passwordbaru == $request->cpasswordbaru){
                $passwordbaru = Hash::make($request->passwordbaru);
                $user->update(['password' => $passwordbaru]);
                return back()->with('success','Password berhasil diupdate');
            }else{
                return back()->with('gagal', 'Konfirmasi password baru tidak sesuai.');
            }
        }else{
            return back()->with('gagal', 'Password lama tidak sesuai');
        }
    }
    public function profilupdate(Request $request)
    {
        $siswa = Profil_siswa::where('nisn', Auth::user('siswa')->nisn)->first();
        $siswad = Profil_siswa::where('nisn', Auth::user('siswa')->nisn)->first();
        $siswa->fill($request->all());
        if ($request->hasFile('foto')){
            $filenamewithextension = $request->file('foto')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $filenametostorefoto = $filename.'_'.uniqid().'.'.$extension;
            Storage::disk('ftp-siswa')->put($filenametostorefoto, fopen($request->file('foto'), 'r+'));
            Storage::disk('ftp-siswa')->delete($siswad->foto);
            $siswa['foto'] = $filenametostorefoto;
        }
        if ($request->hasFile('ijazah')){
            $filenamewithextension = $request->file('ijazah')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('ijazah')->getClientOriginalExtension();
            $filenametostorefoto = $filename.'_'.uniqid().'.'.$extension;
            Storage::disk('ftp-siswa')->put($filenametostorefoto, fopen($request->file('ijazah'), 'r+'));
            Storage::disk('ftp-siswa')->delete($siswad->ijazah);
            $siswa['ijazah'] = $filenametostorefoto; }
        $siswa->update();

        return back()->with('success','Penambahan Tahun Ajaran Berhasil');
    }
    public function bantuan()
    {
        $bantuans = Bantuan::where('status', 'Show')->get();
        return view('siswa.bantuan', compact('bantuans'));        
    }
    public function bantuanid($id)
    {
        $bantuan = Bantuan::find($id);
        return view('siswa.bantuan-id', compact('bantuan'));
    }
    public function forummenu()
    {
        $forums = Forum::where('menu', 'Siswa Baru')->get();
        return view('siswa.forum', compact('forums'));
    }
    public function forumid($id)
    {
        $forum = Forum::find($id);
        $chats = ForumChat::where('id_forum', $id)->whereNull('id_chat')->get();
        return view('siswa.forum-id', compact('forum', 'chats'));
    }
    public function chatstore(Request $request)
    {
        $chat = new ForumChat();
        $chat['id_forum'] = $request->id_forum;
        $chat['id_siswa'] = Auth::user('siswa')->nisn;
        $chat['id_chat'] = $request->id_chat;
        $chat['chat'] = $request->chat;
        $chat->save();

        return back()->with('success', 'Berhasil menambahkan chat');

    }
    public function prestasistore(Request $request)
    {
        $prestasi = new PrestasiSiswa();
        $prestasi->fill($request->all());
         if ($request->hasFile('lampiran')){
            $filenamewithextension = $request->file('lampiran')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('lampiran')->getClientOriginalExtension();
            $filenametostorefoto = $filename.'_'.uniqid().'.'.$extension;
            Storage::disk('ftp-prestasi')->put($filenametostorefoto, fopen($request->file('lampiran'), 'r+'));
            $prestasi['lampiran'] = $filenametostorefoto;
        }
        $prestasi->save();
        Alert::success('Prestasi sudah disimpan', 'Berhasil');
        return back();
    }
    public function prestasiupdate(Request $request)
    {
        $prestasi = PrestasiSiswa::find($request->id);
        $prestasid = PrestasiSiswa::find($request->id);
        $prestasi->fill($request->all());
        if ($request->hasFile('lampiran')){
            $filenamewithextension = $request->file('lampiran')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('lampiran')->getClientOriginalExtension();
            $filenametostorefoto = $filename.'_'.uniqid().'.'.$extension;
            Storage::disk('ftp-prestasi')->put($filenametostorefoto, fopen($request->file('lampiran'), 'r+'));
            Storage::disk('ftp-prestasi')->delete($prestasid->lampiran);
            $prestasi['lampiran'] = $filenametostorefoto;
        }
        $prestasi->update();
        return back()->with('success', 'Berhasil mengupdate Prestasi Anda');
    }
    public function prestasidelete($id)
    {
        $prestasi = PrestasiSiswa::find($id);
        if (!empty($prestasi->lampiran)) {
            Storage::disk('ftp-standar')->delete($prestasi->lampiran);
        }
        $prestasi->delete();
        Alert::success('Berhasil Hapus Prestasi', 'Berhasil');
        return back()->with('success', 'Berhasil Hapus Prestasi Anda');
    }
    public function prestasikonfirmasi($id)
    {
        // dd($id_profil);
        $prestasis = PrestasiSiswa::find($id)->update(['status'=>'Konfirmasi']);
        return back()->with('success', 'Berhasil Mengkonfirmasi Prestasi');
    }
    public function jurusankonfirmasi(Request $request)
    {
        $siswa = Profil_siswa::where('nisn', Auth::user('siswa')->nisn)->first();
        $siswa['minat_jurusan'] = (!empty($request->jurusan))?implode(',', $request['jurusan']):'';
        $siswa->update();
        Alert::success('Pemilihan jurusan telah disimpan', 'Berhasil');
        return back();
    }
}
