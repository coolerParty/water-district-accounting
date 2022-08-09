<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $table = "billings";

    public function jev()
    {
        return $this->belongsTo(JournalEntryVoucher::Class,'journal_entry_voucher_id');
    }
}
