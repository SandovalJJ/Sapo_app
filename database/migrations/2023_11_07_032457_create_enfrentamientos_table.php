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
            $table->unsignedBigInteger('fk_id_torneo');
            $table->unsignedBigInteger('id_equipo_local');
            $table->unsignedBigInteger('id_equipo_visitante');
            $table->integer('ronda')->default(1);
            $table->unsignedBigInteger('resultado')->nullable(); // Puede ser nulo si no hay resultado aún

            $table->foreign('fk_id_torneo')->references('id_torneo')->on('torneos');
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
