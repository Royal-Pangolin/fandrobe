<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['parent_id' => null, 'name' => 'Camisetas',  'slug' => 'camisetas',  'image_url' => null],
            ['parent_id' => null, 'name' => 'Sudaderas',  'slug' => 'sudaderas',  'image_url' => null],
            ['parent_id' => null, 'name' => 'Gorras',     'slug' => 'gorras',     'image_url' => null],
            ['parent_id' => null, 'name' => 'Accesorios', 'slug' => 'accesorios', 'image_url' => null],
            ['parent_id' => null, 'name' => 'Vinilo',     'slug' => 'vinilo',     'image_url' => null],
            ['parent_id' => null, 'name' => 'Pósters',    'slug' => 'posters',    'image_url' => null],
        ];

        DB::table('categories')->insert($categories);
    }
}
