@extends('siswa.template')
@section('warna','blue')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/event.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/materialize-stepper.min.css')}}">

@endsection

@section('menu')
<div class="categories-wrapper light-blue darken-3" style="height: 48px">
  <div class="categories-container">
    <div class="container">
      <ul class="tabs">
        <li class="tab col s3"><a class="{{($siswa->status=='Verifikasi Admin')? 'active': ''}}"href="#dasbord">Dasbord</a></li>
        <li class="tab col s3"><a  href="#prestasi">Prestasi</a></li>
        <li class="tab col s3"><a class="{{($siswa->status=='Daftar')? 'active': ''}}" href="#profil">Profil Saya</a></li>
        <li class="tab col s3"><a href="#pengumuman">Pengumuman</a></li>
      </ul>
    </div>
  </div>
</div>
@endsection

@section('content')

<div id="portfolio" class="section white">


<div class="container">

   @if($siswa->status == 'Daftar')
       
        <?php 
          if ($siswa->status== 'Verifikasi Siswa') {
            $progress = 75;
          }if ($siswa->status== 'Verifikasi Admin') {
            $progress = 100;
          }elseif ($siswa->status== 'Daftar') {
            $progress = 50;
          }
        ?>

       <h4>Progress Pendaftaran Anda </h4>
        <p>Silahkan Melengkapi Pendaftaran Anda. Lakukan Step by step diabwah ini</p>

                <div class="progress">
                    <div class="determinate" role="progressbar" style="width: {{$progress}}%;"></div>
                </div>
        @endif

  <div id="dasbord" class="col s12">
    @if($siswa->status == 'Verifikasi Siswa')
    <center><img src="http://smadel.lc/images/standar/sekolah.png" width="30%"><br><br>
      <p>Silahkan mendatangi sekolah untuk melakukan verifikasi selanjutnya</p></center>
    @elseif($siswa->status=='Verifikasi Admin')
    <ul class="collapsible" data-collapsible="expandable">
        <li>
          <div class="collapsible-header {{(count($prestasis))? '': 'active'}}" ><i class="material-icons">filter_drama</i>Prestasi</div>
          <div class="collapsible-body">
            <form action="{{route('prestasi.siswa.tambah')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
            <input type="hidden" name="id_profil_siswa" value="{{$siswa->id}}">

            <span>Tambahkan prestasi yang pernah didapatkan pada sekelohan yang sebelumnya</span>

            <div class="file-field input-field">
              <div class="btn blue">
                <span>Upload</span>
                <input type="file" name="lampiran">
              </div>
              @if ($errors->has('lampiran'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('lampiran') }}</strong>
                  </span>
              @endif
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Upload Hasil Scan">
              </div>
            </div>
            
            <div class="row">
            <div class="col s10"><span>Kami Sangat Menghargai Prestasi Calon Siswa. Prestasi yang telah diperoleh pada jenjang sekolah sebelumnya siswa dapat dimasukkan disini</span></div>
            <button class="btn red col s2" type="submit">Tambah</button>
            </div>

            </form>
          </div>
        </li>
        <li>
          <div class="collapsible-header {{(!empty($prestasis) && empty($siswa->minat_jurusan))? 'active': ''}}" ><i class="material-icons">place</i>Jurusan</div>
          <div class="collapsible-body"><span>Menentukan jurusan atas dasar niat dan keinginan siswa. Silahkan centang pada pilihan jurusan yang diminati</span>

            <form action="{{route('jurusan.siswa.konfirmasi')}}" method="post">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
                @foreach($jurusans as $jurusan)
                <?php 
                    $namajurusan = App\Models\Jurusan::find($jurusan->id_jurusan);
                ?>

                <p>
                  <input type="checkbox" id="invalidCheck{{$jurusan->id_jurusan}}" name="jurusan[]" value="{{$jurusan->id_jurusan}}" {{(preg_match("/".$jurusan->id_jurusan."/i", $siswa->minat_jurusan))?'checked': ''}}/>
                  <label  for="invalidCheck{{$jurusan->id_jurusan}}">{{(!empty($namajurusan))? $namajurusan->jurusan: ''}}</label>
                </p>
                @endforeach
                <div class="row">
                <div class="col s8"><span>Kami memerlukan data minat siswa untuk menentukan jurusan, data ini akan dijadikan pembanding kemampuan dan peminatan guna memperoleh data terbaik</span></div>
                <button class="btn red col s4" type="submit">Konfirmasi Minat Jurusan</button>
                </div>
              </form>

          </div>
        </li>
        <li>
          <div class="collapsible-header {{(!empty($prestasis) && !empty($siswa->minat_jurusan))? 'active': ''}}"><i class="material-icons">whatshot</i>Jadwal Test Ujian Masuk</div>
          <div class="collapsible-body"><span>
            Pelaksanaan Test Ujian Masuk yang akan dilakukan serentak
          </span>
             <div class="collection">
                <a href="#!" class="collection-item">
                    {{hari_tanggal(date('Y-m-d-G-i-s', strtotime($ta->tgl_test)))}}
                </a>
              </div>
          </div>
        </li>
    </ul>
    @endif

  </div>


  <div id="prestasi" class="col s12">
     
     <div class="row">
        @if(count($prestasis))
        @foreach($prestasis as $prestasi)
        <div class="col s12 m4">
          <div class="card">
            <div class="card-image">
              <img src="{{url(env('FTP_HOST').'/prestasi/'.$prestasi->lampiran)}}">
              @if(!empty($prestasi->nama))<span class="card-title">Card Title</span>@endif
            </div>
             @if(!empty($prestasi->nama))
            <div class="card-content">
              <p>I am a very simple card. I am good at containing small bits of information.
              I am convenient because I require little markup to use effectively.</p>
            </div>
            @endif
            <div class="card-action">
              <form action="{{url('siswa/prestasi/siswa/delete/'.$prestasi->id)}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="id" value="{{$prestasi->id}}">
                    <button class="btn red" type="submit">Hapus</button>
              </form>
            </div>
          </div>
        </div>
        @endforeach
        @else
        Anda belum melakukan upload prestasi
        @endif
      </div>

  </div>

  <div id="profil" class="col s12">
   <div class="row">

