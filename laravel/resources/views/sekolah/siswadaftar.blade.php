@extends('sekolah.template-sekolah')

@section('content')

<div class="nav-scroller bg-white box-shadow">
   <ul class="nav nav-underline" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" id="jadwal-tab" href="{{url('sekolah/kelas/'.$id_ta)}}" >Tahun Ajaran</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="jadwal-tab" href="{{url('sekolah/tahunajaran/id/'.$id_ta)}}" >Update Tahun Ajaran</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" id="jadwal-tab" href="{{url('sekolah/tahunajaran/siswadaftar/'.$id_ta)}}" >Siswa Daftar</a>
        </li>
    </ul>
</div>

<br><br>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
<h1 class="h2">Pendaftar</h1>
<div class="btn-toolbar mb-2 mb-md-0">
  <div class="btn-group mr-2">
    <button class="btn btn-sm btn-outline-secondary">Share</button>
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
    <li class="breadcrumb-item active" aria-current="page"><a href="{{url('sekolah/kelas/'.$id_ta)}}">Tahun Ajaran</a></li>
    <li class="breadcrumb-item active" aria-current="page">Daftar Siswa</li>
  </ol>
</nav>


@if(Session::has('success'))
    <div class="alert alert-info alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::get('success') }}
    </div>
@endif

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        
<div class="table-responsive-sm">
<table id="example" class="table table-hover table-sm" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Nisn</th>
                <th>Nama Lengkap</th>
                <th>Sekolah Asal</th>
                <th>Nama Ayah</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php $n=1;?>
        <tbody>
            @foreach($siswas as $siswa)
            <tr>
                <td>{{$n++}}</td>
                <td>{{$siswa->nisn}}</td>
                <td>{{$siswa->nama_lengkap}}</td>
                <td>{{$siswa->sekolah_asal}}</td>
                <td>{{$siswa->nama_ayah}}</td>
                <td>{{$siswa->status}}</td>
                <td><a href="{{url('sekolah/tahunajaran/siswadaftar/profil/'.$siswa->id)}}" class="btn btn-info btn-sm">Lihat</a></td>
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
