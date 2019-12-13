@extends('siswa.template')
@section('warna','blue')

@section('css')
@endsection
@section('content')

<div class="container">
    <div class="row">

        <br><br>
                <h4>{{$forum->forum}}</h4>
                <?php 
                    $pengurus = App\Models\Pengurus::find($forum->id_pengurus);
                ?>
                <p class="text-muted small">by <a href="{{url('')}}">{{(!empty($pengurus))? $pengurus->nama: 'NN'}}</a> | {{$forum->updated_at->diffForHumans()}}</p>
    </div>
    <div class="row">
        @foreach($chats as $chat)
         <?php 
            if ($chat->id_pengurus != null) {
                    $dd = App\Models\Pengurus::find($chat->id_pengurus);
                    $nama = (!empty($dd))? $dd->nama : 'NN';
                    $status = 'Pengurus';
                    $foto = env('FTP_BASE').'/user.png';
            }elseif ($chat->id_siswa != null) {
                    $dd = App\Models\Profil_siswa::where('nisn',$chat->id_siswa)->select('nama_lengkap','foto')->first();
                    $nama = (!empty($dd))? $dd->nama_lengkap : 'NNs';
                    $status = 'Siswa';
                    $foto = (!empty($dd))? env('FTP_BASE').'/siswa/'.$dd->foto : 'NNs';
            }else{
                $nama = 'NN';
                $foto = 'NN';
            }

            $balaschats = App\Models\ForumChat::where('id_chat', $chat->id)->whereNotNull('id_chat')->get();

        ?>
        <div class="col s1">
            <img src="{{$foto}}" alt="" class="img" width="40">
        </div>
        <div class="col s11"> <b>{{$nama}}</b> {{$chat->waktu->diffForHumans()}}<br> <small>{{$status}} - {{$chat->waktu->diffForHumans()}}</small>
            <br>{!!$chat->chat!!}
            <br><br>
             @foreach($balaschats as $balaschat)
                <?php
                    if ($balaschat->id_pengurus != null) {
                            $bb = App\Models\Pengurus::find($balaschat->id_pengurus);
                            $namabb = (!empty($bb))? $bb->nama : 'NN';
                            $statusbb = 'Pengurus';
                            $fotobb = env('FTP_BASE').'/user.png';
                    }elseif ($balaschat->id_siswa != null) {
                            $bb = App\Models\Profil_siswa::where('nisn',$balaschat->id_siswa)->select('nama_lengkap','foto')->first();
                            $namabb = (!empty($bb))? $bb->nama_lengkap : 'NNs';
                            $statusbb = 'Siswa';
                            $fotobb = (!empty($bb))? env('FTP_BASE').'/siswa/'.$bb->foto : 'NNs';
                    }else{
                        $namabb = 'NN';
                        $fotobb = 'NN';
                    }
                ?>
            <div class="row">
                <div class="col s1">
                    <img src="{{$fotobb}}" alt="" class="img" width="40">
                </div>
                <div class="col s10"> <b>{{$namabb}}</b> <br> <small>{{$statusbb}} - {{$balaschat->waktu->diffForHumans()}}</small><br>
                    {!!$chat->chat!!}
                </div>
            </div>
            @endforeach
            <div class="row">
                <form class="col s12" method="POST" action="{{ route('forum.chat') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_forum" value="{{$forum->id}}">
                    <input type="hidden" name="id_chat" value="{{$chat->id}}">
                    <div class="row">
                         <div class="input-field col s12">
                          <input id="last_name" type="text" class="validate" name="chat">
                          <label for="last_name">Balas Komentar</label>
                        </div>
                        <div class="col s12" style="text-align: right;">
                       <button class="btn-flat">Balas <i class="material-icons left">send</i></button>
                       </div>
                    </div>
                </form>
            </div>
        </div>


        @endforeach

        </div>
            <form action="{{route('forum.chat')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id_forum" value="{{$forum->id}}">
               
                <div class="card-panel row">
                <div class="input-field col s12">
                  <textarea id="textarea1" class="materialize-textarea" name="chat"></textarea>
                  <label for="textarea1">Komentar</label>
                </div>
                <div class="col s12" style="text-align: right;">
                   <button class="btn blue" >Tambah</button>
                </div>
              </div>
            </form>
    </div>
</div>
        
        



@endsection

@section('script')
@endsection