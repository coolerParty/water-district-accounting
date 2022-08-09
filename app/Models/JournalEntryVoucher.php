<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JournalEntryVoucher extends Model
{
    use HasFactory;

    protected $table = 'journal_entry_vouchers';

    public function transactions(): HasMany
    {
        return $this->HasMany(Transaction::class);
    }

    public function cashReciept()
    {
        return $this->hasOne(CashReceipt::class, 'journal_entry_voucher_id');
    }

    public function billing()
    {
        return $this->hasOne(Billing::class, 'journal_entry_voucher_id');
    }

    public function materialIssuedJournal()
    {
        return $this->hasOne(MaterialIssuedJournal::class, 'journal_entry_voucher_id');
    }

    public function disbursement()
    {
        return $this->hasOne(Disbursement::class, 'journal_entry_voucher_id');
    }

    public function generalJournal()
    {
        return $this->hasOne(GeneralJournal::class, 'journal_entry_voucher_id');
    }
}
