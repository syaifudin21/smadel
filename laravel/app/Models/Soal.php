<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $fillable = [
	    'id_guru','id_list_pelajaran','id_bab','soal','topik','type','soal','jawaban_1','jawaban_2','jawaban_3','jawaban_4','jawaban_5','benar', 'pembahasan','status'
	];
}
