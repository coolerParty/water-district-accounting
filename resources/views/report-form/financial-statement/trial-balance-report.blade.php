<!DOCTYPE html>
<html lang="en">

<head>
    <title>Trial Balace Report : For the period ended : {{ $year}} - {{ DateTime::createFromFormat('!m',
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
                    <th colspan="4" class="text-center text-bold">
                        <div>TRIAL BALANCE</div>
                        <div class="subtitle">Municipality of Tarangnan</div>
                        <div class="subtitle">For the period ended : {{ DateTime::createFromFormat('!m',
                            $month)->format('F') }}, {{ $year}}</div>
                    </th>
                </tr>

                <tr class="font-m">
                    <th class="text-center" colspan="2">Account</th>
                    <th class="text-center" colspan="2">Amount</th>
                </tr>
                <tr class="font-m">
                    <th class="text-center">Title</th>
                    <th class="text-center">Code</th>
                    <th class="text-center">Debit</th>
                    <th class="text-center">Credit</th>
                </tr>
                @php
                $totalAmount = 0;
                @endphp
                @foreach($accounts as $account)
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

                $totalAmount = $totalAmount + $amount;

                @endphp
                <tr class="font-xs">
                    <td class="text-left">{{ $account->name }}</td>
                    <td class="text-center w-code-110">{{ $account->code }}</td>
                    <td class="text-right x-5">{{ ($amount > 0)? number_format($amount,2) : '' }}</td>
                    <td class="text-right x-5">{{ ($amount < 0)? number_format(-1 * $amount,2) : '' }}</td>
                </tr>
                @endforeach


                <tr class="font-xs">
                    <th class="text-center">Total:</th>
                    <th class="text-right x-5"></th>
                    <th class="text-right x-5" colspan="2">{{ number_format($totalAmount,2) }}</th>
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
