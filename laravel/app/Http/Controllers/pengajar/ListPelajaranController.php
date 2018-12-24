<?php

namespace App\Http\Controllers\pengajar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ListPelajaran;
use App\Models\Kurikulum;

class ListPelajaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pengajar');
    }

    public function index()
    {
    	$pelajarans = ListPelajaran::where('id_guru', Auth::user('pengajar')->id)
                        ->join('kurikulums', 'list_pelajarans.id_kurikulum', 'kurikulums.id')
                        ->join('jurusans', 'list_pelajarans.id_jurusan', 'jurusans.id')
                        ->join('tingkat_kelas', 'list_pelajarans.id_tk', 'tingkat_kelas.id')
                        ->join('mapels', 'list_pelajarans.id_mapel', 'mapels.id')
                        ->select('mapel', 'kurikulum', 'tingkat_kelas','jurusan', 'list_pelajarans.id')
                        ->paginate(10);
        $kurikulums = Kurikulum::all();

        return view('pengajar.list-pelajaran', compact('pelajarans', 'kurikulums'));
    }
    public function pelajaranid($id)
    {
        $pelajaran = ListPelajaran::where('list_pelajarans.id', $id)
                    ->join('kurikulums', 'list_pelajarans.id_kurikulum', 'kurikulums.id')
                    ->join('jurusans', 'list_pelajarans.id_jurusan', 'jurusans.id')
                    ->join('tingkat_kelas', 'list_pelajarans.id_tk', 'tingkat_kelas.id')
                    ->join('mapels', 'list_pelajarans.id_mapel', 'mapels.id')
                    ->select('mapel', 'kurikulum', 'tingkat_kelas','jurusan', 'list_pelajarans.*')
                    ->first();
        $kurikulums = Kurikulum::all();
        return view('pengajar.pelajaran-id', compact('pelajaran', 'kurikulums'));
    }
    public function store(Request $request)
    {
        $pelajaran = new ListPelajaran();
        $pelajaran['id_guru'] = Auth::user('pengajar')->id;
        $pelajaran->fill($request->all());
        $pelajaran->save();
        return back()->with('success', 'Berhasil menambahkan Bab Mapel');
    }
    
    public function update(Request $request)
    {
        $pelajaran = ListPelajaran::find($request->id);
        $pelajaran->fill($request->all());
        $pelajaran->update();

        return back()->with('success','Berhasil Update Bab Mapel');
    }
    public function delete($id)
    {
        $hapus = ListPelajaran::find($id);

        if ($hapus) {
            $hapus->delete();
            return response()->json([
                'message' => 'Berhasil Hapus',
                'kode' => '00'
            ]);
        }else{
            return response()->json([
                'message' => 'Gagal Hapus',
                'kode' => '01'
            ]);
        }
        
    }
    public function coba()
    {
        return response()->json([
            'data' => 'Berhasil'
        ]);
    }
}
