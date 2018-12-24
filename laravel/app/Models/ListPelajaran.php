<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListPelajaran extends Model
{
    protected $fillable = [
	    'id_guru','id_kurikulum','id_jurusan','id_tk','id_mapel','status'
	];
}
