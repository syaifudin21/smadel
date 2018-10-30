@extends('pengurus.template-pengurus')
@section('head')
<link href="{{asset('plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endsection
@section('content')

<div class="nav-scroller bg-white box-shadow">
   <ul class="nav nav-underline" id="myTab" role="tablist">
        <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Bantuan</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tambah" role="tab" aria-controls="profile" aria-selected="false">Tambah</a>
        </li>
    </ul>
</div>

<br><br>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
<h1 class="h2">Bantuan</h1>
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
    <li class="breadcrumb-item active" aria-current="page">Bantuan</li>
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
                        <th>tanggal</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php $n=1;?>
                <tbody>
                    @foreach($bantuans as $bantuan)
                    <tr>
                        <td>{{$n++}}</td>
                        <td>{{$bantuan->judul}}</td>
                        <td>{{$bantuan->status}}</td>
                        <form method="POST" action="{{url('pengurus/bantuan/'.$bantuan->id)}}">
                        <td>
                            <a href="{{url('pengurus/bantuan/'.$bantuan->id)}}" class="btn btn-outline-success btn-sm">Lihat</a> 
                            @if($bantuan->status=='Hidden')
                            <a href="{{url('pengurus/bantuan/tampilkan/'.$bantuan->id)}}" class="btn btn-outline-secondary btn-sm">Tampilkan</a> 
                            @else
                            <a href="{{url('pengurus/bantuan/sembunyikan/'.$bantuan->id)}}" class="btn btn-outline-warning btn-sm">Sembunyikan</a> 
                            @endif
                            <a href="{{url('pengurus/bantuan/edit/'.$bantuan->id)}}" class="btn btn-outline-primary btn-sm">Update</a>
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
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
    <form method="POST" action="{{route('bantuan.tambah')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group row">
            <label for="pertanyaan" class="col-sm-4 col-form-label text-md-right">Pertanyaan</label>
            <div class="col-md-6">
                <input id="pertanyaan" type="text" class="form-control{{ $errors->has('pertanyaan') ? ' is-invalid' : '' }}" name="pertanyaan" value="{{ old('pertanyaan') }}" required autofocus>
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
                <input id="judul" type="text" class="form-control{{ $errors->has('judul') ? ' is-invalid' : '' }}" name="judul" value="{{ old('judul') }}" required autofocus>
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
                <textarea id="isi" class="form-control{{ $errors->has('isi') ? ' is-invalid' : '' }} editor" name="isi" required autofocus>{{ old('isi') }}</textarea>
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
                <input id="lampiran" type="file" class="form-control{{ $errors->has('lampiran') ? ' is-invalid' : '' }}" name="lampiran" value="{{ old('lampiran') }}" autofocus>

                @if ($errors->has('lampiran'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('lampiran') }}</strong>
                    </span>
                @endif
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
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/adapters/jquery.js') }}"></script>
<script type="text/javascript">
    $('.editor').ckeditor();
</script>
@endsection
