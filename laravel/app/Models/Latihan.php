<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Latihan extends Model
{
    protected $fillable = [
	    'id_guru','latihan','durasi','waktu_tampil','waktu_selesai','soal','tujuan','status'
	];
}
