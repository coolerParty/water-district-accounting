<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountChart extends Model
{
    use HasFactory;
    protected $table = "account_charts";

    public function accountGroup()
    {
        return $this->belongsTo(AccountGroup::Class,'acctgrp_id');
    }

    public function MajorAccountGroup()
    {
        return $this->belongsTo(AccountGroup::Class,'mjracctgrp_id');
    }

    public function SubMajorAccountGroup()
    {
        return $this->belongsTo(AccountGroup::Class,'submjracctgrp_id');
    }
}
