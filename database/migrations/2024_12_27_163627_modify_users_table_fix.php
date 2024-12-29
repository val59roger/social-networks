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
        Schema::dropIfExists('users'); // Supprimer la table existante

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->char('pseudo')->nullable();
            $table->string('first_name')->nullable();
            $table->string('name');
            $table->integer('age')->nullable();
            $table->string('email')->unique();
            $table->integer('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamp('date_inscription')->nullable();
            $table->char('url_profile')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
