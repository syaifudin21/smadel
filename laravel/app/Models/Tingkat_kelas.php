<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tingkat_kelas extends Model
{
    protected $fillable = [
        'id_jurusan','tingkat_kelas', 'status'
    ];
    public $timestamps = false;
}
