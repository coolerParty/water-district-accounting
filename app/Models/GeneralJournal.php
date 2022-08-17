<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GeneralJournal extends Model
{
    use HasFactory;
    protected $table = "general_journals";

    public function jev() : BelongsTo
    {
        return $this->belongsTo(JournalEntryVoucher::Class,'journal_entry_voucher_id');
    }
}
