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
        Schema::create('regla_individuals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->Integer('conjuntoPeriodo')->default(0);
            $table->String('periodo')->default('Cualquiera');
            $table->String('momentoPeriodo')->default('Entero');
            $table->json('condiciones');
            $table->String('accion1')->default('Nada');
            $table->String('accion2')->default('Nada');
            $table->unsignedBigInteger('ruleset_id');
            $table->foreign('ruleset_id')->references('id')->on('reglas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regla_individuals');
    }
};
