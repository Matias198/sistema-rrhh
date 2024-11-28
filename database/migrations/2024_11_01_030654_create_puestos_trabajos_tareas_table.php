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
        Schema::create('puesto_trabajo_tarea_trabajo', function (Blueprint $table) {
            $table->unsignedBigInteger('id_puesto_trabajo');
            $table->foreign('id_puesto_trabajo')->references('id')->on('puesto_trabajos');
            $table->unsignedBigInteger('id_tarea_trabajo');
            $table->foreign('id_tarea_trabajo')->references('id')->on('tarea_trabajos');
            $table->primary(['id_puesto_trabajo', 'id_tarea_trabajo']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puesto_trabajo_tarea_trabajo');
    }
};
