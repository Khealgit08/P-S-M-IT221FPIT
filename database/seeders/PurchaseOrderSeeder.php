<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PurchaseOrderSeeder extends Seeder
{
    public function run()
    {
        $orders = [];
        for ($i = 1; $i <= 10; $i++) {
            $items = [
                ['item' => 'ItemA-' . $i, 'quantity' => rand(10, 100), 'price' => rand(10, 50)],
                ['item' => 'ItemB-' . $i, 'quantity' => rand(5, 30), 'price' => rand(20, 60)],
            ];
            $total = 0;
            foreach ($items as $item) {
                $total += $item['quantity'] * $item['price'];
            }
            $orders[] = [
                'supplier_id' => ($i % 10) + 1,
                'order_date' => Carbon::now()->subDays($i),
                'items' => json_encode($items),
                'total_amount' => $total,
                'status' => $i % 3 === 0 ? 'pending' : ($i % 4 === 0 ? 'delivered' : 'approved'),
                'approval_status' => $i % 2 === 0 ? 'approved' : 'pending',
                'approved_by' => $i % 2 === 0 ? 1 : null,
                'approved_at' => $i % 2 === 0 ? Carbon::now()->subDays($i-1) : null,
                'rejected_reason' => $i % 5 === 0 ? 'Budget exceeded' : null,
                'discrepancy_flag' => false,
                'discrepancy_details' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('purchase_orders')->insert($orders);
    }
}
