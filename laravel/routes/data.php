<?php 

// data kelas 
Route::get('/kurikulum/{id}', 'data\DataController@tampiljurusan');
Route::get('/jurusan/{id}', 'data\DataController@tampiltingkatkelas');
Route::get('/tingkatkelas/{id}', 'data\DataController@tampilmapel');
Route::get('/mapel/{id}', 'data\DataController@tampilbab');

//mengirim notif

