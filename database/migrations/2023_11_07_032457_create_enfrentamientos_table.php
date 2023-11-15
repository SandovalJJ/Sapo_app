<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnfrentamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enfrentamientos', function (Blueprint $table) {
            $table->id('id_enfrentamiento'); // Llave primaria autoincremental
            $table->unsignedBigInteger('id_equipo_local')->nullable();
            $table->unsignedBigInteger('id_equipo_visitante')->nullable();
            $table->unsignedBigInteger('resultado')->nullable();
            $table->foreign('id_equipo_local')->references('id_equipo')->on('equipos');
            $table->foreign('id_equipo_visitante')->references('id_equipo')->on('equipos');

            // Deshabilita las columnas created_at y updated_at
  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enfrentamientos');
    }
}
