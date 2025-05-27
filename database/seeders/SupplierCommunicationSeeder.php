<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SupplierCommunicationSeeder extends Seeder
{
    public function run()
    {
        DB::table('supplier_communications')->insert([
            [
                'supplier_id' => 1,
                'communication_date' => Carbon::now()->subDays(9),
                'type' => 'Email',
                'subject' => 'Order Confirmation',
                'content' => 'Order #1 confirmed.',
                'response' => 'Thank you for your order.',
                'handled_by' => 'Support Team',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'supplier_id' => 2,
                'communication_date' => Carbon::now()->subDays(7),
                'type' => 'Phone',
                'subject' => 'Delivery Delay',
                'content' => 'Notified about delivery delay.',
                'response' => 'We apologize for the delay.',
                'handled_by' => 'Logistics',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
