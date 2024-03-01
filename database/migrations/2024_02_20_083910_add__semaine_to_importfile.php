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
        Schema::table('importfile', function (Blueprint $table) {
            $table->unsignedBigInteger('semaine')->nullable();
            $table->foreign('semaine')->references('id')->on('rapport_semaine')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('importfile', function (Blueprint $table) {
            //
        });
    }
};
