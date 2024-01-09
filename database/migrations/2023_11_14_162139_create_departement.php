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
        Schema::create('departement', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_filiale')->nullable();
            $table->foreign('id_filiale')->references('id')->on('filiales')->onDelete('cascade')->onUpdate('cascade');
            $table->string('slug')->unique()->nullable();
            $table->string('nom')->nullable();
            $table->string('Description')->nullable();
            $table->string('Coutprevisionnel')->nullable();
            $table->string('observation')->nullable();
            $table->enum('status',['activer','supprimer','desactiver'])->default('activer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departement');
    }
};
