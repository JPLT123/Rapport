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
        Schema::create('taches_supplementaires', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('description')->nullable();
            $table->string('justification')->nullable();
            $table->string('duree')->nullable();
            $table->string('impact')->nullable();
            $table->date('date')->nullable();
            $table->enum('status',['approuver','rejeter','attente'])->default('attente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taches_supplementaires');
    }
};
