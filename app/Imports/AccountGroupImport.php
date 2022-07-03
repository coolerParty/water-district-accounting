<?php

namespace App\Imports;

use App\Models\AccountGroup;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithValidation;

class AccountGroupImport implements ToModel, WithUpserts, WithValidation, WithHeadingRow, WithBatchInserts, WithChunkReading, ShouldQueue
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AccountGroup([
            'code' => $row['code'],
            'name' => $row['name'],
            'seq_no' => $row['seq_no'],
        ]);
    }

    public function uniqueBy()
    {
        return ['name'];
    }

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
            '*.seq_no' => ['nullable', 'numeric','min:0'],
            '*.code'   => ['required', 'string','min:0'],
            '*.name'   => ['required', 'min:3','string'],
        ];
    }

}
