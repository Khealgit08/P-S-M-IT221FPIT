<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GoodsReceiptNoteSeeder extends Seeder
{
    public function run()
    {
        DB::table('goods_receipt_notes')->insert([
            [
                'purchase_order_id' => 1,
                'received_by' => 'Warehouse Staff',
                'received_date' => Carbon::now()->subDays(7),
                'items' => json_encode([
                    ['item' => 'Paper', 'quantity' => 100],
                    ['item' => 'Pens', 'quantity' => 200],
                ]),
                'remarks' => 'All items received in good condition.',
                'status' => 'received',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
