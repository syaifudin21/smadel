<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas_mapel extends Model
{
    protected $fillable = ['id_kelas', 'jam', 'id_guru','id_mapel'];
}
