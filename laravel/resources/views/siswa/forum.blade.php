@extends('siswa.template-siswabaru')

@section('content')
        

        <h4 class="m-0">Pusat Bantuan</h4>
        <p class="text-muted mb-heading">Kami menyediakan solusi semoga dapat membantu</p>
        <hr>

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

        <ol>
            @foreach($forums as $forum)
            <a href="{{url('siswa/forum/id/'.$forum->id)}}"><li>{{$forum->forum}}</li></a>
            @endforeach
        </ol>

        {{-- <ol class="breadcrumb">
            <li class="breadcrumb-item">Daftar</li>
            @if($siswa->status == 'Daftar')
            <li class="breadcrumb-item active">Verifikasi Data Siswa</li>
            @elseif($siswa->status == 'Verifikasi Siswa')
            <li class="breadcrumb-item">Verifikasi Data Siswa</li>
            <li class="breadcrumb-item active">Verifikasi Sekolah</li>
            @endif  
        </ol> --}}

        


@endsection

@section('script')

@endsection