<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SupplierPerformanceSeeder extends Seeder
{
    public function run()
    {
        $performances = [];
        for ($i = 1; $i <= 10; $i++) {
            $performances[] = [
                'supplier_id' => $i,
                'evaluation_date' => Carbon::now()->subDays($i),
                'quality_score' => rand(70, 100),
                'delivery_score' => rand(70, 100),
                'cost_score' => rand(70, 100),
                'compliance_score' => rand(70, 100),
                'overall_score' => rand(70, 100),
                'comments' => 'Performance review ' . $i,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('supplier_performances')->insert($performances);
    }
}
