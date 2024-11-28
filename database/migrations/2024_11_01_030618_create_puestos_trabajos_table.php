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
        Schema::create('puesto_trabajos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo_puesto')->unique();
            $table->string('descripcion_generica');
            $table->decimal('sueldo_base', 999, 2);
            $table->unsignedBigInteger('id_departamento_trabajo');
            $table->foreign('id_departamento_trabajo')->references('id')->on('departamento_trabajos');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puesto_trabajos');
    }
};
