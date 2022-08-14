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

    public function cashReciept(): hasOne
    {
        return $this->hasOne(CashReceipt::class, 'journal_entry_voucher_id');
    }

    public function billing(): hasOne
    {
        return $this->hasOne(Billing::class, 'journal_entry_voucher_id');
    }

    public function materialIssuedJournal(): hasOne
    {
        return $this->hasOne(MaterialIssuedJournal::class, 'journal_entry_voucher_id');
    }

    public function disbursement(): hasOne
    {
        return $this->hasOne(Disbursement::class, 'journal_entry_voucher_id');
    }

    public function generalJournal(): hasOne
    {
        return $this->hasOne(GeneralJournal::class, 'journal_entry_voucher_id');
    }

    public function scopeVisibleTo($query, User $user)
    {
        $query->where(function ($query) use ($user){
            if (!auth()->user()->can('Super Admin')) {
                $query->where('user_id', $user->id);
            }
        });
    }
}
