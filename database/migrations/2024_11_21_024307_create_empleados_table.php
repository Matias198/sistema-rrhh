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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('legajo');
            $table->date('fecha_ingreso');
            $table->string('estado_laboral');
            $table->unsignedBigInteger('id_persona');
            $table->unsignedBigInteger('id_puesto_trabajo');
            $table->foreign('id_persona')->references('id')->on('personas');
            $table->foreign('id_puesto_trabajo')->references('id')->on('puesto_trabajos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
