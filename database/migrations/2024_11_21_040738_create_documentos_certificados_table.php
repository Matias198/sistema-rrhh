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
        Schema::create('documentos_certificados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_persona');
            $table->unsignedBigInteger('id_tipo_documento');
            $table->foreign('id_persona')->references('id')->on('personas');
            $table->foreign('id_tipo_documento')->references('id')->on('tipos_documentos');
            $table->string('nombre_archivo');
            $table->string('detalle', 255)->nullable();
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos_certificados');
    }
};
