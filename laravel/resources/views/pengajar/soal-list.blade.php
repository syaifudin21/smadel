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
     <a href="#!" class="breadcrumb">{{$pelajaran->kurikulum. ' - '. $pelajaran->jurusan. ' - '. $pelajaran->tingkat_kelas. ' - '. $pelajaran->mapel}}</a>
    </div>

  </div>
  <a class="btn-floating btn-large halfway-fab waves-effect waves-light blue  modal-trigger" href="#modal1"><i class="material-icons">add</i></a>

</div>
@endsection

@section('content')
<div id="portfolio" class="section white">
<div class="container">
  <div id="dasbord" class="col s12">

        <table class="table bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Bab</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $n= 1;?>
            @foreach($babs as $bab)
            <tr>
              <td>{{$n++}}</td>
              <td colspan="3"><b>{{$bab->bab}}</b> <small>{{$bab->topik}}</small></td>
              <td><a href="{{url('pengajar/soal/tambah/idbab/'.$bab->id.'/'.$pelajaran->id)}}" class="btn blue">Tambah</a></td>
            </tr>
              <?php 
                $s = 1;
                $soals = App\Models\Soal::where('id_bab', $bab->id)->get();
              ?>
              @if(!empty($soals))
              @foreach($soals as $soal)
              <tr>
                <td></td>
                <td>{{$s++}}</td>
                <td>{{$soal->soal}}</td>
                <td>{{$soal->type}}</td>
                <td>{{$soal->status}}</td>
              </tr>
              @endforeach
              @else
              <tr>
                <td>~</td>
                <td><small>Kosong</small></td>
              </tr>
              @endif
              
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
      <h4>Tambah Konten Soal</h4>
      <p>Konten ini dapat disisipkan disetiap soal yang ada</p>

      <div class="row">
          <div class="input-field col s6 offset-s3">
            <select id="type" class="browser-default" name="type">
              <option disabled selected>Pilih Type</option>
              <option value="Artikel">Artikel</option>
              <option value="Audio">Audio</option>
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
  $(document).ready(function() {
    $('.modal').modal();
    @if(Session::has('berhasil'))
      Materialize.toast('{{ Session::get('berhasil') }}', 4000);
    @endif
    $('ul.tabs').tabs();
  });
</script>
@endsection