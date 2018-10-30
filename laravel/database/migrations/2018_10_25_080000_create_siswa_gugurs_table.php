<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswaGugursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa_gugurs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_ta');
            $table->integer('id_pendaftaran');
            $table->enum('status', ['Pendaftaran', 'Kasus', 'Pindah']);
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa_gugurs');
    }
}
