@extends('siswa.template-siswabaru')

@section('content')
        

        @if($siswa->status == 'Daftar')
        <h4 class="m-0">Progress Pendaftaran Anda</h4>
        <p class="text-mutexd mb-heading">Silahkan Melengkapi Pendaftaran Anda. Lakukan Step by step diabwah ini</p>

        <?php 
          if ($siswa->status== 'Verifikasi Siswa') {
            $progress = 90;
          }if ($siswa->status== 'Verifikasi Admin') {
            $progress = 100;
          }elseif ($siswa->status== 'Daftar') {
            $progress = 75;
          }
        ?>

        <div class="card">
            <div class="card-body">
                <div class="progress" style="height: 20px;">
                    <div class="progress-bar" role="progressbar" style="width: {{$progress}}%;" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100">{{$progress}}%</div>
                </div>
            </div>
        </div>
        @endif

        <ol class="breadcrumb">
            <li class="breadcrumb-item">Daftar</li>
            @if($siswa->status == 'Daftar')
            <li class="breadcrumb-item active">Verifikasi Data Siswa</li>
            @elseif($siswa->status == 'Verifikasi Siswa')
            <li class="breadcrumb-item">Verifikasi Data Siswa</li>
            <li class="breadcrumb-item active">Verifikasi Sekolah</li>
            @elseif($siswa->status == 'Verifikasi Admin')
            <li class="breadcrumb-item">Verifikasi Data Siswa</li>
            <li class="breadcrumb-item">Verifikasi Sekolah</li>
            <li class="breadcrumb-item active">Pendaftaran Selesai</li>
            @endif  
        </ol>

        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissable">
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

        @if($siswa->status == 'Daftar')
        <h1 class="page-heading h2">Selamat Datang Siswa Baru di {{$profil->nama_sekolah}}</h1>
          <div class="card card-stats-primary">
              <div class="card-body">
                  Pendaftaran anda telah kami terima, silahkan cek kembali data anda dan lakukan ferifikasi data anda di bawah ini jika sudah benar.
              </div>
          </div>

          <h5>Profil Anda</h5>
          <form class="col s12" action="{{route('siswa.profil.update')}}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
              <div class="form-group row">
                  <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{$siswa->nama_lengkap}}" placeholder="Nama Lengkap">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="tgl" class="col-sm-3 col-form-label">Tempat Tanggal Lahir</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="tgl" name="tgl" value="{{$siswa->tgl}}" placeholder="Tempat Tanggal Lahir">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="nama_lengkap" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                  <div class="col-sm-9">
                      <select name="jk" class="form-control" id="jk">
                        <option {{($siswa->jk=='Laki-laki')? 'selected': ''}}>Laki-laki</option>
                        <option {{($siswa->jk=='Perempuan')? 'selected': ''}}>Perempuan</option>
                      </select>   
                  </div>
              </div>
              <div class="form-group row">
                  <label for="nisn" class="col-sm-3 col-form-label">NISN</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="nisn" name="nisn" value="{{$siswa->nisn}}" placeholder="Nisn">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="agama" class="col-sm-3 col-form-label">Agama</label>
                  <div class="col-sm-9">
                      <select name="agama" class="form-control" id="agama">
                        <option {{($siswa->agama=='Islam')? 'selected': ''}}>Islam</option>
                        <option {{($siswa->agama=='Protestan')? 'selected': ''}}>Protestan</option>
                        <option {{($siswa->agama=='Katolik')? 'selected': ''}}>Katolik</option>
                        <option {{($siswa->agama=='Hindu')? 'selected': ''}}>Hindu</option>
                        <option {{($siswa->agama=='Budha')? 'selected': ''}}>Budha</option>
                        <option {{($siswa->agama=='Kong Hu Cu')? 'selected': ''}}>Kong Hu Cu</option>
                      </select>   
                  </div>
              </div>
              <div class="form-group row">
                  <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="alamat" name="alamat" value="{{$siswa->alamat}}" placeholder="Alamat">
                  </div>
              </div>
               <div class="form-group row">
                  <label for="tinggal" class="col-sm-3 col-form-label">Tinggal Bersama</label>
                  <div class="col-sm-9">
                      <select name="tinggal" class="form-control" id="tinggal">
                        <option {{($siswa->tinggal=='Orang Tua')? 'selected': ''}}>Orang Tua</option>
                        <option {{($siswa->tinggal=='Kost')? 'selected': ''}}>Kost</option>
                        <option {{($siswa->tinggal=='Asrama')? 'selected': ''}}>Asrama</option>
                        <option {{($siswa->tinggal=='Lainnya')? 'selected': ''}}>Lainnya</option>
                      </select>  
                  </div>
              </div>
               <div class="form-group row">
                  <label for="transportasi" class="col-sm-3 col-form-label">Transportasi ke Sekolah</label>
                  <div class="col-sm-9">
                      <select name="transportasi" class="form-control" id="transportasi">
                        <option {{($siswa->tinggal=='Sepeda Motor')? 'selected': ''}}>Sepeda Motor</option>
                        <option {{($siswa->tinggal=='Jalan Kaki')? 'selected': ''}}>Jalan Kaki</option>
                        <option {{($siswa->tinggal=='Transportasi Umum')? 'selected': ''}}>Transportasi Umum</option>
                        <option {{($siswa->tinggal=='Lainnya')? 'selected': ''}}>Lainnya</option>
                      </select>  
                  </div>
              </div>
              <div class="form-group row">
                  <label for="nomor_hp" class="col-sm-3 col-form-label">Nomor HP Siswa</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" value="{{$siswa->nomor_hp}}" placeholder="Nomor HP Siswa">
                  </div>
              </div>
              <hr>
              <h5>Profil Orang Tua</h5>
              <div class="form-group row">
                  <label for="nama_ayah" class="col-sm-3 col-form-label">Nama Ayah</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="{{$siswa->nama_ayah}}" placeholder="Nama Ayah">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="tgl_ayah" class="col-sm-3 col-form-label">Tempat Tanggal Lahir Ayah</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="tgl_ayah" name="tgl_ayah" value="{{$siswa->tgl_ayah}}" placeholder="Tempat Tanggal Lahir Ayah">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="pendidikan_ayah" class="col-sm-3 col-form-label">Pendidikan Terakhir Ayah</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="pendidikan_ayah" name="pendidikan_ayah" value="{{$siswa->pendidikan_ayah}}" placeholder="Pendidkan Terakhir Ayah">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="pekerjaan_ayah" class="col-sm-3 col-form-label">Pekerjaan Ayah</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" value="{{$siswa->pekerjaan_ayah}}" placeholder="Pekerjaan Ayah">
                  </div>
              </div>
               <div class="form-group row">
                  <label for="nama_ibu" class="col-sm-3 col-form-label">Nama Ibu</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="{{$siswa->nama_ibu}}" placeholder="Nama Ibu">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="tgl_ibu" class="col-sm-3 col-form-label">Tempat Tanggal Lahir Ibu</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="tgl_ibu" name="tgl_ibu" value="{{$siswa->tgl_ibu}}" placeholder="Tempat Tanggal Lahir Ibu">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="pendidikan_ibu" class="col-sm-3 col-form-label">Pendidikan Terakhir Ibu</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="pendidikan_ibu" name="pendidikan_ibu" value="{{$siswa->pendidikan_ibu}}" placeholder="Pendidkan Terakhir Ibu">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="pekerjaan_ibu" class="col-sm-3 col-form-label">Pekerjaan Ibu</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" value="{{$siswa->pekerjaan_ibu}}" placeholder="Pekerjaan ibu">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="nomor_hp_ortu" class="col-sm-3 col-form-label">Nomor HP Orang Tua</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="nomor_hp_ortu" name="nomor_hp_ortu" value="{{$siswa->nomor_hp_ortu}}" placeholder="Nomor HP Orang Tua">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="alamat_ortu" class="col-sm-3 col-form-label">Alamat Orang Tua</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="alamat_ortu" name="alamat_ortu" value="{{$siswa->alamat_ortu}}" placeholder="Alamat Orang Tua">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="tinggi" class="col-sm-3 col-form-label">Tinggi Badan Siswa</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="tinggi" name="tinggi" value="{{$siswa->tinggi}}" placeholder="Tinggi Badan Siswa">
                  </div>
              </div>
               <div class="form-group row">
                  <label for="berat" class="col-sm-3 col-form-label">Berat Badan Siswa</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="berat" name="berat" value="{{$siswa->berat}}" placeholder="Berat Badan Siswa">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="jarak_sekolah" class="col-sm-3 col-form-label">Jarak Tempu Sekolah</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="jarak_sekolah" name="jarak_sekolah" value="{{$siswa->jarak_sekolah}}" placeholder="Jarak Tempu Sekolah">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="tempu_sekolah" class="col-sm-3 col-form-label">Waktu Tempu Sekolah</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="tempu_sekolah" name="tempu_sekolah" value="{{$siswa->tempu_sekolah}}" placeholder="Waktu Tempu Sekolah">
                  </div>
              </div>
              <hr>
              <h5>Sekolah Asal</h5>
              <div class="form-group row">
                  <label for="sekolah_asal" class="col-sm-3 col-form-label">Sekolah Asal</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="sekolah_asal" name="sekolah_asal" value="{{$siswa->sekolah_asal}}" placeholder="Sekolah Asal">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="sekolah_alamat" class="col-sm-3 col-form-label">Alamat Sekolah</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="sekolah_alamat" name="sekolah_alamat" value="{{$siswa->sekolah_alamat}}" placeholder="Alamat Sekolah">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="sekolah_angkatan" class="col-sm-3 col-form-label">Sekolah Angkatan</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="sekolah_angkatan" name="sekolah_angkatan" value="{{$siswa->sekolah_angkatan}}" placeholder="Sekolah Angkatan">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="course_title" class="col-sm-3 col-form-label">Foto</label>
                  <div class="col-sm-9 col-md-4">
                      <p><img src="{{env('FTP_BASE').'/siswa/'.$siswa->foto}}" id="foto" alt="" width="150" class="rounded"></p>
                      <label class="custom-file">
                        <input type="file" id="file" name="foto"  onchange="fotoURl(this)">
                        <span class="custom-file-control"></span>
                      </label>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="course_title" class="col-sm-3 col-form-label">Ijazah</label>
                  <div class="col-sm-9 col-md-4">
                      <p><img src="{{env('FTP_BASE').'/siswa/'.$siswa->ijazah}}" id="ijazah" alt="" width="150" class="rounded"></p>
                      <label class="custom-file">
                        <input type="file" id="file" name="ijazah"  onchange="fileijazah(this)">
                        <span class="custom-file-control"></span>
                      </label>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="sekolah_angkatan" class="col-sm-3 col-form-label"></label>
                  <div class="col-sm-9">
                      <button type="submit" class="btn btn-primary">Update</button>
                      <a href="{{url('siswa/verifikasi/nisn/'.$siswa->nisn)}}" class="btn btn-danger">Verifikasi Data </a>
                  </div>
              </div>
             
            </form>
            @elseif($siswa->status == 'Verifikasi Siswa')
            <center style="padding: 30px 0px">
            <img src="{{asset('images/standar/sekolah.png')}}" width="30%"> <br><br>
            <h5>Silahkan mendatangi sekolah untuk melakukan verifikasi selanjutnya</h5>

            </center>
            @elseif($siswa->status == 'Verifikasi Admin')
            <div class="card-deck">
                <div class="card">
                  <div class="card-img-top"></div>
                  <div class="card-header text-white bg-primary ">Prestasi</div>
                    <div class="card-body">
                        <p class="card-text">Kami Sangat Menghargai Prestasi Calon Siswa. Prestasi yang telah diperoleh pada jenjang sekolah sebelumnya siswa dapat dimasukkan disini</p>
                        <p class="card-text">
                            <small class="text-muted"> Prestasi Saya</small>
                        </p>
                    </div>
                        <ul class="list-group list-group-flush">
                          @if(!empty($prestasis))
                          @foreach($prestasis as $prestasi)
                          <li class="list-group-item"> <b>{{$prestasi->prestasi}}</b> - {{$prestasi->instansi}} <br> 
                            @if($prestasi->status=='Belum')
                            <a href="#" class="btn btn-outline-primary btn-sm"  data-toggle="modal" data-target="#exampleModalupdate" 
                            data-prestasi="{{$prestasi->prestasi}}" 
                            data-id="{{$prestasi->id}}"
                            data-lampiran ="{{$prestasi->lampiran}}"
                            data-instansi ="{{$prestasi->instansi}}"
                            data-tanggal ="{{$prestasi->tanggal}}"
                            >Update</a>
                            <a href="#" class="btn btn-outline-danger btn-sm"  data-toggle="modal" data-target="#modalhapus" data-id="{{$prestasi->id}}">Hapus</a>
                            <a href="{{url('siswa/prestasi/siswa/konfirmasi/'.$prestasi->id)}}" class="btn btn-outline-success btn-sm">Konfirmasi</a>
                            @endif
                          </li>
                          @endforeach
                          @else
                          Tidak Ada Prestasi
                          @endif
                        </ul>
                         <div class="card-footer">
                          <small>Sebelum melakukan konfirmasi prestasi, pastikan tidak ada kesalahan dalam penulisan atau gambar/foto yang diupload</small>
                        </div>
                        <div class="card-body">
                          <a href="#" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#exampleModalupdate">Tambah Prestasi</a>
                        </div>
                       
                </div>
                <div class="card">
                  <div class="card-header text-white bg-primary ">Menentukan Jurusan</div>
                    <div class="card-body">
                        <p class="card-text">Menentukan jurusan atas dasar niat dan keinginan siswa
                        </p>
                        <p class="card-text">
                            <small class="text-muted">Minat Jurusan Saya Adalah</small>
                        </p>
                        <form action="{{route('jurusan.siswa.konfirmasi')}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <ul class="list-group list-group-flush">
                          @foreach($jurusans as $jurusan)
                          <?php 
                              $namajurusan = App\Models\Jurusan::find($jurusan->id_jurusan);
                          ?>
                          <li class="list-group-item">
                            <div class="form-group">
                              <div class="form-check" style=" margin-bottom: -19px;">
                                <input class="form-check-input" type="checkbox" name="jurusan[]" value="{{$jurusan->id_jurusan}}" id="invalidCheck{{$jurusan->id_jurusan}}" style=" left: 20px; top: 3px;" {{(preg_match("/".$jurusan->id_jurusan."/i", $siswa->minat_jurusan))?'checked': ''}}>
                                <label class="form-check-label" for="invalidCheck{{$jurusan->id_jurusan}}">
                                  {{(!empty($namajurusan))? $namajurusan->jurusan: ''}}
                                </label>
                              </div>
                            </div>
                          </li>
                          @endforeach
                        </ul>
                        <button type="submit" class="btn btn-primary btn-sm">Konfirmasi Minat Jurusan</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                  <div class="card-header text-white bg-primary ">Lakukan Test Ujian Masuk</div>
                    <div class="card-body">
                        <p class="card-text">Pelaksanaan Test Ujian Masuk yang akan dilakukan serentak</p>
                        <p class="card-text">
                            <small class="text-muted">Pelaksanaan pada tanggal </small>
                            <div class="card card-stats-danger text-center">
                                <div class="card-body">
                                    <p>{{hari_tanggal(date('Y-m-d-G-i-s', strtotime($ta->tgl_test)))}}</p>
                                </div>
                            </div>

                        </p>
                    </div>
                </div>
            </div>


            {{-- modal create / update prstasi --}}
            <div class="modal fade" id="exampleModalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="judulmodal">Tambah Prestasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="form" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="id_profil_siswa" value="{{$siswa->id}}">
                    <div id="put-input"></div>
                  <div class="modal-body row">
                  <div class="col-sm-9">
                       <div class="form-group row">
                            <label for="prestasi" class="col-sm-3 col-form-label">Prestasi</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control {{ $errors->has('prestasi') ? ' is-invalid' : '' }}" name="prestasi" id="prestasi" placeholder="Nama Prestasi" value="{{old('prestasi')}}">
                              @if ($errors->has('prestasi'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('prestasi') }}</strong>
                                  </span>
                              @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="instansi" class="col-sm-3 col-form-label">Instansi</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control {{ $errors->has('instansi') ? ' is-invalid' : '' }}" name="instansi" id="instansi" placeholder="Instansi Penyelenggara" value="{{old('instansi')}}">
                              @if ($errors->has('instansi'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('instansi') }}</strong>
                                  </span>
                              @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal" class="col-sm-3 col-form-label">Tanggal </label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control {{ $errors->has('tanggal') ? ' is-invalid' : '' }}" name="tanggal" id="tanggal" placeholder="Tanggal Perolehan Prestasi" value="{{old('tanggal')}}">
                              @if ($errors->has('tanggal'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('tanggal') }}</strong>
                                  </span>
                              @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lampiran" class="col-sm-3 col-form-label">Foto / Bukti </label>
                            <div class="col-sm-9">
                            <input type="file" class="form-control {{ $errors->has('lampiran') ? ' is-invalid' : '' }}" name="lampiran"  onchange="fileprestasi(this)">
                              @if ($errors->has('lampiran'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('lampiran') }}</strong>
                                  </span>
                              @endif
                            </div>
                        </div>
                  </div>
                  <div class="col-sm-3">
                        <img id="prestasifoto" alt="" width="150" class="rounded">
                  </div>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="buttonsubmit" class="btn btn-primary">Update</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>

            {{-- modal delete prestasi --}}
            <div class="modal fade" id="modalhapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Prestasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="form-delete" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="id" id="id">
                  <div class="modal-body">
                    Apakah anda yakin menghapus prestasi anda?      
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="myButton">Hapus</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            @endif

