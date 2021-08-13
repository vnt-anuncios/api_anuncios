<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favoritos', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('anuncio_id')->unsigned();
            $table->primary(['user_id','anuncio_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('anuncio_id')->references('id')->on('anuncios');
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
        Schema::dropIfExists('favoritos');
    }
}
