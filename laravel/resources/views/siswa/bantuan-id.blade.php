@extends('siswa.template-siswabaru')

@section('content')
        

        <h4 class="m-0">{{$bantuan->pertanyaan}}</h4>
        <p class="text-muted mb-heading">Beri penilaian tentang artikel ini apakah membantu anda</p>
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

        <h1 class="page-heading h2">{{$bantuan->judul}}</h1>
        <div class="row">
                <div class="card-body">
                    {!!$bantuan->isi!!}
                </div>
                @if(!empty($bantuan->lampiran))
                      <a href="{{url(env('FTP_BASE').'/bantuan/'.$bantuan->lampiran)}}"><img src="{{url(env('FTP_BASE').'/bantuan/'.$bantuan->lampiran)}}" class="img-thumbnails"></a>
                @endif
        </div>

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