@endsection

@section('script')
<script type="text/javascript">
  function fotoURl(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#foto').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
  }
  function fileprestasi(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#prestasifoto').attr('src', e.target.result);
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
  $('#modalhapus').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var modal = $(this);
    modal.find('#id').val(id)
    $("#form-delete").attr("action", '{{url('siswa/prestasi/siswa/delete')}}/'+id);
  });

  $('#exampleModalupdate').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var prestasi = button.data('prestasi');
    var lampiran = button.data('lampiran');
    var instansi = button.data('instansi');
    var tanggal = button.data('tanggal');
    var modal = $(this);
    modal.find('#prestasi').val(prestasi)
    modal.find('#id').val(id)
    modal.find('#instansi').val(instansi)
    modal.find('#tanggal').val(tanggal)
    document.getElementById("prestasifoto").src = "http://file.smawahasmodel.sch.id/prestasi/"+lampiran;

    if (typeof(id) == "undefined"){
        $("#form").attr("action", '{!!route('prestasi.siswa.tambah')!!}');
        document.getElementById("buttonsubmit").innerHTML = "Tambah";
        document.getElementById("judulmodal").innerHTML = "Tambah Prestasi";
        $('#put-input').empty();
    } else{
      var status = "ada";
        $("#form").attr("action", '{!!route('prestasi.siswa.update')!!}');
        document.getElementById("buttonsubmit").innerHTML = "Update";
        document.getElementById("judulmodal").innerHTML = "Update Prestasi";
        $('#put-input').empty();
        $('#put-input').append('{{ method_field('PUT') }}');
    }
      
  });
  $('.your-checkbox').prop('indeterminate', true)
</script>

@endsection