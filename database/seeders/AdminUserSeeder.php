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

        // Credentiale din .env via config (compatibil cu config:cache). FLAG:
        // inainte de productie scoate fallback-ul de parola din config/app.php
        // si seteaza ADMIN_PASSWORD doar in .env — vezi README.
        $admin = User::updateOrCreate(
            ['email' => config('app.admin_email')],
            [
                'name' => 'Adrian Vasilescu',
                'password' => Hash::make(config('app.admin_password')),
            ]
        );

        // email_verified_at si role nu sunt mass-assignable (role ramane in afara
        // Fillable ca sa nu poata fi escaladat la inregistrare) — le setam explicit.
        $admin->forceFill([
            'email_verified_at' => $admin->email_verified_at ?? now(),
            'role' => 'admin',
        ])->save();

        $admin->assignRole($superRole);
    }
}
