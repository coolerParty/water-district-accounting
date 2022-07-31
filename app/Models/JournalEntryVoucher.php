<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JournalEntryVoucher extends Model
{
    use HasFactory;

    protected $table = 'journal_entry_vouchers';

    public function transactions(){
        return $this->HasMany (Transaction::class,'journal_entry_voucher_id')->get();
    }

    public function cashReciept(){
        return $this->hasOne (CashReceipt::class,'journal_entry_voucher_id')->where('type',1)->get();
    }

    public function billing(){
        return $this->hasOne (Billing::class,'journal_entry_voucher_id')->where('type',2)->get();
    }

    public function materialIssuedJournal(){
        return $this->hasOne (Billing::class,'journal_entry_voucher_id')->where('type',3)->get();
    }

    public function disbursement(){
        return $this->hasOne (Disbursement::class,'journal_entry_voucher_id')->where('type',4)->get();
    }

    public function generalJournal(){
        return $this->hasOne (GeneralJournal::class,'journal_entry_voucher_id')->where('type',5)->get();
    }
}
