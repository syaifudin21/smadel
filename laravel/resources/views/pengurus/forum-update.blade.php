@extends('pengurus.template-pengurus')

@section('content')

<div class="nav-scroller bg-white box-shadow">
   <ul class="nav nav-underline" id="myTab" role="tablist">
        <li class="nav-item">
        <a class="nav-link" href="{{url('/pengurus/forum/'.$id)}}">{{$forum->forum}}</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" href="{{url('/pengurus/forum/edit/'.$id)}}">Update</a>
        </li>
    </ul>
</div>

<br><br>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
<h1 class="h2">Update Forum {{$forum->forum}}</h1>
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
    <li class="breadcrumb-item"><a href="{{url('pengurus/forum')}}">Forum</a></li>
    <li class="breadcrumb-item"><a href="{{url('pengurus/forum/'.$id)}}">{{$forum->forum}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Update</li>
  </ol>
</nav>

    <form method="POST" action="{{ route('forum.update') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <input type="hidden" name="id" value="{{$id}}">
        <div class="form-group row">
            <label for="forum" class="col-sm-4 col-form-label text-md-right">Forum</label>
            <div class="col-md-6">
                <input id="forum" type="text" class="form-control{{ $errors->has('forum') ? ' is-invalid' : '' }}" name="forum" value="{{ $forum->forum}}" required autofocus>
                @if ($errors->has('forum'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('forum') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="judul" class="col-sm-4 col-form-label text-md-right">Menu</label>
            <div class="col-md-6">
                <select class="form-control{{ $errors->has('menu') ? ' is-invalid' : '' }}" name="menu">
                    <option disabled>Pilih Menu</option>
                    <option {{($forum->menu=='Siswa Baru')? 'selected': ''}}>Siswa Baru</option>
                    <option {{($forum->menu=='Umum')? 'selected': ''}}>Umum</option>
                    <option {{($forum->menu=='Siswa')? 'selected': ''}}>Siswa</option>
                    <option {{($forum->menu=='Guru')? 'selected': ''}}>Guru</option>
                </select>
                @if ($errors->has('menu'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('menu') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        
            <div class="form-group row">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>

@endsection

@section('script')
@endsection
