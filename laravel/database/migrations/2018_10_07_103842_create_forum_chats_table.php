<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_chats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_forum');
            $table->integer('id_pengurus')->nullable();
            $table->integer('id_siswa')->nullable();
            $table->integer('id_chat')->nullable();
            $table->string('chat');
            $table->timestamp('waktu')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forum_chats');
    }
}
