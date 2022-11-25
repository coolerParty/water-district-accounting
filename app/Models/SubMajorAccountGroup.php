<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubMajorAccountGroup extends Model
{
    use HasFactory;

    protected $table = "sub_major_account_groups";

    protected $fillable = [
        'code', 'name','seq_no'
    ];

    public function accountCharts() : HasMany
    {
        return $this->hasMany(AccountChart::Class,'submjracctgrp_id');
    }

}
