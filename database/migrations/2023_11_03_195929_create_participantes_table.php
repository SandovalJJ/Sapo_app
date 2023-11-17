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
        Schema::create('participantes', function (Blueprint $table) {
            $table->string('cedula')->primary();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('telefono');
            $table->string('correo');
            $table->integer('puntos')->default(0);
            $table->integer('puntosTemporal')->default(0);
            $table->string('agencia');
            $table->string('estado')->default('pendiente');
            $table->unsignedBigInteger('fk_id_equipo')->nullable();

            // Definir la clave foránea a la tabla 'equipos'
            $table->foreign('fk_id_equipo')->references('id_equipo')->on('equipos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participantes');
    }
};
