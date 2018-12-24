<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CobaJawab extends Model
{
    protected $fillable = [
    	'nisn','id_latihan','waktu_mulai','waktu_selesai','status'
    ];
}
