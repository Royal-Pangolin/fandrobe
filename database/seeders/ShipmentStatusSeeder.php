<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShipmentStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['name' => 'preparing',  'description' => 'Preparando el envío'],
            ['name' => 'shipped',    'description' => 'Enviado al transportista'],
            ['name' => 'in_transit', 'description' => 'En tránsito'],
            ['name' => 'delivered',  'description' => 'Entregado'],
            ['name' => 'returned',   'description' => 'Devuelto'],
        ];

        DB::table('shipment_statuses')->insert($statuses);
    }
}
