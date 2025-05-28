<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SupplierCommunicationSeeder extends Seeder
{
    public function run()
    {
        $communications = [];
        for ($i = 1; $i <= 10; $i++) {
            $communications[] = [
                'supplier_id' => $i,
                'communication_date' => Carbon::now()->subDays($i),
                'type' => $i % 2 === 0 ? 'Email' : 'Phone',
                'subject' => 'Subject ' . $i,
                'content' => 'Content for communication ' . $i,
                'response' => 'Response ' . $i,
                'handled_by' => 'Handler ' . $i,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('supplier_communications')->insert($communications);
    }
}
