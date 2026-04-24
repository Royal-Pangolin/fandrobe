<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'artist_id'   => 1,
                'category_id' => 1,
                'name'        => 'Camiseta Bad Bunny Un Verano Sin Ti',
                'slug'        => 'camiseta-bad-bunny-un-verano-sin-ti',
                'description' => 'Camiseta oficial de la gira Un Verano Sin Ti.',
                'sku'         => 'BB-CAM-001',
                'base_price'  => 34.99,
                'is_active'   => true,
            ],
            [
                'artist_id'   => 2,
                'category_id' => 1,
                'name'        => 'Camiseta Rosalía Motomami',
                'slug'        => 'camiseta-rosalia-motomami',
                'description' => 'Camiseta oficial del álbum Motomami.',
                'sku'         => 'ROS-CAM-001',
                'base_price'  => 29.99,
                'is_active'   => true,
            ],
            [
                'artist_id'   => 3,
                'category_id' => 2,
                'name'        => 'Sudadera C. Tangana El Madrileño',
                'slug'        => 'sudadera-c-tangana-el-madrileno',
                'description' => 'Sudadera oficial del álbum El Madrileño.',
                'sku'         => 'CT-SUD-001',
                'base_price'  => 49.99,
                'is_active'   => true,
            ],
            [
                'artist_id'   => 4,
                'category_id' => 3,
                'name'        => 'Gorra Bizarrap Sessions',
                'slug'        => 'gorra-bizarrap-sessions',
                'description' => 'Gorra oficial de las Bizarrap Music Sessions.',
                'sku'         => 'BIZ-GOR-001',
                'base_price'  => 24.99,
                'is_active'   => true,
            ],
            [
                'artist_id'   => 5,
                'category_id' => 1,
                'name'        => 'Camiseta Coldplay Music of the Spheres',
                'slug'        => 'camiseta-coldplay-music-of-the-spheres',
                'description' => 'Camiseta oficial de la gira Music of the Spheres.',
                'sku'         => 'CP-CAM-001',
                'base_price'  => 39.99,
                'is_active'   => true,
            ],
        ];

        DB::table('products')->insert($products);
    }
}