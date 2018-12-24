@extends('pengajar.pengajar-template')
@section('warna','blue')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/event.css')}}">
<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
@endsection

@section('menu')
<div class="categories-wrapper light-blue darken-3" style="height: 48px">
  <div class="categories-container">
    <div class="container">
     <a href="{{url('pengajar')}}" class="breadcrumb">Home</a>
     <a href="{{url('pengajar/materi')}}" class="breadcrumb">Materi</a>
     <a href="{{url('pengajar/materi/list/'.$pelajaran->id)}}" class="breadcrumb">{{$pelajaran->kurikulum. ' - '. $pelajaran->jurusan. ' - '. $pelajaran->tingkat_kelas. ' - '. $pelajaran->mapel}}</a>
     <a href="#!" class="breadcrumb">Tambah</a>
    </div>
  </div>
</div>
@endsection

@section('content')
<div id="portfolio" class="section white">
<div class="container">
  <div id="dasbord" class="col s12">
    <form method="POST" action="{{route('materi.tambah')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id_bab" value="{{$id_bab}}">
        <input type="hidden" name="id_list_pelajaran" value="{{$id_pel}}">
       
        <div class="row">
            <div class="col m6 s12">
              {{-- <div class="chips chips-autocomplete"></div> --}}
               <div class="input-field">
                  <input id="topik" type="text" class="validate" name="topik" value="{{old('topik')}}">
                  <label for="topik">Topik</label>
                  @if ($errors->has('topik'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('topik') }}</strong>
                    </span>
                  @endif
                </div>
            </div>
            <div class="col m6 s12">
              <div class="file-field input-field">
                <div class="btn blue">
                  <span>Upload Doc/PDF</span>
                  <input type="file" name="file"  onchange="fotoURl(this)" >
                </div>
                @if ($errors->has('file'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('file') }}</strong>
                    </span>
                @endif
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" placeholder="File">
                </div>
              </div>
            </div>
        </div>
       
        <div class="input-field col s12">
          <textarea name="materi" required>{{old('materi')}}</textarea>
          @if ($errors->has('materi'))
              <span class="invalid-feedback">
                  <strong>{{ $errors->first('materi') }}</strong>
              </span>
          @endif
        </div>
        <div class="row"><br>
        <button type="submit" class="col s12 btn blue">Simpan</button>
        </div>
  </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{url('js/texteditor.js')}}"></script>
<script type="text/javascript">
  $('.chips').material_chip();
  $('.chips-initial').material_chip({
    data: [{
      tag: 'Apple',
    }, {
      tag: 'Microsoft',
    }, {
      tag: 'Google',
    }],
  });
  $('.chips-placeholder').material_chip({
    placeholder: 'Enter a tag',
    secondaryPlaceholder: '+Tag',
  });
  $('.chips-autocomplete').material_chip({
    autocompleteOptions: {
      data: {
        'Apple': null,
        'Microsoft': null,
        'Google': null
      },
      limit: Infinity,
      minLength: 1
    }
  });
  $(document).ready(function() {
    @if(Session::has('berhasil'))
      Materialize.toast('{{ Session::get('berhasil') }}', 4000);
    @endif
  });
</script>
@endsection