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
        Schema::create('puestos_trabajos_tareas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_puesto_trabajo');
            $table->foreign('id_puesto_trabajo')->references('id')->on('puesto_trabajos');
            $table->unsignedBigInteger('id_tarea');
            $table->foreign('id_tarea')->references('id')->on('tarea_trabajos');
            $table->primary(['id_puesto_trabajo', 'id_tarea']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puestos_trabajos_tareas');
    }
};
