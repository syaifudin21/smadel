<?php 

Route::post('/login', 'Android\Siswa\SiswaController@login');
Route::post('/logout', 'Android\Siswa\SiswaController@logout');

//ambil data artikel yang sudah disetujuai pengurus/guru
Route::post('/artikel', 'Android\Siswa\ArtikelController@artikel');
Route::post('/artikel/detail', 'Android\Siswa\ArtikelController@artikelid');

Route::get('/artikel/id/{id}', 'Android\Siswa\ArtikelController@artikelview');

// dari mesin aplikasi lokal
Route::post('/absen/upload', 'Android\Siswa\AbsenController@upload');
//android akses
Route::post('/absen/download', 'Android\Siswa\AbsenController@download');

//kelas
Route::post('/kelas/siswa', 'Android\Siswa\KelasController@kelasdiikuti');
Route::post('/kelas/siswa/kelasid', 'Android\Siswa\KelasController@kelasid');

