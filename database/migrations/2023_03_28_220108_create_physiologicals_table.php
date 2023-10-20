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
        Schema::create('physiologicals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('patient_id');//MEMORIA: NECESITAMOS DECLARAR Y LUEGO LLAMAMOS A FOREING KEY
            $table->string('type');
            $table->string('description')->nullable();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade'); ///FK ^
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('physiologicals');
    }
};
