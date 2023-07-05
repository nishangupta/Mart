<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $factoryUsers = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => 'admin'
            ],
            [
                'name' => 'Nishant',
                'email' => 'nishant@nishant.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => 'user'
            ],
            [
                'name' => 'Shreya',
                'email' => 'shreya@shreya.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => 'shipper'
            ],
        ];

        foreach ($factoryUsers as $user) {
            /** @var User $newUser */
            $newUser =  User::factory()->create([
                'name' => $user['name'],
                'email' => $user['email'],
            ]);

            $newUser->assignRole($user['role']);
        }
    }
}
