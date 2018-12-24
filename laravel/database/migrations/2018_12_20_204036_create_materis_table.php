<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_guru');
            $table->integer('id_list_pelajaran');
            $table->integer('id_bab');
            $table->text('topik');
            $table->text('materi')->nullable();
            $table->text('file')->nullable();
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
        Schema::dropIfExists('materis');
    }
}
