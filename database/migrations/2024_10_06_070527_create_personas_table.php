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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido'); 
            $table->string('dni')->unique();
            $table->string('cuil')->unique();
            $table->date('fecha_nacimiento');
            $table->unsignedBigInteger('id_sexo');
            $table->unsignedBigInteger('id_estado_civil');
            $table->unsignedBigInteger('id_municipio');
            $table->foreign('id_sexo')->references('id')->on('sexos');
            $table->foreign('id_estado_civil')->references('id')->on('estado_civils');
            $table->foreign('id_municipio')->references('id')->on('municipios');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
