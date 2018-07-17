<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapels', function (Blueprint $table) {
           $table->increments('id');
            $table->string('mapel', 100);
            $table->longText('deskripsi')->nullable();
            $table->enum('jenis_mapel', ['Mata Pelajaran Wajib (Kelompok A)', 'Mata Pelajaran Wajib (Kelompok B)', 'A. Peminatan Matematika dan Sains', 'B. Peminatan Sosial', 'C. Peminatan Bahasa', 'Palajaran Wajib', 'Muatan Lokal']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mapels');
    }
}
