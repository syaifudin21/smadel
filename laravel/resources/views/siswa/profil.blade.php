@extends('siswa.template-siswabaru')

@section('content')
        

        <h4 class="m-0">Informasi Profil Siswa</h4>
        <p class="text-muted mb-heading">Anda Dapat Melihat Profil Anda, dan dapat melengkapi informasi anda. Tapi Tidak tidak bisa Update pada bagian tertentu</p>
        <hr>
        <table class="table">
          <tr><th>Nama</th><td>{{$siswa->nama_lengkap}}</td></tr>
          <tr><th>Tempat Tanggal Lahir</th><td>{{$siswa->tgl}}</td></tr>
          <tr><th>Jenis Kelamin</th><td>{{$siswa->jk}}</td></tr>
          <tr><th>Nomor Induk Sekolah Nasional</th><td>{{$siswa->nisn}}</td></tr>
          <tr><th>Agama</th><td>{{$siswa->agama}}</td></tr>
          <tr><th>Alamat</th><td>{{$siswa->alamat}}</td></tr>
          <tr><th>Tinggal Bersama</th><td>{{$siswa->tinggal}}</td></tr>
          <tr><th>Transportasi ke Sekolah</th><td>{{$siswa->transportasi}}</td></tr>
          <tr><th>Nomor Hp Siswa</th><td>{{$siswa->nomor_hp}}</td></tr>
          <tr><th>Nama Ayah</th><td>{{$siswa->nama_ayah}}</td></tr>
          <tr><th>Tempat Tanggal Lahir Ayah</th><td>{{$siswa->tgl_ayah}}</td></tr>
          <tr><th>Pendidikan Terakhir Ayah</th><td>{{$siswa->pendidikan_ayah}}</td></tr>
          <tr><th>Pekerjaan Terakhir Ayah</th><td>{{$siswa->pekerjaan_ayah}}</td></tr>
          <tr><th>Penghasilan Ayah</th><td>{{$siswa->penghasilan_ayah}}</td></tr>
          <tr><th>Keterangan Ayah</th><td>{{$siswa->keterangan_ayah}}</td></tr>
          <tr><th>Nama Ibu</th><td>{{$siswa->nama_ibu}}</td></tr>
          <tr><th>Tempat Tanggal Lahir Ibu</th><td>{{$siswa->tgl_ibu}}</td></tr>
          <tr><th>Pendidikan Terakhir Ibu</th><td>{{$siswa->pendidikan_ibu}}</td></tr>
          <tr><th>Pekerjaan Terakhir Ibu</th><td>{{$siswa->pekerjaan_ibu}}</td></tr>
          <tr><th>Penghasilan Ibu</th><td>{{$siswa->penghasilan_ibu}}</td></tr>
          <tr><th>Ketarangan Ibu</th><td>{{$siswa->keterangan_ibu}}</td></tr>
          <tr><th>Alamat Orang Tua Sekarang</th><td>{{$siswa->alamat_ortu}}</td></tr>
          <tr><th>Nomor HP Orang Tua</th><td>{{$siswa->nomor_hp_ortu}}</td></tr>
          <tr><th>Tinggi Badan</th><td>{{$siswa->tinggi}}</td></tr>
          <tr><th>Berat Badan</th><td>{{$siswa->berat}}</td></tr>
          <tr><th>Jarak Tempu Kesekolah</th><td>{{$siswa->jarak_sekolah}}</td></tr>
          <tr><th>Waktu Tempu Kesekolah</th><td>{{$siswa->tempu_sekolah}}</td></tr>
          <tr><th>Anak Ke-</th><td>{{$siswa->anak_ke}}</td></tr>
          <tr><th>Jumlah Saudara</th><td>{{$siswa->jml_saudara}}</td></tr>
          <tr><th>Sekolah Asal</th><td>{{$siswa->sekolah_asal}}</td></tr>
          <tr><th>Alamat Sekolah Asal</th><td>{{$siswa->sekolah_alamat}}</td></tr>
          <tr><th>Lulus Sekolah Asal Tahun</th><td>{{$siswa->sekolah_angkatan}}</td></tr>
          <tr><th>Nilai Test Masuk</th><td>{{$siswa->nilai_test}}</td></tr>
          <tr><th>Minat Jurusan</th><td>{{$siswa->minat_jurusan}}</td></tr>
          <tr><th>Kelas Pertama</th><td>{{$siswa->diterima_kelas}}</td></tr>
          <tr><th>Nomor Induk</th><td>{{$siswa->no_induk}}</td></tr>
          <tr><th>Lampiran Foto</th><td>{{$siswa->foto}}</td></tr>
          <tr><th>Lampiran Akte</th><td>{{$siswa->akte}}</td></tr>
          <tr><th>Lampiran KPS</th><td>{{$siswa->kps}}</td></tr>
          <tr><th>Lampiran Ijazah</th><td>{{$siswa->ijazah}}</td></tr>
        </table>

@endsection

@section('script')

@endsection