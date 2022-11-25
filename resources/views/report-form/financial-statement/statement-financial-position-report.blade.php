<!DOCTYPE html>
<html lang="en">

<head>
    <title>Detailed Statement of Financial Position Report : For the period ended : {{ $year}} - {{ DateTime::createFromFormat('!m',
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
                        <div>DETAILED STATEMENT OF FINANCIAL POSITION</div>
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
                    $subtotal_accountGroup_liabilities_equity = 0;
                @endphp

                @foreach($accountGroups as $ag)
                    @php
                        $subtotal_accountGroup = 0;
                    @endphp
                    <tr class="font-xs">
                        <td class="text-left w-code-110 text-uppercase text-bold" colspan="3">{{ $ag->name }}</td>
                    </tr>
                    @foreach($accountGroupsNon as $agn)
                        @if($agn->acct_gp_id == $ag->id)
                            @php
                                $subtotal_curr = 0;
                            @endphp
                            <tr class="font-xs">
                                <td class="text-left w-code-110 text-uppercase text-bold pd-left-40" colspan="3">
                                    @if($agn->current_non == 1)
                                        Current {{ $ag->name }}
                                    @elseif($agn->current_non == 2)
                                        Non-Current {{ $ag->name }}
                                    @elseif($agn->acct_gp_id == 1 || $agn->acct_gp_id == 2)
                                        <span style="color:red;"> -- Unselected To Accounts to Current/Non Current  --</span>
                                    @endif
                                </td>
                            </tr>
                            @foreach($accountMajorGroups as $amg)
                                @if($amg->current_non == $agn->current_non && $ag->code == $amg->acct_mgp_code[0])
                                    @php
                                        $amg_totalAmount = 0;
                                    @endphp
                                    <tr class="font-xs">
                                        <td class="text-left w-code-90 text-bold pd-left-40">{{ $amg->acct_mgp_code }}</td>
                                        <td class="text-left w-code-110 text-uppercase text-bold">{{ $amg->acct_mgp_name }}</td>
                                        <td class="text-right w-code-110 text-bold"></td>
                                    </tr>
                                    @foreach($accountSubMajorGroups as $asmg)
                                        @if($ag->code == $amg->acct_mgp_code[0] && $amg->acct_mgp_code == substr($asmg->acct_smgp_code, 0, 4) && $agn->current_non == $asmg->current_non &&  $amg->current_non == $agn->current_non)
                                        @php
                                            $asmg_totalAmount = 0;
                                        @endphp
                                        <tr class="font-xs">
                                            <td class="text-left w-code-90 text-bold pd-left-40">{{ $asmg->acct_smgp_code }}</td>
                                            <td class="text-left w-code-110 text-bold pd-left-20" colspan="2">{{ $asmg->acct_smgp_name }}</td>
                                        </tr>
                                            @foreach($accounts as $account)
                                                @if($ag->id == $account->acctgrp_id && $amg->acct_mgp_id == $account->mjracctgrp_id && $asmg->acct_smgp_id == $account->submjracctgrp_id && $agn->current_non == $account->current_non)
                                                    @php
                                                        $amount = 0;

                                                        foreach($journals as $journal){
                                                            if($journal->accountchart_id == $account->id){
                                                                $amount = ($account->code[0] == 1) ? $journal->subtotal_debit - $journal->subtotal_credit : -1 * ($journal->subtotal_debit - $journal->subtotal_credit);
                                                            }
                                                        }

                                                        foreach($beginningBalances as $bal){
                                                            if($bal->accountchart_id == $account->id){
                                                                $amount = $amount + $bal->amount;
                                                            }
                                                        }
                                                        $subtotal_curr = $subtotal_curr + $amount;
                                                        $subtotal_accountGroup = $subtotal_accountGroup + $amount;
                                                        $amg_totalAmount = $amg_totalAmount + $amount;
                                                        $asmg_totalAmount = $asmg_totalAmount + $amount;

                                                        if($ag->code == 2 || $ag->code == 3){
                                                            $subtotal_accountGroup_liabilities_equity = $subtotal_accountGroup_liabilities_equity + $amount;
                                                        }


                                                    @endphp
                                                <tr class="font-xs">
                                                    <td class="text-center w-code-110 pd-left-40" style="{{ (($account->current_non == 3 || $account->current_non == '') && $ag->id <> 3) ? 'color:red;' : '' }}">{{ $account->code }}</td>
                                                    <td class="text-left pd-left-40">{{ $account->name }}</td>
                                                    <td class="text-right x-5">{{ ($amount < 0) ? '( ' . number_format(-1 * $amount,2) . ' )' : number_format($amount,2) }}</td>
                                                </tr>
                                                @endif
                                            @endforeach
                                            <tr class="font-xs">
                                                <td class="text-left"></td>
                                                <td class="text-left w-code-110 text-bold pd-left-20">Total {{ $asmg->acct_smgp_name }}</td>
                                                <td class="text-right w-code-110 text-bold">{{ ($asmg_totalAmount < 0) ? '( ' . number_format(-1 * $asmg_totalAmount,2) . ' )' : number_format($asmg_totalAmount,2) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    <tr class="font-xs">
                                        <td class="text-left"></td>
                                        <td class="text-left w-code-110 text-uppercase text-bold">Total {{ $amg->acct_mgp_name }}</td>
                                        <td class="text-right w-code-110 text-bold">{{ ($amg_totalAmount < 0) ? '( ' . number_format(-1 * $amg_totalAmount,2) .' )' : number_format($amg_totalAmount,2) }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            @if($ag->id <> 3)
                                <tr class="font-xs">
                                    <td class="text-left w-code-110 text-uppercase text-bold pd-left-40" colspan="2">Total
                                        @if($agn->current_non == 1)
                                            Current {{ $ag->name }}
                                        @elseif($agn->current_non == 2)
                                            Non-Current {{ $ag->name }}
                                        @elseif($agn->acct_gp_id == 1 || $agn->acct_gp_id == 2)
                                        <span style="color:red;"> -- Unselected To Accounts to Current/Non Current  --</span>
                                        @endif
                                    </td>
                                    <td class="text-right w-code-110 text-bold">{{ ($subtotal_curr < 0) ? '( ' . number_format(-1 * $subtotal_curr,2) .' )' : number_format($subtotal_curr,2) }}</td>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                    <tr class="font-xs">
                        <td class="text-left w-code-110 text-uppercase text-bold" colspan="2">Total {{ $ag->name }}</td>
                        <td class="text-right w-code-110 text-bold">{{ ($subtotal_accountGroup < 0) ? '( ' . number_format(-1 * $subtotal_accountGroup,2) .' )' : number_format($subtotal_accountGroup,2) }}</td>
                    </tr>
                @endforeach
                <tr class="font-xs">
                    <th class="text-left text-bold" colspan="2">NET INCOME / (LOSS)</th>
                    <th class="text-right x-5 text-bold">{{ ($NET_Total_amount < 0) ? '( ' . number_format(-1 * $NET_Total_amount,2) .' )' : number_format($NET_Total_amount,2) }}</th>
                </tr>
                <tr class="font-xs">
                    <th class="text-left text-bold" colspan="2">TOTAL LIABILITIES AND EQUITY</th>
                    <th class="text-right x-5 text-bold">{{ (($NET_Total_amount + $subtotal_accountGroup_liabilities_equity) < 0) ? '( ' . number_format(-1 * ($NET_Total_amount + $subtotal_accountGroup_liabilities_equity),2) .' )' : number_format(($NET_Total_amount + $subtotal_accountGroup_liabilities_equity),2) }}</th>
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
