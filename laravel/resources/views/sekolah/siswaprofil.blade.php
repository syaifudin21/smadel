@extends('sekolah.template-sekolah')

@section('content')

<div class="nav-scroller bg-white box-shadow">
   <ul class="nav nav-underline" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" id="jadwal-tab" href="{{url('sekolah/kelas/'.$siswa->id_ta)}}" >Tahun Ajaran</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="jadwal-tab" href="{{url('sekolah/tahunajaran/id/'.$siswa->id_ta)}}" >Update Tahun Ajaran</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="jadwal-tab" href="{{url('sekolah/tahunajaran/siswadaftar/'.$siswa->id_ta)}}" >Siswa Daftar</a>
        </li>
    </ul>
</div>

<br><br>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
<h1 class="h2"> Profil Siswa</h1>
<div class="btn-toolbar mb-2 mb-md-0">
  <div class="btn-group mr-2">
    @if($siswa->status=='Verifikasi Siswa')
    <button class="btn btn-sm btn-outline-danger" onclick="window.location.href='{{url('sekolah/tahunajaran/siswadaftar/verifikasi/'.$siswa->id)}}'">Verifikasi Admin Sekarang</button>
    @endif
    <button class="btn btn-sm btn-outline-secondary">{{$siswa->status}}</button>
  </div>
</div>
</div>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white" style="padding: 0px">
    <li class="breadcrumb-item" aria-current="page"><a href="{{url('sekolah/kelas/'.$siswa->id_ta)}}">Tahun Ajaran</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{url('sekolah/tahunajaran/siswadaftar/'.$siswa->id_ta)}}">Siswa Daftar</a></li>
    <li class="breadcrumb-item active" aria-current="page">Profil Siswa</li>
  </ol>
</nav>

@if(Session::has('success'))
  <div class="alert alert-info alert-dismissable">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      {{ Session::get('success') }}
  </div>
@endif

<div class="table-responsive-sm">
  <table id="example" class="table table-hover table-sm" style="width:100%">
      <tr><th>Nama</th><td>{{$siswa->nama_lengkap}}</td></tr>
      <tr><th>Tempat Tanggal Lahir</th><td>{{$siswa->tgl}}</td></tr>
      <tr><th>Jenis Kelamin</th><td>{{$siswa->jk}}</td></tr>
      <tr><th>Nomor Induk Sekolah Nasional</th><td>{{$siswa->nisn}}</td></tr>
      <tr><th>Agama</th><td>{{$siswa->agama}}</td></tr>
      <tr><th>Alamat</th><td>{{$siswa->alamat}}</td></tr>
      <tr><th>Tinggal Bersama</th><td>{{$siswa->tinggal}}</td></tr>
      <tr><th>Transportasi ke Sekolah</th><td>{{$siswa->transportasi}}</td></tr>
      <tr><th>Nomor Hp Siswa</th><td>{{$siswa->nomor_hp}}</td></tr>
      <tr><th>Nama Ayah</th><td>{{$siswa->nama_ayah}}</td></tr>
      <tr><th>Tempat Tanggal Lahir Ayah</th><td>{{$siswa->tgl_ayah}}</td></tr>
      <tr><th>Pendidikan Terakhir Ayah</th><td>{{$siswa->pendidikan_ayah}}</td></tr>
      <tr><th>Pekerjaan Terakhir Ayah</th><td>{{$siswa->pekerjaan_ayah}}</td></tr>
      <tr><th>Penghasilan Ayah</th><td>{{$siswa->penghasilan_ayah}}</td></tr>
      <tr><th>Keterangan Ayah</th><td>{{$siswa->keterangan_ayah}}</td></tr>
      <tr><th>Nama Ibu</th><td>{{$siswa->nama_ibu}}</td></tr>
      <tr><th>Tempat Tanggal Lahir Ibu</th><td>{{$siswa->tgl_ibu}}</td></tr>
      <tr><th>Pendidikan Terakhir Ibu</th><td>{{$siswa->pendidikan_ibu}}</td></tr>
      <tr><th>Pekerjaan Terakhir Ibu</th><td>{{$siswa->pekerjaan_ibu}}</td></tr>
      <tr><th>Penghasilan Ibu</th><td>{{$siswa->penghasilan_ibu}}</td></tr>
      <tr><th>Ketarangan Ibu</th><td>{{$siswa->keterangan_ibu}}</td></tr>
      <tr><th>Alamat Orang Tua Sekarang</th><td>{{$siswa->alamat_ortu}}</td></tr>
      <tr><th>Nomor HP Orang Tua</th><td>{{$siswa->nomor_hp_ortu}}</td></tr>
      <tr><th>Tinggi Badan</th><td>{{$siswa->tinggi}}</td></tr>
      <tr><th>Berat Badan</th><td>{{$siswa->berat}}</td></tr>
      <tr><th>Jarak Tempu Kesekolah</th><td>{{$siswa->jarak_sekolah}}</td></tr>
      <tr><th>Waktu Tempu Kesekolah</th><td>{{$siswa->tempu_sekolah}}</td></tr>
      <tr><th>Anak Ke-</th><td>{{$siswa->anak_ke}}</td></tr>
      <tr><th>Jumlah Saudara</th><td>{{$siswa->jml_saudara}}</td></tr>
      <tr><th>Sekolah Asal</th><td>{{$siswa->sekolah_asal}}</td></tr>
      <tr><th>Alamat Sekolah Asal</th><td>{{$siswa->sekolah_alamat}}</td></tr>
      <tr><th>Lulus Sekolah Asal Tahun</th><td>{{$siswa->sekolah_angkatan}}</td></tr>
      <tr><th>Nilai Test Masuk</th><td>{{$siswa->nilai_test}}</td></tr>
      <tr><th>Minat Jurusan</th><td>
        <?php
         $pisah = explode(",",$siswa->minat_jurusan);
            for ($i=0; $i < count($pisah) ; $i++) { 
                $jurusan = App\Models\Jurusan::find($pisah[$i]);
                $print = (!empty($jurusan)) ? $jurusan->jurusan : 'Belum Memilih Jurusan' ;
                echo ' '. $print;
            }
         ?>
      </td></tr>
      <tr><th>Kelas Pertama</th><td>{{$siswa->diterima_kelas}}</td></tr>
      <tr><th>Nomor Induk</th><td>{{$siswa->no_induk}}</td></tr>
      <tr><th>Lampiran Foto</th>
        <td>@if(!empty($siswa->foto))<a href="{{url(env('FTP_BASE').'/siswa/'.$siswa->foto)}}">Lampiran Foto</a>@endif</td></tr>
      <tr><th>Lampiran Akte</th>
        <td>@if(!empty($siswa->akte))<a href="{{url(env('FTP_BASE').'/siswa/'.$siswa->akte)}}">Lampiran Akte</a>@endif</td></tr>
      <tr><th>Lampiran KPS</th>
        <td>@if(!empty($siswa->kps))<a href="{{url(env('FTP_BASE').'/siswa/'.$siswa->kps)}}">Lampiran Kps</a>@endif</td></tr>
      <tr><th>Lampiran Ijazah</th>
        <td>@if(!empty($siswa->ijazah))<a href="{{url(env('FTP_BASE').'/siswa/'.$siswa->ijazah)}}">Lampiran Ijazah</a>@endif</td></tr>
  </table>

</div>
@endsection

@section('script')
@endsection
