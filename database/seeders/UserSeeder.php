<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // `password`
        $password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

        $factoryUsers = [
            [
                'name' => 'Admin',
                'email' => 'admin@2023.laravelconf.tw',
                'password' => $password,
                'role' => 'admin'
            ],
            [
                'name' => 'Miles',
                'email' => 'miles@2023.laravelconf.tw',
                'password' => $password,
                'role' => 'user'
            ],
            [
                'name' => 'Nathan',
                'email' => 'nathan@2023.laravelconf.tw',
                'password' => $password,
                'role' => 'shipper'
            ],
            [
                'name' => 'Ban',
                'email' => 'ban@2023.laravelconf.tw',
                'password' => $password,
                'role' => 'user'
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
