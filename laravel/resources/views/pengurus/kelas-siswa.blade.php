@extends('pengurus.template-pengurus')

@section('content')

<div class="nav-scroller bg-white box-shadow">
   <ul class="nav nav-underline" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" href="{{url('pengurus/kelas')}}">{{$kelas->kelas}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Siswa</a>
        </li>
    </ul>
</div>

<br><br>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
<h1 class="h2"> Kelas {{$kelas->kelas}}</h1>
<div class="btn-toolbar mb-2 mb-md-0">
  <div class="btn-group mr-2">
    <button class="btn btn-sm btn-outline-secondary">Update</button>
    <button class="btn btn-sm btn-outline-secondary">Export</button>
  </div>
  <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
    <span data-feather="calendar"></span>
    This week
  </button>
</div>
</div>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white" style="padding: 0px">
    <li class="breadcrumb-item"><a href="{{url('pengurus/kelas/')}}">Tahun Ajaran {{$kelas->tahun_ajaran}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$kelas->kelas}}</li>
  </ol>
</nav>

@if(Session::has('success'))
  <div class="alert alert-info alert-dismissable">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      {{ Session::get('success') }}
  </div>
@endif

<table class="table table-hover table-sm" style="width:100%">
<thead>
    <tr>
        <th>#</th>
        <th>Nisn</th>
        <th>Nama</th>
        <th>Alamat</th>
    </tr>
</thead>
<?php $n=1;?>
<tbody>
    @foreach($siswakelass as $siswakelas)
    <tr>
        <td>{{$n++}}</td>
        <td>{{$siswakelas->nisn}}</td>
        <td>{{$siswakelas->nama_lengkap}}</td>
        <td>{{$siswakelas->alamat}}</td>
    </tr>
    @endforeach
</tbody>
</table>
</div>
    </div>

</div>

@endsection

@section('script')
@endsection
