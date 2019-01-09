<?php

Route::get('/', 'pengajar\PengajarController@index')->name('pengajar');
Route::get('/login', 'pengajar\PengajarLoginController@showLoginForm');
Route::post('/login', 'pengajar\PengajarLoginController@login')->name('pengajar.login');
Route::get('/daftar', 'pengajar\PengajarDaftarController@daftar');
Route::post('/daftar', 'pengajar\PengajarDaftarController@create')->name('pengajar.daftar');
Route::post('/logout', 'pengajar\PengajarLoginController@logout')->name('pengajar.logout');

Route::get('/listpelajaran', 'pengajar\ListPelajaranController@index');
Route::post('/listpelajaran', 'pengajar\ListPelajaranController@store')->name('listpelajaran.tambah');
Route::put('/listpelajaran', 'pengajar\ListPelajaranController@update')->name('listpelajaran.update');
Route::delete('/listpelajaran/delete/{id}', 'pengajar\ListPelajaranController@delete')->name('listpelajaran.delete');
Route::get('/listpelajaran/id/{id}', 'pengajar\ListPelajaranController@pelajaranid');
 
Route::delete('/coba', 'pengajar\ListPelajaranController@coba');

Route::get('/materi', 'pengajar\MateriController@index');
Route::get('/materi/tambah/idbab/{id_bab}/{id_pel}', 'pengajar\MateriController@tambah');
Route::get('/materi/update/idbab/{id_bab}/{id_pel}', 'pengajar\MateriController@rubah');
Route::post('/materi', 'pengajar\MateriController@store')->name('materi.tambah');
Route::put('/materi', 'pengajar\MateriController@update')->name('materi.update');
Route::delete('/materi/delete/{id}', 'pengajar\MateriController@delete');
Route::get('/materi/list/{id_pel}', 'pengajar\MateriController@listmateri');
Route::get('/materi/id/{id_materi}/{id_pel}', 'pengajar\MateriController@materiid');

Route::get('/soal', 'pengajar\SoalController@index');
Route::get('/soal/tambah/idbab/{id_bab}/{id_pel}', 'pengajar\SoalController@tambah');
Route::get('/soal/update/idbab/{id_bab}/{id_pel}', 'pengajar\SoalController@rubah');
Route::post('/soal', 'pengajar\SoalController@store')->name('soal.tambah');
Route::put('/soal', 'pengajar\SoalController@update')->name('soal.update');
Route::delete('/soal/delete/{id}', 'pengajar\SoalController@delete');
Route::get('/soal/list/{id_pel}', 'pengajar\SoalController@listsoal');
Route::get('/soal/id/{id_soal}/{id_pel}', 'pengajar\SoalController@soalid');
