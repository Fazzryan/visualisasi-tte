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
            'nip' => '432007006200094',
            'name' => 'Fazryan',
            'email' => 'fazryan@gmail.com',
            'password' => Hash::make('BajuButut123@'),
            'role' => 'superadmin'
        ]);

        User::create([
            'nip' => '198607012022211001',
            'name' => 'Ganjar',
            'email' => 'jaynugraha@gmail.com',
            'password' => Hash::make('Jayjay123@'),
            'role' => 'admin'
        ]);

        User::create([
            'nip' => '20011109202512100',
            'name' => 'dinda',
            'email' => 'dinda@gmail.com',
            'password' => Hash::make('dinda@123'),
            'role' => 'user_skpd'
        ]);
    }
}
