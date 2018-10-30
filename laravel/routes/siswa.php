<?php

Route::get('/', 'siswa\SiswaController@index')->name('siswa');
Route::get('/login', 'siswa\SiswaLoginController@showLoginForm')->name('siswa.login');
Route::post('/login', 'siswa\SiswaLoginController@login')->name('siswa.login');
Route::get('/daftar', 'siswa\SiswaDaftarController@daftar')->name('siswa.daftar');
Route::post('/daftar', 'siswa\SiswaDaftarController@create')->name('siswa.daftar');
Route::post('/logout', 'siswa\SiswaLoginController@logout')->name('siswa.logout');

Route::get('/baru', 'siswa\SiswaController@baru')->name('baru');
Route::get('/profil', 'siswa\SiswaController@profil');
Route::get('/akun', 'siswa\SiswaController@akun');
Route::put('/profilupdate', 'siswa\SiswaController@profilupdate')->name('siswa.profil.update');
Route::put('/akunupdate', 'siswa\SiswaController@akunupdate')->name('siswa.akun.update');
Route::get('/verifikasi/nisn/{nisn}', 'siswa\SiswaController@verifikasisiswa');

Route::get('/bantuan', 'siswa\SiswaController@bantuan');
Route::get('/bantuan/id/{id}', 'siswa\SiswaController@bantuanid');

Route::get('/forum/menu/siswabaru', 'siswa\SiswaController@forummenu');
Route::get('/forum/id/{id}', 'siswa\SiswaController@forumid');
Route::post('/forum/id', 'siswa\SiswaController@chatstore')->name('forum.chat');

Route::post('/prestasi/siswa', 'siswa\SiswaController@prestasistore')->name('prestasi.siswa.tambah');
Route::put('/prestasi/siswa', 'siswa\SiswaController@prestasiupdate')->name('prestasi.siswa.update');
Route::delete('/prestasi/siswa/delete/{id}', 'siswa\SiswaController@prestasidelete')->name('prestasi.siswa.delete');
Route::get('/prestasi/siswa/konfirmasi/{id}', 'siswa\SiswaController@prestasikonfirmasi');
Route::put('/jurusan/siswa/konfirmasi', 'siswa\SiswaController@jurusankonfirmasi')->name('jurusan.siswa.konfirmasi');
