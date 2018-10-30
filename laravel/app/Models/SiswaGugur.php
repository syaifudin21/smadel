<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiswaGugur extends Model
{
    protected $fillable = [
	    'id_ta','id_pendaftaran','status','keterangan'
	];
}
