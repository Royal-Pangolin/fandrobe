<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call([
            RoleSeeder::class,
            GenreSeeder::class,
            CategorySeeder::class,
            SizeSeeder::class,
            ColorSeeder::class,
            DiscountTypeSeeder::class,
            OrderStatusSeeder::class,
            ShipmentStatusSeeder::class,
            ArtistSeeder::class,
            ProductSeeder::class,
            ProductImageSeeder::class,
            UserSeeder::class,
        ]);
    }
}
