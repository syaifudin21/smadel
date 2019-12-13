@extends('pengurus.template-pengurus')

@section('content')

<div class="nav-scroller bg-white box-shadow">
   <ul class="nav nav-underline" id="myTab" role="tablist">
        <li class="nav-item">
        <a class="nav-link" href="{{url('/pengurus/bantuan/'.$id)}}">{{$bantuan->judul}}</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" href="{{url('/pengurus/bantuan/update/'.$id)}}">Update</a>
        </li>
    </ul>
</div>

<br><br>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
<h1 class="h2">Update Bantuan {{$bantuan->judul}}</h1>
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
    <li class="breadcrumb-item"><a href="{{url('pengurus/bantuan')}}">Bantuan</a></li>
    <li class="breadcrumb-item"><a href="{{url('pengurus/bantuan/'.$id)}}">{{$bantuan->judul}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Update</li>
  </ol>
</nav>

    <form method="POST" action="{{ route('bantuan.update') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <input type="hidden" name="id" value="{{$id}}">
        <div class="form-group row">
            <label for="pertanyaan" class="col-sm-4 col-form-label text-md-right">Pertanyaan</label>
            <div class="col-md-6">
                <input id="pertanyaan" type="text" class="form-control{{ $errors->has('pertanyaan') ? ' is-invalid' : '' }}" name="pertanyaan" value="{{ $bantuan->pertanyaan}}" required autofocus>
                @if ($errors->has('pertanyaan'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('pertanyaan') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="judul" class="col-sm-4 col-form-label text-md-right">Judul</label>
            <div class="col-md-6">
                <input id="judul" type="text" class="form-control{{ $errors->has('judul') ? ' is-invalid' : '' }}" name="judul" value="{{$bantuan->judul}}" required autofocus>
                @if ($errors->has('judul'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('judul') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="isi" class="col-sm-4 col-form-label text-md-right">Isi</label>
            <div class="col-md-6">
                <textarea id="isi" class="form-control{{ $errors->has('isi') ? ' is-invalid' : '' }} editor" name="isi" required autofocus>{{ $bantuan->isi}}</textarea>
                @if ($errors->has('isi'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('isi') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label text-md-right">Lampiran (foto)</label>
            <div class="col-md-6">
                <img src="{{url(env('FTP_HOST').'/bantuan/'.$bantuan->lampiran)}}" width="30%" class="img img-thumbnail" id="foto"><br>
                <input id="lampiran" type="file" class="form-control{{ $errors->has('lampiran') ? ' is-invalid' : '' }}" name="lampiran" value="{{ old('lampiran') }}" autofocus  onchange="fotoURl(this)">

                @if ($errors->has('lampiran'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('lampiran') }}</strong>
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
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/adapters/jquery.js') }}"></script>

<script type="text/javascript">
    $('.editor').ckeditor();
    function fotoURl(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#foto').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
  }

</script>
@endsection
