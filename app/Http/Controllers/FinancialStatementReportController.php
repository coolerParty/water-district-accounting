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
        if ($type == 3) {
            return $this->statementFinancialPositionReport($year, $month);
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
        if ($type == 3) {
            return $this->statementFinancialPositionPDF($year, $month);
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
        $accountGroups = AccountGroup::select('id', 'code', 'name')
            ->where(function ($query) {
                $query->orWhere('code', 4)
                    ->orWhere('code', 5);
            })
            ->get();

        $accountMajorGroups = MajorAccountGroup::select('id', 'code', 'name')
            ->where(function ($query) {
                $query->orWhereRaw('left(code,1) = 4')
                    ->orWhereRaw('left(code,1) = 5');
            })
            ->get();

        $accountSubMajorGroups = SubMajorAccountGroup::select('id', 'code', 'name')
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
            ->whereIn('accountchart_id', $accounts->pluck('id', 'id'))
            ->get();

        $beginningBalances = BeginningBalance::select('accountchart_id', 'amount')
            ->whereBetween('start_date', [
                Carbon::parse($year . '-01-01')->startOfYear(),
                Carbon::parse($year . '-01-01')->endOfYear(),
            ])
            ->whereIn('accountchart_id', $accounts->pluck('id', 'id'))
            ->get();

        return view(
            'report-form.financial-statement.detailed-income-statement-report',
            compact(
                'accountGroups',
                'accountMajorGroups',
                'accountSubMajorGroups',
                'journals',
                'year',
                'month',
                'beginningBalances',
                'accounts'
            )
        );
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
        $accountGroups = AccountGroup::select('id', 'code', 'name')
            ->where(function ($query) {
                $query->orWhere('code', 4)
                    ->orWhere('code', 5);
            })
            ->get();

        $accountMajorGroups = MajorAccountGroup::select('id', 'code', 'name')
            ->where(function ($query) {
                $query->orWhereRaw('left(code,1) = 4')
                    ->orWhereRaw('left(code,1) = 5');
            })
            ->get();

        $accountSubMajorGroups = SubMajorAccountGroup::select('id', 'code', 'name')
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
            ->whereIn('accountchart_id', $accounts->pluck('id', 'id'))
            ->get();

        $beginningBalances = BeginningBalance::select('accountchart_id', 'amount')
            ->whereBetween('start_date', [
                Carbon::parse($year . '-01-01')->startOfYear(),
                Carbon::parse($year . '-01-01')->endOfYear(),
            ])
            ->whereIn('accountchart_id', $accounts->pluck('id', 'id'))
            ->get();

        $pdf = PDF::loadView(
            'report-form.financial-statement.detailed-income-statement-report',
            compact(
                'accountGroups',
                'accountMajorGroups',
                'accountSubMajorGroups',
                'journals',
                'year',
                'month',
                'beginningBalances',
                'accounts'
            )
        );
        $filename = 'Detailed Income Statement Report ' . $year . '-' . $month;
        $pdf->setPaper('LEGAL', 'portrait');

        return $pdf->download($filename . '.pdf');
    }
    // Detailed Income Statement Report End
    // Statement Financial Position Report Start
    public function statementFinancialPositionReport($year, $month)
    {
        $monthFormatted = $this->monthFormat($month);
        $accounts = AccountChart::select('id', 'code', 'name', 'acctgrp_id', 'mjracctgrp_id', 'submjracctgrp_id', 'current_non')
            ->where(function ($query) {
                $query->orWhereRaw('left(code,1) = 1')
                    ->orWhereRaw('left(code,1) = 2')
                    ->orWhereRaw('left(code,1) = 3');
            })
            ->orderBy('code', 'ASC')
            ->get();

        $accountGroups = AccountGroup::with('accountCharts')
            ->select('id', 'code', 'name')
            ->where(function ($query) {
                $query->orWhere('code', 1)
                    ->orWhere('code', 2)
                    ->orWhere('code', 3);
            })
            ->get();

        $accountGroupsNon = DB::table('account_charts')
            ->join('account_groups', 'account_groups.id', '=', 'account_charts.acctgrp_id')
            ->where(function ($query) {
                $query->orWhereRaw('left(account_charts.code,1) = 1')
                    ->orWhereRaw('left(account_charts.code,1) = 2')
                    ->orWhereRaw('left(account_charts.code,1) = 3');
            })
            ->select('current_non', 'account_groups.id as acct_gp_id')
            ->orderBy('account_charts.code', 'ASC')
            ->groupBy('current_non', 'acct_gp_id')
            ->get();

        $accountMajorGroups = DB::table('account_charts')
            ->join('major_account_groups', 'major_account_groups.id', '=', 'account_charts.mjracctgrp_id')
            ->where(function ($query) {
                $query->orWhereRaw('left(account_charts.code,1) = 1')
                    ->orWhereRaw('left(account_charts.code,1) = 2')
                    ->orWhereRaw('left(account_charts.code,1) = 3');
            })
            ->select('current_non', 'major_account_groups.id as acct_mgp_id', 'major_account_groups.code as acct_mgp_code', 'major_account_groups.name as acct_mgp_name')
            ->orderBy('account_charts.code', 'ASC')
            ->groupBy('current_non', 'acct_mgp_id', 'acct_mgp_code', 'acct_mgp_name')
            ->get();

        $accountSubMajorGroups = DB::table('account_charts')
            ->join('sub_major_account_groups', 'sub_major_account_groups.id', '=', 'account_charts.submjracctgrp_id')
            ->where(function ($query) {
                $query->orWhereRaw('left(account_charts.code,1) = 1')
                    ->orWhereRaw('left(account_charts.code,1) = 2')
                    ->orWhereRaw('left(account_charts.code,1) = 3');
            })
            ->select('current_non', 'sub_major_account_groups.id as acct_smgp_id', 'sub_major_account_groups.code as acct_smgp_code', 'sub_major_account_groups.name as acct_smgp_name')
            ->orderBy('acct_smgp_code', 'ASC')
            ->orderBy('current_non', 'ASC')
            ->groupBy('current_non', 'acct_smgp_id', 'acct_smgp_code', 'acct_smgp_name')
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
            ->whereIn('accountchart_id', $accounts->pluck('id', 'id'))
            ->get();

        $beginningBalances = BeginningBalance::select('accountchart_id', 'amount')
            ->whereBetween('start_date', [
                Carbon::parse($year . '-01-01')->startOfYear(),
                Carbon::parse($year . '-01-01')->endOfYear(),
            ])
            ->whereIn('accountchart_id', $accounts->pluck('id', 'id'))
            ->get();

        // Net Income Loss Start
        $NET_journals = DB::table('journal_entry_vouchers')
            ->join('transactions', 'journal_entry_vouchers.id', '=', 'transactions.journal_entry_voucher_id')
            ->join('account_charts', 'account_charts.id', '=', 'transactions.accountchart_id')
            ->whereBetween('jv_date', [
                Carbon::parse($year . '-01-01')->startOfYear(),
                Carbon::parse($year . '-' . $monthFormatted . '-01')->endOfMonth(),
            ])
            ->selectRaw('left(account_charts.code,1) as account_group, (sum(debit) - sum(credit)) as subtotal')
            ->groupBy('account_group')
            ->whereRaw('(credit + debit) <> 0')
            ->where(function ($query) {
                $query->orWhereRaw('left(account_charts.code,1) = 4')
                    ->orWhereRaw('left(account_charts.code,1) = 5');
            })
            ->get();

        $NET_beginningBalances = DB::table('beginning_balances')
            ->join('account_charts', 'account_charts.id', '=', 'beginning_balances.accountchart_id')
            ->selectRaw('left(account_charts.code,1) as account_group, sum(amount) as subtotal')
            ->whereBetween('start_date', [
                Carbon::parse($year . '-01-01')->startOfYear(),
                Carbon::parse($year . '-01-01')->endOfYear(),
            ])
            ->groupBy('account_group')
            ->where('amount','<>',0)
            ->where(function ($query) {
                $query->orWhereRaw('left(account_charts.code,1) = 4')
                    ->orWhereRaw('left(account_charts.code,1) = 5');
            })
            ->get();

        $NET_Total_amount = 0;
        foreach($NET_journals as $NET_journal)
        {
            if($NET_journal->account_group == 4)
            {
                $NET_Total_amount = $NET_Total_amount +  $NET_journal->subtotal;
            }
            else
            {
                $NET_Total_amount = $NET_Total_amount -  $NET_journal->subtotal;
            }
        }

        foreach($NET_beginningBalances as $NET_beginningBalance)
        {
            if($NET_beginningBalance->account_group == 4)
            {
                $NET_Total_amount = $NET_Total_amount +  $NET_beginningBalance->subtotal;
            }
            else
            {
                $NET_Total_amount = $NET_Total_amount -  $NET_beginningBalance->subtotal;
            }
        }

        // Net Income Loss End



        return view(
            'report-form.financial-statement.statement-financial-position-report',
            compact(
                'accountGroups',
                'accountMajorGroups',
                'accountSubMajorGroups',
                'journals',
                'year',
                'month',
                'beginningBalances',
                'accounts',
                'accountGroupsNon',
                'NET_Total_amount'
            )
        );
    }

    public function statementFinancialPositionPDF($year, $month)
    {
        $monthFormatted = $this->monthFormat($month);
        $accounts = AccountChart::select('id', 'code', 'name', 'acctgrp_id', 'mjracctgrp_id', 'submjracctgrp_id', 'current_non')
            ->where(function ($query) {
                $query->orWhereRaw('left(code,1) = 1')
                    ->orWhereRaw('left(code,1) = 2')
                    ->orWhereRaw('left(code,1) = 3');
            })
            ->orderBy('code', 'ASC')
            ->get();

        $accountGroups = AccountGroup::with('accountCharts')
            ->select('id', 'code', 'name')
            ->where(function ($query) {
                $query->orWhere('code', 1)
                    ->orWhere('code', 2)
                    ->orWhere('code', 3);
            })
            ->get();

        $accountGroupsNon = DB::table('account_charts')
            ->join('account_groups', 'account_groups.id', '=', 'account_charts.acctgrp_id')
            ->where(function ($query) {
                $query->orWhereRaw('left(account_charts.code,1) = 1')
                    ->orWhereRaw('left(account_charts.code,1) = 2')
                    ->orWhereRaw('left(account_charts.code,1) = 3');
            })
            ->select('current_non', 'account_groups.id as acct_gp_id')
            ->orderBy('account_charts.code', 'ASC')
            ->groupBy('current_non', 'acct_gp_id')
            ->get();

        $accountMajorGroups = DB::table('account_charts')
            ->join('major_account_groups', 'major_account_groups.id', '=', 'account_charts.mjracctgrp_id')
            ->where(function ($query) {
                $query->orWhereRaw('left(account_charts.code,1) = 1')
                    ->orWhereRaw('left(account_charts.code,1) = 2')
                    ->orWhereRaw('left(account_charts.code,1) = 3');
            })
            ->select('current_non', 'major_account_groups.id as acct_mgp_id', 'major_account_groups.code as acct_mgp_code', 'major_account_groups.name as acct_mgp_name')
            ->orderBy('account_charts.code', 'ASC')
            ->groupBy('current_non', 'acct_mgp_id', 'acct_mgp_code', 'acct_mgp_name')
            ->get();

        $accountSubMajorGroups = DB::table('account_charts')
            ->join('sub_major_account_groups', 'sub_major_account_groups.id', '=', 'account_charts.submjracctgrp_id')
            ->where(function ($query) {
                $query->orWhereRaw('left(account_charts.code,1) = 1')
                    ->orWhereRaw('left(account_charts.code,1) = 2')
                    ->orWhereRaw('left(account_charts.code,1) = 3');
            })
            ->select('current_non', 'sub_major_account_groups.id as acct_smgp_id', 'sub_major_account_groups.code as acct_smgp_code', 'sub_major_account_groups.name as acct_smgp_name')
            ->orderBy('acct_smgp_code', 'ASC')
            ->orderBy('current_non', 'ASC')
            ->groupBy('current_non', 'acct_smgp_id', 'acct_smgp_code', 'acct_smgp_name')
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
            ->whereIn('accountchart_id', $accounts->pluck('id', 'id'))
            ->get();

        $beginningBalances = BeginningBalance::select('accountchart_id', 'amount')
            ->whereBetween('start_date', [
                Carbon::parse($year . '-01-01')->startOfYear(),
                Carbon::parse($year . '-01-01')->endOfYear(),
            ])
            ->whereIn('accountchart_id', $accounts->pluck('id', 'id'))
            ->get();

        // Net Income Loss Start
        $NET_journals = DB::table('journal_entry_vouchers')
            ->join('transactions', 'journal_entry_vouchers.id', '=', 'transactions.journal_entry_voucher_id')
            ->join('account_charts', 'account_charts.id', '=', 'transactions.accountchart_id')
            ->whereBetween('jv_date', [
                Carbon::parse($year . '-01-01')->startOfYear(),
                Carbon::parse($year . '-' . $monthFormatted . '-01')->endOfMonth(),
            ])
            ->selectRaw('left(account_charts.code,1) as account_group, (sum(debit) - sum(credit)) as subtotal')
            ->groupBy('account_group')
            ->whereRaw('(credit + debit) <> 0')
            ->where(function ($query) {
                $query->orWhereRaw('left(account_charts.code,1) = 4')
                    ->orWhereRaw('left(account_charts.code,1) = 5');
            })
            ->get();

        $NET_beginningBalances = DB::table('beginning_balances')
            ->join('account_charts', 'account_charts.id', '=', 'beginning_balances.accountchart_id')
            ->selectRaw('left(account_charts.code,1) as account_group, sum(amount) as subtotal')
            ->whereBetween('start_date', [
                Carbon::parse($year . '-01-01')->startOfYear(),
                Carbon::parse($year . '-01-01')->endOfYear(),
            ])
            ->groupBy('account_group')
            ->where('amount','<>',0)
            ->where(function ($query) {
                $query->orWhereRaw('left(account_charts.code,1) = 4')
                    ->orWhereRaw('left(account_charts.code,1) = 5');
            })
            ->get();

        $NET_Total_amount = 0;
        foreach($NET_journals as $NET_journal)
        {
            if($NET_journal->account_group == 4)
            {
                $NET_Total_amount = $NET_Total_amount +  $NET_journal->subtotal;
            }
            else
            {
                $NET_Total_amount = $NET_Total_amount -  $NET_journal->subtotal;
            }
        }

        foreach($NET_beginningBalances as $NET_beginningBalance)
        {
            if($NET_beginningBalance->account_group == 4)
            {
                $NET_Total_amount = $NET_Total_amount +  $NET_beginningBalance->subtotal;
            }
            else
            {
                $NET_Total_amount = $NET_Total_amount -  $NET_beginningBalance->subtotal;
            }
        }

        // Net Income Loss End

        $pdf = PDF::loadView(
            'report-form.financial-statement.statement-financial-position-report',
            compact(
                'accountGroups',
                'accountMajorGroups',
                'accountSubMajorGroups',
                'journals',
                'year',
                'month',
                'beginningBalances',
                'accounts',
                'accountGroupsNon',
                'NET_Total_amount'
            )
        );
        $filename = 'Statement Financial Position Report ' . $year . '-' . $month;
        $pdf->setPaper('LEGAL', 'portrait');

        return $pdf->download($filename . '.pdf');
    }
    // Statement Financial Position Report End

    public function monthFormat($month)
    {
        if ($month < 10) {
            return '0' . $month;
        } else {
            return $month;
        }
    }
}
