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
        Schema::create('cuenta_bancos', function (Blueprint $table) {
            // Claves foráneas para la relación muchos a muchos
        $table->unsignedBigInteger('id_persona');
        $table->unsignedBigInteger('id_banco');
        $table->unsignedBigInteger('id_tipo');

        // Definir las claves foráneas
        $table->foreign('id_persona')->references('id')->on('personas');
        $table->foreign('id_banco')->references('id')->on('bancos');
        $table->foreign('id_tipo')->references('id')->on('tipo_bancos');

        // Opción de incluir timestamps para tener control sobre la fecha de creación/actualización
        $table->timestamps();

        // Definir una clave primaria compuesta (opcional, para evitar duplicados)
        $table->primary(['id_persona', 'id_banco']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuenta_bancos');
    }
};
