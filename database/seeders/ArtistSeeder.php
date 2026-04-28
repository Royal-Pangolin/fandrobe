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
                'genre_id'  => 1,
                'name'      => 'Bad Bunny',
                'bio'       => 'Artista urbano puertorriqueño, referente del reggaeton y trap latino.',
                'image_url' => 'bad-bunny.jpeg',
                'is_active' => true,
            ],
            [
                'genre_id'  => 2,
                'name'      => 'Rosalía',
                'bio'       => 'Cantante española de flamenco fusionado con pop y urbano.',
                'image_url' => 'rosalia.jpeg',
                'is_active' => true,
            ],
            [
                'genre_id'  => 3,
                'name'      => 'C. Tangana',
                'bio'       => 'Artista madrileño de música urbana y fusión española.',
                'image_url' => 'c-tangana.jpeg',
                'is_active' => true,
            ],
            [
                'genre_id'  => 1,
                'name'      => 'Bizarrap',
                'bio'       => 'Productor y DJ argentino conocido por sus Music Sessions.',
                'image_url' => 'bizarrap.jpeg',
                'is_active' => true,
            ],
            [
                'genre_id'  => 4,
                'name'      => 'Coldplay',
                'bio'       => 'Banda británica de rock alternativo y pop.',
                'image_url' => 'coldplay.jpeg',
                'is_active' => true,
            ],
            [
                'genre_id'  => 5,
                'name'      => 'Taylor Swift',
                'bio'       => 'Cantautora estadounidense de pop y country, una de las artistas más vendidas de la historia.',
                'image_url' => 'taylor-swift.jpeg',
                'is_active' => true,
            ],
            [
                'genre_id'  => 6,
                'name'      => 'Kendrick Lamar',
                'bio'       => 'Rapero y compositor estadounidense, considerado uno de los mejores de su generación.',
                'image_url' => 'kendrick-lamar.jpeg',
                'is_active' => true,
            ],
            [
                'genre_id'  => 4,
                'name'      => 'Arctic Monkeys',
                'bio'       => 'Banda británica de rock indie, conocida por su estilo crudo y letras ingeniosas.',
                'image_url' => 'artic-monkeys.jpeg',
                'is_active' => true,
            ],
            [
                'genre_id'  => 7,
                'name'      => 'Daft Punk',
                'bio'       => 'Dúo francés de música electrónica, pioneros del house y el electronic pop.',
                'image_url' => 'daft-punk.jpeg',
                'is_active' => true,
            ],
            [
                'genre_id'  => 3,
                'name'      => 'Quevedo',
                'bio'       => 'Artista canario de música urbana española, conocido por su hit Quédate.',
                'image_url' => 'quevedo.jpeg',
                'is_active' => true,
            ],
            [
                'genre_id'  => 1,
                'name'      => 'J Balvin',
                'bio'       => 'Artista colombiano de reggaeton, uno de los más influyentes del género.',
                'image_url' => 'j-balvin.jpeg',
                'is_active' => true,
            ],
            [
                'genre_id'  => 5,
                'name'      => 'Dua Lipa',
                'bio'       => 'Cantante británico-albanesa de pop y dance-pop, con éxitos mundiales.',
                'image_url' => 'dua-lipa.jpeg',
                'is_active' => true,
            ],
        ];

        DB::table('artists')->insert($artists);
    }
}
