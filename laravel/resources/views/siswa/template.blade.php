<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Lato Font -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

    <!-- Stylesheet -->
    <link href="{{asset('materialize/css/gallery-materialize.min.css')}}" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    
    @yield('css')

  </head>

  <body>

    <!-- Navbar and Header -->
    <nav class="nav-extended @yield('warna')">
      <div class="nav-background">
        <div class="pattern active" style="background-image: url('{{asset('images/standar/1400x300.png')}}');"></div>
      </div>
      <div class="nav-wrapper container">
        <a href="{{url('siswa')}}" class="brand-logo"><i class="material-icons">camera</i>{{ config('app.name', 'Laravel') }}</a>
        <ul class="right">
          {{-- <li><a class='dropdown-button' href='#' data-activates='feature-notif' data-belowOrigin="true" data-constrainWidth="false"><i class="material-icons">notifications_none</i></a></li> --}}
        </ul>
        

        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
          <?php $sis = App\Models\Profil_siswa::where('nisn', Auth::user('siswa')->nisn)->select('nama_lengkap', 'status')->first();?>
          <li class="active"><a href="{{url('/siswa')}}">{{$sis->nama_lengkap}}</a></li>
          
          <li><a href="{{($sis->status=='Diterima')? url('siswa/forum') : url('siswa/forum/menu/siswabaru')}}"><i class="material-icons">forum</i></a></li>
          <li><a  class='dropdown-button' href='#' data-activates='feature-pengaturan' data-belowOrigin="true" data-constrainWidth="false"><i class="material-icons">settings</i></a></li>
        </ul>
        <!-- Dropdown Structure -->
        <ul id='feature-notif' class='dropdown-content'>
          <li><a><b>Matematika</b><br>Uji Kompetisi 2 hal.30</a></li>
          <li><a><b>Bhs Inggris</b><br>Uji Kompetisi 2 hal.30</a></li>
          <li><a><b>Sejarah</b><br>Uji Kompetisi 2 hal.30</a></li>
          <li><a><b>Matematika</b><br>Uji Kompetisi 2 hal.30</a></li>
          <li><a><b>Matematika</b><br>Uji Kompetisi 2 hal.30</a></li>
        </ul>
        <ul id='feature-pengaturan' class='dropdown-content' style="    width: 176px;">
          @if($sis->status=='Diterima')
          <li><a href="blog.html"><i class="material-icons left">edit</i>Artikel</a></li>
          <li><a href="docs.html"><i class="material-icons left">school</i>Pencapaian</a></li>
          <li><a href="no-image.html"><i class="material-icons left">import_export</i>Eksport</a></li>
          @endif
          <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons left">power_settings_new</i>Logout</a></li>
        </ul>
        
      </div>

      <!-- Fixed Masonry Filters -->
      @yield('menu')
      
    </nav>
    <ul class="side-nav" id="nav-mobile">
      <li><a href="blog.html"><i class="material-icons">edit</i>Artikel</a></li>
      <li><a href="docs.html"><i class="material-icons">school</i>Pencapaian</a></li>
      <li><a href="horizontal.html"><i class="material-icons">forum</i>Chatting</a></li>
      <li><a href="no-image.html"><i class="material-icons">import_export</i>Eksport</a></li>
      <li><a href="no-image.html"><i class="material-icons">power_settings_new</i>Logout</a></li>
    </ul>

    <form id="logout-form" action="{{ route('logout') }}" method="POST">
      {{ csrf_field() }}
    </form>

    @yield('content')

    

    <!-- Core Javascript -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="{{asset('materialize/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('materialize/js/masonry.pkgd.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/materialize/0.98.0/js/materialize.min.js"></script>
    {{-- <script src="{{asset('materialize/js/color-thief.min.js')}}"></script> --}}
    <script src="{{asset('materialize/js/galleryExpand.js')}}"></script>
    <script src="{{asset('materialize/js/init.js')}}"></script>
    
    @yield('script')
    @include('sweet::alert')

  </body>
</html>