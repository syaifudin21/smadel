@extends('pengajar.pengajar-template')
@section('warna','blue')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/event.css')}}">
@endsection

@section('menu')
<div class="categories-wrapper light-blue darken-3" style="height: 48px">
  <div class="categories-container">
    <div class="container">
     <a href="{{url('pengajar')}}" class="breadcrumb">Home</a>
     <a href="{{url('pengajar/soal')}}" class="breadcrumb">Soal</a>
     <a href="{{url('pengajar/soal/list/'.$pelajaran->id)}}" class="breadcrumb">{{$pelajaran->kurikulum. ' - '. $pelajaran->jurusan. ' - '. $pelajaran->tingkat_kelas. ' - '. $pelajaran->mapel}}</a>
     <a href="#!" class="breadcrumb">Soal</a>
    </div>
  </div>
</div>
@endsection

@section('content')
<div id="portfolio" class="section white">
<div class="container">
  <div id="dasbord" class="col s12">

    {{$soal->soal}}

    <br>

    <a data-url="{{url('pengajar/soal/delete/'.$soal->id)}}" data-redirect="{{url('pengajar/soal/list/'.$pelajaran->id)}}" class="hapus btn red"><i class="material-icons">delete</i></a>

  </div>    
</div>
</div>

@endsection

@section('script')
<script type="text/javascript" src="{{asset('js/hapus.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    @if(Session::has('berhasil'))
      Materialize.toast('{{ Session::get('berhasil') }}', 4000);
    @endif
    $('ul.tabs').tabs();
  });
</script>
@endsection