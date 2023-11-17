<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id('id_equipo');
            $table->string('estado_equipo');
            $table->integer('puntos')->default(0);
            $table->integer('capitan')->nullable();
            $table->unsignedBigInteger('fk_id_torneo')->nullable();

            // Definir la clave foránea a la tabla 'torneos'
            $table->foreign('fk_id_torneo')->references('id_torneo')->on('torneos');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
