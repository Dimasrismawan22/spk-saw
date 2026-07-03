<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    // =========================
    // FIELD YANG BOLEH DIISI
    // =========================
    protected $fillable = [

        // NAMA USER
        'name',

        // EMAIL LOGIN
        'email',

        // PASSWORD LOGIN
        'password',
    ];

    // =========================
    // FIELD YANG DISEMBUNYIKAN
    // =========================
    protected $hidden = [

        // PASSWORD USER
        'password',

        // TOKEN REMEMBER ME
        'remember_token',
    ];

    // =========================
    // CAST DATA
    // =========================
    protected function casts(): array
    {
        return [

            // EMAIL VERIFIED
            'email_verified_at' => 'datetime',

            // PASSWORD OTOMATIS DI-HASH
            'password' => 'hashed',
        ];
    }
}