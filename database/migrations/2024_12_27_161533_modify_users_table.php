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
        Schema::table('users', function (Blueprint $table) {
            $table->char('pseudo')->nullable(); // Ajout d'une colonne 'pseudo' facultative
            $table->string('prenom')->nullable(); // Ajout d'une colonne 'prenom' facultative
            $table->integer('age')->nullable(); // Ajout d'une colonne 'age' facultative
            $table->int('telephone')->nullable(); // Ajout d'une colonne 'telephone' facultative
            $table->timestamp('date_inscription')->nullable(); // Ajout d'une colonne 'date_inscription' facultative
            $table->char('url_profile')->nullable(); // Ajout d'une colonne 'url_profile' facultative
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('pseudo')->nullable(); // Supprimer la colonne 'pseudo' en cas de rollback
            $table->dropColumn('prenom')->nullable(); // Supprimer la colonne 'prenom' en cas de rollback
            $table->dropColumn('age')->nullable(); // Supprimer la colonne 'age' en cas de rollback
            $table->dropColumn('telephone')->nullable(); // Supprimer la colonne 'telephone' en cas de rollback
            $table->intdropColumneger('date_inscription')->nullable(); // Supprimer la colonne 'date_inscription' en cas de rollback
            $table->dropColumn('url_profile')->nullable(); // Supprimer la colonne 'url_profile' en cas de rollback
        });
    }
};
