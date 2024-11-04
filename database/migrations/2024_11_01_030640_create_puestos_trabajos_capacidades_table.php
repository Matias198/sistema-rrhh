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
        Schema::create('puestos_trabajos_capacidades', function (Blueprint $table) {
            $table->unsignedBigInteger('id_puesto_trabajo');
            $table->foreign('id_puesto_trabajo')->references('id')->on('puesto_trabajos');
            $table->unsignedBigInteger('id_capacidad');
            $table->foreign('id_capacidad')->references('id')->on('capacidades_trabajos');
            $table->primary(['id_puesto_trabajo', 'id_capacidad']);
            $table->boolean('excluyente')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puestos_trabajos_capacidades');
    }
};
