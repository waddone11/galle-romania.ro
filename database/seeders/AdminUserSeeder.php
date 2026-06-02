<?php

namespace Database\Seeders;

use App\Models\User;
use BezhanSalleh\FilamentShield\Support\Utils;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $superAdminName = Utils::getSuperAdminName(); // default: super_admin
        $superRole = Role::firstOrCreate(['name' => $superAdminName, 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);

        $admin = User::firstOrCreate(
            ['email' => 'admin@galle-silva.ro'],
            [
                'name' => 'Admin Galle Silva',
                'password' => Hash::make('parola-temporara-galle-2026'),
                'email_verified_at' => now(),
            ]
        );

        $admin->assignRole($superRole);
    }
}
