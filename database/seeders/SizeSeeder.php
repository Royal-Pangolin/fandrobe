<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    public function run(): void
    {
        $sizes = [
            ['name' => 'XS', 'sort_order' => 1],
            ['name' => 'S',  'sort_order' => 2],
            ['name' => 'M',  'sort_order' => 3],
            ['name' => 'L',  'sort_order' => 4],
            ['name' => 'XL', 'sort_order' => 5],
            ['name' => 'XXL','sort_order' => 6],
        ];

        DB::table('sizes')->insert($sizes);
    }
}