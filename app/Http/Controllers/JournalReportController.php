<?php

namespace App\Http\Controllers;

use App\Models\JournalEntryVoucher;
use Illuminate\Support\Facades\DB;
use PDF;

class JournalReportController extends Controller
{
    public function journalReport($type, $date_start, $date_end)
    {
        if ($type == 1) {
            return $this->cashRecieptJournalReport($type, $date_start, $date_end);
        }
        if ($type == 2) {
            return $this->billingJournalReport($type, $date_start, $date_end);
        }
        if ($type == 5) {
            return $this->generalJournalReport($type, $date_start, $date_end);
        }
    }

    public function journalPdf($type, $date_start, $date_end)
    {
        if ($type == 1) {
            return $this->cashRecieptJournalPDF($type, $date_start, $date_end);
        }
        if ($type == 2) {
            return $this->billingJournalPDF($type, $date_start, $date_end);
        }
        if ($type == 5) {
            return $this->generalJournalPDF($type, $date_start, $date_end);
        }
    }

    public function cashRecieptJournalReport($type, $date_start, $date_end)
    {
        $journals = JournalEntryVoucher::with('cashReciept', 'transactions')->select('id', 'jev_no', 'type', 'jv_date', 'particulars')
            ->where('type', $type)
            ->where('jv_date', '>=', $date_start)
            ->where('jv_date', '<=', $date_end)
            ->orderBy('jv_date', 'ASC')
            ->orderBy('jev_no', 'ASC')
            ->with('transactions')
            ->get();

        $recaps = DB::table('transactions')
            ->join('journal_entry_vouchers', 'transactions.journal_entry_voucher_id', '=', 'journal_entry_vouchers.id')
            ->join('account_charts', 'transactions.accountchart_id', '=', 'account_charts.id')
            ->select('code', 'name', DB::raw('sum(debit) as tdebit'), DB::raw('sum(credit) as tcredit'))
            ->where('type', $type)
            ->where('jv_date', '>=', $date_start)
            ->where('jv_date', '<=', $date_end)
            ->groupBy('code', 'name')
            ->orderBy('code', 'ASC')
            ->get();

        return view('report-form.crj-journals-report', compact('journals', 'date_start', 'date_end', 'recaps'));
    }

    public function cashRecieptJournalPDF($type, $date_start, $date_end)
    {
        $journals = JournalEntryVoucher::with('cashReciept', 'transactions')->select('id', 'jev_no', 'type', 'jv_date', 'particulars')
            ->where('type', $type)
            ->where('jv_date', '>=', $date_start)
            ->where('jv_date', '<=', $date_end)
            ->orderBy('jv_date', 'ASC')
            ->orderBy('jev_no', 'ASC')
            ->with('transactions')
            ->get();

        $recaps = DB::table('transactions')
            ->join('journal_entry_vouchers', 'transactions.journal_entry_voucher_id', '=', 'journal_entry_vouchers.id')
            ->join('account_charts', 'transactions.accountchart_id', '=', 'account_charts.id')
            ->select('code', 'name', DB::raw('sum(debit) as tdebit'), DB::raw('sum(credit) as tcredit'))
            ->where('type', $type)
            ->where('jv_date', '>=', $date_start)
            ->where('jv_date', '<=', $date_end)
            ->groupBy('code', 'name')
            ->orderBy('code', 'ASC')
            ->get();

        $pdf = PDF::loadView('report-form.crj-journals-report', compact('journals', 'date_start', 'date_end', 'recaps'));
        $typename = $this->typeName($type);

        $filename = 'Journal ' . $typename . '-' . $date_start . '-' . $date_end;

        $pdf->setPaper('LEGAL', 'landscape');

        return $pdf->download($filename . '.pdf');
    }

    public function billingJournalReport($type, $date_start, $date_end)
    {
        $journals = JournalEntryVoucher::with('billing', 'transactions')->select('id', 'jev_no', 'type', 'jv_date', 'particulars')
            ->where('type', $type)
            ->where('jv_date', '>=', $date_start)
            ->where('jv_date', '<=', $date_end)
            ->orderBy('jv_date', 'ASC')
            ->orderBy('jev_no', 'ASC')
            ->with('transactions')
            ->get();

        $recaps = DB::table('transactions')
            ->join('journal_entry_vouchers', 'transactions.journal_entry_voucher_id', '=', 'journal_entry_vouchers.id')
            ->join('account_charts', 'transactions.accountchart_id', '=', 'account_charts.id')
            ->select('code', 'name', DB::raw('sum(debit) as tdebit'), DB::raw('sum(credit) as tcredit'))
            ->where('type', $type)
            ->where('jv_date', '>=', $date_start)
            ->where('jv_date', '<=', $date_end)
            ->groupBy('code', 'name')
            ->orderBy('code', 'ASC')
            ->get();

        return view('report-form.bj-journals-report', compact('journals', 'date_start', 'date_end', 'recaps'));
    }

