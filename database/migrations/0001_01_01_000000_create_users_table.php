<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration
     */
    public function up(): void
    {
        // =========================
        // TABEL USERS
        // =========================
        Schema::create('users', function (Blueprint $table) {

            // PRIMARY KEY
            $table->id();

            // =========================
            // DATA USER
            // =========================

            // NAMA USER
            $table->string('name');

            // EMAIL LOGIN
            $table->string('email')
                  ->unique();

            // VERIFIKASI EMAIL
            $table->timestamp('email_verified_at')
                  ->nullable();

            // PASSWORD LOGIN
            $table->string('password');

            // REMEMBER LOGIN
            $table->rememberToken();

            // TIMESTAMP
            $table->timestamps();
        });

        // =========================
        // RESET PASSWORD
        // =========================
        Schema::create('password_reset_tokens', function (Blueprint $table) {

            // EMAIL USER
            $table->string('email')
                  ->primary();

            // TOKEN RESET
            $table->string('token');

            // WAKTU TOKEN
            $table->timestamp('created_at')
                  ->nullable();
        });

        // =========================
        // SESSION LOGIN
        // =========================
        Schema::create('sessions', function (Blueprint $table) {

            // SESSION ID
            $table->string('id')
                  ->primary();

            // USER LOGIN
            $table->foreignId('user_id')
                  ->nullable()
                  ->index();

            // IP ADDRESS
            $table->string('ip_address', 45)
                  ->nullable();

            // DEVICE / BROWSER
            $table->text('user_agent')
                  ->nullable();

            // DATA SESSION
            $table->longText('payload');

            // LAST ACTIVITY
            $table->integer('last_activity')
                  ->index();
        });
    }

    /**
     * Hapus tabel
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');

        Schema::dropIfExists('password_reset_tokens');

        Schema::dropIfExists('users');
    }
};