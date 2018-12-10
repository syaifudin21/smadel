@extends('siswa.template')
@section('warna','blue')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/event.css')}}">
@endsection

@section('menu')
<div class="categories-wrapper light-blue darken-3" style="height: 48px">
  <div class="categories-container">
    <div class="container">
     <a href="{{url('siswa')}}" class="breadcrumb">Home</a>
     <a href="#!" class="breadcrumb">Absensi</a>
    </div>
  </div>
</div>
@endsection

@section('content')
<div id="portfolio" class="section white">
<div class="container">
  <div id="dasbord" class="col s12">
  <div class="row">
       <table>
         <thead>
           <tr>
             <th>Tanggal</th>
             <th>Masuk 1</th>
             <th>Keluar 1</th>
             <th>Masuk 2</th>
             <th>Keluar 2</th>
             <th>Keterangan</th>
           </tr>
         </thead>
         <tbody>
          @foreach($hadirs as $hadir)
           <tr>
            <td>{{$hadir->tanggal}}</td>
            <td>{{$hadir->masuk_1}}</td>
            <td>{{$hadir->keluar_1}}</td>
            <td>{{$hadir->masuk_2}}</td>
            <td>{{$hadir->keluar_2}}</td>
            <td>{{(!empty($hadir->event))? $hadir->event: $hadir->keterangan}}</td>
           </tr>
           @endforeach
         </tbody>
       </table>
  </div>    
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