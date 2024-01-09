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
        Schema::create('planification', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_projet')->nullable();
            $table->foreign('id_projet')->references('id')->on('projets')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('slug')->unique()->nullable();
            $table->string('nom')->nullable();
            $table->string('ressources_necessaires')->nullable();
            $table->string('resultat_attendus')->nullable();
            $table->string('hierachie')->nullable();
            $table->string('observation')->nullable();
            $table->date('date')->nullable();
            $table->enum('status',['Complete','Inachever','Approved','attente'])->default('attente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planification');
    }
};
