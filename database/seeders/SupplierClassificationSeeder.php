<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SupplierClassificationSeeder extends Seeder
{
    public function run()
    {
        DB::table('supplier_classifications')->insert([
            [
                'supplier_id' => 1,
                'classification' => 'Preferred',
                'criteria' => 'Consistent quality and delivery',
                'assigned_by' => 'Manager',
                'assigned_at' => Carbon::now()->subDays(15),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'supplier_id' => 2,
                'classification' => 'Standard',
                'criteria' => 'Meets minimum requirements',
                'assigned_by' => 'Manager',
                'assigned_at' => Carbon::now()->subDays(12),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
