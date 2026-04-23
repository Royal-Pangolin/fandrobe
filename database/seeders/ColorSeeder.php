<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    public function run(): void
    {
        $colors = [
            ['name' => 'Negro',  'hex_code' => '#000000'],
            ['name' => 'Blanco', 'hex_code' => '#FFFFFF'],
            ['name' => 'Gris',   'hex_code' => '#808080'],
            ['name' => 'Rojo',   'hex_code' => '#FF0000'],
            ['name' => 'Azul',   'hex_code' => '#0000FF'],
            ['name' => 'Verde',  'hex_code' => '#008000'],
        ];

        DB::table('colors')->insert($colors);
    }
}
