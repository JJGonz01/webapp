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
        Schema::create('ter_pats', function (Blueprint $table) {
            $table->timestamps();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('therapy_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('therapy_id')->references('id')->on('therapies')->onDelete('cascade');
            $table->primary(['patient_id', 'therapy_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ter_pats');
    }
};
