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
        Schema::table('rapport', function (Blueprint $table) {
            
            $table->unsignedBigInteger('general')->nullable();
            $table->foreign('general')->references('id')->on('rapportgeneral')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rapport', function (Blueprint $table) {
            //
        });
    }
};
