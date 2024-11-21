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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_archivo');
            $table->date('fecha_vencimiento');
            $table->boolean('estado');
            $table->unsignedBigInteger('id_empleado');
            $table->unsignedBigInteger('id_tipo_contrato');
            $table->unsignedBigInteger('id_tipo_jornada');
            $table->foreign('id_empleado')->references('id')->on('empleados');
            $table->foreign('id_tipo_contrato')->references('id')->on('tipo_contratos');
            $table->foreign('id_tipo_jornada')->references('id')->on('tipo_jornadas');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
