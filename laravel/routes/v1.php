<?php 

Route::post('/login', 'Android\Siswa\DataController@tampiljurusan');

Route::post('/absen/upload', 'Android\Siswa\AbsenController@upload');
Route::post('/absen/download', 'Android\Siswa\AbsenController@download');
