<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralJournal extends Model
{
    use HasFactory;
    protected $table = "general_journals";

    public function jev()
    {
        return $this->belongsTo(JournalEntryVoucher::Class,'journal_entry_voucher_id');
    }
}
