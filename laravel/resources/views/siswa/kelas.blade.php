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
     <a href="#!" class="breadcrumb">Kelas</a>
    </div>
  </div>
  {{-- <a class="btn-floating btn-large halfway-fab waves-effect waves-light blue" href="{{url('siswa/artikel/tambah')}}"><i class="material-icons">add</i></a> --}}
</div>
@endsection

@section('content')
<div id="portfolio" class="section white">
<div class="container">
  <div id="dasbord" class="col s12">
  <div class="row">

    <div class="col m8 s12">
      <ul class="collapsible popout" data-collapsible="accordion">
        @foreach($siswakelass as $siswakelas)
        <li>
          <div class="collapsible-header {{($tahunajaran->tahun_ajaran == $siswakelas->tahun_ajaran)? 'active': ''}}"><i class="material-icons">filter_drama</i>
            {{$siswakelas->tingkat_kelas}} - {{$siswakelas->kelas}}
          </div>
          <div class="collapsible-body">
            <div class="row">
              <div class="col s9">{{$siswakelas->deskripsi}}<br>
               {{--  Tanggal Buka {{$siswakelas->tgl_buka}} <br>
                Tanggal Tutup {{$siswakelas->tgl_tutup}} <br>
                Tanggal Arsip {{$siswakelas->tgl_arsip}} --}}
              </div>
              <div class="col s3">
                  <a href="{{url('siswa/kelas/id/'.$siswakelas->id_kelas)}}" class="btn blue btn-large">Masuk</a>
              </div>
            </div>
          </div>
        </li>
        @endforeach
      </ul>
    </div>
    <div class="col m4 s12"></div>
      
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
    $('.collapsible').collapsible();
  });
</script>
@endsection