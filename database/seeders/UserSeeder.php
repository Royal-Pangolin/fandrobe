<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'role_id'        => 1,
                'first_name'     => 'Admin',
                'last_name'      => 'Fandrobe',
                'email'          => 'admin@fandrobe.com',
                'phone'          => '600000001',
                'password'       => Hash::make('password'),
                'email_verified' => true,
                'is_active'      => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'role_id'        => 2,
                'first_name'     => 'Pablo',
                'last_name'      => 'García',
                'email'          => 'pablo@fandrobe.com',
                'phone'          => '600000002',
                'password'       => Hash::make('password'),
                'email_verified' => true,
                'is_active'      => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'role_id'        => 2,
                'first_name'     => 'María',
                'last_name'      => 'López',
                'email'          => 'maria@fandrobe.com',
                'phone'          => '600000003',
                'password'       => Hash::make('password'),
                'email_verified' => true,
                'is_active'      => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
