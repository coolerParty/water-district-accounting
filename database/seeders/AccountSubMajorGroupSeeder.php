<?php

namespace Database\Seeders;

use App\Models\SubMajorAccountGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSubMajorGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accountSubMajorGroups = [
            [   'code' => '1-01-01', 'name' => "Cash on Hand",                                              'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-01-02', 'name' => "Cash in Bank-Local Currency",                               'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-01-03', 'name' => "Cash in Bank-Foreign Currency",                             'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-02-01', 'name' => "Investments in Time Deposits",                              'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-02-02', 'name' => "Financial Assets at Fair Value Through Surplus or Deficit", 'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-02-03', 'name' => "Financial Assets - Held to Maturity",                       'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-02-04', 'name' => "Financial Assets - Available for Sale",                     'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-02-05', 'name' => "Financial Assets - Others",                                 'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-02-06', 'name' => "Investments in Joint Venture",                              'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-02-07', 'name' => "Sinking Fund",                                              'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-03-01', 'name' => "Loans and Receivable Accounts",                             'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-03-02', 'name' => "Lease  Receivables",                                        'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-03-03', 'name' => "Inter-Agency Receivables",                                  'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-03-04', 'name' => "Intra-Agency Receivables",                                  'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-03-05', 'name' => "Advances",                                                  'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-03-06', 'name' => "Other Receivables",                                         'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-04-01', 'name' => "Inventory Held for Sale",                                   'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-04-02', 'name' => "Inventory Held for Distribution",                           'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-04-03', 'name' => "Inventory Held for Manufacturing ",                         'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-04-04', 'name' => "Inventory Held for Consumption",                            'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-05-01', 'name' => "Prepayments",                                               'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-05-02', 'name' => "Deferred Charges",                                          'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-06-01', 'name' => "Land and Buildings",                                        'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-07-01', 'name' => "Bearer Biological Assets1",                                  'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-07-02', 'name' => "Land Improvements",                                         'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-07-03', 'name' => "Infrastructure Assets",                                     'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-07-04', 'name' => "Buildings and Other Structures",                            'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-07-05', 'name' => "Machinery and Equipment",                                   'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-07-06', 'name' => "Transportation Equipment",                                  'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-07-07', 'name' => "Furniture, Fixtures and Books",                             'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-07-08', 'name' => "Leased Assets",                                             'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-07-09', 'name' => "Leased Assets Improvements",                                'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-07-10', 'name' => "Construction in Progress",                                  'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-07-11', 'name' => "Service Concession Assets",                                 'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-07-99', 'name' => "Other Property, Plant and Equipment",                       'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-08-01', 'name' => "Bearer Biological Assets",                                  'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-09-01', 'name' => "Intangible Assets",                                         'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '1-09-02', 'name' => "Service Concession Assets1",                                 'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '2-01-01', 'name' => "Payables",                                                  'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '2-01-02', 'name' => "Bills/Bonds/Loans Payable",                                 'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '2-02-01', 'name' => "Inter-Agency Payables",                                     'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '2-03-01', 'name' => "Intra-Agency Payables",                                     'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '2-04-01', 'name' => "Trust Liabilities",                                         'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '2-05-01', 'name' => "Deferred Credits",                                          'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '2-06-01', 'name' => "Provisions",                                                'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '2-99-99', 'name' => "Other Payables",                                            'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '3-01-01', 'name' => "Government Equity",                                         'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '3-02-01', 'name' => "Intermediate Accounts",                                     'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '3-03-01', 'name' => "Equity in Joint Venture",                                   'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '3-04-01', 'name' => "Unrealized Gain/(Loss)",                                    'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '4-01-01', 'name' => "Tax Revenue - Individual and Corporation",                  'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '4-01-02', 'name' => "Tax Revenue - Property",                                    'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '4-01-03', 'name' => "Tax Revenue - Goods and Services",                          'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '4-01-04', 'name' => "Tax Revenue - Others",                                      'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '4-01-05', 'name' => "Tax Revenue - Fines and Penalties",                         'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '4-01-06', 'name' => "Share from National Taxes",                                 'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '4-02-01', 'name' => "Service Income",                                            'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '4-02-02', 'name' => "Business Income",                                           'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '4-03-01', 'name' => "Assistance and Subsidy ",                                   'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '4-03-02', 'name' => "Transfers",                                                 'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '4-04-01', 'name' => "Shares",                                                    'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '4-04-02', 'name' => "Grants",                                                    'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '4-05-01', 'name' => "Gains",                                                     'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '4-06-01', 'name' => "Miscellaneous Income",                                      'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '4-07-01', 'name' => "Sale of Assets",                                            'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-01-01', 'name' => "Salaries and Wages",                                        'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-01-02', 'name' => "Other Compensation",                                        'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-01-03', 'name' => "Personnel Benefit Contributions",                           'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-01-04', 'name' => "Other Personnel Benefit",                                   'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-02-01', 'name' => "Traveling Expenses",                                        'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-02-02', 'name' => "Training and Scholarship Expenses",                         'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-02-03', 'name' => "Supplies and Materials Expenses",                           'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-02-04', 'name' => "Utility Expenses",                                          'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-02-05', 'name' => "Communication Expenses",                                    'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-02-06', 'name' => "Awards/Rewards and Prizes",                                 'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-02-07', 'name' => "Survey, Research, Exploration and Development Expenses",    'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-02-08', 'name' => "Demolition/Relocation and Desilting/Dredging Expenses",     'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-02-09', 'name' => "Generation,Transmission and Distribution Expenses",         'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-02-10', 'name' => "Confidential,Intelligence and Extraordinary Expenses",      'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-02-11', 'name' => "Professional Services",                                     'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-02-12', 'name' => "General Services",                                          'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-02-13', 'name' => "Repairs and Maintenance",                                   'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-02-14', 'name' => "Financial Assistance/Subsidy",                              'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-02-15', 'name' => "Transfers1",                                                 'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-02-16', 'name' => "Taxes, Insurance Premiums and Other Fees",                  'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-02-99', 'name' => "Other Maintenance and Operating Expenses",                  'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-03-01', 'name' => "Financial Expenses",                                        'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-04-01', 'name' => "Cost of Goods Manufactured",                                'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-04-02', 'name' => "Cost of Sales",                                             'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-05-01', 'name' => "Depreciation",                                              'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-05-02', 'name' => "Amortization",                                              'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-05-03', 'name' => "Impairment Loss",                                           'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-05-04', 'name' => "Losses",                                                    'created_at' => now(), 'updated_at' => now(),   ],
            [   'code' => '5-05-05', 'name' => "Grants1",                                                    'created_at' => now(), 'updated_at' => now(),   ],
        ];

        foreach ($accountSubMajorGroups as $accountGroup) {
            SubMajorAccountGroup::create($accountGroup);
        }
    }
}
