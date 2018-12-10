<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsenSiswa extends Model
{
    protected $fillable = [
	    'mesin','nisn','id_finger','event','tanggal','masuk_1','keluar_1','masuk_2','keluar_2','id_user_edit','keterangan'
	];
}
