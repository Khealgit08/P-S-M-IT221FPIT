<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ContractSeeder extends Seeder
{
    public function run()
    {
        $contracts = [];
        for ($i = 1; $i <= 10; $i++) {
            $contracts[] = [
                'supplier_id' => $i,
                'title' => 'Contract Title ' . $i,
                'terms' => 'Terms for contract ' . $i,
                'sla' => 'SLA for contract ' . $i,
                'start_date' => Carbon::now()->subMonths($i),
                'end_date' => Carbon::now()->addMonths($i),
                'payment_terms' => 'Net ' . (30 + $i),
                'discount_terms' => $i % 2 === 0 ? '2% if paid within 10 days' : null,
                'status' => $i % 2 === 0 ? 'active' : 'expired',
                'payment_due_date' => Carbon::now()->addDays($i * 3),
                'payment_alert_sent' => $i % 2 === 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('contracts')->insert($contracts);
    }
}
