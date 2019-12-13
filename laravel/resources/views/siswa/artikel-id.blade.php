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
     <a href="{{url('siswa/artikel')}}" class="breadcrumb">Artikel</a>
     <a href="#!" class="breadcrumb">{{$artikel->judul}}</a>
    </div>
  </div>
  <a class="btn-floating btn-large halfway-fab waves-effect waves-light blue" href="{{url('siswa/artikel/update/id/'.$artikel->id)}}"><i class="material-icons">edit</i></a>
</div>
@endsection

@section('content')
<div id="portfolio" class="section white">
<div class="container">
  <div id="dasbord" class="col s12">
  <div class="row">
       <div class="col s12 m9">
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
            <center>
            <img src="{{url(env('FTP_BASE').'/artikel/'.$artikel->lampiran)}}" width="100%" style="margin: 6px auto;">
            <h5>{{$artikel->judul}} {!!($artikel->status == 'Tampil')? '<span class="chip blue white-text" data-badge-caption="">'.$artikel->status.'</span>': '<span class="chip red white-text" data-badge-caption="">'.$artikel->status.'</span>' !!}</h5> 
            <span>{{hari_tanggal_indo_waktu(date('Y-m-d-G-i-s', strtotime($artikel->updated_at)), true)}} - Author : {{$nama}}</span>
            </center>
            {!!$artikel->artikel!!}

      </div>
      <div class="col s12 m3">
        <table class="bordered highlight">
          @foreach($articles as $article)
          <tr><td>{{$article->judul}}</td></tr>
          @endforeach
        </table>
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
  });
</script>
@endsection