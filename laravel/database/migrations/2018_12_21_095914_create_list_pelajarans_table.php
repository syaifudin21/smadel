<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListPelajaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_pelajarans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_guru');
            $table->integer('id_kurikulum');
            $table->integer('id_jurusan');
            $table->integer('id_tk');
            $table->integer('id_mapel');
            $table->enum('status', ['Tampil', 'Sembunyi'])->default('Tampil');
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
        Schema::dropIfExists('list_pelajarans');
    }
}
