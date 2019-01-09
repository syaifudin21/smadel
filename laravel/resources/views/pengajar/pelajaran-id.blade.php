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
     <a href="{{url('pengajar/listpelajaran')}}" class="breadcrumb">Pelajaran</a>
     <a href="#!" class="breadcrumb">{{$pelajaran->mapel}}</a>
    </div>
  </div>
</div>
@endsection

@section('content')
<div id="portfolio" class="section white">
<div class="container">
  <div id="dasbord" class="col s12">
    <table class="table bordered">
      <tr><th>Kurikulum</th><td>{{$pelajaran->kurikulum}}</td></tr>
      <tr><th>Jurusan</th><td>{{$pelajaran->jurusan}}</td></tr>
      <tr><th>Tingkat Kelas</th><td>{{$pelajaran->tingkat_kelas}}</td></tr>
      <tr><th>Mata Pelajaran</th><td>{{$pelajaran->mapel}}</td></tr>

    </table>
    <br>
    <a class="btn blue  modal-trigger" href="#modal1">Update</a>

    <a data-url="{{url('pengajar/listpelajaran/delete/'.$pelajaran->id)}}" data-redirect="{{url('pengajar/listpelajaran')}}" class="hapus btn red"><i class="material-icons left">delete</i>Hapus</a>

  </div>    
</div>
</div>

  <div id="modal1" class="modal modal-fixed-footer">
    <form method="post" action="{{route('listpelajaran.tambah')}}">{{ csrf_field() }}
    <div class="modal-content">
      <h4>Tambah Pelajaran</h4>
      <p>Pelajaran yang dipilih akan digunakan sebagai berkas yang dikelola oleh guru</p>

      <div class="row">
          <div class="input-field col s6 offset-s3">
            <select id="kurikulum" class="browser-default" name="id_kurikulum" value="{{$pelajaran->id_kurikulum}}">
              <option value="" disabled>Pilih Kurikulum</option>
              @foreach($kurikulums as $kurikulum)
              <option value="{{$kurikulum->id}}">{{$kurikulum->kurikulum}}</option>
              @endforeach
            </select>
          </div>
          <div class="input-field col s6 offset-s3">
            <select id="jurusan" class="browser-default" name="id_jurusan" value="{{$pelajaran->id_jurusan}}">
            </select>
          </div>
          <div class="input-field col s6 offset-s3">
            <select id="tingkatkelas" class="browser-default" name="id_tk">
            </select>
          </div>
          <div class="input-field col s6 offset-s3">
            <select id="mapel" class="browser-default" name="id_mapel">
            </select>
          </div>
         
      </div>

    </div>
    <div class="modal-footer">
      <button type="submit" class="waves-effect waves-light btn blue">Tambah</button>
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
    </div>
    </form>
  </div>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('js/hapus.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.modal').modal();
  });

  $('#kurikulum').on('change', function(e){
      var id = e.target.value;
      $('#jurusan').empty();
      $('#tingkatkelas').empty();
      $('#mapel').empty();
      $.get('{{ url('data/kurikulum')}}/'+id, function(data){
        $('#jurusan').append("<option value=''disabled selected>Pilih Jurusan</option>")
        $.each(data.jurusans, function(index, element){
          $('#jurusan').append("<option value="+element.id+">"+element.jurusan+"</option>")
        });
      });
  });
  $('#jurusan').on('change', function(e){
      var id = e.target.value;
      $('#tingkatkelas').empty();
      $('#mapel').empty();
      $.get('{{ url('data/jurusan')}}/'+id, function(data){
      //   var n = 1;
        $('#tingkatkelas').append("<option value='' disabled selected>Pilih Tingkat Kelas</option>")
        $.each(data.tks, function(index, element){
          $('#tingkatkelas').append("<option value="+element.id+">"+element.tingkat_kelas+"</option>")
        });
      });
  });
  $('#tingkatkelas').on('change', function(e){
      var id = e.target.value;
      $('#mapel').empty();
      $.get('{{ url('data/tingkatkelas')}}/'+id, function(data){
      //   var n = 1;
        $('#mapel').append("<option value='' disabled selected>Pilih Mata Pelajaran</option>")
        $.each(data.mapels, function(index, element){
          $('#mapel').append("<option value="+element.id+">"+element.mapel+"</option>")
        });
      });
  });

  $(document).ready(function() {
    @if(Session::has('berhasil'))
      Materialize.toast('{{ Session::get('berhasil') }}', 4000);
    @endif
    $('ul.tabs').tabs();
  });


</script>
@endsection