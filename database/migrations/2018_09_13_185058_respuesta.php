<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Respuesta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuesta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('marcada');
            $table->string('texto');
            $table->integer('formulario_id')->unsigned();
            $table->foreign('formulario_id')->references('id')->on('formulario')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('opcion_id')->unsigned();
            $table->foreign('opcion_id')->references('id')->on('opcion')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('encuesta_id')->unsigned();
            $table->foreign('encuesta_id')->references('id')->on('encuesta')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('respuesta');
    }
}
