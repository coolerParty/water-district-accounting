<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialIssuedJournal extends Model
{
    use HasFactory;

    protected $table = "material_issued_journals";

    public function jev()
    {
        return $this->belongsTo(JournalEntryVoucher::Class,'journal_entry_voucher_id')->where('type',3)->get();
    }
}
