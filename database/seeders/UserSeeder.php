<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure roles exist or create them
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Create an Admin User (if not exists)
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );

        if (!$admin->hasRole($adminRole)) {
            $admin->assignRole($adminRole);
        }

        // Create a Test User (if not exists)
        $testUser = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
            ]
        );

        if (!$testUser->hasRole($userRole)) {
            $testUser->assignRole($userRole);
        }

        // Create Additional Random Users with roles
        User::factory(5)->create()->each(function ($user) use ($userRole) {
            if (!$user->hasRole($userRole)) {
                $user->assignRole($userRole);
            }
        });
    }
}
