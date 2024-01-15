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
        Schema::create('therapyforum', function (Blueprint $table) {
        $table->id();
        $table->timestamps();
        $table->string('title');
        $table->string('description')->nullable();
        $table->json('ids_upload')->nullable();
        $table->unsignedBigInteger('therapy_id');
        $table->foreign('therapy_id')->references('id')->on('therapies')->onDelete('cascade'); 
             
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
