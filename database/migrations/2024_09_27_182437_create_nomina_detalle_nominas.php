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
        Schema::create('nomina_detalle_nominas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nomina');
            $table->unsignedBigInteger('id_detalle');

            // Definir las claves foráneas
            $table->foreign('id_nomina')->references('id')->on('nominas');
            $table->foreign('id_detalle')->references('id')->on('detalles');

            // Opción de incluir timestamps para tener control sobre la fecha de creación/actualización
            $table->timestamps();

            // Definir una clave primaria compuesta (opcional, para evitar duplicados)
            $table->primary(['id_nomina', 'id_detalle']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nomina_detalle_nominas');
    }
};
