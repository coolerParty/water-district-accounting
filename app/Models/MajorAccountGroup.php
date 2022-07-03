<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MajorAccountGroup extends Model
{
    use HasFactory;

    protected $table ="major_account_groups";

    protected $fillable = [
        'code', 'name','seq_no'
    ];

}
