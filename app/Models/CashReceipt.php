<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CashReceipt extends Model
{
    use HasFactory;

    protected $table = "cash_receipts";

    public function jev() : BelongsTo
    {
        return $this->belongsTo(JournalEntryVoucher::Class,'journal_entry_voucher_id');
    }
}
