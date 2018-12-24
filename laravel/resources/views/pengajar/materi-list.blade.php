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
     <a href="{{url('pengajar/materi')}}" class="breadcrumb">Materi</a>
     <a href="#!" class="breadcrumb">{{$pelajaran->kurikulum. ' - '. $pelajaran->jurusan. ' - '. $pelajaran->tingkat_kelas. ' - '. $pelajaran->mapel}}</a>
    </div>

  </div>
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
              <th>Bab</th>
              <th>Materi</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $n= 1;?>
            @foreach($babs as $bab)
            <tr>
              <td>{{$n++}}</td>
              <td><b>{{$bab->bab}}</b> <br><small>{{$bab->topik}}</small></td>
              <?php 
                $materis = App\Models\Materi::where('id_bab', $bab->id)->get();
              ?>
              <td>
                @foreach($materis as $materi)
                <a href="{{url('pengajar/materi/id/'.$materi->id.'/'.$pelajaran->id)}}" class="btn">{{$materi->topik}}</a>
                @endforeach
              </td>
              <td><a href="{{url('pengajar/materi/tambah/idbab/'.$bab->id.'/'.$pelajaran->id)}}" class="btn blue">Tambah</a></td>
            </tr>
          </tbody>
          @endforeach
        </table>
  </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    @if(Session::has('berhasil'))
      Materialize.toast('{{ Session::get('berhasil') }}', 4000);
    @endif
    $('ul.tabs').tabs();
  });
</script>
@endsection