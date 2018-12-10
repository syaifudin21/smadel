@extends('siswa.template')
@section('warna','blue')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/event.css')}}">
@endsection

@section('menu')
<div class="categories-wrapper light-blue darken-3" style="height: 48px">
  <div class="categories-container">
    <div class="container">
     <ul class="tabs">
        <li class="tab col s3"><a class="active" href="#dasbord">Dasbord</a></li>
        <li class="tab col s3"><a href="#pengumuman">Pengumuman</a></li>
      </ul>
    </div>
  </div>
</div>
@endsection

@section('content')
<div id="portfolio" class="section white">
<div class="container">

  <div id="dasbord" class="col s12">
  <div class="row">
          <div class="col s12 m6 l4">
            <div class="card blue darken-1">
              <div class="card-content white-text">
                <span class="card-title"><b>Rekap Absen</b></span>
                <p>Anda dapat melihat rekap absensi sesuai dengan user anda</p>
              </div>
              <div class="card-action">
                <a href="{{url('siswa/absen')}}" class="white-text">Lihat</a>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l4">
            <div class="card orange darken-1">
              <div class="card-content white-text">
               <span class="card-title"><b>Kelas</b></span>
                <p>Berisikan aktifitas kelas, nilai dan pengumuman kelas ada disini</p>
              </div>
              <div class="card-action">
                <a href="{{url('siswa/kelas')}}" class="white-text">Lihat</a>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l4">
            <div class="card brown lighten-1">
              <div class="card-content white-text">
                <span class="card-title"><b>Organisasi</b></span>
                <p>Kegiatan Ekstrakurikuler dengan informasi yang berkaitan</p>
              </div>
              <div class="card-action">
                <a href="#" class="white-text">Fitur ini belum tersedia</a>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l4 white-text">
            <div class="card cyan ">
              <div class="card-content">
                <span class="card-title"><b>Administrasi</b></span>
                <p>Perihal tentang administrasi serta status pembayaran</p>
              </div>
              <div class="card-action">
                <a href="#" class="white-text">Fitur ini belum tersedia</a>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l4 white-text">
            <div class="card red darken-1">
              <div class="card-content">
                <span class="card-title"><b>Kasus</b></span>
                <p>Catatan penting tentang anda tercatat disini.</p>
              </div>
              <div class="card-action">
                <a href="#" class="white-text">Fitur ini belum tersedia</a>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l4 white-text">
            <div class="card green darken-3">
              <div class="card-content">
                <span class="card-title"><b>Prestasi</b></span>
                <p>Prestasi yang anda dapatkan dapat dilihat disini</p>
              </div>
              <div class="card-action">
                <a href="{{url('siswa/prestasi')}}" class="white-text">Lihat</a>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l4 white-text">
            <div class="card green lighten-1">
              <div class="card-content">
                <span class="card-title"><b>Artikel</b></span>
                <p>Anda dapat menuangkan ide gagasan dalam bentuk artikel</p>
              </div>
              <div class="card-action">
                <a href="{{url('siswa/artikel')}}" class="white-text">Coba Sekarang</a>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l4 white-text">
            <div class="card blue lighten-2">
              <div class="card-content">
                <span class="card-title"><b>Log Aktifitas</b></span>
                <p>Log aktifitas yang berkaiatan dengan ID anda</p>
              </div>
              <div class="card-action">
                <a href="#" class="white-text">Fitur ini belum tersedia</a>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l4 white-text">
            <div class="card purple lighten-2">
              <div class="card-content">
                <span class="card-title"><b>Perpustakaan</b></span>
                <p>Ketersediaan buku dapat anda lihat disini </p>
              </div>
              <div class="card-action">
                <a href="#" class="white-text">Fitur ini belum tersedia</a>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l4 white-text">
            <div class="card orange darken-4">
              <div class="card-content">
                <span class="card-title"><b>Pengaduan</b></span>
                <p>Hal yang berkaitan masukan atau kritik dapat dikirimkan disini</p>
              </div>
              <div class="card-action">
                <a href="#" class="white-text">Fitur ini belum tersedia</a>
              </div>
            </div>
          </div>
        </div>    
  </div>

  <div id="pengumuman" class="col s12">

    <div class="row">
         <table class="bordered highlight">
           @foreach($pengumumans as $pengumuman)
                <tr>
                    <?php 
                        if ($pengumuman->status_user == 'Pengurus') {
                            $dd = App\Models\Pengurus::find($pengumuman->id_user);
                                $nama = (!empty($dd))? $dd->nama : 'NN';
                        }elseif ($pengumuman->status_user == 'Guru') {
                            $dd = App\Models\Pengajars::find($pengumuman->id_user);
                                $nama = (!empty($dd))? $dd->nama : 'NN';
                        }elseif ($pengumuman->status_user == 'Siswa') {
                            $dd = App\Models\Siswas::find($pengumuman->id_user);
                                $nama = (!empty($dd))? $dd->nama : 'NN';
                        }else{
                            $nama = 'NN';
                        }
                    ?>
            <td>
              <h5>{{$pengumuman->nama_pengumuman}}</h5>
               <span><i class="material-icons left">date_range</i>{{hari_tanggal_indo_waktu(date('Y-m-d-G-i-s', strtotime($pengumuman->updated_at)), true)}} | {{$pengumuman->status_user}} - {{$nama}}</span>
              <p>{{$pengumuman->isi}}</a>
            </td>
          </tr>
          @endforeach
        </table>
      </div>

  </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    @if(Session::has('berhasil'))
      Materialize.toast('{{ Session::get('berhasil') }}', 4000);
    @endif
    $('ul.tabs').tabs();
  });
</script>
@endsection