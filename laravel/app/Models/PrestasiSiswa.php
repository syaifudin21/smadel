<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestasiSiswa extends Model
{
    protected $fillable = [
        'id_profil_siswa','prestasi','instansi','tanggal','lampiran','status'
    ];
    public $timestamps = false;
}
