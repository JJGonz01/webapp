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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('description')->nullable();
            $table->dateTime('date_start');
            $table->boolean('completed')->default(false); 
            $table->boolean('running')->default(false);
            $table->json('data_collected')->nullable();
            $table->integer('stage')->default(0);

            $table->float('bpm_lim')->default(0);
            $table->float('move_lim')->default(0);
            $table->string('time_show')->default("mostrarNada");

            $table->integer('percentage')->default(8);
            $table->float('movement')->default(0.6);
            $table->string('modoJuego')->default(0);

            $table->unsignedBigInteger('therapy_id');
            $table->foreign('therapy_id')->references('id')->on('therapies')->onDelete('cascade');

            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
