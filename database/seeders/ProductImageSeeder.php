<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        $images = [
            [
                'product_id' => 1,
                'url'        => 'https://placehold.co/600x600/beige/white?text=Un+Verano+Sin+Ti',
                'alt_text'   => 'Camiseta Un Verano Sin Ti frontal',
                'is_cover'   => true,
            ],
            [
                'product_id' => 2,
                'url'        => 'https://placehold.co/600x600/beige/white?text=Motomami',
                'alt_text'   => 'Camiseta Motomami',
                'is_cover'   => true,
            ],
            [
                'product_id' => 3,
                'url'        => 'https://placehold.co/600x600/beige/white?text=El+Madrileno',
                'alt_text'   => 'Sudadera El Madrileño',
                'is_cover'   => true,
            ],
            [
                'product_id' => 4,
                'url'        => 'https://placehold.co/600x600/beige/white?text=BZRP',
                'alt_text'   => 'Gorra Bizarrap',
                'is_cover'   => true,
            ],
            [
                'product_id' => 5,
                'url'        => 'https://placehold.co/600x600/beige/white?text=Music+Spheres',
                'alt_text'   => 'Camiseta Coldplay',
                'is_cover'   => true,
            ],
            [
                'product_id' => 6,
                'url'        => 'https://placehold.co/600x600/beige/white?text=The+Eras+Tour',
                'alt_text'   => 'Sudadera Taylor Swift',
                'is_cover'   => true,
            ],
            [
                'product_id' => 7,
                'url'        => 'https://placehold.co/600x600/beige/white?text=DAMN.',
                'alt_text'   => 'Vinilo Kendrick Lamar',
                'is_cover'   => true,
            ],
            [
                'product_id' => 8,
                'url'        => 'https://placehold.co/600x600/beige/white?text=AM',
                'alt_text'   => 'Póster Arctic Monkeys',
                'is_cover'   => true,
            ],
            [
                'product_id' => 9,
                'url'        => 'https://placehold.co/600x600/beige/white?text=RAM',
                'alt_text'   => 'Camiseta Daft Punk',
                'is_cover'   => true,
            ],
            [
                'product_id' => 10,
                'url'        => 'https://placehold.co/600x600/beige/white?text=DQE',
                'alt_text'   => 'Sudadera Quevedo',
                'is_cover'   => true,
            ],
            [
                'product_id' => 11,
                'url'        => 'https://placehold.co/600x600/beige/white?text=Colores',
                'alt_text'   => 'Gorra J Balvin',
                'is_cover'   => true,
            ],
            [
                'product_id' => 12,
                'url'        => 'https://placehold.co/600x600/beige/white?text=Future+Nostalgia',
                'alt_text'   => 'Vinilo Dua Lipa',
                'is_cover'   => true,
            ],
        ];

        DB::table('product_images')->insert($images);
    }
}
