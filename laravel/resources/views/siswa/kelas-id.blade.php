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
     <a href="{{url('siswa/kelas')}}" class="breadcrumb">Kelas</a>
     <a href="#!" class="breadcrumb">{{$kelas->kelas}}</a>
    </div>
  </div>
</div>
@endsection

@section('content')
<div id="portfolio" class="section white">
<div class="container">
  <div id="dasbord" class="col s12">
      <canvas id="densityChart" width="600" height="400"></canvas>
  <div class="row">
       <table>
         <thead>
           <tr>
             <th>Mapel</th>
             <th>Pengajar</th>
             <th>Nilai</th>
             <th>Action</th>
           </tr>
         </thead>
         <tbody>
          @foreach($mapels as $mapel)
           <tr>
             <td>{{$mapel->mapel}}</td>
             <td>Budi</td>
             <td>90</td>
             <td><a href="{{url('siswa/kelas/mapel/'.$mapel->id)}}" class="btn blue btn-small">Detail</a></td>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
<script type="text/javascript">
  var densityCanvas = document.getElementById("densityChart");

  Chart.defaults.global.defaultFontSize = 12;

  var densityData = {
    label: 'Nilai',
    data: [40, 50, 70, 55, 65, 45, 70, 80, 60, 95, 50, 60, 70, 90, 60, 50]
  };

  var barChart = new Chart(densityCanvas, {
    type: 'horizontalBar',
    data: {
      labels: ["Matematika", "Fisika", "Kimia", "Bhs. Indonesia", "Geografi", "Al-Quran", "Aqidah Akhlaq", "Fiqih", "SKI", "Bhs. Inggris", "Biologi", "Sejarah", "Ekonomi", "PenjasOrkes", "Aswaja", "Bhs. Arab"],
      datasets: [densityData]
    }
  });

  $(document).ready(function() {
    @if(Session::has('berhasil'))
      Materialize.toast('{{ Session::get('berhasil') }}', 4000);
    @endif
  });
</script>
@endsection