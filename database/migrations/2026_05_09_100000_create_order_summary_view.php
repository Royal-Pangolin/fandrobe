<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW vw_order_summary AS
            SELECT
                o.id,
                CONCAT(u.first_name, ' ', u.last_name) AS customer_name,
                u.email                                 AS customer_email,
                os.name                                 AS status_name,
                o.status_id,
                o.total_amount,
                o.currency,
                COUNT(oi.id)                            AS item_count,
                o.placed_at
            FROM orders o
            INNER JOIN users u           ON u.id        = o.user_id
            INNER JOIN order_statuses os ON os.id       = o.status_id
            LEFT  JOIN order_items oi    ON oi.order_id = o.id
            GROUP BY
                o.id,
                u.first_name,
                u.last_name,
                u.email,
                os.name,
                o.status_id,
                o.total_amount,
                o.currency,
                o.placed_at
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_order_summary');
    }
};
