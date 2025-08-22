<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ambil role dari database
        // Method firstOrFail() akan menghentikan proses jika role tidak ditemukan
        $adminRole = Role::where('name', 'Admin')->firstOrFail();
        $userRole = Role::where('name', 'User')->firstOrFail();

        // 2. Buat User Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role_id' => $adminRole->role_id, // Gunakan ID dari role admin yang sudah diambil
        ]);

        // 3. Buat User Biasa
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role_id' => $userRole->role_id, // Gunakan ID dari role user yang sudah diambil
        ]);
    }
}
