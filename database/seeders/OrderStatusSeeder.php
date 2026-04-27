<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['name' => 'pending',    'description' => 'Pedido pendiente de pago'],
            ['name' => 'paid',       'description' => 'Pedido pagado'],
            ['name' => 'processing', 'description' => 'Pedido en preparación'],
            ['name' => 'shipped',    'description' => 'Pedido enviado'],
            ['name' => 'delivered',  'description' => 'Pedido entregado'],
            ['name' => 'cancelled',  'description' => 'Pedido cancelado'],
            ['name' => 'refunded',   'description' => 'Pedido reembolsado'],
        ];

        DB::table('order_statuses')->insert($statuses);
    }
}