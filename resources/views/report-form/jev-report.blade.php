<!DOCTYPE html>
<html lang="en">

<head>
    <title>JEV.No : {{ date('Y',
        strtotime($journal->jv_date)) . '-' . date('m', strtotime($journal->jv_date)) .
        '-'
        }}@if(strlen($journal->jev_no)==1){{ '000' . $journal->jev_no
        }}@elseif(strlen($journal->jev_no)==2){{ '00' . $journal->jev_no
        }}@elseif(strlen($journal->jev_no)==3){{ '0' . $journal->jev_no }}@else{{ '0' . $journal->jev_no
        }}@endif</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .report {
            width: 700px !important;
            margin: auto;
        }

        .head {
            height: 70px;
            width: 700px !important;
            border: rgb(32, 32, 32) solid 2px;
        }

        .title {
            height: 70px;
            width: 70%;
            float: left;
            border-right: rgb(32, 32, 32) solid 2px;
            padding: 8px;
        }

        .subtitle {
            font-size: .8em;
        }

        .no {
            height: 70px;
            width: 30%;
            float: right;
            padding: 8px;
        }

        .signatories {
            height: 70px;
            width: 700px !important;
            border: rgb(32, 32, 32) solid 2px;
        }

        .sign {
            border-right: rgb(32, 32, 32) solid 2px;
            height: 70px;
            width: 350px;
            padding: 8px;
        }

        .float-right {
            float: right;
        }

        .float-left {
            float: left;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-bold {
            font-weight: bold;
        }

        .border-right-none {
            border-right: none;
        }

        .x-5{
            min-width: 60px;
            padding-right: 5px;
            padding-left: 5px;
        }

        /* Table */
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 700px !important;
        }

        td,
        th {
            border: rgb(32, 32, 32) solid 2px;
            text-align: left;
            padding: 4px;
        }
    </style>
</head>

<body>
    <div class="report">
        <div class="table">
            <table>
            <tr>
                <th colspan="3" class="text-center text-bold">
                    <div>JOURNAL ENTRY VOUCHER</div>
                    <div class="subtitle">Municipality of Tarangnan</div>
                    <div class="subtitle">Catarman Water Disctrict</div>
                </th>

                <th colspan="3" class="text-center text-bold" style="min-width: 150px!important;">
                    <div class="subtitle">JEV.No : {{ date('Y',
                        strtotime($journal->jv_date)) . '-' . date('m', strtotime($journal->jv_date)) .
                        '-'
                        }}@if(strlen($journal->jev_no)==1){{ '000' . $journal->jev_no
                        }}@elseif(strlen($journal->jev_no)==2){{ '00' . $journal->jev_no
                        }}@elseif(strlen($journal->jev_no)==3){{ '0' . $journal->jev_no }}@else{{ '0' . $journal->jev_no
                        }}@endif</div>
                    <div class="subtitle">Date : {{ $journal->jv_date }}</div>
                </th>
            </tr>

                <tr class="subtitle">
                    <th class="text-center">Responsibility</th>
                    <th class="text-center">Accounts and Explanation</th>
                    <th class="text-center">Accounts</th>
                    <th></th>
                    <th colspan="2" class="text-center">Amount</th>
                </tr>
                <tr class="subtitle">
                    <th class="text-center">Center</th>
                    <th></th>
                    <th class="text-center">Code</th>
                    <th class="text-center" style="width: 15px;">p</th>
                    <th class="text-center x-5">Debit</th>
                    <th class="text-center x-5">Credit</th>
                </tr>
                @foreach($transactions as $t)
                <tr class="subtitle">
                    <td></td>
                    <td>{{ $t->accountChart->name }}</td>
                    <td class="text-center" style="width: 105px;">{{ $t->accountChart->code }}</td>
                    <td></td>
                    <td class="text-right x-5">{{
                        ($t->debit == 0) ? '' : number_format($t->debit,2) }}</td>
                    <td class="text-right x-5">{{
                        ($t->credit == 0) ? '' : number_format($t->credit,2) }}</td>
                </tr>
                @endforeach
                <tr class="subtitle">
                    <td></td>
                    <td colspan="3">{{ $journal->particulars }}</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="subtitle">
                    <td></td>
                    <td colspan="3"></td>
                    <td class="text-right x-5">{{ number_format($transactions->sum('debit'),2) }}</td>
                    <td class="text-right x-5">{{ number_format($transactions->sum('credit'),2) }}</td>
                </tr>

            </table>
        </div>
        <div class="subtitle">
            <table>
                <tr>
                    <td>
                        <div>Prepared by:</div>
                        <div class="text-center text-bold">Angerlyn Colonia, CPA</div>
                        <div class="text-center">Corporate Accounts Analyst</div>
                    </td>
                    <td>
                        <div>Certified by:</div>
                        <div class="text-center text-bold">Eleonor A. Villarta, MBA</div>
                        <div class="text-center">AGSD Manager</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</body>

</html>
