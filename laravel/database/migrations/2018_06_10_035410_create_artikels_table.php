<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtikelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artikels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul');
            $table->string('slug_judul');
            $table->text('text_pembuka');
            $table->string('tag')->nullable();
            $table->text('artikel');
            $table->text('lampiran')->nullable();
            $table->enum('status_user', ['Pengurus', 'Pengajar', 'Siswa']);
            $table->integer('id_user');
            $table->enum('status', ['Tampil', 'Sembunyi', 'Blok', 'Pengajuan'])->default('Pengajuan');
            $table->enum('user_acc', ['Pengurus', 'Pengajar'])->nullable();
            $table->integer('id_user_acc')->nullable();
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
        Schema::dropIfExists('artikels');
    }
}
