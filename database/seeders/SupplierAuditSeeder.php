<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SupplierAuditSeeder extends Seeder
{
    public function run()
    {
        $audits = [];
        for ($i = 1; $i <= 10; $i++) {
            $audits[] = [
                'supplier_id' => $i,
                'audit_date' => Carbon::now()->subDays($i),
                'auditor' => 'Auditor ' . $i,
                'findings' => 'Findings for audit ' . $i,
                'recommendations' => 'Recommendation ' . $i,
                'status' => $i % 2 === 0 ? 'passed' : 'conditional',
                'next_audit_date' => Carbon::now()->addMonths($i),
                'notification_sent' => $i % 2 === 0,
                'corrective_actions' => 'Corrective action ' . $i,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('supplier_audits')->insert($audits);
    }
}
