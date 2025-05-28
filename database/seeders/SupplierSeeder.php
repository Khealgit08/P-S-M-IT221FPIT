<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        $suppliers = [];
        for ($i = 1; $i <= 10; $i++) {
            $suppliers[] = [
                'name' => 'Supplier ' . $i,
                'contact_person' => 'Contact ' . $i,
                'email' => 'supplier' . $i . '@example.com',
                'phone' => '100000000' . $i,
                'address' => 'Address ' . $i,
                'status' => $i % 3 === 0 ? 'inactive' : ($i % 4 === 0 ? 'blacklisted' : 'active'),
                'certification' => 'Cert ' . $i,
                'certification_expiry' => Carbon::now()->addMonths($i),
                'compliance_status' => $i % 2 === 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('suppliers')->insert($suppliers);
    }
}
