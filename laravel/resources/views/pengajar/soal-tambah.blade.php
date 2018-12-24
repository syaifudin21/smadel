@extends('pengajar.pengajar-template')
@section('warna','blue')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/event.css')}}">
@endsection

@section('menu')
<div class="categories-wrapper light-blue darken-3" style="height: 48px">
  <div class="categories-container">
    <div class="container">
     <a href="{{url('pengajar')}}" class="breadcrumb">Home</a>
     <a href="{{url('pengajar/soal')}}" class="breadcrumb">Soal</a>
     <a href="{{url('pengajar/soal/list/'.$pelajaran->id)}}" class="breadcrumb">{{$pelajaran->kurikulum. ' - '. $pelajaran->jurusan. ' - '. $pelajaran->tingkat_kelas. ' - '. $pelajaran->mapel}}</a>
     <a href="#!" class="breadcrumb">Tambah</a>
    </div>
  </div>
</div>
@endsection

@section('content')
<div id="portfolio" class="section white">
<div class="container">
  <div id="dasbord" class="col s12">
    <form method="POST" action="{{route('soal.tambah')}}" id="form-soal" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id_bab" value="{{$id_bab}}">
        <input type="hidden" name="id_list_pelajaran" value="{{$id_pel}}">
      <br>
       
        <div class="row">
          <div class="col s6">
            <label>Jenis Soal</label>
            <select class="browser-default" id="type" required name="type">
              <option value="" disabled selected>Pilih Jenis Soal</option>
              <option value="Pilihan">Pilihan</option>
              <option value="Essai">Essai</option>
            </select>
          </div>
           <div class="col s6">
            <label>Metode Input</label>
            <select class="browser-default" id="media" required>
              <option value="" disabled selected>Pilih Media Input</option>
              <option value="Input">Input</option>
              <option value="Import">Import</option>
            </select>
          </div>
        </div>
         <div class="row">
            <div class="col s2">Topik Soal</div>
            <div class="col s10">
              <div class="chips chips-initial" id="chips-topik"></div>
              <input type="hidden" name="topik" id="topik">
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12">
              <div class="file-field input-field">
                <div class="btn blue">
                  <span>Upload Gambar</span>
                  <input type="file" name="gambar[]" multiple accept="image/*">
                </div>
                @if ($errors->has('file'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('file') }}</strong>
                    </span>
                @endif
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" placeholder=".jpg .png">
                </div>
              </div>
            </div>
            <div class="col m6 s12" id="formimport">
              <div class="file-field input-field">
                <div class="btn blue">
                  <span>Upload Excel</span>
                  <input type="file" name="file">
                </div>
                @if ($errors->has('file'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('file') }}</strong>
                    </span>
                @endif
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" placeholder="xls">
                </div>
              </div>
            </div>
        </div>
        <div class="row" id="formsoal">
          <div class="col s12">
            <div class="input-field ">
              <textarea id="textarea1" class="materialize-textarea" name="soal"></textarea>
              <label for="textarea1"><b>Soal </b> <small> (Isikan Soal pada kolom ini)</small></label>
            </div>
          <table id="isian">
            <tr>
              <td style="width: 1%"> <p><input name="benar" value="1" type="radio" id="test1" /><label for="test1"></label></p></td>
              <td style="padding: 0px; width: 99%">
                <div class="input-field"><input id="first_name" type="text" name="jawaban_1" class="validate"><label for="first_name">Jawaban</label></div>
              </td>
            </tr>
            <tr>
              <td style="width: 1%"> <p><input name="benar" value="2" type="radio" id="test12" /><label for="test12"></label></p></td>
              <td style="padding: 0px; width: 99%">
                <div class="input-field"><input id="first_name" type="text" name="jawaban_2" class="validate"><label for="first_name">Jawaban</label></div>
              </td>
            </tr>
            <tr>
              <td style="width: 1%"> <p><input name="benar" value="3" type="radio" id="test13" /><label for="test13"></label></p></td>
              <td style="padding: 0px; width: 99%">
                <div class="input-field"><input id="first_name" type="text" name="jawaban_3" class="validate"><label for="first_name">Jawaban</label></div>
              </td>
            </tr>
            <tr>
              <td style="width: 1%"> <p><input name="benar" value="4" type="radio" id="test14" /><label for="test14"></label></p></td>
              <td style="padding: 0px; width: 99%">
                <div class="input-field"><input id="first_name" type="text" name="jawaban_4" class="validate"><label for="first_name">Jawaban</label></div>
              </td>
            </tr>
            <tr>
              <td style="width: 1%"> <p><input name="benar" value="5" type="radio" id="test15" /><label for="test15" ></label></p></td>
              <td style="padding: 0px; width: 99%">
                <div class="input-field"><input id="first_name" type="text" name="jawaban_5" class="validate"><label for="first_name">Jawaban</label></div>
              </td>
            </tr>
          </table>

            <div class="input-field">
              <textarea id="textarea1" class="materialize-textarea" name="pembahasan"></textarea>
              <label for="textarea1"><b>Pembahasan </b> <small> (Pembahasan soal tuliskan pada kolom ini)</small></label>
            </div>
          </div>
        </div>
       
        
        <div class="row"><br>
        <button type="button" class="col s12 btn blue" id="kirim">Simpan</button>
        </div>
      </form>
  </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  document.getElementById('formimport').style.display = 'none';
  $('.chips').material_chip();
  $('.chips-initial').material_chip({
    data: [
    @foreach($topiks as $topik)
    {tag: "{{$topik}}"
    }, 
    @endforeach
    ],
  });

  $('#type').on('change', function(e){
      var value = e.target.value;
      if (value == 'Pilihan') {
        document.getElementById('isian').style.display = 'block';
      } else {
        document.getElementById('isian').style.display = 'none';
      }
  });
  $('#media').on('change', function(e){
      var value = e.target.value;
      if (value == 'Import') {
        document.getElementById('formsoal').style.display = 'none';
        document.getElementById('formimport').style.display = 'block';
      } else {
        document.getElementById('formsoal').style.display = 'block';
        document.getElementById('formimport').style.display = 'none';
      }
  });

  $('#kirim').click(function(){
    event.preventDefault();
    var kata = $("#chips-topik").html();
    var kirim = document.getElementById("topik").value = kata;
    document.getElementById('form-soal').submit();
  });   

  $(document).ready(function() {
    @if(Session::has('berhasil'))
      Materialize.toast('{{ Session::get('berhasil') }}', 4000);
    @endif
  });
</script>
@endsection