@if($siswa->status == 'Daftar')
<div class="col s12">
<p>Anda dapat melakukan update profil (tombol hijau) jika dirasa data yang dimasukkan kurang tepat. Lakukan konfirmasi data (tombol merah) jika data dirasa sudah tidak ada yang perlu dibenahi. Anda tidak akan bisa merubah profil anda setelah anda mengkonfirmasi data profil anda</p>     <br>
</div>
@endif

<form class="col s12" action="{{route('siswa.profil.update')}}" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }}
      {{ method_field('PUT') }}

      <?php 
       $siswadisabled = ($siswa->status == 'Daftar')? '': 'disabled';
      ?>
      <div class="row">
        <div class="input-field col m5 s12">
          <input id="first_name" type="text" class="validate" name="nama_lengkap" value="{{ $siswa->nama_lengkap}}" required {{$siswadisabled}}>
          <label for="first_name">Nama Lengkap</label>
           {{-- @if ($errors->has('nama_lengkap'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('nama_lengkap') }}</strong>
                </span>
            @endif --}}
        </div>
        <div class="input-field col m4 s12">
          <input id="tgl" type="text" class="validate" name="tgl" value="{{$siswa->tgl }}" {{$siswadisabled}}>
          <label for="tgl">Tempat, Tanggal Lahir</label>
        </div>
        <div class="input-field col m3 s12">
          <input id="nim" type="number" class="validate" name="nisn" value="{{ $siswa->nisn }}" {{$siswadisabled}}>
          <label for="nim">Nomor Induk Siswa Nasional</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col m3 s12">
            <select name="jk" {{$siswadisabled}}>
              <option {{($siswa->jk=='Laki-laki')? 'selected': ''}}>Laki-laki</option>
              <option {{($siswa->jk=='Perempuan')? 'selected': ''}}>Perempuan</option>
            </select>
            <label>Jenis Kelamin</label>
        </div>
        <div class="input-field col m3 s12">
            <select name="agama" {{$siswadisabled}}>
              <option {{($siswa->agama=='Islam')? 'selected': ''}}>Islam</option>
              <option {{($siswa->agama=='Protestan')? 'selected': ''}}>Protestan</option>
              <option {{($siswa->agama=='Katolik')? 'selected': ''}}>Katolik</option>
              <option {{($siswa->agama=='Hindu')? 'selected': ''}}>Hindu</option>
              <option {{($siswa->agama=='Budha')? 'selected': ''}}>Budha</option>
              <option {{($siswa->agama=='Kong Hu Cu')? 'selected': ''}}>Kong Hu Cu</option>
            </select>
            <label>Agama</label>
        </div>
        <div class="input-field col m3 s6">
          <input id="tinggi" type="number" class="validate" name="tinggi" value="{{ $siswa->tinggi }}" {{$siswadisabled}}>
          <label for="tinggi">Tinggi</label>
        </div>
        <div class="input-field col m3 s6">
          <input id="last_name" type="number" class="validate" name="berat" value="{{ $siswa->berat }}" {{$siswadisabled}}>
          <label for="last_name">Berat</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col m3 s12">
          <input id="hp" type="number" class="validate" name="nomor_hp" value="{{ $siswa->nomor_hp }}" {{$siswadisabled}}>
          <label for="hp">Nomor Hp</label>
        </div>
        <div class="input-field col m9 s12">
          <input id="jalan" type="text" class="validate" name="alamat" value="{{ $siswa->alamat }}" {{$siswadisabled}}>
          <label for="jalan">Jalan</label>
        </div>
      </div>
      <div class="row">
          <div class="input-field col m3 s12">
            <select name="tinggal" {{$siswadisabled}}>
              <option value="" disabled>Pilih Tinggal </option>
              <option {{($siswa->tinggal=='Orang Tua')? 'selected': ''}}>Orang Tua</option>
              <option {{($siswa->tinggal=='Kost')? 'selected': ''}}>Kost</option>
              <option {{($siswa->tinggal=='Asrama')? 'selected': ''}}>Asrama</option>
              <option {{($siswa->tinggal=='Lainnya')? 'selected': ''}}>Lainnya</option>
            </select>
            <label>Tinggal Bersama</label>
          </div>
          <div class="input-field col m3 s12">
            <select name="transportasi" {{$siswadisabled}}>
              <option value="" disabled>Pilih Transpoartasi</option>
              <option {{($siswa->tinggal=='Sepeda Motor')? 'selected': ''}}>Sepeda Motor</option>
              <option {{($siswa->tinggal=='Jalan Kaki')? 'selected': ''}}>Jalan Kaki</option>
              <option {{($siswa->tinggal=='Transportasi Umum')? 'selected': ''}}>Transportasi Umum</option>
              <option {{($siswa->tinggal=='Lainnya')? 'selected': ''}}>Lainnya</option>
            </select>
            <label>Transportasi ke Sekolah</label>
          </div>
          <div class="input-field col m3 s12">
            <input id="tempu" type="text" class="validate" name="tempu_sekolah" value="{{$siswa->tempu_sekolah}}" {{$siswadisabled}}>
            <label for="tempu">Waktu Tempu ke Sekolah</label>
          </div>
          <div class="input-field col m3 s12">
            <input id="jarak" type="text" class="validate" name="jarak_sekolah" value="{{ $siswa->jarak_sekolah }}" {{$siswadisabled}}>
            <label for="jarak">Jarak ke Sekolah</label>
          </div>
      </div>
        <div class="row">
          <div class="col s12">
            <h5>Keterangan Orang Tua</h5>
          </div>
        </div>
        <div class="row">
          <div class="input-field col m3 s12">
            <input id="nama_ayah" type="text" class="validate" name="nama_ayah" value="{{ $siswa->nama_ayah }}" {{$siswadisabled}}>
            <label for="nama_ayah">Nama Ayah</label>
          </div>
          <div class="input-field col m3 s12">
            <input id="tgl_ayah" type="text" class="validate" name="tgl_ayah" value="{{ $siswa->tgl_ayah }}" {{$siswadisabled}}>
            <label for="tgl_ayah">Tempat Tanggal Lahir Ayah</label>
          </div>
          <div class="input-field col m2 s12">
            <input id="pekerjaan_ayah" type="text" class="validate" name="pekerjaan_ayah" value="{{ $siswa->pekerjaan_ayah }}" {{$siswadisabled}}>
            <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
          </div>
          <div class="input-field col m2 s12">
            <input id="pendidikan_ayah" type="text" class="validate" name="pendidikan_ayah" value="{{$siswa->pendidikan_ayah }}" {{$siswadisabled}}>
            <label for="pendidikan_ayah">Pendidikan Terakhir</label>
          </div>
          <div class="input-field col m2 s12">
            <input type="checkbox" class="filled-in" id="filled-in-box" name="keterangan_ayah" value="Hidup" {{($siswa->keterangan_ayah=='Hidup')? 'checked': ''}} {{$siswadisabled}}/>
            <label for="filled-in-box">Masih Hidup</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col m3 s12">
            <input id="nama_ibu" type="text" class="validate" name="nama_ibu" value="{{ $siswa->nama_ibu }}" {{$siswadisabled}}>
            <label for="nama_ibu">Nama Ibu</label>
          </div>
          <div class="input-field col m3 s12">
            <input id="tgl_ayah" type="text" class="validate" name="tgl_ibu" value="{{ $siswa->tgl_ibu }}" {{$siswadisabled}}>
            <label for="tgl_ibu">Tempat Tanggal Lahir Ibu</label>
          </div>
          <div class="input-field col m2 s12">
            <input id="pekerjaan_ibu" type="text" class="validate" name="pekerjaan_ibu" value="{{ $siswa->pekerjaan_ibu }}" {{$siswadisabled}}>
            <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
          </div>
          <div class="input-field col m2 s12">
            <input id="pendidikan_ibu" type="text" class="validate" name="pendidikan_ibu" value="{{ $siswa->pendidikan_ibu}}" {{$siswadisabled}}>
            <label for="pendidikan_ibu">Pendidikan Terakhir</label>
          </div>
          <div class="input-field col m2 s12">
            <input type="checkbox" class="filled-in" id="filled-in-box" name="keterangan_ibu" value="Hidup" {{($siswa->keterangan_ayah=='Hidup')? 'checked': ''}}  {{$siswadisabled}}/>
            <label for="filled-in-box">Masih Hidup</label>
          </div>
        </div>

        <div class="row">
        <div class="input-field col m3 s12">
          <input id="nomor_hp_ortu" type="number" class="validate" name="nomor_hp_ortu" value="{{ $siswa->nomor_hp_ortu }}" {{$siswadisabled}}>
          <label for="nomor_hp_ortu">Nomor Hp Orang Tua</label>
        </div>
        <div class="input-field col m9 s12">
          <input id="ortu_jln" type="text" class="validate" name="alamat_ortu" value="{{ $siswa->alamat_ortu }}" {{$siswadisabled}}>
          <label for="ortu_jln">Alamat Orang Tua</label>
        </div>
      </div>

        <div class="row">
          <div class="col s12">
            <h5>Keterangan Sekolah Asal</h5>
          </div>
        </div>
        <div class="row">
          <div class="input-field col m4 s12">
            <input id="sekolah_asal" type="text" class="validate" name="sekolah_asal" value="{{  $siswa->sekolah_asal }}" {{$siswadisabled}}>
            <label for="sekolah_asal">Nama Sekolah Sebelumnya (SMP Sederajat)</label>
          </div>
          <div class="input-field col m5 s12">
            <input id="sekolah_alamat" type="text" class="validate" name="sekolah_alamat" value="{{  $siswa->sekolah_alamat }}" {{$siswadisabled}}>
            <label for="sekolah_alamat">Alamat Sekolah SMP</label>
          </div>
          <div class="input-field col m3 s12">
              <input id="sekolah_alamat" type="text" class="validate" name="sekolah_angkatan" value="{{  $siswa->sekolah_angkatan }}" {{$siswadisabled}}>
            <label for="sekolah_alamat">Angkatan / Tahun Kelulusan</label>
          </div>
        </div>

        <div class="row">
          <div class="col s12">
            <h5>Lampiran</h5>
          </div>
        </div>
        <div class="row">
          <div class="col m2 s12 valign-wrapper">
            <img class="materialboxed" src="{{url(env('FTP_HOST').'/siswa/'.$siswa->foto)}}" width="100%" id="foto">
          </div>
          <div class="col m4 s12">
             <div class="file-field input-field">
                <div class="btn btn-flat">
                  <span>Foto</span>
                  <input type="file" name="foto" onchange="fotoURl(this)" value="{{ old('foto') }}"  {{$siswadisabled}}>
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" placeholder="Upload Foto" {{$siswadisabled}}>
                </div>
              </div>
          </div>
          <div class="col m2 s12 valign-wrapper">
            <img class="materialboxed" src="{{url(env('FTP_HOST').'/siswa/'.$siswa->ijazah)}}" width="100%" id="ijazah">
          </div>
          <div class="col m4 s12">
            <div class="file-field input-field">
              <div class="btn btn-flat">
                <span>Ijazah</span>
                <input type="file" name="ijazah"  onchange="fileijazah(this)"  {{$siswadisabled}}>
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Upload Ijazah / Raport Smt 1-5" value="{{ old('ijazah') }}" {{$siswadisabled}}>
              </div>
            </div>
          </div>
      </div>

      <br><br><br>
      <div class="row">
        @if($siswa->status== 'Daftar')
        <div class="col s6">
          Lakukan konfirmasi data yang sebelumnya anda masukkan guna untuk melakukan proses pendaftaran selanjutnya
        </div>
        <div class="col s1">
        </div>
        <div class="col s5">
          <button class="btn" type="submit">Update</button>
          <a href="{{url('siswa/verifikasi/nisn/'.$siswa->nisn)}}" class="btn red darken-3">Konfirmasi Data</a>
        </div>
        @else
        <div class="col s12">
          Anda tidak dapat lagi mengubah data anda. Lakukan perubahan dengan melaporkan ke Admin
        </div>
        @endif
      </div>
      </div>
    </form>


   </div>
  </div>

  <div id="pengumuman" class="col s12">
    <div class="container">
    <div class="row">
        <table class="bordered highlight">
           @foreach($pengumumans as $pengumuman)
                <tr>
                    <?php 
                        if ($pengumuman->status_user == 'pengurus') {
                            $dd = App\Models\Pengurus::find($pengumuman->id_user);
                                $nama = (!empty($dd))? $dd->nama : 'NN';
                        }elseif ($pengumuman->status_user == 'guru') {
                            $dd = App\Models\Pengajars::find($pengumuman->id_user);
                                $nama = (!empty($dd))? $dd->nama : 'NN';
                        }elseif ($pengumuman->status_user == 'siswa') {
                            $dd = App\Models\Siswas::find($pengumuman->id_user);
                                $nama = (!empty($dd))? $dd->nama : 'NN';
                        }else{
                            $nama = 'NN';
                        }
                    ?>
            <td>
              <h5>{{$pengumuman->nama_pengumuman}}</h5>
               <span><i class="material-icons left">date_range</i>{{hari_tanggal_indo_waktu(date('Y-m-d-G-i-s', strtotime($pengumuman->updated_at)), true)}} | {{$pengumuman->status_user}} - {{$nama}}</span>
              <p>{{$pengumuman->isi}}</a>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>


</div>
</div>
@endsection

@section('script')

<script type="text/javascript" src="{{asset('js/materialize-stepper.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.collapsible').collapsible();
    $('select').material_select();
  });

function anyThing() {
  setTimeout(function(){ $('.stepper').nextStep(); }, 1500);
}
$(function(){
   $('.stepper').activateStepper();
});

$(document).ready(function(){
  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: [], // Creates a dropdown of 15 years to control year,
    today: 'Today',
    clear: 'Clear',
    close: 'Ok',
    closeOnSelect: false // Close upon selecting a date,
  });
});

function fotoURl(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#foto').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
  }
}
function fileijazah(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#ijazah').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
  }
}

</script>
@endsection