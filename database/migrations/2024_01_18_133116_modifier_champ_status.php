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
        DB::statement("ALTER TABLE projets MODIFY COLUMN status ENUM('attente', 'Terminer', 'Retard', 'Avance', 'Suspendu', 'supprimer', 'activer') DEFAULT 'attente'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Si nécessaire, vous pouvez définir la colonne status comme string dans la migration de rollback
        Schema::table('projets', function (Blueprint $table) {
            $table->string('status')->default('attente')->change();
        });
    }

    // public function up()
    // {
    //     // Changez le type de la colonne status à enum avec des valeurs spécifiées
    //     Schema::table('projets', function (Blueprint $table) {
    //         $table->enum('status', ['attente', 'Terminer', 'Retard', 'Avance', 'Suspendu', 'supprimer', 'activer'])->default('attente')->change();
    //     });
    // }

    // /**
    //  * Reverse the migrations.
    //  *
    //  * @return void
    //  */
    // public function down()
    // {
    //     // Si nécessaire, vous pouvez définir la colonne status comme string dans la migration de rollback
    //     Schema::table('projets', function (Blueprint $table) {
    //         $table->string('status')->default('attente')->change();
    //     });
    // }
};
