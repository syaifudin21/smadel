@extends('pengurus.template-pengurus')

@section('content')

<div class="nav-scroller bg-white box-shadow">
   <ul class="nav nav-underline" id="myTab" role="tablist">
        <li class="nav-item">
        <a class="nav-link" href="{{url('/pengurus/prestasi/'.$id)}}">{{$prestasi->nama}}</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" href="{{url('/pengurus/prestasi/update/'.$id)}}">Update</a>
        </li>
    </ul>
</div>

<br><br>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
<h1 class="h2">Update Prestasi {{$prestasi->nama}}</h1>
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
    <li class="breadcrumb-item"><a href="{{url('pengurus/prestasi')}}">Prestasi</a></li>
    <li class="breadcrumb-item"><a href="{{url('pengurus/prestasi/'.$id)}}">{{$prestasi->nama}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Update</li>
  </ol>
</nav>

    <form method="POST" action="{{ route('prestasi.update') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <input type="hidden" name="id" value="{{$id}}">
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label text-md-right">Prestasi</label>
            <div class="col-md-6">
                <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ $prestasi->nama }}" required autofocus>
                @if ($errors->has('nama'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('nama') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="instalasi" class="col-sm-4 col-form-label text-md-right">Instalasi</label>
            <div class="col-md-6">
                <input id="instalasi" type="text" class="form-control{{ $errors->has('instalasi') ? ' is-invalid' : '' }}" name="instalasi" value="{{ $prestasi->instalasi }}" required autofocus>
                @if ($errors->has('instalasi'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('instalasi') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="deskripsi" class="col-sm-4 col-form-label text-md-right">Deskripsi</label>
            <div class="col-md-6">
                <textarea id="deskripsi" class="form-control{{ $errors->has('deskripsi') ? ' is-invalid' : '' }}" name="deskripsi" required autofocus>{{ $prestasi->deskripsi }}</textarea>
                @if ($errors->has('deskripsi'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('deskripsi') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="foto" class="col-sm-4 col-form-label text-md-right">Foto</label>
            <div class="col-md-6">
                <input id="foto" type="file" class="form-control{{ $errors->has('foto') ? ' is-invalid' : '' }}" name="foto" autofocus>

                @if ($errors->has('foto'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('foto') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="foto" class="col-sm-4 col-form-label text-md-right">Tanggal</label>
            <div class="col-md-6">
            <input type="date" class="form-control" name="tanggal" class="form-control{{ $errors->has('tanggal') ? ' is-invalid' : '' }}" value="{{ $prestasi->tanggal }}">
                
                @if ($errors->has('tanggal'))
                    <span class="wak-feedback">
                        <strong>{{ $errors->first('tanggal') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        
            <div class="form-group row">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>

@endsection

@section('script')
@endsection
