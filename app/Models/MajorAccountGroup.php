<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MajorAccountGroup extends Model
{
    use HasFactory;

    protected $table ="major_account_groups";

    protected $fillable = [
        'code', 'name','seq_no'
    ];

    public function accountCharts() : HasMany
    {
        return $this->hasMany(AccountChart::Class,'mjracctgrp_id');
    }
}
