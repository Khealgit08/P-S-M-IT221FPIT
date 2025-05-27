<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SupplierPerformanceSeeder extends Seeder
{
    public function run()
    {
        DB::table('supplier_performances')->insert([
            [
                'supplier_id' => 1,
                'evaluation_date' => Carbon::now()->subDays(6),
                'quality_score' => 95,
                'delivery_score' => 90,
                'cost_score' => 85,
                'compliance_score' => 100,
                'overall_score' => 92.5,
                'comments' => 'Excellent performance.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'supplier_id' => 2,
                'evaluation_date' => Carbon::now()->subDays(4),
                'quality_score' => 80,
                'delivery_score' => 85,
                'cost_score' => 80,
                'compliance_score' => 90,
                'overall_score' => 83.75,
                'comments' => 'Good, but can improve delivery.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
