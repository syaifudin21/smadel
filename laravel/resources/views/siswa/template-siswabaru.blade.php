<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from learnplus.frontendmatter.com/fixed-instructor-quiz-edit.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 04 Jun 2018 08:17:27 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Instructor - Edit quiz - Fixed layout</title>

    <!-- Prevent the demo from appearing in search engines (REMOVE THIS) -->
    <meta name="robots" content="noindex">

    <!-- Simplebar -->
    <link type="text/css" href="{{asset('learn/vendor/simplebar.css')}}" rel="stylesheet">

    <!-- Material Design Icons  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Roboto Web Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">

    <!-- MDK -->
    <link type="text/css" href="{{asset('learn/vendor/material-design-kit.css')}}" rel="stylesheet">

    <!-- Sidebar Collapse -->
    <link type="text/css" href="{{asset('learn/vendor/sidebar-collapse.min.css')}}" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="{{asset('learn/css/style.css')}}" rel="stylesheet">


    <!-- Touchspin -->
    <link rel="stylesheet" href="{{asset('learn/css/bootstrap-touchspin.css')}}">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{asset('learn/css/nestable.css')}}">

    @yield('css')

</head>

<body class="ls-top-navbar">


    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-dark bg-primary m-0 fixed-top">

        <!-- Toggle sidebar -->
        <button class="navbar-toggler d-block" data-toggle="sidebar" type="button">
    <span class="material-icons">menu</span>
  </button>

        <!-- Brand -->
        <a href="{{url('siswa')}}" class="navbar-brand">{{$profil->nama_singkat_sekolah}}</a>

       

        <div class="navbar-spacer"></div>

        <!-- Menu -->

         <ul class="nav navbar-nav d-none d-md-flex">
            <?php
                $status = App\Models\Profil_siswa::where('nisn', Auth::user('siswa')->nisn)->select('status')->first();
            ?>
            @if($status != 'Diterima')
            <li class="nav-item">
                <a class="nav-link" href="{{url('siswa/forum/menu/siswabaru')}}">Forum</a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{url('siswa/bantuan')}}">Bantuan</a>
            </li>
        </ul>
       

        <!-- Menu -->
        <ul class="nav navbar-nav">
            <!-- User dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link active dropdown-toggle" data-toggle="dropdown" href="#" role="button">Akun</a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{url('siswa/profil')}}">
                      <i class="material-icons">edit</i> Profil Saya
                    </a>
                    <a class="dropdown-item" href="{{url('siswa/akun')}}">
                      <i class="material-icons">person</i> Rubah Password
                    </a >
                    <a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class="material-icons">lock</i> Logout
                    </a>
                </div>
            </li>
            <!-- // END User dropdown -->
        </ul>
    </nav>

    <form id="logout-form" action="{{ route('siswa.logout') }}" method="POST">
        {{ csrf_field() }}
    </form>
    <!-- // END Navbar -->

    <div class="container">
        @yield('content')
    </div>

    <div class="mdk-drawer js-mdk-drawer" id="default-drawer">
        <div class="mdk-drawer__content ls-top-navbar-xs-up">
            <div class="sidebar sidebar-left sidebar-light bg-white o-hidden">
                <div class="sidebar-p-y" data-simplebar data-simplebar-force-enabled="true">
                    <ul class="sidebar-menu">
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="{{url('siswa')}}">
                              <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">school</i> Beranda
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="{{asset('learn/vendor/jquery.min.js')}}"></script>

    <!-- Bootstrap -->
    <script src="{{asset('learn/vendor/popper.min.js')}}"></script>
    <script src="{{asset('learn/vendor/bootstrap.min.js')}}"></script>

    <!-- Simplebar -->
    <!-- Used for adding a custom scrollbar to the drawer -->
    <script src="{{asset('learn/vendor/simplebar.js')}}"></script>

    <!-- MDK -->
    <script src="{{asset('learn/vendor/dom-factory.js')}}"></script>
    <script src="{{asset('learn/vendor/material-design-kit.js')}}"></script>

    <!-- Sidebar Collapse -->
    <script src="{{asset('learn/vendor/sidebar-collapse.js')}}"></script>

    <!-- App JS -->
    <script src="{{asset('learn/js/main.js')}}"></script>


    @yield('script')

    <script type="text/javascript">
    $("form").submit(function(){
         $(this).find(':submit').prop('disabled', true);
    });
    </script>
</body>


<!-- Mirrored from learnplus.frontendmatter.com/fixed-instructor-quiz-edit.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 04 Jun 2018 08:17:27 GMT -->
</html>