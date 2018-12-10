<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsenSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absen_siswas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mesin');
            $table->string('nisn',20);
            $table->integer('id_finger');
            $table->string('event')->nullable();
            $table->date('tanggal')->nullable();
            $table->time('masuk_1')->nullable();
            $table->time('keluar_1')->nullable();
            $table->time('masuk_2')->nullable();
            $table->time('keluar_2')->nullable();
            $table->integer('id_user_edit')->nullable();
            $table->string('keterangan')->default('Hari Normal');
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
        Schema::dropIfExists('absen_siswas');
    }
}
