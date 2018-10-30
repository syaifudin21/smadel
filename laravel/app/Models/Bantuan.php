<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bantuan extends Model
{
    protected $fillable = [
       'pertanyaan', 'judul','id_pengurus','isi', 'lampiran','like','dislike', 'created_at', 'updated_at', 'status'
    ];
    public $timestamps = false;
}
