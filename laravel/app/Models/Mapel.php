<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $fillable = ['mapel', 'deskripsi', 'jenis_mapel'];
    public $timestamps = false;
}
