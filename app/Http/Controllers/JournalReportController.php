<?php

namespace App\Http\Controllers;

use App\Models\JournalEntryVoucher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class JournalReportController extends Controller
{
    public function journalReport($type, $date_start, $date_end)
    {
        $this->confirmation($type);

        if ($type == 1) {
            return $this->cashRecieptJournalReport($type, $date_start, $date_end);
        }
        if ($type == 2) {
            return $this->billingJournalReport($type, $date_start, $date_end);
        }
        if ($type == 3) {
            return $this->materialsStockIssuedJournalReport($type, $date_start, $date_end);
        }
        if ($type == 4) {
            return $this->checkDisbursementJournalReport($type, $date_start, $date_end);
        }
        if ($type == 5) {
            return $this->generalJournalReport($type, $date_start, $date_end);
        }
    }

    public function journalPdf($type, $date_start, $date_end)
    {
        $this->confirmation($type);

        if ($type == 1) {
            return $this->cashRecieptJournalPDF($type, $date_start, $date_end);
        }
        if ($type == 2) {
            return $this->billingJournalPDF($type, $date_start, $date_end);
        }
        if ($type == 3) {
            return $this->materialsStockIssuedJournalPDF($type, $date_start, $date_end);
        }
        if ($type == 4) {
            return $this->checkDisbursementJournalPDF($type, $date_start, $date_end);
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
            ->visibleTo(Auth::user())
            ->orderBy('jv_date', 'ASC')
            ->orderBy('jev_no', 'ASC')
            ->get();

        if (empty($journals)) {
            abort(404);
        }

        $recaps = $this->recapitulation($type, $date_start, $date_end);


        return view('report-form.crj-journals-report', compact('journals', 'date_start', 'date_end', 'recaps'));
    }

    public function cashRecieptJournalPDF($type, $date_start, $date_end)
    {
        $journals = JournalEntryVoucher::with('cashReciept', 'transactions')->select('id', 'jev_no', 'type', 'jv_date', 'particulars')
            ->where('type', $type)
            ->where('jv_date', '>=', $date_start)
            ->where('jv_date', '<=', $date_end)
            ->visibleTo(Auth::user())
            ->orderBy('jv_date', 'ASC')
            ->orderBy('jev_no', 'ASC')
            ->get();

        if (empty($journals)) {
            abort(404);
        }

        $recaps = $this->recapitulation($type, $date_start, $date_end);

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
            ->visibleTo(Auth::user())
            ->orderBy('jv_date', 'ASC')
            ->orderBy('jev_no', 'ASC')
            ->get();

        if (empty($journals)) {
            abort(404);
        }

        $recaps = $this->recapitulation($type, $date_start, $date_end);

        return view('report-form.bj-journals-report', compact('journals', 'date_start', 'date_end', 'recaps'));
    }

    public function billingJournalPDF($type, $date_start, $date_end)
    {
        $journals = JournalEntryVoucher::with('billing', 'transactions')->select('id', 'jev_no', 'type', 'jv_date', 'particulars')
            ->where('type', $type)
            ->where('jv_date', '>=', $date_start)
            ->where('jv_date', '<=', $date_end)
            ->visibleTo(Auth::user())
            ->orderBy('jv_date', 'ASC')
            ->orderBy('jev_no', 'ASC')
            ->get();

        if (empty($journals)) {
            abort(404);
        }

        $recaps = $this->recapitulation($type, $date_start, $date_end);

        $pdf = PDF::loadView('report-form.bj-journals-report', compact('journals', 'date_start', 'date_end', 'recaps'));
        $typename = $this->typeName($type);

        $filename = 'Journal ' . $typename . '-' . $date_start . '-' . $date_end;

        $pdf->setPaper('LEGAL', 'landscape');

        return $pdf->download($filename . '.pdf');
    }

    // Materials Stock Issued Journals Report Start
    public function materialsStockIssuedJournalReport($type, $date_start, $date_end)
    {
        $journals = JournalEntryVoucher::with('materialIssuedJournal', 'transactions')->select('id', 'jev_no', 'type', 'jv_date', 'particulars')
            ->where('type', $type)
            ->where('jv_date', '>=', $date_start)
            ->where('jv_date', '<=', $date_end)
            ->visibleTo(Auth::user())
            ->orderBy('jv_date', 'ASC')
            ->orderBy('jev_no', 'ASC')
            ->get();

        if (empty($journals)) {
            abort(404);
        }

        $recaps = $this->recapitulation($type, $date_start, $date_end);


        return view('report-form.msij-journals-report', compact('journals', 'date_start', 'date_end', 'recaps'));
    }

    public function materialsStockIssuedJournalPDF($type, $date_start, $date_end)
    {
        $journals = JournalEntryVoucher::with('materialIssuedJournal', 'transactions')->select('id', 'jev_no', 'type', 'jv_date', 'particulars')
            ->where('type', $type)
            ->where('jv_date', '>=', $date_start)
            ->where('jv_date', '<=', $date_end)
            ->visibleTo(Auth::user())
            ->orderBy('jv_date', 'ASC')
            ->orderBy('jev_no', 'ASC')
            ->get();

        if (empty($journals)) {
            abort(404);
        }

        $recaps = $this->recapitulation($type, $date_start, $date_end);

        $pdf = PDF::loadView('report-form.msij-journals-report', compact('journals', 'date_start', 'date_end', 'recaps'));
        $typename = $this->typeName($type);

        $filename = 'Journal ' . $typename . '-' . $date_start . '-' . $date_end;

        $pdf->setPaper('LEGAL', 'landscape');

        return $pdf->download($filename . '.pdf');
    }
    // Materials Stock Issued Journals Report End

    // Check Disbursement Journals Report Start
    public function checkDisbursementJournalReport($type, $date_start, $date_end)
    {
        $journals = JournalEntryVoucher::with('disbursement', 'transactions')->select('id', 'jev_no', 'type', 'jv_date', 'particulars')
            ->where('type', $type)
            ->where('jv_date', '>=', $date_start)
            ->where('jv_date', '<=', $date_end)
            ->visibleTo(Auth::user())
            ->orderBy('jv_date', 'ASC')
            ->orderBy('jev_no', 'ASC')
            ->get();

        if (empty($journals)) {
            abort(404);
        }

        $recaps = $this->recapitulation($type, $date_start, $date_end);


        return view('report-form.dv-journals-report', compact('journals', 'date_start', 'date_end', 'recaps'));
    }

    public function checkDisbursementJournalPDF($type, $date_start, $date_end)
    {
        $journals = JournalEntryVoucher::with('disbursement', 'transactions')->select('id', 'jev_no', 'type', 'jv_date', 'particulars')
            ->where('type', $type)
            ->where('jv_date', '>=', $date_start)
            ->where('jv_date', '<=', $date_end)
            ->visibleTo(Auth::user())
            ->orderBy('jv_date', 'ASC')
            ->orderBy('jev_no', 'ASC')
            ->get();

        if (empty($journals)) {
            abort(404);
        }

        $recaps = $this->recapitulation($type, $date_start, $date_end);

        $pdf = PDF::loadView('report-form.dv-journals-report', compact('journals', 'date_start', 'date_end', 'recaps'));
        $typename = $this->typeName($type);

        $filename = 'Journal ' . $typename . '-' . $date_start . '-' . $date_end;

        $pdf->setPaper('LEGAL', 'landscape');

        return $pdf->download($filename . '.pdf');
    }
    // Check Disbursement Journals Report End

    public function generalJournalReport($type, $date_start, $date_end)
    {
        $journals = JournalEntryVoucher::with('generalJournal', 'transactions')->select('id', 'jev_no', 'type', 'jv_date', 'particulars')
            ->where('type', $type)
            ->where('jv_date', '>=', $date_start)
            ->where('jv_date', '<=', $date_end)
            ->visibleTo(Auth::user())
            ->orderBy('jv_date', 'ASC')
            ->orderBy('jev_no', 'ASC')
            ->get();

        if (empty($journals)) {
            abort(404);
        }

        $recaps = $this->recapitulation($type, $date_start, $date_end);

        return view('report-form.gj-journals-report', compact('journals', 'date_start', 'date_end', 'recaps'));
    }

    public function generalJournalPDF($type, $date_start, $date_end)
    {
        $journals = JournalEntryVoucher::with('generalJournal', 'transactions')->select('id', 'jev_no', 'type', 'jv_date', 'particulars')
            ->where('type', $type)
            ->where('jv_date', '>=', $date_start)
            ->where('jv_date', '<=', $date_end)
            ->visibleTo(Auth::user())
            ->orderBy('jv_date', 'ASC')
            ->orderBy('jev_no', 'ASC')
            ->get();

        if (empty($journals)) {
            abort(404);
        }

        $recaps = $this->recapitulation($type, $date_start, $date_end);

        $pdf = PDF::loadView('report-form.gj-journals-report', compact('journals', 'date_start', 'date_end', 'recaps'));
        $typename = $this->typeName($type);

        $filename = 'Journal ' . $typename . '-' . $date_start . '-' . $date_end;

        $pdf->setPaper('LEGAL', 'landscape');

        return $pdf->download($filename . '.pdf');
    }

    public function recapitulation($type, $date_start, $date_end)
    {
        return DB::table('transactions')
        ->join('journal_entry_vouchers', 'transactions.journal_entry_voucher_id', '=', 'journal_entry_vouchers.id')
        ->join('account_charts', 'transactions.accountchart_id', '=', 'account_charts.id')
        ->select('code', 'name', DB::raw('sum(debit) as tdebit'), DB::raw('sum(credit) as tcredit'), DB::raw('IF(debit = 0 , 2 , 1) as seqdebit'))
        ->where('type', $type)
        ->where('jv_date', '>=', $date_start)
        ->where('jv_date', '<=', $date_end)
        ->where(function ($query){
            if (!auth()->user()->can('Super Admin')) {
                $query->where('user_id', Auth::user()->id);
            }
        })
        ->groupBy('code', 'name', 'seqdebit')
        ->orderBy('seqdebit', 'ASC')
        ->orderBy('code', 'ASC')
        ->get();
    }

    public function confirmation($type)
    {
        if ($type == 1) {
            $this->authorize('cash-receipt-journal-report');
        }
        if ($type == 2) {
            $this->authorize('billing-report');
        }
        if ($type == 3) {
            $this->authorize('material-journal-report');
        }
        if ($type == 4) {
            $this->authorize('disbursement-journal-report');
        }
        if ($type == 5) {
            $this->authorize('general-journal-report');
        }
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
