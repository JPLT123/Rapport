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
        Schema::table('planif_hebdomadaire', function (Blueprint $table) {
            $table->unsignedBigInteger('importfile')->nullable();
            $table->foreign('importfile')->references('id')->on('importfile')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('planif_hebdomadaire', function (Blueprint $table) {
            //
        });
    }
};
