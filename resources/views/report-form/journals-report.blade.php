<!DOCTYPE html>
<html lang="en">

<head>
    <title>CRJ Report : Date : {{ $date_start}} - {{ $date_end}}</title>
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
                        <div>CASH RECEIPT JOURNAL</div>
                        <div class="subtitle">Municipality of Tarangnan</div>
                        <div class="subtitle">Date : {{ $date_start}} - {{ $date_end}}</div>
                        <div class="subtitle">Sheet No.1</div>
                    </th>
                </tr>

                <tr class="subtitle">
                    <th class="text-center" rowspan="4">Date</th>
                    <th class="text-center" rowspan="4">RCID No.</th>
                    <th class="text-center" rowspan="4">JEV No.</th>
                    <th class="text-center" rowspan="4">Payor</th>
                    <th class="text-center" colspan="6">Collections</th>
                    <th class="text-center" colspan="4">Deposits</th>
                </tr>
                <tr class="subtitle">
                    <!-- <th class="text-center"></th> -->
                    <!-- <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th class="text-center"></th> -->
                    <th class="text-center" rowspan="2">Debit</th>
                    <th class="text-center" colspan="5">Credit</th>
                    <th class="text-center" colspan="5">Debit</th>
                </tr>
                <tr class="subtitle">
                    <!-- <th class="text-center"></th> -->
                    <!-- <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th class="text-center"></th> -->
                    <!-- <th class="text-center"></th> -->
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th class="text-center" colspan="3">Sundry</th>
                    <th class="text-center"></th>
                    <th class="text-center" colspan="3">Sundry</th>
                </tr>
                <tr class="subtitle">
                    <!-- <th class="text-center"></th> -->
                    <!-- <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th class="text-center"></th> -->
                    <th class="text-center x-5">1-01-01-010</th>
                    <th class="text-center x-5">1-01-01-020</th>
                    <th class="text-center x-5">1-03-01-020</th>
                    <th class="text-center x-5">Acct Code</th>
                    <th class="text-center">PR</th>
                    <th class="text-center">Credit</th>
                    <th class="text-center x-5">1-01-02-010</th>
                    <th class="text-center x-5">Acct Code</th>
                    <th class="text-center">PR</th>
                    <th class="text-center">Debit</th>
                </tr>
                @forelse($journals as $journal)
                <tr class="subtitle">
                    <td class="text-center">{{ $journal->jv_date }}</td>
                    <td class="text-center"></td>
                    <td class="text-center">{{ $journal->jev_no }}</td>
                    <td class="text-center"></td>
                    <td class="text-right x-5">
                        @foreach($journal->transactions as $d)
                        @if($d->debit <> 0 && $d->accountChart->code == '1-01-01-010')
                            {{ number_format($d->debit,2) }}
                            @endif
                            @endforeach
                    </td>
                    <td class="text-right x-5">
                        @foreach($journal->transactions as $d)
                        @if($d->credit <> 0 && $d->accountChart->code == '1-01-01-020')
                            {{ number_format($d->credit,2) }}
                            @endif
                            @endforeach
                    </td>
                    <td class="text-right x-5">
                        @foreach($journal->transactions as $d)
                        @if($d->credit <> 0 && $d->accountChart->code == '1-03-01-020')
                            {{ number_format($d->credit,2) }}
                            @endif
                            @endforeach
                    </td>
                    <!-- CREDIT sundry START-->
                    <!-- code -->
                    <td class="text-center x-5">
                        @foreach($journal->transactions as $d)
                            @if($d->debit == 0 && $d->accountChart->code <> '1-01-01-020' && $d->accountChart->code <>
                                '1-03-01-020')
                                <div class="text-center x-5 pd-5"> {{ $d->accountChart->code }} </div>
                            @endif
                        @endforeach
                    </td>
                    <!-- pr -->
                    <td class="text-center">
                        @foreach($journal->transactions as $d)
                            @if($d->debit == 0 && $d->accountChart->code <> '1-01-01-020' && $d->accountChart->code <>
                                '1-03-01-020')

                            @endif
                        @endforeach
                    </td>
                    <!-- credit -->
                    <td class="text-right">
                        @foreach($journal->transactions as $d)
                            @if($d->debit == 0 && $d->accountChart->code <> '1-01-01-020' && $d->accountChart->code <>
                                '1-03-01-020')
                                <div class="pd-5">{{ number_format($d->credit,2) }}</div>
                            @endif
                        @endforeach
                    </td>
                    <!-- CREDIT sundry END-->
                    <td class="text-right">
                        @foreach($journal->transactions as $d)
                            @if($d->credit == 0 && $d->accountChart->code == '1-01-02-010')
                            {{ number_format($d->credit,2) }}
                            @endif
                        @endforeach
                    </td>
                    <!-- DEBIT sundry START-->
                    <!-- code -->
                    <td class="text-center x-5">
                        @foreach($journal->transactions as $d)
                            @if($d->credit == 0 && $d->accountChart->code <> '1-01-02-010' && $d->accountChart->code <>
                                '1-01-01-010')
                                <div class="text-center x-5 pd-5"> {{ $d->accountChart->code }} </div>
                            @endif
                        @endforeach
                    </td>
                    <!-- pr -->
                    <td class="text-center">
                        @foreach($journal->transactions as $d)
                            @if($d->credit == 0 && $d->accountChart->code <> '1-01-02-010' && $d->accountChart->code <>
                                '1-01-01-010')

                            @endif
                        @endforeach
                    </td>
                    <!-- debit -->
                    <td class="text-right">
                        @foreach($journal->transactions as $d)
                            @if($d->credit == 0 && $d->accountChart->code <> '1-01-02-010' && $d->accountChart->code <>
                                '1-01-01-010')
                                <div class="pd-5">{{ number_format($d->debit,2) }}</div>
                            @endif
                        @endforeach
                    </td>
                    <!-- DEBIT sundry END-->
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
                    $creditSundry = 0;
                    $DebitTwo = 0;
                    $DebitSundry = 0;
                @endphp

                @foreach($journals as $journal)
                @foreach($journal->transactions as $d)

                    @if($d->debit <> 0 && $d->accountChart->code == '1-01-01-010')
                        @php
                            $Debite = $Debite + $d->debit
                        @endphp
                    @endif


                    @if($d->credit <> 0 && $d->accountChart->code == '1-01-01-020')
                        @php
                            $creditone = $creditone + $d->credit
                        @endphp
                    @endif

                    @if($d->credit <> 0 && $d->accountChart->code == '1-03-01-020')
                        @php
                            $creditTwo = $creditTwo + $d->credit
                        @endphp
                    @endif

                    @if($d->debit == 0 && $d->accountChart->code <> '1-01-01-020' && $d->accountChart->code <>
                            '1-03-01-020')
                        @php
                            $creditSundry = $creditSundry + $d->credit
                        @endphp
                    @endif

                    @if($d->debit <> 0 && $d->accountChart->code == '1-01-02-010')
                        @php
                            $DebitTwo = $DebitTwo + $d->debit
                        @endphp
                    @endif

                    @if($d->credit == 0 && $d->accountChart->code <> '1-01-02-010' &&
                        $d->accountChart->code <>
                            '1-01-01-010')
                        @php
                            $DebitSundry = $DebitSundry + $d->debit
                        @endphp
                    @endif

                @endforeach
                @endforeach

                <tr class="subtitle">
                    <td class="text-center" colspan="4"><b>Total:</b></td>
                    <td class="text-right"><b>{{ number_format($Debite,2) }}</b></td>
                    <td class="text-right"><b>{{ number_format($creditone,2) }}</b></td>
                    <td class="text-right"><b>{{ number_format($creditTwo,2) }}</b></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-right"><b>{{ number_format($creditSundry,2) }}</b></td>
                    <td class="text-right"><b>{{ number_format($DebitTwo,2) }}</b></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-right"><b>{{ number_format($DebitSundry,2) }}</b></td>
                </tr>
            </table>
        </div>

        <div class="p-10 subtitle">
            <h3>RECAPITULATION: AUGUST</h3>
            <table class="sub-report">
                <tr>
                    <th class="text-center">Account Name</th>
                    <th class="text-center">Account Name</th>
                    <th class="text-center">Debit</th>
                    <th class="text-center">Credit</th>
                </tr>
                @foreach($journal->transactions as $transaction)
                <tr>
                    <td>{{ $transaction->accountChart->name }}</td>
                    <td class="text-center x-5">{{ $transaction->accountChart->code }}</td>
                    <td class="text-right">
                        @if($transaction->debit <> 0)
                            {{ number_format($transaction->debit,2) }}
                        @endif
                    </td>
                    <td class="text-right">
                        @if($transaction->credit <> 0)
                            {{ number_format($transaction->credit,2) }}
                        @endif
                    </td>
                </tr>
                @endforeach
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
