@extends('pengurus.template-pengurus')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
<h1 class="h2"> Kelas {{$ta->tahun_ajaran}}</h1>
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
    <li class="breadcrumb-item"><a href="{{url('pengurus/kelas')}}">Tahun Ajaran {{$ta->tahun_ajaran}}</a></li>
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
        <th>Jurusan</th>
        <th>Kelas</th>
        <th>Wali Kelas</th>
        <th>Siswa</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
</thead>
<?php $n=1;?>
<tbody>
    @foreach($kelass as $kelas)
    <tr>
      <?php 
        $jurusan = App\Models\Jurusan::where('id', $kelas->id_jurusan)->select('jurusan')->first();
        $siswas = App\Models\Kelas_siswa::where('id_kelas', $kelas->id)->get();
      ?>
        <td>{{$n++}}</td>
        <td>{{(!empty($jurusan))? $jurusan->jurusan: 'Jurusan Hilang'}}</td>
        <td>{{$kelas->kelas}}</td>
        <td>{{$kelas->id_guru}}</td>
        <td>{{count($siswas)}}</td>
        <td>{{$kelas->status}}</td>
        <td>
          <a href="{{url('pengurus/kelas/id/'.$kelas->id)}}" class="btn btn-outline-primary btn-sm">Detail</a>
        </td>
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
