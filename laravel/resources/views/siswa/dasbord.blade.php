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
        <li class="tab col s3"><a href="#dasbord">Dasbord</a></li>
        <li class="tab col s3"><a href="#kelas">Kelas</a></li>
        <li class="tab col s3"><a href="#ekstra">Ekstrakurikuler</a></li>
        <li class="tab col s3"><a class="active" href="#pengumuman">Pengumuman</a></li>
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

      <div class="col s12 m8">
        @foreach($artikels as $artikel)
        <?php 
            if ($artikel->status_user == 'pengurus') {
                $dd = App\Models\Pengurus::find($artikel->id_user);
                    $nama = (!empty($dd))? $dd->nama : 'NN';
            }elseif ($artikel->status_user == 'guru') {
                $dd = App\Models\Pengajars::find($artikel->id_user);
                    $nama = (!empty($dd))? $dd->nama : 'NN';
            }elseif ($artikel->status_user == 'siswa') {
                $dd = App\Models\Siswas::find($artikel->id_user);
                    $nama = (!empty($dd))? $dd->nama : 'NN';
            }else{
                $nama = 'NN';
            }
        ?>
        <div class="row">
          <div class="col s3">
            <img src="{{env('FTP_BASE').'/artikel/'.$artikel->lampiran}}" width="100%" style="margin: 6px auto;">
          </div>
          <div class="col s9">
            <h5>{{$artikel->judul}}</h5>
            <span>{{hari_tanggal_indo_waktu(date('Y-m-d-G-i-s', strtotime($artikel->updated_at)), true)}} - Author : {{$nama}}</span>
            <p>{{$artikel->text_pembuka}} <a href="{{url('artikel/'.$artikel->id.'/'.$artikel->slug_judul)}}">Lihat Selengkapnya</a> </p>
          </div>
        </div>
        @endforeach
        
        {{ $artikels->links() }}
      </div>

      <div class="col s12 m4">
      <div class="row">
        <table class="bordered highlight">
          <tr><td><i class="material-icons small left">date_range</i><b>Matematika</b><br>Uji Kompetisi 2 hal.30</td></tr>
          <tr><td><i class="material-icons small left">date_range</i><b>Kimia</b><br>Uji Kompetisi 2 hal.30</td></tr>
          <tr><td><i class="material-icons small left">date_range</i><b>Kimia</b><br>Uji Kompetisi 2 hal.30</td></tr>
          <tr><td><i class="material-icons small left">date_range</i><b>Kimia</b><br>Uji Kompetisi 2 hal.30</td></tr>
          <tr><td><i class="material-icons small left">date_range</i><b>Kimia</b><br>Uji Kompetisi 2 hal.30</td></tr>
          <tr><td><i class="material-icons small left">date_range</i><b>Kimia</b><br>Uji Kompetisi 2 hal.30</td></tr>
        </table>
      </div>
      <div class="row">
        <div class="col s4">
          <div class="date">
            <span class="binds"></span>
            <span class="month">August</span>
            <h1 class="day">28</h1>
          </div>
        </div>
        <div class="col s8">
          <b>Penerimaan Siswa Baru</b><br>
          Lorem ipsum dolor sit amet,  
        </div>
      </div>
      <div class="row">
        <div class="col s4">
          <div class="date">
            <span class="binds"></span>
            <span class="month">August</span>
            <h1 class="day">08</h1>
          </div>
        </div>
        <div class="col s8">
          <b>Pener sitrimaan Siswa Baru</b><br>
          Lorem ipsum dolo amet,  
        </div>
      </div>
      <div class="row">
        <div class="col s4">
          <div class="date">
            <span class="binds"></span>
            <span class="month">Maret</span>
            <h1 class="day">30</h1>
          </div>
        </div>
        <div class="col s8">
          <b>Penerimaan Siswa Baru</b><br>
           proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 
        </div>
      </div>
      </div>
    </div>
  </div>

  <div id="kelas" class="col s12">
  <div class="row">
      <canvas id="densityChart" width="600" height="400"></canvas>
      <div class="col m8 s12">
      <table class="bordered striped highlight responsive-table">
        <thead>
          <tr>
              <th>#</th>
              <th>Matapelajaran</th>
              <th>Pengajar</th>
              <th>Nilai Akademik</th>
              <th>Nilai Praktik</th>
          </tr>
        </thead>
        <tbody>
          @foreach($mapels as $mapel)
          <tr>
            <td>1</td>
            <td>{{$mapel->mapel}}</td>
            <td>Nama Pengajar</td>
            <td>87 , 80, 70, 70</td>
            <td>87 , 80, 70, 70</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>

      <div class="col m4 s12">
        <table class="bordered highlight">
          <tr><td><i class="material-icons small left">date_range</i><b>Matematika</b><br>Uji Kompetisi 2 hal.30</td></tr>
          <tr><td><i class="material-icons small left">date_range</i><b>Kimia</b><br>Uji Kompetisi 2 hal.30</td></tr>
          <tr><td><i class="material-icons small left">date_range</i><b>Kimia</b><br>Uji Kompetisi 2 hal.30</td></tr>
          <tr><td><i class="material-icons small left">date_range</i><b>Kimia</b><br>Uji Kompetisi 2 hal.30</td></tr>
          <tr><td><i class="material-icons small left">date_range</i><b>Kimia</b><br>Uji Kompetisi 2 hal.30</td></tr>
          <tr><td><i class="material-icons small left">date_range</i><b>Kimia</b><br>Uji Kompetisi 2 hal.30</td></tr>
        </table>
      </div>
  </div>
  </div>

  <div id="ekstra" class="col s12">


    <div class="row">

      <div class="col s12 m8">

        <div class="row">
          <div class="col s12 m6">
            <div class="card blue-grey darken-1">
              <div class="card-content white-text">
                <span class="card-title">Struktur Organisasi</span>
                <p>I am a very simple card. I am good at containing small bits of information.
                I am convenient because I require little markup to use effectively.</p>
              </div>
              <div class="card-action">
                <a href="#" class="white-text">Lihat</a>
                <a href="#" class="white-text">Admin</a>
              </div>
            </div>
          </div>
          <div class="col s12 m6">
            <div class="card orange darken-1">
              <div class="card-content white-text">
                <span class="card-title">Program Kerja</span>
                <p>I am a very simple card. I am good at containing small bits of information.
                I am convenient because I require little markup to use effectively.</p>
              </div>
              <div class="card-action">
                <a href="#" class="white-text">Lihat</a>
                <a href="#" class="white-text">Admin</a>
              </div>
            </div>
          </div>
          <div class="col s12 m6">
            <div class="card brown lighten-1">
              <div class="card-content white-text">
                <span class="card-title">Catatan Peristiwa</span>
                <p>I am a very simple card. I am good at containing small bits of information.
                I am convenient because I require little markup to use effectively.</p>
              </div>
              <div class="card-action">
                <a href="#" class="white-text">Lihat</a>
                <a href="#" class="white-text">Admin</a>
              </div>
            </div>
          </div>
          <div class="col s12 m6 white-text">
            <div class="card cyan ">
              <div class="card-content">
                <span class="card-title">Catatan Ekspedisi</span>
                <p>I am a very simple card. I am good at containing small bits of information.
                I am convenient because I require little markup to use effectively.</p>
              </div>
              <div class="card-action">
                <a href="#" class="white-text">Lihat</a>
                <a href="#" class="white-text">Admin</a>
              </div>
            </div>
          </div>
        </div>


      </div>

      <div class="col s12 m4">
      <div class="row">
        <div class="col s4">
          <div class="date">
            <span class="binds"></span>
            <span class="month">August</span>
            <h1 class="day">28</h1>
          </div>
        </div>
        <div class="col s8">
          <b>Penerimaan Siswa Baru</b><br>
          Lorem ipsum dolor sit amet,  
        </div>
      </div>
      <div class="row">
        <div class="col s4">
          <div class="date">
            <span class="binds"></span>
            <span class="month">August</span>
            <h1 class="day">08</h1>
          </div>
        </div>
        <div class="col s8">
          <b>Pener sitrimaan Siswa Baru</b><br>
          Lorem ipsum dolo amet,  
        </div>
      </div>
      <div class="row">
        <div class="col s4">
          <div class="date">
            <span class="binds"></span>
            <span class="month">Maret</span>
            <h1 class="day">30</h1>
          </div>
        </div>
        <div class="col s8">
          <b>Penerimaan Siswa Baru</b><br>
           proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
<script type="text/javascript">
  var densityCanvas = document.getElementById("densityChart");

  Chart.defaults.global.defaultFontSize = 12;

  var densityData = {
    label: 'Perkembangan Nilai',
    data: [40, 50, 70, 55, 65, 45, 70, 80, 60, 95, 50, 60, 70, 90, 60, 50]
  };

  var barChart = new Chart(densityCanvas, {
    type: 'bar',
    data: {
      labels: ["Matematika", "Fisika", "Kimia", "Bhs. Indonesia", "Geografi", "Al-Quran", "Aqidah Akhlaq", "Fiqih", "SKI", "Bhs. Inggris", "Biologi", "Sejarah", "Ekonomi", "PenjasOrkes", "Aswaja", "Bhs. Arab"],
      datasets: [densityData]
    }
  });

  $(document).ready(function() {
    @if(Session::has('berhasil'))
      Materialize.toast('{{ Session::get('berhasil') }}', 4000);
    @endif
    $('ul.tabs').tabs();
  });
</script>
@endsection