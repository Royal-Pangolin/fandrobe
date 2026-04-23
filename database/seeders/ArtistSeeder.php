<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtistSeeder extends Seeder
{
    public function run(): void
    {
        $artists = [
            [
                'genre_id' => 1,
                'name'     => 'Bad Bunny',
                'bio'      => 'Artista urbano puertorriqueño, referente del reggaeton y trap latino.',
                'is_active' => true,
            ],
            [
                'genre_id' => 2,
                'name'     => 'Rosalía',
                'bio'      => 'Cantante española de flamenco fusionado con pop y urbano.',
                'is_active' => true,
            ],
            [
                'genre_id' => 3,
                'name'     => 'C. Tangana',
                'bio'      => 'Artista madrileño de música urbana y fusión española.',
                'is_active' => true,
            ],
            [
                'genre_id' => 1,
                'name'     => 'Bizarrap',
                'bio'      => 'Productor y DJ argentino conocido por sus Music Sessions.',
                'is_active' => true,
            ],
            [
                'genre_id' => 4,
                'name'     => 'Coldplay',
                'bio'      => 'Banda británica de rock alternativo y pop.',
                'is_active' => true,
            ],
        ];

        DB::table('artists')->insert($artists);
    }
}
