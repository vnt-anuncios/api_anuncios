<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAnuncioIdToDestacadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('destacados', function (Blueprint $table) {
            $table->bigInteger('anuncio_id')->unsigned()->nullable();
            $table->foreign('anuncio_id')->references('id')->on('anuncios')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('destacados', function (Blueprint $table) {
            //
        });
    }
}
