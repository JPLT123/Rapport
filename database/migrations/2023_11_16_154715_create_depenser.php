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
        Schema::create('depenser', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique()->nullable();
            $table->string('Designation')->nullable();
            $table->string('CoutReel')->nullable();
            $table->string('Coutprevisionnel')->nullable();
            $table->string('observation')->nullable();
            $table->enum('status',['activer','supprimer','desactiver'])->default('activer');
            $table->unsignedBigInteger('id_tache')->nullable();
            $table->foreign('id_tache')->references('id')->on('taches')->onDelete('cascade')->onUpdate('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depenser');
    }
};
