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
     <a href="{{url('pengajar/materi')}}" class="breadcrumb">Materi</a>
     <a href="{{url('pengajar/materi/list/'.$pelajaran->id)}}" class="breadcrumb">{{$pelajaran->kurikulum. ' - '. $pelajaran->jurusan. ' - '. $pelajaran->tingkat_kelas. ' - '. $pelajaran->mapel}}</a>
     <a href="#!" class="breadcrumb">{{$materi->topik}}</a>
    </div>

  </div>
</div>
@endsection

@section('content')
<div id="portfolio" class="section white">
<div class="container">
  <div id="dasbord" class="col s12">
    <center>
      <h4>{{$materi->topik}}</h4>
      @if(!empty($materi->file)) <a href="{{url('')}}">{{$materi->topik.'_'.$materi->file}}</a>@endif
      <a href="{{url('pengajar/materi/update/idbab/'.$materi->id_bab.'/'.$pelajaran->id)}}">Update</a>
    </center>
    
    <br>
    {!!$materi->materi!!}
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