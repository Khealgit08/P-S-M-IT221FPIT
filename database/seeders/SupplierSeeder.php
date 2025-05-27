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
        DB::table('suppliers')->insert([
            [
                'name' => 'Acme Supplies',
                'contact_person' => 'John Doe',
                'email' => 'acme@example.com',
                'phone' => '1234567890',
                'address' => '123 Main St, City',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Global Traders',
                'contact_person' => 'Jane Smith',
                'email' => 'global@example.com',
                'phone' => '0987654321',
                'address' => '456 Market Ave, City',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
