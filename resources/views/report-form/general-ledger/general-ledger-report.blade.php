<!DOCTYPE html>
<html lang="en">

<head>
    <title>General Ledger Report : For the period ended : {{ $year}} - {{ DateTime::createFromFormat('!m', $month)->format('F') }}</title>
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

        .sub-report {
            width: 700px !important;
            margin-left: 0;
        }

        .head {
            height: 70px;
            width: 1400px !important;
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

        .font-m {
            font-size: .75em;
        }

        .font-xs {
            font-size: .7em;
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

        .text-left {
            text-align: left;
        }

        .text-bold {
            font-weight: bold;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .border-right-none {
            border-right: none;
        }

        .x-5 {
            min-width: 60px;
            padding-right: 5px;
            padding-left: 5px;
        }

        .pd-5 {
            padding-top: 2px;
            padding-bottom: 2px;
        }

        .p-10 {
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .w-code-110 {
            width: 110px;
            padding-right: 5px;
            padding-left: 5px;
        }

        .w-code-90 {
            width: 90px;
            padding-right: 5px;
            padding-left: 5px;
        }

        .border-none {
            border: none;
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
                    <th colspan="5" class="text-center text-bold">
                        <div>GENERAL LEDGER</div>
                        <div class="subtitle">Municipality of Tarangnan</div>
                        <div class="subtitle">For the period ended : {{ DateTime::createFromFormat('!m', $month)->format('F') }}, {{ $year}}</div>
                        <div class="text-left subtitle">Year: {{ $year }}</div>
                        <div class="text-left subtitle">A/C # {{ $accounts->code }} {{ $accounts->name }}</div>
                    </th>
                </tr>

                <tr class="font-m">
                    <th class="text-center">Reference</th>
                    <th class="text-center">Debit</th>
                    <th class="text-center">Credit</th>
                    <th class="text-center x-5">Net</th>
                    <th class="text-center w-code">Balance</th>
                </tr>
                @if(!empty($beginningBalance))
                <tr class="font-m">
                    <td class="text-left">Forwarded Balance</td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center x-5"></td>
                    <td class="text-right w-code">
                        @if($beginningBalance->amount < 0 ) ( {{ number_format(($beginningBalance )? -1 *
                            $beginningBalance->amount : 0,2) }} )
                            @else
                            {{ ($beginningBalance )? number_format($beginningBalance->amount,2) : '' }}
                            @endif
                    </td>
                </tr>
                @endif
                @php
                $running_balance = ($beginningBalance )? $beginningBalance->amount : 0;
                $subtotalDebit = 0;
                $subtotalCredit = 0;
                $subtotalNET = 0;
                $totalDebit = 0;
                $totalCredit = 0;
                $totalNET = 0;
                @endphp

                @if($journals->count() <> 0)
                    @foreach($jvAllMonths as $jMonth)
                    <tr class="font-xs">
                        <th>{{ DateTime::createFromFormat('!m', $jMonth)->format('F') }}</th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                    </tr>
                    @foreach($journals as $journal)
                    @if($journal->jv_month == $jMonth)
                    <tr class="font-xs">
                        <td class="text-left">
                            {{ ($journal->type == 1) ? 'Cash Journal' : '' }}
                            {{ ($journal->type == 2) ? 'Billing Journal' : '' }}
                            {{ ($journal->type == 3) ? 'Materials Stock Issued Journal' : '' }}
                            {{ ($journal->type == 4) ? 'Check Disbursement Journal' : '' }}
                            {{ ($journal->type == 5) ? 'General Journal' : '' }}
                        </td>
                        <td class="text-right">{{ ($journal->subtotal_debit <> 0) ?
                                number_format($journal->subtotal_debit,2) : '' }}</td>
                        <td class="text-right">{{ ($journal->subtotal_credit <> 0) ?
                                number_format($journal->subtotal_credit,2) : '' }}</td>
                        <td class="text-right">
                            @if($journal->subtotal_debit - $journal->subtotal_credit < 0) ( {{ number_format(-1 *
                                ($journal->subtotal_debit - $journal->subtotal_credit),2) }} )
                                @else
                                {{ number_format($journal->subtotal_debit - $journal->subtotal_credit,2) }}
                                @endif
                        </td>
                        <td class="text-right">
                            @if($running_balance + $journal->subtotal_debit - $journal->subtotal_credit < 0) ( {{
                                number_format(-1 * ($running_balance + $journal->subtotal_debit -
                                $journal->subtotal_credit),2) }} )
                                @else
                                {{ number_format($running_balance + $journal->subtotal_debit -
                                $journal->subtotal_credit,2) }}
                                @endif
                        </td>
                    </tr>
                    @php
                    $running_balance = $running_balance + $journal->subtotal_debit - $journal->subtotal_credit;
                    $subtotalDebit = $subtotalDebit + $journal->subtotal_debit ;
                    $subtotalCredit = $subtotalCredit + $journal->subtotal_credit;
                    $subtotalNET = $subtotalNET + $journal->subtotal_debit - $journal->subtotal_credit;
                    $totalDebit = $totalDebit + $journal->subtotal_debit ;
                    $totalCredit = $totalCredit + $journal->subtotal_credit;
                    $totalNET = $totalNET + $journal->subtotal_debit - $journal->subtotal_credit;
                    @endphp
                    @endif
                    @endforeach
                    <tr class="font-xs">
                        <th class="text-center"></th>
                        <th class="text-right">{{ ($subtotalDebit <> 0)? number_format($subtotalDebit,2) : '' }}</th>
                        <th class="text-right">{{ ($subtotalCredit <> 0)? number_format($subtotalCredit ,2) : '' }}</th>
                        <th class="text-right">
                            @if($subtotalNET < 0) ( {{ number_format(-1 * $subtotalNET,2) }} ) @else {{
                                number_format($subtotalNET,2) }} @endif </th>
                        <th class="text-right">
                            @if($running_balance < 0) ( {{ number_format(-1 * $running_balance,2) }} ) @else {{
                                number_format($running_balance,2) }} @endif </th>
                    </tr>
                    @php
                    $subtotalDebit = 0;
                    $subtotalCredit = 0;
                    $subtotalNET = 0;
                    @endphp
                    @endforeach
                    @else
                    <tr class="subtitle">
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                    </tr>
                    @endif



                    <tr class="font-xs">
                        <th class="text-center">Total:</th>
                        <th class="text-right x-5">{{ number_format($totalDebit,2) }}</th>
                        <th class="text-right x-5">{{ number_format($totalCredit,2) }}</th>
                        <th class="text-right x-5">
                            @if($totalNET < 0) ( {{ number_format(-1 * $totalNET,2) }} ) @else {{
                                number_format($totalNET,2) }} @endif </th>
                        <th class="text-right x-5">
                            @if($running_balance < 0) ( {{ number_format(-1 * $running_balance,2) }} ) @else {{
                                number_format( $running_balance,2) }} @endif </th>
                    </tr>
            </table>
        </div>

        <div class="p-10 subtitle">
            <table>
                <tr>
                    <td class="border-none">
                        <div>Prepared by:</div>
                        <div class="text-center text-bold">Angerlyn Colonia, CPA</div>
                        <div class="text-center">Corporate Accounts Analyst</div>
                    </td>
                    <td class="border-none">
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
