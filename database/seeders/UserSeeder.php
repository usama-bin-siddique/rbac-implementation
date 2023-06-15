<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            'name' => 'admin',
            'phone' => '923211234567',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ];

        if (User::count() === 0) {

            User::create([
                'name' => $user['name'],
                'phone' => $user['phone'],
                'email' => $user['email'],
                'password' => $user['password'],
            ])
                ->assignRole('admin');
        }
    }
}
