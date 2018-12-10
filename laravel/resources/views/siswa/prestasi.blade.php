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
     <a href="#!" class="breadcrumb">Prestasi</a>
    </div>
  </div>
</div>
@endsection

@section('content')
<div id="portfolio" class="section white">
<div class="container">
  <div id="dasbord" class="col s12">
    <div class="row">
        @if(count($prestasis))
        @foreach($prestasis as $prestasi)
        <div class="col s12 m4">
          <div class="card">
            <div class="card-image">
              <img src="{{url('http://file.smawahasmodel.sch.id/prestasi/'.$prestasi->lampiran)}}">
              @if(!empty($prestasi->nama))<span class="card-title">Card Title</span>@endif
            </div>
             @if(!empty($prestasi->nama))
            <div class="card-content">
              <p>I am a very simple card. I am good at containing small bits of information.
              I am convenient because I require little markup to use effectively.</p>
            </div>
            @endif
            <div class="card-action">
              <form action="{{url('siswa/prestasi/siswa/delete/'.$prestasi->id)}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="id" value="{{$prestasi->id}}">
                    <button class="btn red" type="submit">Hapus</button>
              </form>
            </div>
          </div>
        </div>
        @endforeach
        @else
        Anda belum memiliki prestasi
        @endif
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
  });
</script>
@endsection