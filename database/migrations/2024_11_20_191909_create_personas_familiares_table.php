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
        Schema::create('personas_familiares', function (Blueprint $table) {
            $table->unsignedBigInteger('id_persona');
            $table->foreign('id_persona')->references('id')->on('personas');
            $table->unsignedBigInteger('id_familiar');
            $table->foreign('id_familiar')->references('id')->on('familiares');
            $table->unsignedBigInteger('id_tipo_relacion');
            $table->foreign('id_tipo_relacion')->references('id')->on('tipos_relaciones');
            $table->string('detalle'); 
            $table->boolean('estado')->default(true);
            $table->primary(['id_persona', 'id_familiar']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas_familiares');
    }
};
