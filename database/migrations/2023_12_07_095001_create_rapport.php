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
        Schema::create('rapport', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_prochain_tache')->nullable();
            $table->foreign('id_prochain_tache')->references('id')->on('tacheprochain')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_tache')->nullable();
            $table->foreign('id_tache')->references('id')->on('taches')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('tache_realiser')->nullable();
            $table->string('tache_suplementaire')->nullable();
            $table->time('debut_heure')->nullable();
            $table->time('fin_heure')->nullable();
            $table->string('materiels_utiliser')->nullable();
            $table->string('lieu')->nullable();
            $table->string('observation')->nullable();
            $table->string('observationglobal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapport');
    }
};
