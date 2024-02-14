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
        Schema::table('filiales', function (Blueprint $table) {
            $table->unsignedBigInteger('id_Service')->nullable();
            $table->foreign('id_Service')->references('id')->on('services')->onDelete('cascade')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('filiales', function (Blueprint $table) {
            //
        });
    }
};
