<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_guru');
            $table->integer('id_list_pelajaran');
            $table->integer('id_bab');
            $table->integer('id_konten')->nullable();
            $table->text('topik');
            $table->enum('type',['Pilihan', 'Essai']);
            $table->text('soal');
            $table->text('jawaban_1')->nullable();
            $table->text('jawaban_2')->nullable();
            $table->text('jawaban_3')->nullable();
            $table->text('jawaban_4')->nullable();
            $table->text('jawaban_5')->nullable();
            $table->enum('benar', ['1','2','3','4','5']);
            $table->text('pembahasan');
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
        Schema::dropIfExists('soals');
    }
}
