<?php

Route::get('/', 'sekolah\SekolahController@index')->name('sekolah');
Route::get('/login', 'sekolah\SekolahLoginController@showLoginForm')->name('sekolah.login');
Route::post('/login', 'sekolah\SekolahLoginController@login')->name('sekolah.login');
Route::get('/daftar', 'sekolah\SekolahDaftarController@daftar')->name('sekolah.daftar');
Route::post('/daftar', 'sekolah\SekolahDaftarController@create')->name('sekolah.daftar');
Route::post('/logout', 'sekolah\SekolahLoginController@logout')->name('sekolah.logout');

Route::get('/tahunajaran', 'sekolah\SekolahController@tahunajaran');
Route::post('/tahunajaran', 'sekolah\SekolahController@tatambah')->name('tahunajaran.tambah');

Route::get('/profil', 'sekolah\SekolahController@profil');
Route::put('/profil', 'sekolah\SekolahController@edit')->name('sekolah.edit');
Route::get('/pengurus', 'sekolah\SekolahController@pengurus');
Route::post('/pengurus', 'sekolah\SekolahController@storepengurus')->name('sekolah.pengurus.tambah');
Route::get('/pengurus/{id}', 'sekolah\SekolahController@pengurusid');
Route::get('/pengurus/update/{id}', 'sekolah\SekolahController@pengurusedit');
Route::put('/pengurus/update', 'sekolah\SekolahController@pengurusupdate')->name('sekolah.pengurus.update');
Route::delete('/pengurus/delete/{id}', 'sekolah\SekolahController@deletepengurus');

Route::get('/atribut', 'sekolah\AtributController@index');
Route::post('/atribut', 'sekolah\AtributController@store')->name('atribut.tambah');
Route::get('/atribut/{id}', 'sekolah\AtributController@atributid');
Route::get('/atribut/update/{id}', 'sekolah\AtributController@edit');
Route::put('/atribut/update', 'sekolah\AtributController@update')->name('atribut.update');
Route::delete('/atribut/delete/{id}', 'sekolah\AtributController@delete');

Route::get('/ekstrakurikuler', 'sekolah\EkstrakurikulerController@index');
Route::post('/ekstrakurikuler', 'sekolah\EkstrakurikulerController@store')->name('ekstrakurikuler.tambah');
Route::get('/ekstrakurikuler/{id}', 'sekolah\EkstrakurikulerController@atributid');
Route::get('/ekstrakurikuler/update/{id}', 'sekolah\EkstrakurikulerController@edit');
Route::put('/ekstrakurikuler/update', 'sekolah\EkstrakurikulerController@update')->name('ekstrakurikuler.update');
Route::delete('/ekstrakurikuler/delete/{id}', 'sekolah\EkstrakurikulerController@delete');

Route::get('/fasilitas', 'sekolah\\FasilitasController@index');
Route::post('/fasilitas', 'sekolah\FasilitasController@store')->name('fasilitas.tambah');
Route::get('/fasilitas/{id}', 'sekolah\FasilitasController@atributid');
Route::get('/fasilitas/update/{id}', 'sekolah\FasilitasController@edit');
Route::put('/fasilitas/update', 'sekolah\FasilitasController@update')->name('fasilitas.update');
Route::delete('/fasilitas/delete/{id}', 'sekolah\FasilitasController@delete');

Route::get('/album', 'layanan\AlbumController@sekolah');