    public function billingJournalPDF($type, $date_start, $date_end)
    {
        $journals = JournalEntryVoucher::with('billing', 'transactions')->select('id', 'jev_no', 'type', 'jv_date', 'particulars')
            ->where('type', $type)
            ->where('jv_date', '>=', $date_start)
            ->where('jv_date', '<=', $date_end)
            ->orderBy('jv_date', 'ASC')
            ->orderBy('jev_no', 'ASC')
            ->with('transactions')
            ->get();

        $recaps = DB::table('transactions')
            ->join('journal_entry_vouchers', 'transactions.journal_entry_voucher_id', '=', 'journal_entry_vouchers.id')
            ->join('account_charts', 'transactions.accountchart_id', '=', 'account_charts.id')
            ->select('code', 'name', DB::raw('sum(debit) as tdebit'), DB::raw('sum(credit) as tcredit'))
            ->where('type', $type)
            ->where('jv_date', '>=', $date_start)
            ->where('jv_date', '<=', $date_end)
            ->groupBy('code', 'name')
            ->orderBy('code', 'ASC')
            ->get();

        $pdf = PDF::loadView('report-form.bj-journals-report', compact('journals', 'date_start', 'date_end', 'recaps'));
        $typename = $this->typeName($type);

        $filename = 'Journal ' . $typename . '-' . $date_start . '-' . $date_end;

        $pdf->setPaper('LEGAL', 'landscape');

        return $pdf->download($filename . '.pdf');
    }

    public function generalJournalReport($type, $date_start, $date_end)
    {
        $journals = JournalEntryVoucher::with('generalJournal', 'transactions')->select('id', 'jev_no', 'type', 'jv_date', 'particulars')
            ->where('type', $type)
            ->where('jv_date', '>=', $date_start)
            ->where('jv_date', '<=', $date_end)
            ->orderBy('jv_date', 'ASC')
            ->orderBy('jev_no', 'ASC')
            ->with('transactions')
            ->get();

        $recaps = DB::table('transactions')
            ->join('journal_entry_vouchers', 'transactions.journal_entry_voucher_id', '=', 'journal_entry_vouchers.id')
            ->join('account_charts', 'transactions.accountchart_id', '=', 'account_charts.id')
            ->select('code', 'name', DB::raw('sum(debit) as tdebit'), DB::raw('sum(credit) as tcredit'))
            ->where('type', $type)
            ->where('jv_date', '>=', $date_start)
            ->where('jv_date', '<=', $date_end)
            ->groupBy('code', 'name')
            ->orderBy('code', 'ASC')
            ->get();

        return view('report-form.gj-journals-report', compact('journals', 'date_start', 'date_end', 'recaps'));
    }

    public function generalJournalPDF($type, $date_start, $date_end)
    {
        $journals = JournalEntryVoucher::with('generalJournal', 'transactions')->select('id', 'jev_no', 'type', 'jv_date', 'particulars')
            ->where('type', $type)
            ->where('jv_date', '>=', $date_start)
            ->where('jv_date', '<=', $date_end)
            ->orderBy('jv_date', 'ASC')
            ->orderBy('jev_no', 'ASC')
            ->with('transactions')
            ->get();

        $recaps = DB::table('transactions')
            ->join('journal_entry_vouchers', 'transactions.journal_entry_voucher_id', '=', 'journal_entry_vouchers.id')
            ->join('account_charts', 'transactions.accountchart_id', '=', 'account_charts.id')
            ->select('code', 'name', DB::raw('sum(debit) as tdebit'), DB::raw('sum(credit) as tcredit'))
            ->where('type', $type)
            ->where('jv_date', '>=', $date_start)
            ->where('jv_date', '<=', $date_end)
            ->groupBy('code', 'name')
            ->orderBy('code', 'ASC')
            ->get();

        $pdf = PDF::loadView('report-form.gj-journals-report', compact('journals', 'date_start', 'date_end', 'recaps'));
        $typename = $this->typeName($type);

        $filename = 'Journal ' . $typename . '-' . $date_start . '-' . $date_end;

        $pdf->setPaper('LEGAL', 'landscape');

        return $pdf->download($filename . '.pdf');
    }

    public function typeName($type)
    {
        if ($type == 1) {
            return "CRJ";
        } elseif ($type == 2) {
            return "BJ";
        } elseif ($type == 3) {
            return "MSIJ";
        } elseif ($type == 4) {
            return "CDJ";
        } elseif ($type == 5) {
            return "GJ";
        } else {
            return "";
        }
    }

}
