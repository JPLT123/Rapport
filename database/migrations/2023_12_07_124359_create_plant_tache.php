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
        Schema::create('plant_tache', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tache')->nullable();
            $table->foreign('id_tache')->references('id')->on('taches')->onDelete('cascade')->onUpdate('cascade');
            
            $table->unsignedBigInteger('id_planif')->nullable();
            $table->foreign('id_planif')->references('id')->on('planif_hebdomadaire')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plant_tache');
    }
};
