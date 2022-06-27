<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashReceipt extends Model
{
    use HasFactory;

    protected $table = "cash_receipts";

    public function jev()
    {
        return $this->hasone(JournalEntryVoucher::Class,'code_id')->where('type',1)->get();
    }
}
