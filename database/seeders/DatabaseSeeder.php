<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nip' => '198607012022211001',
            'name' => 'Ganjar',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('BajuButut123@'),
            'role' => 'superadmin'
        ]);

        // 2. Akun ADMIN/STAFF (19 akun tambahan)
        // Kita akan membuat 19 akun acak lainnya
        for ($i = 0; $i < 19; $i++) {
            $is_admin = $i < 3 ? 'admin' : 'user_skpd'; // Buat 3 akun pertama sebagai admin, sisanya user

            User::create([
                // Contoh format NIP acak 18 digit
                'nip' => '19' . rand(70, 99) . rand(10, 12) . rand(10, 31) . rand(1000, 9999) . rand(1, 4) . rand(100, 999),

                // Gunakan Faker untuk data nama dan email
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),

                // Semua akun menggunakan password yang sama untuk kemudahan
                'password' => Hash::make('password'),
                'role' => $is_admin,
            ]);
        }
    }
}
