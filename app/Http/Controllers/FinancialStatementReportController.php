<?php

namespace App\Http\Controllers;

use App\Models\AccountChart;
use App\Models\AccountGroup;
use App\Models\BeginningBalance;
use App\Models\MajorAccountGroup;
use App\Models\SubMajorAccountGroup;
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
        if ($type == 2) {
            return $this->detailedIncomeStatementReport($year, $month);
        }
    }

    public function pdf($type, $year, $month)
    {
        if ($type == 1) {
            return $this->trialBalancePDF($year, $month);
        }
        if ($type == 2) {
            return $this->detailedIncomeStatementPDF($year, $month);
        }
    }

    // Trial Balance Report Start
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
    // Trial Balance Report End
    // Detailed Income Statement Report Start
    public function detailedIncomeStatementReport($year, $month)
    {
        $monthFormatted = $this->monthFormat($month);
        $accounts = AccountChart::with('accountGroup', 'MajorAccountGroup', 'SubMajorAccountGroup')
            ->select('id', 'code', 'name', 'acctgrp_id', 'mjracctgrp_id', 'submjracctgrp_id')
            ->where(function ($query) {
                $query->orWhereRaw('left(code,1) = 4')
                    ->orWhereRaw('left(code,1) = 5');
            })
            ->orderBy('code', 'ASC')
            ->get();
        $accountGroups = AccountGroup::select('id','code','name')
            ->where(function ($query) {
                $query->orWhere('code', 4)
                    ->orWhere('code', 5);
            })
            ->get();

        $accountMajorGroups = MajorAccountGroup::select('id','code','name')
            ->where(function ($query) {
                $query->orWhereRaw('left(code,1) = 4')
                    ->orWhereRaw('left(code,1) = 5');
            })
            ->get();

        $accountSubMajorGroups = SubMajorAccountGroup::select('id','code','name')
            ->where(function ($query) {
                $query->orWhereRaw('left(code,1) = 4')
                    ->orWhereRaw('left(code,1) = 5');
            })
            ->get();

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

        return view('report-form.financial-statement.detailed-income-statement-report',
                    compact(
                        'accountGroups','accountMajorGroups','accountSubMajorGroups',
                        'journals', 'year', 'month', 'beginningBalances', 'accounts'
                    ));
    }

    public function detailedIncomeStatementPDF($year, $month)
    {
        $monthFormatted = $this->monthFormat($month);
        $accounts = AccountChart::with('accountGroup', 'MajorAccountGroup', 'SubMajorAccountGroup')
            ->select('id', 'code', 'name', 'acctgrp_id', 'mjracctgrp_id', 'submjracctgrp_id')
            ->where(function ($query) {
                $query->orWhereRaw('left(code,1) = 4')
                    ->orWhereRaw('left(code,1) = 5');
            })
            ->orderBy('code', 'ASC')
            ->get();
        $accountGroups = AccountGroup::select('id','code','name')
            ->where(function ($query) {
                $query->orWhere('code', 4)
                    ->orWhere('code', 5);
            })
            ->get();

        $accountMajorGroups = MajorAccountGroup::select('id','code','name')
            ->where(function ($query) {
                $query->orWhereRaw('left(code,1) = 4')
                    ->orWhereRaw('left(code,1) = 5');
            })
            ->get();

        $accountSubMajorGroups = SubMajorAccountGroup::select('id','code','name')
            ->where(function ($query) {
                $query->orWhereRaw('left(code,1) = 4')
                    ->orWhereRaw('left(code,1) = 5');
            })
            ->get();

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

        $pdf = PDF::loadView('report-form.financial-statement.detailed-income-statement-report',
                            compact(
                                'accountGroups','accountMajorGroups','accountSubMajorGroups',
                                'journals', 'year', 'month', 'beginningBalances', 'accounts'
                            ));
        $filename = 'Detailed Income Statement Report ' . $year . '-' . $month;
        $pdf->setPaper('LEGAL', 'portrait');

        return $pdf->download($filename . '.pdf');
    }
    // Detailed Income Statement Report End

    public function monthFormat($month)
    {
        if ($month < 10) {
            return '0' . $month;
        } else {
            return $month;
        }
    }
}
