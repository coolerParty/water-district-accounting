<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountChart extends Model
{
    use HasFactory;
    protected $table = "account_charts";

    protected $fillable = [
        'code', 'name','acctgrp_id','mjracctgrp_id','submjracctgrp_id'
    ];

    public function accountGroup()
    {
        return $this->belongsTo(AccountGroup::Class,'acctgrp_id');
    }

    public function MajorAccountGroup()
    {
        return $this->belongsTo(MajorAccountGroup::Class,'mjracctgrp_id');
    }

    public function SubMajorAccountGroup()
    {
        return $this->belongsTo(SubMajorAccountGroup::Class,'submjracctgrp_id');
    }
}
