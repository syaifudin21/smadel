<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GambarSoal extends Model
{
    protected $fillable = [
		'id_soal','gambar'
	];
    public $timestamps = false;
}
