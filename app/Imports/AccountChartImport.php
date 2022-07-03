<?php

namespace App\Imports;

use App\Models\AccountChart;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;

class AccountChartImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation, WithBatchInserts, WithChunkReading, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AccountChart([
            'code'             => $row['code'],
            'name'             => $row['name'],
            'acctgrp_id'       => $row['acctgrp_id'],
            'mjracctgrp_id'    => $row['mjracctgrp_id'],
            'submjracctgrp_id' => $row['submjracctgrp_id'],
        ]);
    }

    // public function uniqueBy()
    // {
    //     return ['name'];
    // }

    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }

    public function rules(): array
    {
        return [
            '*.code'             => ['required', 'string','min:0'],
            '*.name'             => ['required', 'min:3','string','unique:account_charts'],
            '*.acctgrp_id'       => ['required', 'integer','min:0'],
            '*.mjracctgrp_id'    => ['required', 'integer','min:0'],
            '*.submjracctgrp_id' => ['required', 'integer','min:0'],
        ];
    }


}
