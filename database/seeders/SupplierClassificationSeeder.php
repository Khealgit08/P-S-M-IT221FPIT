<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SupplierClassificationSeeder extends Seeder
{
    public function run()
    {
        $classifications = [];
        for ($i = 1; $i <= 10; $i++) {
            $classifications[] = [
                'supplier_id' => $i,
                'classification' => $i % 2 === 0 ? 'Preferred' : 'Standard',
                'criteria' => 'Criteria ' . $i,
                'assigned_by' => 'Manager ' . $i,
                'assigned_at' => Carbon::now()->subDays($i),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('supplier_classifications')->insert($classifications);
    }
}
