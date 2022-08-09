<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transactions";

    public function accountChart()
    {
        return $this->belongsTo(AccountChart::Class,'accountchart_id');
    }

    public function jev()
    {
        return $this->belongsTo(JournalEntryVoucher::Class);
    }
}
