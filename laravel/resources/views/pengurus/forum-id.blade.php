@extends('pengurus.template-pengurus')

@section('content')

<div class="nav-scroller bg-white box-shadow">
   <ul class="nav nav-underline" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" href="{{url('pengurus/forum/'.$id)}}">{{$forum->forum}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('pengurus/forum/edit/'.$id)}}">Update</a>
        </li>
    </ul>
</div>

<br><br>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
<h1 class="h2">{{$forum->forum}} <small><small>({{$forum->menu}})</small></small></h1>
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
    <li class="breadcrumb-item"><a href="{{url('pengurus/forum')}}">Bantuan</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$forum->forum}}</li>
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


      @foreach($chats as $chat)
        <?php 
            if ($chat->id_pengurus != null) {
                    $dd = App\Models\Pengurus::find($chat->id_pengurus);
                    $nama = (!empty($dd))? $dd->nama : 'NN';
                    $status = 'Pengurus';
                    $foto = 'http://file.smawahasmodel.sch.id/user.png';
            }elseif ($chat->id_siswa != null) {
                    $dd = App\Models\Profil_siswa::where('nisn',$chat->id_siswa)->select('nama_lengkap','foto')->first();
                    $nama = (!empty($dd))? $dd->nama_lengkap : 'NNs';
                    $status = 'Pengurus';
                    $foto = (!empty($dd))? 'http://file.smawahasmodel.sch.id/siswa/'.$dd->foto : 'NNs';
            }else{
                $nama = 'NN';
                $foto = 'NN';
            }

            $balaschats = App\Models\ForumChat::where('id_chat', $chat->id)->whereNotNull('id_chat')->get();

        ?>
        <div class="media">
          <img class="mr-3" src="{{$foto}}" alt="Generic placeholder image" width="64px">
          <div class="media-body">
            <h5 class="mt-0">{{$nama}} <small class="text-muted"> ({{$status}}) - {{$chat->waktu->diffForHumans()}}</small></h5>
            {!!$chat->chat!!}
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#balaschat"
                        data-id="{{$chat->id}}" 
                        > Balas</button>

            @foreach($balaschats as $balaschat)
                <?php
                    if ($balaschat->id_pengurus != null) {
                            $bb = App\Models\Pengurus::find($balaschat->id_pengurus);
                            $namabb = (!empty($bb))? $bb->nama : 'NN';
                            $statusbb = 'Pengurus';
                            $fotobb = 'http://file.smawahasmodel.sch.id/user.png';
                    }elseif ($balaschat->id_siswa != null) {
                            $bb = App\Models\Profil_siswa::where('nisn',$balaschat->id_siswa)->select('nama_lengkap','foto')->first();
                            $namabb = (!empty($bb))? $bb->nama_lengkap : 'NNs';
                            $statusbb = 'Siswa';
                            $fotobb = (!empty($bb))? 'http://file.smawahasmodel.sch.id/siswa/'.$bb->foto : 'NNs';
                    }else{
                        $nama = 'NN';
                        $foto = 'NN';
                    }
                ?>
                <div class="media mt-3">
                  <a class="pr-3" href="#">
                    <img src="{{$fotobb}}" alt="Generic placeholder image" width="64px">
                  </a>
                  <div class="media-body">
                    <h5 class="mt-0">{{$nama}}<small class="text-muted"> ({{$statusbb}}) - {{$balaschat->waktu->diffForHumans()}}</small></h5>
                     
                    {!!$balaschat->chat!!}
                  </div>
                </div>
            @endforeach
          </div>
        </div>
        <hr>
        @endforeach

          <form method="POST" action="{{ route('chatstore.tambah') }}">
              {{ csrf_field() }}
              <input type="hidden" name="id_forum" value="{{$forum->id}}">
              <textarea id="chat" class="form-control{{ $errors->has('chat') ? ' is-invalid' : '' }} editor" name="chat" required autofocus rows="10">{{ old('chat') }}</textarea> 
              <button class="btn btn-primary" type="submit">Tambah Chat</button>
          </form>
    </div>
</div>

<div class="modal fade" id="balaschat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Balas Chat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('chatstore.tambah') }}">
        {{ csrf_field() }}
      <input type="hidden" name="id_forum" value="{{$forum->id}}">
      <input type="hidden" name="id_chat" id="id">
      <div class="modal-body">
                <textarea id="summernote" name="chat" class="form-control"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Balas</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('script')
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/adapters/jquery.js') }}"></script>
<script type="text/javascript">
  $('.editor').ckeditor();

  $('#balaschat').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var modal = $(this);
    console.log(id);
    modal.find('#id').val(id)
  })
</script>

@endsection
