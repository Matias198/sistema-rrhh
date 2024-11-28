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
        Schema::create('puesto_trabajo_capacidades_trabajo', function (Blueprint $table) {
            $table->unsignedBigInteger('id_puesto_trabajo');
            $table->foreign('id_puesto_trabajo')->references('id')->on('puesto_trabajos');
            $table->unsignedBigInteger('id_capacidades_trabajo');
            $table->foreign('id_capacidades_trabajo')->references('id')->on('capacidades_trabajos');
            $table->primary(['id_puesto_trabajo', 'id_capacidades_trabajo']);
            $table->boolean('excluyente')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puesto_trabajo_capacidades_trabajo');
    }
};
