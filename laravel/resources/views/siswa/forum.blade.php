@extends('siswa.template')
@section('warna','blue')

@section('css')
@endsection
@section('content')
        
    <div class="container">
        <div class="row">
        <h4 class="m-0">Pusat Bantuan</h4>
        <p class="text-muted mb-heading">Kami menyediakan solusi semoga dapat membantu</p>

        <div class="collection">
            @foreach($forums as $forum)
            <a href="{{url('siswa/forum/id/'.$forum->id)}}"  class="collection-item">{{$forum->forum}}</a>
            @endforeach
        </div>
    </div>
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