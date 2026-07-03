<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Jalankan database seeder.
     */
    public function run(): void
    {
        // =====================================================
        // AKUN TUNGGAL WAKIL KESISWAAN
        // =====================================================

        // Email login Wakil Kesiswaan
        $email = 'kesiswaan@smpn1pamekasan.sch.id';

        // Password login Wakil Kesiswaan
        $password = 'kesiswaan123';

        // =====================================================
        // HAPUS USER LAIN
        // =====================================================
        // Tujuannya agar sistem hanya memiliki 1 user,
        // yaitu Wakil Kesiswaan.
        User::where('email', '!=', $email)->delete();

        // =====================================================
        // BUAT / UPDATE AKUN WAKIL KESISWAAN
        // =====================================================
        User::updateOrCreate(
            [
                'email' => $email,
            ],
            [
                'name' => 'Wakil Kesiswaan',

                // Password disimpan dalam bentuk hash
                'password' => Hash::make($password),
            ]
        );
    }
}