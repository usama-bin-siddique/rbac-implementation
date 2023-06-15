<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'admin', 'guard_name' => 'web', 'created_at' => now()],
            ['name' => 'user', 'guard_name' => 'web', 'created_at' => now()],
        ];

        if (Role::query()->count() === 0) {
            Role::query()->insert($roles);
        }
    }
}
