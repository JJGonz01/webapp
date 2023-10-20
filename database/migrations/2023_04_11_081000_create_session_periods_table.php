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
        Schema::create('session_periods', function (Blueprint $table) {
            $table->id(); 
            $table->json('durations')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('therapy_id');
            $table->foreign('therapy_id')->references('id')->on('therapies')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_periods');
    }
};
