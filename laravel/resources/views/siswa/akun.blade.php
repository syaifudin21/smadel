@extends('siswa.template-siswabaru')

@section('content')
        

        <h4 class="m-0">Akun</h4>
        <p class="text-muted mb-heading">Anda dapat melakukan rubah password disini</p>
        <hr>

        @if(Session::has('success'))
            <div class="alert alert-info alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('success') }}
            </div>
        @endif
        @if(Session::has('gagal'))
            <div class="alert alert-danger alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('gagal') }}
            </div>
        @endif

          <form class="col s12" action="{{route('siswa.akun.update')}}" method="POST">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
              <div class="form-group row">
                  <label for="nisn" class="col-sm-3 col-form-label">Nomor Induk Siswa</label>
                  <div class="col-sm-9">
                      <input type="text" readonly class="form-control" id="nisn" value="{{Auth::user('siswa')->nisn}}" placeholder="NISN">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="passwordlama" class="col-sm-3 col-form-label">Password Lama</label>
                  <div class="col-sm-9">
                      <input type="password" class="form-control" id="passwordlama" name="passwordlama" placeholder="Password Lama">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="passwordbaru" class="col-sm-3 col-form-label">Password Baru</label>
                  <div class="col-sm-9">
                      <input type="password" class="form-control" id="passwordbaru" name="passwordbaru" placeholder="Password Baru">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="cpasswordbaru" class="col-sm-3 col-form-label">Konfirmasi Password Baru</label>
                  <div class="col-sm-9">
                      <input type="password" class="form-control" id="passwordlama" name="cpasswordbaru" placeholder="Konfirmasi Password Baru">
                  </div>
              </div>
          <div class="form-group row">
              <label for="sekolah_angkatan" class="col-sm-3 col-form-label"></label>
              <div class="col-sm-9">
                  <button type="submit" class="btn btn-primary">Update</button>
              </div>
          </div>
         
        </form>
        {{-- <ol class="breadcrumb">
            <li class="breadcrumb-item">Daftar</li>
            @if($siswa->status == 'Daftar')
            <li class="breadcrumb-item active">Verifikasi Data Siswa</li>
            @elseif($siswa->status == 'Verifikasi Siswa')
            <li class="breadcrumb-item">Verifikasi Data Siswa</li>
            <li class="breadcrumb-item active">Verifikasi Sekolah</li>
            @endif  
        </ol> --}}


@endsection

@section('script')

@endsection