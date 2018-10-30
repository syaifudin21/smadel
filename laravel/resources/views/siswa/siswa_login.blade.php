<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from learnplus.frontendmatter.com/guest-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 04 Jun 2018 08:15:28 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>

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





</head>

<body class="login">


    <div class="row">
        <div class="col-sm-8 col-md-4 col-lg-4 mx-auto">
            <div class="text-center m-2">
                <div class="icon-block rounded-circle">
                    <i class="material-icons align-middle md-36 text-muted">lock</i>
                </div>
            </div>
      
            <div class="card bg-transparent">
                <div class="card-header bg-white text-center">
                    <h4 class="card-title">Login</h4>
                    <p class="card-subtitle">Silahkan Login Accunt Anda</p>
                </div>
        
                <div class="card-body">
                    <form  class="form-signin" method="POST" action="{{ route('siswa.login') }}">
                      {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" class="form-control {{ $errors->has('nisn') ? ' is-invalid' : '' }}" placeholder="NISN" name="nisn">
                             @if ($errors->has('nisn'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('nisn') }}</strong>
                                  </span>
                              @endif
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password">
                            @if ($errors->has('password'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                        </div>
                        <div class="form-group ">
                            <button type="submit" class="btn  btn-primary btn-block">
                              <span class="btn-block-text">Login</span>
                            </button>
                        </div>
                        <div class="text-center">
                            <a href="#"><small>Forgot Password?</small></a>
                        </div>
                    </form>
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





</body>


<!-- Mirrored from learnplus.frontendmatter.com/guest-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 04 Jun 2018 08:15:29 GMT -->
</html>