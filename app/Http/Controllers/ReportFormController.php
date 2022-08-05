<?php

namespace App\Http\Controllers;

use App\Models\JournalEntryVoucher;
use App\Models\Transaction;
use PDF;
use Illuminate\Http\Request;


class ReportFormController extends Controller
{
    public function index($id)
    {
        $journal = JournalEntryVoucher::select('id','jev_no','type','jv_date','particulars')->where('id',$id)->first();
        $transactions = Transaction::select('id','accountchart_id','debit','credit')->where('journal_entry_voucher_id',$id)->get();
        return view('report-form.jev-report', compact('journal', 'transactions'));
    }

    public function downloadPdf($id)
    {
        $journal = JournalEntryVoucher::select('id','jev_no','type','jv_date','particulars')->where('id',$id)->first();
        $transactions = Transaction::select('id','accountchart_id','debit','credit')->where('journal_entry_voucher_id',$id)->get();
        $pdf = PDF::loadView('report-form.jev-report',compact('journal','transactions'));
        return $pdf->download('report-form.jev-report.pdf');

        // return view('report-form.jev-report', compact('journal', 'transactions'));
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
