<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OpcionCerrada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opcioncerrada', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dominio');
            $table->string('multiple'); //if multiple == 'NO' then SIMPLE
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
        Schema::dropIfExists('opcioncerrada');
    }
}
