<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    protected $fillable = ['nama', 'deskripsi','pembina', 'foto', 'albums'];
}
