<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            AdminUserSeeder::class,
            AccountGroupSeeder::class,
            AccountMajorGroupSeeder::class,
            AccountSubMajorGroupSeeder::class,
            AccountChartSeeder::class,
            BankSeeder::class,
            CashReceiptJournalSeeder::class,
            BillingSeeder::class,
            MaterialIssuedJournalSeeder::class,
            DisbursementSeeder::class,
            GeneralJournalSeeder::class,
        ]);
    }
}
