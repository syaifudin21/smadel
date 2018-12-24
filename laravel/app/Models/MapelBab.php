<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MapelBab extends Model
{
    protected $fillable = [
        'id_mapel', 'bab', 'topik'
    ];
    public $timestamps = false;
}
