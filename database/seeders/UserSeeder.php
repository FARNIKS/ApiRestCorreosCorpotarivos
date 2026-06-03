<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'lector@corporatehrp.com'],
            [
                'name'     => 'User',
                'password' => Hash::make('User123'),
                'role'     => 'user',
            ]
        );
    }
}
