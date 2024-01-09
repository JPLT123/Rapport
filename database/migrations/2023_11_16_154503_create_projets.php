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
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_filiale')->nullable();
            $table->foreign('id_filiale')->references('id')->on('filiales')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nom')->nullable();
            $table->string('code')->nullable();
            $table->string('description')->nullable();
            $table->date('debutdate')->nullable();
            $table->date('findate')->nullable();
            $table->enum('status',['attente','Terminer','Retard','Avance','Suspendu','supprimer'])->default('attente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projets');
    }
};
