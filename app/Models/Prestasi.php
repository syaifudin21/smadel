<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $fillable = ['tanggal', 'nama', 'deskripsi', 'foto', 'instalasi'];
}
