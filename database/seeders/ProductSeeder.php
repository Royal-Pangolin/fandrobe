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
                'name'        => 'Camiseta Bad Bunny Un Verano Sin Ti',
                'slug'        => 'camiseta-bad-bunny-un-verano-sin-ti',
                'description' => 'Camiseta oficial de la gira Un Verano Sin Ti.',
                'sku'         => 'BB-CAM-001',
                'base_price'  => 34.99,
                'is_active'   => true,
            ],
            [
                'artist_id'   => 2,
                'name'        => 'Camiseta Rosalía Motomami',
                'slug'        => 'camiseta-rosalia-motomami',
                'description' => 'Camiseta oficial del álbum Motomami.',
                'sku'         => 'ROS-CAM-001',
                'base_price'  => 29.99,
                'is_active'   => true,
            ],
            [
                'artist_id'   => 3,
                'name'        => 'Sudadera C. Tangana El Madrileño',
                'slug'        => 'sudadera-c-tangana-el-madrileno',
                'description' => 'Sudadera oficial del álbum El Madrileño.',
                'sku'         => 'CT-SUD-001',
                'base_price'  => 49.99,
                'is_active'   => true,
            ],
            [
                'artist_id'   => 4,
                'name'        => 'Gorra Bizarrap Sessions',
                'slug'        => 'gorra-bizarrap-sessions',
                'description' => 'Gorra oficial de las Bizarrap Music Sessions.',
                'sku'         => 'BIZ-GOR-001',
                'base_price'  => 24.99,
                'is_active'   => true,
            ],
            [
                'artist_id'   => 5,
                'name'        => 'Camiseta Coldplay Music of the Spheres',
                'slug'        => 'camiseta-coldplay-music-of-the-spheres',
                'description' => 'Camiseta oficial de la gira Music of the Spheres.',
                'sku'         => 'CP-CAM-001',
                'base_price'  => 39.99,
                'is_active'   => true,
            ],
            [
                'artist_id'   => 6,
                'name'        => 'Sudadera Taylor Swift The Eras Tour',
                'slug'        => 'sudadera-taylor-swift-the-eras-tour',
                'description' => 'Sudadera oficial de la gira The Eras Tour.',
                'sku'         => 'TS-SUD-001',
                'base_price'  => 54.99,
                'is_active'   => true,
            ],
            [
                'artist_id'   => 7,
                'name'        => 'Vinilo Kendrick Lamar DAMN',
                'slug'        => 'vinilo-kendrick-lamar-damn',
                'description' => 'Edición especial en vinilo del álbum DAMN.',
                'sku'         => 'KL-VIN-001',
                'base_price'  => 34.99,
                'is_active'   => true,
            ],
            [
                'artist_id'   => 8,
                'name'        => 'Póster Arctic Monkeys AM',
                'slug'        => 'poster-arctic-monkeys-am',
                'description' => 'Póster oficial del álbum AM de Arctic Monkeys.',
                'sku'         => 'AM-POS-001',
                'base_price'  => 14.99,
                'is_active'   => true,
            ],
            [
                'artist_id'   => 9,
                'name'        => 'Camiseta Daft Punk Random Access Memories',
                'slug'        => 'camiseta-daft-punk-random-access-memories',
                'description' => 'Camiseta oficial de Daft Punk edición Random Access Memories.',
                'sku'         => 'DP-CAM-001',
                'base_price'  => 29.99,
                'is_active'   => true,
            ],
            [
                'artist_id'   => 10,
                'name'        => 'Sudadera Quevedo DQE',
                'slug'        => 'sudadera-quevedo-dqe',
                'description' => 'Sudadera oficial del álbum Donde Quiero Estar.',
                'sku'         => 'QV-SUD-001',
                'base_price'  => 44.99,
                'is_active'   => true,
            ],
            [
                'artist_id'   => 11,
                'name'        => 'Gorra J Balvin Colores',
                'slug'        => 'gorra-j-balvin-colores',
                'description' => 'Gorra oficial de la colección Colores.',
                'sku'         => 'JB-GOR-001',
                'base_price'  => 24.99,
                'is_active'   => true,
            ],
            [
                'artist_id'   => 12,
                'name'        => 'Vinilo Dua Lipa Future Nostalgia',
                'slug'        => 'vinilo-dua-lipa-future-nostalgia',
                'description' => 'Edición exclusiva en vinilo del álbum Future Nostalgia.',
                'sku'         => 'DL-VIN-001',
                'base_price'  => 32.99,
                'is_active'   => true,
            ],
        ];

        DB::table('products')->insert($products);

        // Categorías: 1=Camisetas, 2=Sudaderas, 3=Gorras, 4=Accesorios, 5=Vinilo, 6=Pósters
        // Asignamos varias categorías por producto para demostrar la relación N:M
        DB::table('category_product')->insert([
            ['product_id' => 1, 'category_id' => 1], // Bad Bunny → Camisetas
            ['product_id' => 1, 'category_id' => 4], // Bad Bunny → Accesorios
            ['product_id' => 2, 'category_id' => 1], // Rosalía → Camisetas
            ['product_id' => 3, 'category_id' => 2], // C. Tangana → Sudaderas
            ['product_id' => 4, 'category_id' => 3], // Bizarrap → Gorras
            ['product_id' => 4, 'category_id' => 4], // Bizarrap → Accesorios
            ['product_id' => 5, 'category_id' => 1], // Coldplay → Camisetas
            ['product_id' => 6, 'category_id' => 2], // Taylor Swift → Sudaderas
            ['product_id' => 7, 'category_id' => 5], // Kendrick Lamar → Vinilo
            ['product_id' => 8, 'category_id' => 6], // Arctic Monkeys → Pósters
            ['product_id' => 9, 'category_id' => 1], // Daft Punk → Camisetas
            ['product_id' => 10, 'category_id' => 2], // Quevedo → Sudaderas
            ['product_id' => 11, 'category_id' => 3], // J Balvin → Gorras
            ['product_id' => 11, 'category_id' => 4], // J Balvin → Accesorios
            ['product_id' => 12, 'category_id' => 5], // Dua Lipa → Vinilo
        ]);
    }
}
