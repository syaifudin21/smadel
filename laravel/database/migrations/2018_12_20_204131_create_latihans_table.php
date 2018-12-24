<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLatihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('latihans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_guru');
            $table->string('latihan');
            $table->integer('durasi');
            $table->dateTime('waktu_tampil')->nullable();
            $table->dateTime('waktu_selesai')->nullable();
            $table->text('soal');
            $table->text('tujuan');
            $table->enum('status',['Tampil','Sembunyi'])->default('Sembunyi');
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
        Schema::dropIfExists('latihans');
    }
}
