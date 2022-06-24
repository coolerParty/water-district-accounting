<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeginningBalance extends Model
{
    use HasFactory;
    protected $table ="beginning_balances";

    public function accountChart()
    {
        return $this->belongsTo(AccountChart::Class,'accountchart_id');
    }
}
