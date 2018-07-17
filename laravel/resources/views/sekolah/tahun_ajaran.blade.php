@extends('sekolah.template-sekolah')

@section('content')
<div class="card">
<div class="card-header">
    <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
        <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detail</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tambah" role="tab" aria-controls="profile" aria-selected="false">Tambah</a>
        </li>
    </ul>
</div>

<div class="card-body">

@if(Session::has('success'))
    <div class="alert alert-info alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::get('success') }}
    </div>
@endif

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <h5 class="card-title">Tahun Ajaran</h5>
        <p class="card-text">ini adalah deskripsi tentang tahun ajaran</p>
<div class="table-responsive-sm">
<table id="example" class="table table-hover table-sm" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Tahun Ajaran</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php $n=1;?>
        <tbody>
            @foreach($ta as $ta)
            <tr>
                <td>{{$n++}}</td>
                <td>{{$ta->tahun_ajaran}}</td>
                <td><a href="" class="btn btn-outline-primary btn-sm">Lihat</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
    </div>

    <div class="tab-pane fade" id="tambah" role="tabpanel" aria-labelledby="profile-tab">
    <form method="POST" action="{{ route('tahunajaran.tambah') }}">
        {{ csrf_field() }}
        <div class="form-group row">
            <label for="tahunajaran" class="col-sm-4 col-form-label text-md-right">{{ __('Tahun Ajaran') }}</label>
            <div class="col-md-6">
                <input id="tahunajaran" type="text" class="form-control{{ $errors->has('tahunajaran') ? ' is-invalid' : '' }}" name="tahunajaran" value="{{ old('tahunajaran') }}" required autofocus>
                @if ($errors->has('tahunajaran'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('tahunajaran') }}</strong>
                    </span>
                @endif
            </div>
        </div>
            <div class="form-group row">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $('#example').DataTable();
</script>
@endsection
