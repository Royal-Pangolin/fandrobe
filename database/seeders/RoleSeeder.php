<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'admin',    'description' => 'Administrador del sistema'],
            ['name' => 'customer', 'description' => 'Cliente registrado'],
        ];

        DB::table('roles')->insert($roles);
    }
}
