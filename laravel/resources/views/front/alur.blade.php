@extends('front.template')

@section('title')
<div class="nav-header hide-on-small-only">
  <h1 class="text-shadow">Selamat Datang </h1>
  <div class="tagline text-shadow">Mengutamakan <span class="element"></span> </div>
</div>
@endsection

@section('background', asset('images/standar/banner1.jpg'))

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/event.css')}}">
@endsection

@section('menu')
<div class="categories-wrapper blue darken-3">
  <div class="categories-container">
    <ul class="container categories">
      <li><a href="{{url('daftar')}}">Form Pendaftaran Siswa Baru </a></li>
      <li class="active"><a href="{{url('alur-pendaftaran-online')}}">Alur Pendaftaran Online</a></li>
      <li><a href="{{url('brosur')}}">Brosur</a></li>
      <li><a href="{{url('tatatertib')}}">Tata Tertib Sekolah</a></li>
      <li><a href="{{url('hasil-seleksi')}}">Hasil Seleksi</a></li>
    </ul>
  </div>
</div>
@endsection

@section('content')
<div id="portfolio" class="section gray">
  <div class="container">
    <center>
      <h4>Alur Pendaftaran Online</h4>
      <img class="materialboxed" width="650" src="{{asset('images/standar/alur.png')}}">
    </center>
    <br><br>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('js/typed.min.js')}}"></script>
<script type="text/javascript">
   document.addEventListener("DOMContentLoaded", function() {
          new Typed('.element', {
          cursorChar: '|',
          strings: ["Menciptakan Dunia dalam Genggaman.", "Membantu dan Menghubungkan Guru dan Siswa", "Memudahkan Pengawasan Perkembangan Siswa"],
          startDelay: 1000,
          showCursor: true,
          autoInsertCss: true,
          backDelay: 2000,
          typeSpeed: 100,
          backSpeed: 20,
          // smartBackspace: false, // this is a default
          loop: true
        });
    });
</script>
@endsection
