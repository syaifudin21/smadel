<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBantuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bantuans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pertanyaan');
            $table->string('judul');
            $table->integer('id_pengurus');
            $table->text('isi');
            $table->text('lampiran')->nullable();
            $table->text('like')->nullable();
            $table->text('dislike')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->enum('status', ['Show', 'Hidden'])->default('Hidden');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bantuans');
    }
}
