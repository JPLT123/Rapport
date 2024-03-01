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
    Schema::create('rapport_semaine', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_user')->nullable();
        $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        $table->string('objet')->nullable();
        $table->string('slug')->unique()->nullable();
        $table->text('realisation')->nullable();
        $table->string('difficulte')->nullable();
        $table->string('budget')->nullable();
        $table->string('recommandation')->nullable();
        $table->date('findate')->nullable();
        $table->date('debutdate')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_rapport_semaine');
    }
};
