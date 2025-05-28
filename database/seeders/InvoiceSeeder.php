<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InvoiceSeeder extends Seeder
{
    public function run()
    {
        $invoices = [];
        for ($i = 1; $i <= 10; $i++) {
            $amount = rand(1000, 5000);
            $invoices[] = [
                'purchase_order_id' => $i,
                'invoice_date' => Carbon::now()->subDays($i),
                'amount' => $amount,
                'status' => $i % 2 === 0 ? 'paid' : 'unpaid',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('invoices')->insert($invoices);
    }
}
