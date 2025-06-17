<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin KPI',
            'email' => 'admin@kpi.com',
            'password' => Hash::make('password'), // wajib di-hash
            'role' => 'admin',
        ]);

        // HRD
        User::create([
            'name' => 'HRD Lisa',
            'email' => 'lisa@kpi.com',
            'password' => Hash::make('password'),
            'role' => 'hrd',
        ]);

        // Karyawan
        User::create([
            'name' => 'Budi Karyawan',
            'email' => 'budi@kpi.com',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
        ]);
    }
}
