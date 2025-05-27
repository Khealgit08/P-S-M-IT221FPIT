<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InvoiceSeeder extends Seeder
{
    public function run()
    {
        DB::table('invoices')->insert([
            [
                'purchase_order_id' => 1,
                'invoice_date' => Carbon::now()->subDays(8),
                'amount' => 90.00,
                'status' => 'paid',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'purchase_order_id' => 2,
                'invoice_date' => Carbon::now()->subDays(3),
                'amount' => 100.00,
                'status' => 'unpaid',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
