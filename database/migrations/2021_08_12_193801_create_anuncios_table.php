<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnunciosTable extends Migration
{
    
    public function up()
    {
        Schema::create('anuncios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo',30);
            $table->double('precio',8,4)->nullable();
            $table->date('fecha_publicacion');
            $table->string('condicion_encuentra',20);
            $table->string('ubicacion');
            $table->string('enlace',150);
            $table->string('descripcion',500);
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('categoria_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('categoria_id')->references('id')->on('categorias');
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
        Schema::dropIfExists('anuncios');
    }
}
