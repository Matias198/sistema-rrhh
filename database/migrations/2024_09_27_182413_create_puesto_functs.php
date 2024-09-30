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
        Schema::create('puesto_functs', function (Blueprint $table) {
            // Claves foráneas para la relación muchos a muchos
            $table->unsignedBigInteger('id_funcion');
            $table->unsignedBigInteger('id_puesto');

            // Definir las claves foráneas
            $table->foreign('id_funcion')->references('id')->on('funcion_trabajos');
            $table->foreign('id_puesto')->references('id')->on('puesto_trabajos');

            // Opción de incluir timestamps para tener control sobre la fecha de creación/actualización
            $table->timestamps();

            // Definir una clave primaria compuesta (opcional, para evitar duplicados)
            $table->primary(['id_funcion', 'id_puesto']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puesto_functs');
    }
};
