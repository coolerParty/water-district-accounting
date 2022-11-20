<!DOCTYPE html>
<html lang="en">

<head>
    <title>Detailed Income Statement Report : For the period ended : {{ $year}} - {{ DateTime::createFromFormat('!m',
        $month)->format('F') }}</title>
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

        }

        .title {
            height: 70px;
            width: 70%;
            float: left;

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

        }

        .sign {

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

        .pd-left-20 {
            padding-left: 20px;
        }

        .pd-left-40 {
            padding-left: 40px;
        }

        .pd-left-60 {
            padding-left: 60px;
        }

        /* Table */

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 700px !important;
            border: none;
        }

        td,
        th {

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
                        <div>DETAILED INCOME STATEMENT</div>
                        <div class="subtitle">Municipality of Tarangnan</div>
                        <div class="subtitle">For the period ended : {{ DateTime::createFromFormat('!m',
                            $month)->format('F') }}, {{ $year}}</div>
                    </th>
                </tr>

                <tr class="font-m">
                    <th class="text-center" colspan="2">Account</th>
                    <th class="text-center">Amount</th>
                </tr>
                @php
                    $total_expense = 0;
                    $total_revenue = 0;
                @endphp
                @foreach($accountGroups as $ag)
                    @php
                        $ag_totalAmount = 0;
                    @endphp
                    <tr class="font-xs">
                        <!-- <td class="text-left w-code-110 text-bold pd-left-20">{{ $ag->code }}</td> -->
                        <td class="text-left w-code-110 text-uppercase text-bold" colspan="3">{{ $ag->name }}</td>
                    </tr>
                        @foreach($accountMajorGroups as $amg)
                            @if($ag->code == $amg->code[0])
                            @php
                                $amg_totalAmount = 0;
                            @endphp
                                <tr class="font-xs">
                                    <td class="text-left w-code-110 text-bold pd-left-40">{{ $amg->code }}</td>
                                    <td class="text-left w-code-110 text-uppercase text-bold" colspan="2">{{ $amg->name }}</td>
                                </tr>
                                @foreach($accountSubMajorGroups as $asmg)
                                    @if($ag->code == $amg->code[0] && $amg->code == substr($asmg->code, 0, 4))
                                    @php
                                        $asmg_totalAmount = 0;
                                    @endphp
                                        <tr class="font-xs">
                                            <td class="text-left w-code-110 text-bold pd-left-40">{{ $asmg->code }}</td>
                                            <td class="text-left w-code-110 text-bold pd-left-20" colspan="2">{{ $asmg->name }}</td>
                                        </tr>
                                            @foreach($accounts as $account)
                                                @if($ag->id == $account->acctgrp_id && $amg->id == $account->mjracctgrp_id && $asmg->id == $account->submjracctgrp_id)
                                                    @php
                                                        $amount = 0;

                                                        foreach($journals as $journal){
                                                            if($journal->accountchart_id == $account->id){
                                                                $amount = $journal->subtotal_debit - $journal->subtotal_credit;
                                                            }
                                                        }

                                                        foreach($beginningBalances as $bal){
                                                            if($bal->accountchart_id == $account->id){
                                                                $amount = $amount + $bal->amount;
                                                            }
                                                        }

                                                        $ag_totalAmount = $ag_totalAmount + $amount;
                                                        $amg_totalAmount = $amg_totalAmount + $amount;
                                                        $asmg_totalAmount = $asmg_totalAmount + $amount;

                                                        if($account->code[0] == 4){
                                                            $total_revenue = $total_revenue + $amount;
                                                        }
                                                        if($account->code[0] == 5){
                                                            $total_expense = $total_expense + $amount;
                                                        }


                                                    @endphp
                                                    <tr class="font-xs">
                                                        <td class="text-center w-code-110 pd-left-40">{{ $account->code }}</td>
                                                        <td class="text-left pd-left-40">{{ $account->name }}</td>
                                                        <td class="text-right x-5">{{ ($amount < 0) ? '( ' . number_format(-1 * $amount,2) . ' )' : number_format($amount,2) }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            <tr class="font-xs">
                                                <td class="text-left"></td>
                                                <td class="text-left w-code-110 text-bold pd-left-20">Total {{ $asmg->name }}</td>
                                                <td class="text-right w-code-110 text-bold">{{ ($asmg_totalAmount < 0) ? '( ' . number_format(-1 * $asmg_totalAmount,2) . ' )' : number_format($asmg_totalAmount,2) }}</td>
                                            </tr>
                                    @endif
                                @endforeach
                                <tr class="font-xs">
                                    <td class="text-left"></td>
                                    <td class="text-left w-code-110 text-uppercase text-bold">Total {{ $amg->name }}</td>
                                    <td class="text-right w-code-110 text-bold">{{ ($amg_totalAmount < 0) ? '( ' . number_format(-1 * $amg_totalAmount,2) .' )' : number_format($amg_totalAmount,2) }}</td>
                                </tr>
                            @endif
                        @endforeach
                    <tr class="font-xs">
                        <!-- <td class="text-left"></td> -->
                        <td class="text-left w-code-110 text-uppercase text-bold" colspan="2">Total {{ $ag->name }}</td>
                        <td class="text-right w-code-110 text-bold">{{ ($ag_totalAmount < 0 ) ? '( ' . number_format(-1 * $ag_totalAmount,2) . ' )' : number_format($ag_totalAmount,2) }}</td>
                    </tr>
                @endforeach
                <tr class="font-xs">
                    <th class="text-center"></th>
                    <th class="text-center text-bold">NET INCOME / (LOSS)</th>
                    <th class="text-right x-5 text-bold">{{ (($total_revenue - $total_expense) < 0) ? '( ' . number_format(-1 * ($total_revenue - $total_expense),2) . ' )' : number_format($total_revenue - $total_expense,2) }}</th>
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
