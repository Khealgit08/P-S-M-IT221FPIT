<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\SupplierSeeder;
use Database\Seeders\PurchaseOrderSeeder;
use Database\Seeders\InvoiceSeeder;
use Database\Seeders\GoodsReceiptNoteSeeder;
use Database\Seeders\SupplierPerformanceSeeder;
use Database\Seeders\SupplierAuditSeeder;
use Database\Seeders\SupplierClassificationSeeder;
use Database\Seeders\SupplierCommunicationSeeder;
use Database\Seeders\ContractSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SupplierSeeder::class,
            PurchaseOrderSeeder::class,
            InvoiceSeeder::class,
            GoodsReceiptNoteSeeder::class,
            SupplierPerformanceSeeder::class,
            SupplierAuditSeeder::class,
            SupplierClassificationSeeder::class,
            SupplierCommunicationSeeder::class,
            ContractSeeder::class,
        ]);
    }
}
