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
            $table->string('s_nombe')->nullable();
            $table->string('apellido');
            $table->string('cuil');
            $table->string('legajo');
            $table->string('dni');
            $table->date('fecha_nacimiento');
            $table->date('fecha_ingreso'); 
            $table->unsignedBigInteger('id_puesto');
            $table->foreign('id_puesto')->references('id')->on('puesto_trabajos');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
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
