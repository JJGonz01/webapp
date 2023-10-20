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
        Schema::create('session_results', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->json('bpm_valores')->nullable();
            $table->json('bpm_medios')->nullable();
            $table->json('move_valores')->nullable();
            $table->json('move_medios')->nullable();
            $table->integer('bpm_limite')->nullable();
            $table->json('rules')->nullable();
            $table->json('listaReglasIniciales')->nullable();
            $table->integer('puntosObtenidos')->nullable();
            $table->unsignedBigInteger('session_id');
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_results');
    }
};
