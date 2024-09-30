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
        Schema::create('nominas', function (Blueprint $table) {
            $table->id();
            $table->string('apellido_nombre');
            $table->string('legajo');
            $table->string('cuil');
            $table->string('trabajo_categoria');
            $table->string('trabajo_division');
            $table->string('trabajo_dpto');
            $table->date('f_ingreso');
            $table->decimal('sueldo');
            $table->string('liq_tipo_mes_año');
            $table->string('jubilado_periodo')->nullable();
            $table->date('jubilado_fecha')->nullable();
            $table->string('jubilado_banco')->nullable();
            $table->date('pago_lugar_fecha');            
            $table->unsignedBigInteger('id_persona');
            $table->foreign('id_persona')->references('id')->on('personas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nominas');
    }
};
