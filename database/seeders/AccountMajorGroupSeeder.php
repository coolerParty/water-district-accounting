<?php

namespace Database\Seeders;

use App\Models\MajorAccountGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountMajorGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accountMajorGroups = [
            ['code' => '1-01',    'name' => "Cash",                                     'created_at' => now(), 'updated_at' => now()],
            ['code' => '1-02',    'name' => "Investments",                              'created_at' => now(), 'updated_at' => now()],
            ['code' => '1-03',    'name' => "Receivables",                              'created_at' => now(), 'updated_at' => now()],
            ['code' => '1-04',    'name' => "Inventories",                              'created_at' => now(), 'updated_at' => now()],
            ['code' => '1-05',    'name' => "Prepayments and Deferred Charges",         'created_at' => now(), 'updated_at' => now()],
            ['code' => '1-06',    'name' => "Investment Property",                      'created_at' => now(), 'updated_at' => now()],
            ['code' => '1-07',    'name' => "Property, Plant and Equipment",            'created_at' => now(), 'updated_at' => now()],
            ['code' => '1-08',    'name' => "Biological Assets",                        'created_at' => now(), 'updated_at' => now()],
            ['code' => '1-09',    'name' => "Intangible Assets",                        'created_at' => now(), 'updated_at' => now()],
            ['code' => '2-01',    'name' => "Financial Liabilities",                    'created_at' => now(), 'updated_at' => now()],
            ['code' => '2-02',    'name' => "Inter-Agency Payables",                    'created_at' => now(), 'updated_at' => now()],
            ['code' => '2-03',    'name' => "Intra-Agency Payables",                    'created_at' => now(), 'updated_at' => now()],
            ['code' => '2-04',    'name' => "Trust Liabilities",                        'created_at' => now(), 'updated_at' => now()],
            ['code' => '2-05',    'name' => "Deferred Credits/Unearned Income",         'created_at' => now(), 'updated_at' => now()],
            ['code' => '2-06',    'name' => "Provisions",                               'created_at' => now(), 'updated_at' => now()],
            ['code' => '2-99',    'name' => "Other Payables",                           'created_at' => now(), 'updated_at' => now()],
            ['code' => '3-01',    'name' => "Government Equity",                        'created_at' => now(), 'updated_at' => now()],
            ['code' => '3-02',    'name' => "Intermediate Accounts",                    'created_at' => now(), 'updated_at' => now()],
            ['code' => '3-03',    'name' => "Equity in Joint Venture",                  'created_at' => now(), 'updated_at' => now()],
            ['code' => '3-04',    'name' => "Unrealized Gain/(Loss)",                   'created_at' => now(), 'updated_at' => now()],
            ['code' => '4-01',    'name' => "Tax Revenue",                              'created_at' => now(), 'updated_at' => now()],
            ['code' => '4-02',    'name' => "Service and Business Income",              'created_at' => now(), 'updated_at' => now()],
            ['code' => '4-03',    'name' => "Transfers, Assistance and Subsidy",        'created_at' => now(), 'updated_at' => now()],
            ['code' => '4-04',    'name' => "Shares, Grants and Donations",             'created_at' => now(), 'updated_at' => now()],
            ['code' => '4-05',    'name' => "Gains",                                    'created_at' => now(), 'updated_at' => now()],
            ['code' => '4-06',    'name' => "Miscellanelus Income",                     'created_at' => now(), 'updated_at' => now()],
            ['code' => '4-07',    'name' => "Other Non-Operating Income",               'created_at' => now(), 'updated_at' => now()],
            ['code' => '5-01',    'name' => "Personnel Services",                       'created_at' => now(), 'updated_at' => now()],
            ['code' => '5-02',    'name' => "Maintenance and Other Operating Expenses", 'created_at' => now(), 'updated_at' => now()],
            ['code' => '5-03',    'name' => "Financial Expenses",                       'created_at' => now(), 'updated_at' => now()],
            ['code' => '5-04',    'name' => "Direct Costs",                             'created_at' => now(), 'updated_at' => now()],
            ['code' => '5-05',    'name' => "Non-Cash Expenses",                        'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($accountMajorGroups as $accountGroup) {
            MajorAccountGroup::create($accountGroup);
        }
    }
}
