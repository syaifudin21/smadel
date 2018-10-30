<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestasiSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestasi_siswas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_profil_siswa');
            $table->string('prestasi');
            $table->string('instansi');
            $table->date('tanggal');
            $table->text('lampiran');
            $table->enum('status', ['Konfirmasi', 'Belum'])->default('Belum');
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
        Schema::dropIfExists('prestasi_siswas');
    }
}
