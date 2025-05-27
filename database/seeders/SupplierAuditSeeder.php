<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SupplierAuditSeeder extends Seeder
{
    public function run()
    {
        DB::table('supplier_audits')->insert([
            [
                'supplier_id' => 1,
                'audit_date' => Carbon::now()->subDays(5),
                'auditor' => 'Audit Team A',
                'findings' => 'Compliant with all requirements.',
                'recommendations' => 'Continue current practices.',
                'status' => 'passed',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'supplier_id' => 2,
                'audit_date' => Carbon::now()->subDays(2),
                'auditor' => 'Audit Team B',
                'findings' => 'Minor issues in documentation.',
                'recommendations' => 'Improve record keeping.',
                'status' => 'conditional',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
