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
}
