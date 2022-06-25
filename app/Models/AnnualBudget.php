<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnualBudget extends Model
{
    use HasFactory;
    protected $table = "annual_budgets";

    protected $fillable = [
        'accountchart_id', 'budget_year','amount'
    ];

    public function accountChart()
    {
        return $this->belongsTo(AccountChart::Class,'accountchart_id');
    }
}
