<!DOCTYPE html>
<html lang="en">

<head>
    <title>BJ Report : Date : {{ $date_start}} - {{ $date_end}}</title>
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
            width: 1400px !important;
            margin: auto;
        }

        .sub-report {
            width: 700px!important;
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

        .text-uppercase{
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

        .w-code {
            width: 60px !important;
        }

        .border-none{
            border:none;
        }

        /* Table */
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 1400px !important;
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
                    <th colspan="16" class="text-center text-bold">
                        <div>BILLING JOURNAL</div>
                        <div class="subtitle">Municipality of Tarangnan</div>
                        <div class="subtitle">Date : {{ $date_start}} - {{ $date_end}}</div>
                        <div class="subtitle">Sheet No.1</div>
                    </th>
                </tr>

                <tr class="subtitle">
                    <th class="text-center" rowspan="2">Date</th>
                    <th class="text-center" rowspan="4">NUMBER OF CONCESSIONAIRIES</th>
                    <th class="text-center" rowspan="4">ZONE #</th>
                    <th class="text-center" rowspan="4">CU M. USED</th>
                    <th class="text-center" rowspan="2">Accounts Receivable</th>
                    <th class="text-center" rowspan="2">Waterwork System Fees</th>
                    <th class="text-center" rowspan="2">Fines Penalties Business Income</th>
                    <th class="text-center" rowspan="2">Other Service Income Extension Fees</th>
                </tr>
                <tr class="subtitle">
                    <!-- <th class="text-center"></th> -->
                    <!-- <th class="text-center"></th> -->
                    <!-- <th class="text-center"></th> -->
                    <!-- <th class="text-center"></th> -->
                    <!-- <th class="text-center"></th> -->
                    <!-- <th class="text-center"></th> -->
                    <!-- <th class="text-center">Deposits</th> -->
                </tr>
                <tr class="subtitle">
                    <th class="text-center">2022</th>
                    <!-- <th class="text-center"></th> -->
                    <!-- <th class="text-center"></th> -->
                    <!-- <th class="text-center"></th> -->
                    <th class="text-center">1-03-01-010</th>
                    <th class="text-center">4-02-02-090</th>
                    <th class="text-center">4-02-02-230</th>
                    <th class="text-center">4-02-01-990-F</th>
                </tr>
                <tr class="subtitle">
                    <th class="text-center">JANUARY</th>
                    <!-- <th class="text-center"></th> -->
                    <!-- <th class="text-center"></th> -->
                    <!-- <th class="text-center"></th> -->
                    <th class="text-center">DR</th>
                    <th class="text-center">CR</th>
                    <th class="text-center">CR</th>
                    <th class="text-center">CR</th>
                </tr>
                @forelse($journals as $journal)
                <tr class="subtitle">
                    <td class="text-center">{{ $journal->jv_date }}</td>
                    <td class="text-center">{{ $journal->billing->metered_sales }}</td>
                    <td class="text-center">{{ $journal->billing->zone }}</td>
                    <td class="text-center">{{
                        number_format(
                        $journal->billing->residential +
                        $journal->billing->comm +
                        $journal->billing->comm_a +
                        $journal->billing->comm_b +
                        $journal->billing->comm_c +
                        $journal->billing->government ,2)
                     }}</td>
                    <td class="text-right x-5">
                        @foreach($journal->transactions as $d)
                            @if($d->debit <> 0 && $d->accountChart->code == '1-03-01-010')
                            {{ number_format($d->debit,2) }}
                            @endif
                        @endforeach
                    </td>
                    <td class="text-right x-5">
                        @foreach($journal->transactions as $d)
                        @if($d->credit <> 0 && $d->accountChart->code == '4-02-02-090')
                            {{ number_format($d->credit,2) }}
                            @endif
                            @endforeach
                    </td>
                    <td class="text-right">
                        @foreach($journal->transactions as $d)
                            @if($d->credit <> 0 && $d->accountChart->code == '4-02-02-230')
                            {{ number_format($d->credit,2) }}
                            @endif
                        @endforeach
                    </td>
                    <td class="text-right">
                        @foreach($journal->transactions as $d)
                            @if($d->credit <> 0 && $d->accountChart->code == '4-02-01-990')
                            {{ number_format($d->credit,2) }}
                            @endif
                        @endforeach
                    </td>
                </tr>
                @empty
                <tr class="subtitle">
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                </tr>
                @endforelse

                @php
                    $Debite = 0;
                    $creditone = 0;
                    $creditTwo = 0;
                    $creditThree = 0;
                @endphp

                @foreach($journals as $journal)
                @foreach($journal->transactions as $d)

                    @if($d->debit <> 0 && $d->accountChart->code == '1-03-01-010')
                        @php
                            $Debite = $Debite + $d->debit
                        @endphp
                    @endif

                    @if($d->credit <> 0 && $d->accountChart->code == '4-02-02-090')
                        @php
                            $creditone = $creditone + $d->credit
                        @endphp
                    @endif

                    @if($d->credit <> 0 && $d->accountChart->code == '4-02-02-230')
                        @php
                            $creditTwo = $creditTwo + $d->credit
                        @endphp
                    @endif

                    @if($d->credit <> 0 && $d->accountChart->code == '4-02-01-990')
                        @php
                            $creditThree = $creditThree + $d->credit
                        @endphp
                    @endif

                @endforeach
                @endforeach

                <tr class="subtitle">
                    <td class="text-center" colspan="4"><b>Total:</b></td>
                    <td class="text-right"><b>{{ number_format($Debite,2) }}</b></td>
                    <td class="text-right"><b>{{ number_format($creditone,2) }}</b></td>
                    <td class="text-right"><b>{{ number_format($creditTwo,2) }}</b></td>
                    <td class="text-right"><b>{{ number_format($creditThree,2) }}</b></td>
                </tr>
            </table>
        </div>

        <div class="p-10 subtitle">
            <h3 class="text-uppercase">RECAPITULATION: {{ Carbon\Carbon::createFromFormat('Y-m-d', $date_start)->format('F') }}</h3>
            <table class="sub-report">
                <tr>
                    <th class="text-center">Account Name</th>
                    <th class="text-center">Account Code</th>
                    <th class="text-center">Debit</th>
                    <th class="text-center">Credit</th>
                </tr>
                @foreach($recaps as $recap)
                    <tr>
                        <td>{{ $recap->name }}</td>
                        <td class="text-center x-5">{{ $recap->code }}</td>
                        <td class="text-right">
                            @if($recap->tdebit <> 0)
                                {{ number_format($recap->tdebit,2) }}
                            @endif
                        </td>
                        <td class="text-right">
                            @if($recap->tcredit <> 0)
                                {{ number_format($recap->tcredit,2) }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td class="text-right"><b>{{ number_format($recaps->sum('tdebit'),2) }}</b></td>
                    <td class="text-right"><b>{{ number_format($recaps->sum('tcredit'),2) }}</b></td>
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
