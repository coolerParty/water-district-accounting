<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Billing extends Model
{
    use HasFactory;

    protected $table = "billings";

    public function jev() : BelongsTo
    {
        return $this->belongsTo(JournalEntryVoucher::Class,'journal_entry_voucher_id');
    }
}
