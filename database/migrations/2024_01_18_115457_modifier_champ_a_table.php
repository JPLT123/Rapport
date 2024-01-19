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
        DB::statement("ALTER TABLE planif_hebdomadaire MODIFY COLUMN status ENUM('Complete', 'Inachever', 'rejeter', 'Approved', 'attente') DEFAULT 'attente'");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('planif_hebdomadaire', function (Blueprint $table) {
            $table->string('status')->default('attente')->change();
        });
    }
};
