<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $fillable = [
	    'nisn','id_coba_jawab','id_soal','jawaban','durasi'
	];
}
