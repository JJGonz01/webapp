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
        Schema::create('fuzzy_data', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->json('bpm_list');
            $table->json('movement_list');
            $table->Integer('heartIncreasing')->default(0);
            $table->Integer('moveIncreasing')->default(0); 
            $table->unsignedBigInteger('session_id');
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuzzy_data');
    }
};
