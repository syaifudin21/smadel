@extends('pengajar.pengajar-template')
@section('warna','indigo  accent-4')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/event.css')}}">
@endsection

@section('menu')
<div class="categories-wrapper indigo darken-3" style="height: 48px">
  <div class="categories-container">
    <div class="container">
     <ul class="tabs indigo darken-3">
        <li class="tab col s3"><a class="active" href="#dasbord">Dasbord</a></li>
        <li class="tab col s3"><a href="#pengumuman">Pengumuman</a></li>
      </ul>
    </div>
  </div>
</div>
@endsection

@section('content')
<div id="portfolio" class="section white">
<div class="container">

<div id="dasbord" class="col s12">
  	<div class="row">
          
		<div class="col s12 m6 l4">
			<div class="card teal darken-2">
			  <div class="card-content white-text">
			    <span class="card-title"><b>Materi</b></span>
			    <p>Anda dapat menambahkan Materi Pembelajaran disini</p>
			  </div>
			  <div class="card-action">
			    <a href="{{url('pengajar/materi')}}" class="white-text">Selengkapnya</a>
			  </div>
			</div>
		</div>
		<div class="col s12 m6 l4">
			<div class="card blue darken-3">
			  <div class="card-content white-text">
			    <span class="card-title"><b>Soal latihan</b></span>
			    <p>Uji kefahaman siswa dapat juga dilakukan test secara online</p>
			  </div>
			  <div class="card-action">
			    <a href="{{url('pengajar/soal')}}" class="white-text">Selengkapnya</a>
			  </div>
			</div>
		</div>
		<div class="col s12 m6 l4">
			<div class="card orange darken-3">
			  <div class="card-content white-text">
			    <span class="card-title"><b>Kelas Mengajar</b></span>
			    <p>Informasi pengajaran kelas terangkum disini</p>
			  </div>
			  <div class="card-action">
			    <a href="{{url('pengajar')}}" class="white-text">Selengkapnya</a>
			  </div>
			</div>
		</div>
		<div class="col s12 m6 l4">
			<div class="card pink darken-2">
			  <div class="card-content white-text">
			    <span class="card-title"><b>List Pelajaran</b></span>
			    <p>Anda bebas memilih pelajaran yang ingin diajarkan</p>
			  </div>
			  <div class="card-action">
			    <a href="{{url('pengajar/listpelajaran')}}" class="white-text">Selengkapnya</a>
			  </div>
			</div>
		</div>

	</div>    
</div>

  <div id="pengumuman" class="col s12">

    <div class="row">
         <table class="bordered highlight">
         	<tr><td>dd</td></tr>
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