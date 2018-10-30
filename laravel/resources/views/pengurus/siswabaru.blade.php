@extends('pengurus.template-pengurus')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
<h1 class="h2">Siswa Baru</h1>
<div class="btn-toolbar mb-2 mb-md-0">
  <div class="btn-group mr-2">
    <a class="btn btn-sm btn-outline-secondary" href="{{url('pengurus/siswabaru/pengumuman')}}">Tambah Pengurmuman</a>
    <a class="btn btn-sm btn-outline-danger" href="{{url('pengurus/siswabaru/konfirmasipendaftaran')}}">Konfirmasi Penerimaan</a>
  </div>
  <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
    <span data-feather="calendar"></span>
    This week
  </button>
</div>
</div>

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
                <th>Nisn</th>
                <th>Nama</th>
                <th>Minat</th>
                <th>Nilai</th>
                <th>Kelas</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php $n=1; $k= 1; $l=1; $m=1;?>
        <tbody>
            @foreach($siswas as $siswa)
            <tr>
                <td>{{$n++}}</td>
                <td>{{$siswa->nisn}}</td>
                <td>{{$siswa->nama_lengkap}}</td>
                <td>
                  <?php
                      $arr = $siswa->minat_jurusan;
                      $array = explode(",",$arr);

                      $jumlah = count($array);
                      for ($i=0; $i < $jumlah ; $i++) {
                        foreach ($jurusans as $jurusan) {
                          $namajurusan = App\Models\Jurusan::where('id',$jurusan->id_jurusan)->first();
                          $print = ($jurusan->id_jurusan == $array[$i]) ? $namajurusan->jurusan : '' ;
                          echo $print. ' ';
                        }
                      }
                    ?>
                </td>

                <td>
                    @if(!empty($siswa->nilai_test))
                    {{$siswa->nilai_test}}
                    @else
                       <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#exampleModalupdate"
                        data-id="{{$siswa->id}}" 
                        >Tambah Nilai</button> 
                    @endif
                </td>
                <td>
                     <div class="btn-group" role="group">
                        <button id="btnGroupDrop{{$siswa->id}}" type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <?php 
                            $sisgur = App\Models\SiswaGugur::where('id_pendaftaran', $siswa->id)->first();
                            if (!empty($sisgur)) {
                              $siswakel = 'Gugur';
                            } else {
                              $siswakelas = App\Models\Kelas_siswa::where('id_siswa', $siswa->id)->orderBy('updated_at', 'DESC')->select('id_kelas')->first();
                              if (!empty($siswakelas)) {
                                $namakelas = App\Models\Kelas::where('id', $siswakelas->id_kelas)->first();
                                $siswakel = (!empty($namakelas)) ? $namakelas->kelas : 'NN' ;
                              } else {
                                $siswakel = 'Pilih Kelas';
                              }
                            }
                            
                          ?>
                          {{$siswakel}}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop{{$siswa->id}}">
                          @foreach($kelass as $kelas)
                            <a class="dropdown-item" onclick="test({{$siswa->id. ','. $kelas->id .','.$kelas->id_tingkatan_kelas.', btnGroupDrop'.$siswa->id}})">{{$kelas->status.' - '. $kelas->kelas}}</a>
                          @endforeach
                          <div id="pengguguran{{$siswa->id}}">
                            @if(empty($sisgur))
                            <a class="dropdown-item" onclick="gugur({{$siswa->id.','.$ta->id.', btnGroupDrop'.$siswa->id.', pengguguran'.$siswa->id}})">Gugur</a>
                            @else
                            <a class="dropdown-item" onclick="batalgugur({{$siswa->id.', btnGroupDrop'.$siswa->id.', pengguguran'.$siswa->id}})">Batal Gugur</a>
                            @endif
                          </div>
                        </div>
                      </div>
                  {{$siswa->diterima_dikelas}}</td>
                <td>{{$siswa->status}}</td>
                <td>
                    <a href="{{url('pengurus/siswabaru/'.$siswa->id)}}" class="btn btn-outline-success btn-sm">Lihat</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
    </div>

</div>

<div class="modal fade" id="exampleModalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Nilai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('pengurus.siswabaru.siswanilaitest') }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
      <input type="hidden" name="id" id="id">
      <div class="modal-body">
          <div class="form-group">
            <label for="nilai_test" class="col-form-label">Nilai</label>
            <input type="text" class="form-control" name="nilai_test" id="nilai_test">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Tambah Nilai</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $('#example').DataTable();
    function test(siswa, kelas, tingkat, object){  
      $.get('{{ url('/pengurus/siswabaru/pilihkelas')}}/'+siswa+'/'+kelas+'/'+tingkat, function(data){
      object.innerHTML=data['namakelas'];
      });
    };
    function gugur(siswa, ta ,object, tombol) {
      console.log(ta);
      $.get('{{ url('/pengurus/siswabaru/gugur')}}/'+siswa+'/'+ta, function(data){
        object.innerHTML='Gugur';
        tombol.innerHTML=' <a class="dropdown-item" onclick="batalgugur('+siswa+', pengguguran'+siswa+')">Batal Gugur</a>'
      });
    }
    function batalgugur(siswa, object,tombol) {
       $.get('{{ url('/pengurus/siswabaru/batalgugur')}}/'+siswa, function(data){
        object.innerHTML='Pilih Kelas';
        tombol.innerHTML=' <a class="dropdown-item" onclick="batalgugur('+siswa+', {{$ta->id}} , btnGroupDrop'+siswa+', pengguguran'+siswa+')">Gugur</a>'
      });
    }

    $('#jurusan').on('change', function(e){
        var id = e.target.value;
        console.log(id);
        
    });

    $('#exampleModalupdate').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        console.log(id);
        modal.find('#id').val(id)
      })
</script>
@endsection
