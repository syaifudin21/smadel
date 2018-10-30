<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumChat extends Model
{
    protected $fillable = [
        'id_forum','id_pengurus','id_siswa','id_chat','chat'
    ];
    public $timestamps = false;
    protected $dates = [
	     'waktu'
    ];
}
