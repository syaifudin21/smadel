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
     <a href="#!" class="breadcrumb">List Pelajaran</a>
    </div>

  </div>
  <a class="btn-floating btn-large halfway-fab waves-effect waves-light blue  modal-trigger" href="#modal1"><i class="material-icons">add</i></a>
</div>
@endsection

@section('content')
<div id="portfolio" class="section white">
<div class="container">
  <div id="dasbord" class="col s12">
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Kurikulum</th>
          <th>Jurusan</th>
          <th>Tingkat Kelas</th>
          <th>Mata Pelajaran</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $n= 1;?>
        @foreach($pelajarans as $pelajaran)
        <tr>
          <td>{{$n++}}</td>
          <td>{{$pelajaran->kurikulum}}</td>
          <td>{{$pelajaran->jurusan}}</td>
          <td>{{$pelajaran->tingkat_kelas}}</td>
          <td>{{$pelajaran->mapel}}</td>
          <td>
            <a href="{{url('pengajar/listpelajaran/id/'.$pelajaran->id)}}" class="btn blue">Detail</a>
            
          </td>
        </tr>
        
      </tbody>
      @endforeach
    </table>
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
            <select id="kurikulum" class="browser-default" name="id_kurikulum">
              <option value="" disabled selected>Pilih Kurikulum</option>
              @foreach($kurikulums as $kurikulum)
              <option value="{{$kurikulum->id}}">{{$kurikulum->kurikulum}}</option>
              @endforeach
            </select>
          </div>
          <div class="input-field col s6 offset-s3">
            <select id="jurusan" class="browser-default" name="id_jurusan">
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