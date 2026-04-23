<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            ['name' => 'Reggaeton',  'description' => 'Música urbana latina'],
            ['name' => 'Flamenco',   'description' => 'Música tradicional española'],
            ['name' => 'Urbano',     'description' => 'Música urbana española'],
            ['name' => 'Rock',       'description' => 'Música rock alternativo'],
            ['name' => 'Pop',        'description' => 'Música pop internacional'],
            ['name' => 'Hip-Hop',    'description' => 'Música hip-hop y rap'],
            ['name' => 'Electrónica','description' => 'Música electrónica y dance'],
        ];

        DB::table('genres')->insert($genres);
    }
}
