@extends('sekolah.template-sekolah')

@section('content')

<div class="nav-scroller bg-white box-shadow">
   <ul class="nav nav-underline" id="myTab" role="tablist">
        <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Bab Mata Pelajaran</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tambah" role="tab" aria-controls="profile" aria-selected="false">Tambah</a>
        </li>
    </ul>
</div>

<br><br>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
<h1 class="h2">Mata Pelajaran {{$mapel->mapel}}</h1>
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
    <li class="breadcrumb-item active" aria-current="page"><a href="{{url('sekolah/kurikulum')}}">Kurikulum</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{url('sekolah/jurusan/'.$tk->id_kurikulum)}}">Jurusan</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{url('sekolah/tk/'.$tk->id_jurusan)}}">Tingkat Kelas {{$tk->tingkat_kelas}}</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{url('sekolah/mapel/'.$mapel->id)}}">Mata Pelajaran</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$mapel->mapel}}</li>
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
                <th>Bab</th>
                <th>Topik</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php $n=1;?>
        <tbody>
            @foreach($babs as $bab)
                <tr>
                    <td>{{$n++}}</td>
                    <td>{{$bab->bab}}</td>
                    <td>{{$bab->topik}}</td>
                    <form method="POST" action="{{url('sekolah/mapel/bab/delete/'.$bab->id)}}">
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#exampleModalupdate"
                                    data-bab="{{$bab->bab}}" 
                                    data-topik="{{$bab->topik}}" 
                                    data-id="{{$bab->id}}"
                                    >Update</button> 
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i> Delete </button>
                    </td>
                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
    </div>

    <div class="tab-pane fade" id="tambah" role="tabpanel" aria-labelledby="profile-tab">
    <form method="POST" action="{{ route('bab.tambah') }}">
        {{ csrf_field() }}
        <input type="hidden" name="id_mapel" value="{{$mapel->id}}">
        <div class="form-group row">
            <label for="bab" class="col-sm-4 col-form-label text-md-right">Bab</label>
            <div class="col-md-6">
                <input id="bab" type="text" class="form-control{{ $errors->has('bab') ? ' is-invalid' : '' }}" name="bab" value="{{ old('bab') }}" required autofocus>
                @if ($errors->has('bab'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('bab') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="topik" class="col-sm-4 col-form-label text-md-right">Topik</label>
            <div class="col-md-6">
                <input id="topik" type="text" class="form-control{{ $errors->has('topik') ? ' is-invalid' : '' }}" name="topik" value="{{ old('topik') }}" autofocus>
                @if ($errors->has('topik'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('topik') }}</strong>
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

<div class="modal fade" id="exampleModalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('bab.update') }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
      <input type="hidden" name="id" id="id">
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Bab</label>
            <input type="text" class="form-control" name="bab" id="bab">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Topik</label>
            <input type="text" class="form-control" name="topik" id="topik">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
  $('#exampleModalupdate').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var bab = button.data('bab');
    var topik = button.data('topik');
    var modal = $(this);
    console.log(id);
    modal.find('#bab').val(bab)
    modal.find('#topik').val(topik)
    modal.find('#id').val(id)
  })
</script>
@endsection
