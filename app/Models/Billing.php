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
        return $this->hasone(JournalEntryVoucher::Class,'code_id')->where('type',2)->get();
    }
}
