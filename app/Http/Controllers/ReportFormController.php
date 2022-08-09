<?php

namespace App\Http\Controllers;

use App\Models\JournalEntryVoucher;
use App\Models\Transaction;
use PDF;
use Illuminate\Http\Request;


class ReportFormController extends Controller
{
    public function jevReport($id)
    {
        $journal = JournalEntryVoucher::select('id', 'jev_no', 'type', 'jv_date', 'particulars')->where('id', $id)->first();

        if($journal->type ==1){
            $this->authorize('cash-receipt-journal-jev');
        }
        if($journal->type ==2){
            $this->authorize('billing-jev');
        }
        if($journal->type ==3){
            $this->authorize('material-journal-jev');
        }
        if($journal->type ==4){
            $this->authorize('disbursement-journal-jev');
        }
        if($journal->type ==5){
            $this->authorize('general-journal-jev');
        }

        $transactions = Transaction::select('id', 'accountchart_id', 'debit', 'credit')->where('journal_entry_voucher_id', $id)->get();
        return view('report-form.jev-report', compact('journal', 'transactions'));
    }

    public function jevPdf($id)
    {
        $journal = JournalEntryVoucher::select('id', 'jev_no', 'type', 'jv_date', 'particulars')->where('id', $id)->first();

        if($journal->type ==1){
            $this->authorize('cash-receipt-journal-jev');
        }
        if($journal->type ==2){
            $this->authorize('billing-jev');
        }
        if($journal->type ==3){
            $this->authorize('material-journal-jev');
        }
        if($journal->type ==4){
            $this->authorize('disbursement-journal-jev');
        }
        if($journal->type ==5){
            $this->authorize('general-journal-jev');
        }

        $transactions = Transaction::select('id', 'accountchart_id', 'debit', 'credit')->where('journal_entry_voucher_id', $id)->get();
        $pdf = PDF::loadView('report-form.jev-report', compact('journal', 'transactions'));

        $typename = $this->typeName($journal->type);
        $jevYrMonth = date('Y', strtotime($journal->jv_date)) . '-' . date('m', strtotime($journal->jv_date));
        $jevNo = "";

        if (strlen($journal->jev_no) == 1) {
            $jevNo = '000' . $journal->jev_no;
        } elseif (strlen($journal->jev_no) == 2) {
            $jevNo = '00' . $journal->jev_no;
        } elseif (strlen($journal->jev_no) == 3) {
            $jevNo = '0' . $journal->jev_no;
        } else {
            $jevNo =  $journal->jev_no;
        }

        $filename = 'JEV No: ' . $typename . '-' . $jevYrMonth . '-' . $jevNo;

        return $pdf->download($filename . '.pdf');

        // return view('report-form.jev-report', compact('journal', 'transactions'));
    }

    public function journalReport($type, $date_start, $date_end)
    {
        $journals = JournalEntryVoucher::select('id', 'jev_no', 'type', 'jv_date', 'particulars')
        ->where('type', $type)
        ->where('jv_date','>=',$date_start)
        ->where('jv_date','<=',$date_end)
        ->orderBy('jv_date','ASC')
        ->orderBy('jev_no','ASC')
        ->with('transactions')
        ->get();

        return view('report-form.journals-report', compact('journals', 'date_start','date_end'));
    }

    public function journalPdf($type, $date_start, $date_end)
    {
        $journals = JournalEntryVoucher::select('id', 'jev_no', 'type', 'jv_date', 'particulars')
        ->where('type', $type)
        ->where('jv_date','>=',$date_start)
        ->where('jv_date','<=',$date_end)
        ->orderBy('jv_date','ASC')
        ->orderBy('jev_no','ASC')
        ->with('transactions')
        ->get();

        $pdf = PDF::loadView('report-form.journals-report', compact('journals', 'date_start','date_end'));
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

    public function store(Request $request)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
