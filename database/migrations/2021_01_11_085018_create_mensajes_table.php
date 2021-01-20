<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_emisor')->unsigned();
            $table->foreign('id_emisor')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_receptor')->unsigned();
            $table->foreign('id_receptor')->references('id')->on('users')->onDelete('cascade');
            $table->char('pm');
            $table->string('mensaje', 4096);
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
        Schema::dropIfExists('mensajes');
    }
}
