@extends('sekolah.template-sekolah')
@section('head')
<link href="{{asset('plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endsection
@section('content')

<div class="nav-scroller bg-white box-shadow">
   <ul class="nav nav-underline" id="myTab" role="tablist">
        <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Mata Pelajaran</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tambah" role="tab" aria-controls="profile" aria-selected="false">Tambah</a>
        </li>
    </ul>
</div>

<br><br>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
<h1 class="h2">Pengurus</h1>
<div class="btn-toolbar mb-2 mb-md-0">
  <div class="btn-group mr-2">
    <button class="btn btn-sm btn-outline-secondary">Share</button>
    <button class="btn btn-sm btn-outline-secondary">Export</button>
  </div>
  <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
    <span data-feather="calendar"></span>
    This week
  </button>
</div>
</div>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white" style="padding: 0px">
    <li class="breadcrumb-item active" aria-current="page">Mata Pelajaran</li>
  </ol>
</nav>


@if(Session::has('success'))
    <div class="alert alert-info alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::get('success') }}
    </div>
@endif

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
		<div class="table-responsive-sm">
		<table id="example" class="table table-hover table-sm" style="width:100%">
		        <thead>
		            <tr>
		                <th>#</th>
		                <th>Nama</th>
		                <th>Email</th>
		                <th>Status</th>
		                <th>Action</th>
		            </tr>
		        </thead>
		        <?php $n=1;?>
		        <tbody>
		            @foreach($penguruses as $pengurus)
		            <tr>
		                <td>{{$n++}}</td>
		                <td>{{$pengurus->nama}}</td>
		                <td>{{$pengurus->email}}</td>
		                <?php 
		                	if ($pengurus->status == 1) {
		                		$status = 'Nilai , Absensi, Setting';
		                	} elseif ($pengurus->status == 2) {
		                		$status = 'Administrasi';
		                	} elseif ($pengurus->status == 3) {
		                		$status = 'Perpustakaan';
		                	} elseif ($pengurus->status == 4) {
		                		$status = 'Organisasi';
		                	} else {
		                		$status = 'Kosong';
		                	}
		                ?>
		                <td>{{$status}}</td>
		                <form method="POST" action="{{url('sekolah/pengurus/delete/'.$pengurus->id)}}">
		                <td><a href="{{url('sekolah/mapel/lihat/'.$pengurus->id)}}" class="btn btn-outline-success btn-sm">Lihat</a> <a href="{{url('sekolah/mapel/update/'.$pengurus->id)}}" class="btn btn-outline-primary btn-sm">Update</a> 
		                    @method('DELETE') {{csrf_field()}}
		                    <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i> Delete </button>
		                </td>
		                </form>
		            </tr>
		            @endforeach
		        </tbody>
		    </table>
		</div>
    </div>

    <div class="tab-pane fade" id="tambah" role="tabpanel" aria-labelledby="profile-tab">
    <form method="POST" action="{{route('sekolah.pengurus.tambah')}}">
        @csrf
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label text-md-right">Nama Pengurus</label>
            <div class="col-md-6">
                <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama') }}" required autofocus>
                @if ($errors->has('nama'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('nama') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-4 col-form-label text-md-right">Email</label>
            <div class="col-md-6">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-4 col-form-label text-md-right">Password</label>
            <div class="col-md-6">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" required autofocus>
                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="jenis_mapel" class="col-sm-4 col-form-label text-md-right">Jenis Mata Pelajaran</label>
            <div class="col-md-6">
                <select class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status">
                    <option value="" disabled selected>Pilih Outoritas</option>
                    <option value="1">Nilai , Absensi, Setting</option>
                    <option value="2">Administrasi</option>
                    <option value="3">Perpustakaan</option>
                    <option value="4">Organisasi</option>
                </select>
            </div>
        </div>
            <div class="form-group row">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
@endsection
