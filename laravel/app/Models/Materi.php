<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $fillable = [
	    'id_guru','id_list_pelajaran','id_bab','topik','materi','file', 'status'
	];
}
