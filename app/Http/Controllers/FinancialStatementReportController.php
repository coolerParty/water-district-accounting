<?php

namespace App\Http\Controllers;

use App\Models\AccountChart;
use App\Models\BeginningBalance;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;

class FinancialStatementReportController extends Controller
{

    public function report($type, $year, $month)
    {


        if ($type == 1) {
            return $this->trialBalanceReport($year, $month);
        }
    }

    public function pdf($type, $year, $month)
    {


        if ($type == 1) {
            return $this->trialBalancePDF($year, $month);
        }
    }

    public function trialBalanceReport($year, $month)
    {
        $monthFormatted = $this->monthFormat($month);
        $accounts = AccountChart::select('id', 'code', 'name')->orderBy('code', 'ASC')->get();
        $journals = DB::table('journal_entry_vouchers')
            ->join('transactions', 'journal_entry_vouchers.id', '=', 'transactions.journal_entry_voucher_id')
            ->whereBetween('jv_date', [
                Carbon::parse($year . '-01-01')->startOfYear(),
                Carbon::parse($year . '-' . $monthFormatted . '-01')->endOfMonth(),
            ])
            ->selectRaw('accountchart_id, sum(debit) as subtotal_debit, sum(credit) as subtotal_credit')
            ->groupBy('accountchart_id')
            ->whereRaw('(credit + debit) <> 0')
            ->get();

        $beginningBalances = BeginningBalance::select('accountchart_id', 'amount')
            ->whereBetween('start_date', [
                Carbon::parse($year . '-01-01')->startOfYear(),
                Carbon::parse($year . '-01-01')->endOfYear(),
            ])
            ->get();

        return view('report-form.financial-statement.trial-balance-report', compact('journals', 'year', 'month', 'beginningBalances', 'accounts'));
    }

    public function trialBalancePDF($year, $month)
    {
        $monthFormatted = $this->monthFormat($month);
        $accounts = AccountChart::select('id', 'code', 'name')->orderBy('code', 'ASC')->get();
        $journals = DB::table('journal_entry_vouchers')
            ->join('transactions', 'journal_entry_vouchers.id', '=', 'transactions.journal_entry_voucher_id')
            ->whereBetween('jv_date', [
                Carbon::parse($year . '-01-01')->startOfYear(),
                Carbon::parse($year . '-' . $monthFormatted . '-01')->endOfMonth(),
            ])
            ->selectRaw('accountchart_id, sum(debit) as subtotal_debit, sum(credit) as subtotal_credit')
            ->groupBy('accountchart_id')
            ->whereRaw('(credit + debit) <> 0')
            ->get();

        $beginningBalances = BeginningBalance::select('accountchart_id', 'amount')
            ->whereBetween('start_date', [
                Carbon::parse($year . '-01-01')->startOfYear(),
                Carbon::parse($year . '-01-01')->endOfYear(),
            ])
            ->get();

        $pdf = PDF::loadView('report-form.financial-statement.trial-balance-report', compact('journals', 'year', 'month', 'beginningBalances', 'accounts'));
        $filename = 'Trial Balance Report ' . $year . '-' . $month;
        $pdf->setPaper('LEGAL', 'portrait');

        return $pdf->download($filename . '.pdf');
    }

    public function monthFormat($month)
    {
        if ($month < 10) {
            return '0' . $month;
        } else {
            return $month;
        }
    }
}
