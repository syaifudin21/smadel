@extends('siswa.template-siswabaru')
@section('css')
    <link rel="stylesheet" href="{{asset('learn/css/summernote.css')}}">
    <!-- Include Editor style. -->
    <link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.5/css/froala_editor.min.css' rel='stylesheet' type='text/css' />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.5/css/froala_style.min.css' rel='stylesheet' type='text/css' />
     
    <!-- Include JS file. -->
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.5/js/froala_editor.min.js'></script>
@endsection
@section('content')
        
        <div class="media page-heading">
            <div class="media-body media-middle">
                <h1 class="h2">{{$forum->forum}}</h1>
                <?php 
                    $pengurus = App\Models\Pengurus::find($forum->id_pengurus);
                ?>
                <p class="text-muted small">by <a href="{{url('')}}">{{(!empty($pengurus))? $pengurus->nama: 'NN'}}</a> | {{$forum->updated_at->diffForHumans()}}</p>
            </div>
            <div class="media-right">
                <a href="#" class="btn btn-white btn-circle"><i class="material-icons">comment</i></a>
            </div>
        </div>

        @if(Session::has('success'))
            <div class="alert alert-info alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('success') }}
            </div>
        @endif
        @if(Session::has('gagal'))
            <div class="alert alert-danger alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('gagal') }}
            </div>
        @endif

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
                    $status = 'Siswa';
                    $foto = (!empty($dd))? 'http://file.smawahasmodel.sch.id/siswa/'.$dd->foto : 'NNs';
            }else{
                $nama = 'NN';
                $foto = 'NN';
            }

            $balaschats = App\Models\ForumChat::where('id_chat', $chat->id)->whereNotNull('id_chat')->get();

        ?>
        <div class="media">
            <div class="media-left text-center">
                <img src="{{$foto}}" alt="" class="img" width="40">
            </div>
            <div class="media-body">
                <div class="card card-body">
                    <p><a href="fixed-student-profile.html">{{$nama}}</a> <small class="text-muted"> ({{$status}}) - {{$chat->waktu->diffForHumans()}}</small></p>
                    {!!$chat->chat!!}
                    
                    <button type="button" class="btn btn-sm btn-white" data-toggle="modal" data-target="#balaschat"
                        data-id="{{$chat->id}}" 
                        ><i class="material-icons btn__icon--left">reply</i> Balas</button> 
                </div>

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
                        $namabb = 'NN';
                        $fotobb = 'NN';
                    }
                ?>
                <div class="media">
                    <div class="media-left text-center">
                        <img src="{{$fotobb}}" alt="" class="img" width="40">
                    </div>
                    <div class="media-body">
                        <div class="card card-body">
                            <p><a href="fixed-student-profile.html">{{$namabb}}</a> <small class="text-muted"> ({{$statusbb}}) - {{$balaschat->waktu->diffForHumans()}}</small></p>
                            {!!$balaschat->chat!!}
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
        @endforeach

        {{-- <ol class="breadcrumb">
            <li class="breadcrumb-item">Daftar</li>
            @if($siswa->status == 'Daftar')
            <li class="breadcrumb-item active">Verifikasi Data Siswa</li>
            @elseif($siswa->status == 'Verifikasi Siswa')
            <li class="breadcrumb-item">Verifikasi Data Siswa</li>
            <li class="breadcrumb-item active">Verifikasi Sekolah</li>
            @endif  
        </ol> --}}

         <div class="card">
            <form action="{{route('forum.chat')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id_forum" value="{{$forum->id}}">
                <div class="card-header">
                    <h4 class="card-title">Comment</h4>
                </div>
                <textarea id="summernote" name="chat"></textarea>
                <div class="card-body text-right">
                    <button class="btn btn-primary">Add comment</button>
                </div>
            </form>
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
      <form method="POST" action="{{ route('forum.chat') }}">
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
<script type="text/javascript">
  $(function() {
    $('#myEditor').froalaEditor({toolbarInline: false})
  });
  $('#balaschat').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var modal = $(this);
    console.log(id);
    modal.find('#id').val(id)
  })
</script>

    <script src="{{asset('learn/vendor/summernote.min.js')}}"></script>
    <script src="{{asset('learn/js/summernote.js')}}"></script>

@endsection