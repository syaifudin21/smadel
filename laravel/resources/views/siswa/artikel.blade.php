@extends('siswa.template')
@section('warna','blue')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/event.css')}}">
@endsection

@section('menu')
<div class="categories-wrapper light-blue darken-3" style="height: 48px">
  <div class="categories-container">
    <div class="container">
     <a href="{{url('siswa')}}" class="breadcrumb">Home</a>
     <a href="#!" class="breadcrumb">Artikel</a>


    </div>

  </div>
  <a class="btn-floating btn-large halfway-fab waves-effect waves-light blue" href="{{url('siswa/artikel/tambah')}}"><i class="material-icons">add</i></a>
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
            if ($artikel->status_user == 'Pengurus') {
                $dd = App\Models\Pengurus::find($artikel->id_user);
                    $nama = (!empty($dd))? $dd->nama : 'NN';
            }elseif ($artikel->status_user == 'Guru') {
                $dd = App\Models\Pengajars::find($artikel->id_user);
                    $nama = (!empty($dd))? $dd->nama : 'NN';
            }elseif ($artikel->status_user == 'Siswa') {
                $dd = App\Models\Profil_siswa::find($artikel->id_user);
                    $nama = (!empty($dd))? $dd->nama_lengkap : 'NN';
            }else{
                $nama = 'NN';
            }
        ?>
        <div class="row">
          <div class="col s3">
            <img src="{{url('http://file.smawahasmodel.sch.id/artikel/'.$artikel->lampiran)}}" width="100%" style="margin: 6px auto;">
          </div>
          <div class="col s9">
            <h5>{{$artikel->judul}}</h5>
            <span>{{hari_tanggal_indo_waktu(date('Y-m-d-G-i-s', strtotime($artikel->updated_at)), true)}} - Author : {{$nama}}</span>
            <p>{{$artikel->text_pembuka}} <br> <a href="{{url('siswa/artikel/view/'.$artikel->slug_judul)}}">Lihat Selengkapnya</a> </p>
          </div>
        </div>
        @endforeach
        
        {{ $artikels->links() }}
      </div>
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