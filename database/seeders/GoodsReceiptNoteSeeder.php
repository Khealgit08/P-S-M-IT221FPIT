<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GoodsReceiptNoteSeeder extends Seeder
{
    public function run()
    {
        $grns = [];
        for ($i = 1; $i <= 10; $i++) {
            $items = [
                ['item' => 'ItemA-' . $i, 'quantity' => rand(10, 100), 'price' => rand(10, 50)],
                ['item' => 'ItemB-' . $i, 'quantity' => rand(5, 30), 'price' => rand(20, 60)],
            ];
            $grns[] = [
                'purchase_order_id' => $i,
                'received_by' => 'Receiver ' . $i,
                'received_date' => Carbon::now()->subDays($i),
                'items' => json_encode($items),
                'remarks' => 'Remarks for GRN ' . $i,
                'status' => $i % 2 === 0 ? 'received' : 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('goods_receipt_notes')->insert($grns);
    }
}
