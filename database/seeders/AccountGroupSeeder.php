<?php

namespace Database\Seeders;

use App\Models\AccountChart;
use App\Models\AccountGroup;
use App\Models\MajorAccountGroup;
use App\Models\SubMajorAccountGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountGroup::factory(5)->create();
        MajorAccountGroup::factory(50)->create();
        SubMajorAccountGroup::factory(100)->create();

        AccountChart::factory(1100)->create([
            'acctgrp_id' => rand(1,5),
            'mjracctgrp_id' => rand(1,50),
            'submjracctgrp_id' => rand(1,100),
        ]);
    }
}
