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
        // \App\Models\User::factory(10)->create();

        $this->call([
            PermissionSeeder::class,
            AdminUserSeeder::class,
            AccountGroupSeeder::class,
            BankSeeder::class,
            CashReceiptJournalSeeder::class,
            BillingSeeder::class,
            MaterialIssuedJournalSeeder::class,
            DisbursementSeeder::class,
            GeneralJournalSeeder::class,
        ]);
    }
}
