<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'percentage', 'description' => 'Descuento en porcentaje sobre el total'],
            ['name' => 'fixed',      'description' => 'Descuento de cantidad fija en euros'],
        ];

        DB::table('discount_types')->insert($types);
    }
}