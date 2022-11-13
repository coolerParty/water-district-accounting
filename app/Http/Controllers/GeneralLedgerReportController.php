<?php

namespace App\Http\Controllers;

use App\Models\AccountChart;
use App\Models\BeginningBalance;
use App\Models\JournalEntryVoucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GeneralLedgerReportController extends Controller
{
    public function report($code, $year, $month)
    {
        $accounts = AccountChart::select('id','code','name')->where('code',$code)->first();

        if (empty($accounts)) {
            abort(404);
        }

        $journals = DB::table('journal_entry_vouchers')
            ->join('transactions', 'journal_entry_vouchers.id', '=', 'transactions.journal_entry_voucher_id')
            ->where('accountchart_id',$accounts->id)
            ->selectRaw('type, accountchart_id,sum(debit) as subtotal_debit, sum(credit) as subtotal_credit, month(jv_date) as jv_month')
            ->groupBy('type','accountchart_id','jv_month')
            ->get();

        $jvAllMonths = $journals->pluck('jv_month','jv_month');

        $beginningBalance = BeginningBalance::select('accountchart_id','amount')->where('accountchart_id')->first();

         return view('report-form.general-ledger.general-ledger-report', compact('journals', 'year', 'month', 'beginningBalance','accounts','jvAllMonths'));
    }
}
