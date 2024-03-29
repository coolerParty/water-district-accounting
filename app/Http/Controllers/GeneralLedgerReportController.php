<?php

namespace App\Http\Controllers;

use App\Models\AccountChart;
use App\Models\BeginningBalance;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\DB;

class GeneralLedgerReportController extends Controller
{
    public function monthFormat($month)
    {
        if ($month < 10) {
            return '0' . $month;
        } else {
            return $month;
        }
    }

    public function report($code, $year, $month)
    {
        $monthFormatted = $this->monthFormat($month);
        $accounts = AccountChart::select('id', 'code', 'name')->where('code', $code)->first();
        if (empty($accounts)) {
            abort(404);
        }

        $journals = DB::table('journal_entry_vouchers')
            ->join('transactions', 'journal_entry_vouchers.id', '=', 'transactions.journal_entry_voucher_id')
            ->where('accountchart_id', $accounts->id)
            ->whereBetween('jv_date', [
                Carbon::parse($year . '-01-01')->startOfYear(),
                Carbon::parse($year . '-' . $monthFormatted . '-01')->endOfMonth(),
            ])
            ->selectRaw('type, accountchart_id,sum(debit) as subtotal_debit, sum(credit) as subtotal_credit, month(jv_date) as jv_month')
            ->groupBy('type', 'accountchart_id', 'jv_month')
            ->get();

        $jvAllMonths = $journals->pluck('jv_month', 'jv_month');

        $beginningBalance = BeginningBalance::select('accountchart_id', 'amount')
            ->whereBetween('start_date', [
                Carbon::parse($year . '-01-01')->startOfYear(),
                Carbon::parse($year . '-01-01')->endOfYear(),
            ])
            ->where('accountchart_id', $accounts->id)
            ->first();

        return view('report-form.general-ledger.general-ledger-report', compact('journals', 'year', 'month', 'beginningBalance', 'accounts', 'jvAllMonths'));
    }

    public function pdf($code, $year, $month)
    {
        $monthFormatted = $this->monthFormat($month);
        $accounts = AccountChart::select('id', 'code', 'name')->where('code', $code)->first();
        if (empty($accounts)) {
            abort(404);
        }

        $journals = DB::table('journal_entry_vouchers')
            ->join('transactions', 'journal_entry_vouchers.id', '=', 'transactions.journal_entry_voucher_id')
            ->where('accountchart_id', $accounts->id)
            ->whereBetween('jv_date', [
                Carbon::parse($year . '-01-01'),
                Carbon::parse($year . $monthFormatted . '-01'),
            ])
            ->selectRaw('type, accountchart_id,sum(debit) as subtotal_debit, sum(credit) as subtotal_credit, month(jv_date) as jv_month')
            ->groupBy('type', 'accountchart_id', 'jv_month')
            ->get();

        $jvAllMonths = $journals->pluck('jv_month', 'jv_month');

        $beginningBalance = BeginningBalance::select('accountchart_id', 'amount')
            ->whereBetween('start_date', [
                Carbon::parse($year . '-01-01'),
                Carbon::parse($year . '-01-01')->endOfYear(),
            ])
            ->where('accountchart_id')
            ->first();

        $pdf = PDF::loadView('report-form.general-ledger.general-ledger-report', compact('journals', 'year', 'month', 'beginningBalance', 'accounts', 'jvAllMonths'));
        $filename = 'General Ledger ' . $year . '-' . $month;
        $pdf->setPaper('LEGAL', 'portrait');

        return $pdf->download($filename . '.pdf');
    }
}
