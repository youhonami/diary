<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Test User 1',
                'email' => 'test1@example.com',
                'password' => 'password',
            ],
            [
                'name' => 'Test User 2',
                'email' => 'test2@example.com',
                'password' => 'password',
            ],
            [
                'name' => 'Test User 3',
                'email' => 'test3@example.com',
                'password' => 'password',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                ],
            );
        }
    }
}
