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
     <a href="#!" class="breadcrumb">Soal</a>
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
              <th>Kurikulum</th>
              <th>Jurusan</th>
              <th>Tingkat Kelas</th>
              <th>Mata Pelajaran</th>
              <th>Jumlah Soal</th>
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
              <?php 
                $materi = App\Models\Soal::where(['id_guru'=>Auth::user('pengajar')->id ,'id_list_pelajaran'=> $pelajaran->id])->count();
              ?>
              <td>{{$materi}}</td>
              <td>
                <a href="{{url('pengajar/soal/list/'.$pelajaran->id)}}" class="btn blue">Detail</a>
                
              </td>
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