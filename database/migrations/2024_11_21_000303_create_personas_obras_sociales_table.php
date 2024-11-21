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
        Schema::create('personas_obras_sociales', function (Blueprint $table) {
            $table->unsignedBigInteger('id_persona');
            $table->foreign('id_persona')->references('id')->on('personas');
            $table->unsignedBigInteger('id_obra_social');
            $table->foreign('id_obra_social')->references('id')->on('obras_sociales');
            $table->string('numero_afiliado');
            $table->primary(['id_persona', 'id_obra_social']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas_obras_sociales');
    }
};
