<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PurchaseOrderSeeder extends Seeder
{
    public function run()
    {
        DB::table('purchase_orders')->insert([
            [
                'supplier_id' => 1,
                'order_date' => Carbon::now()->subDays(10),
                'items' => json_encode([
                    ['item' => 'Paper', 'quantity' => 100, 'price' => 50],
                    ['item' => 'Pens', 'quantity' => 200, 'price' => 20],
                ]),
                'total_amount' => 90.00,
                'status' => 'delivered',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'supplier_id' => 2,
                'order_date' => Carbon::now()->subDays(5),
                'items' => json_encode([
                    ['item' => 'Staplers', 'quantity' => 50, 'price' => 100],
                ]),
                'total_amount' => 100.00,
                'status' => 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
