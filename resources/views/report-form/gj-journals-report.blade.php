<!DOCTYPE html>
<html lang="en">

<head>
    <title>GJ Report : Date : {{ $date_start}} - {{ $date_end}}</title>
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
        .font-m{
            font-size: .75em;
        }

        .font-xs{
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

        .border-none{
            border:none;
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
                    <th colspan="16" class="text-center text-bold">
                        <div>GENERAL JOURNAL</div>
                        <div class="subtitle">Municipality of Tarangnan</div>
                        <div class="subtitle">Date : {{ $date_start}} - {{ $date_end}}</div>
                        <div class="subtitle">Sheet No.1</div>
                    </th>
                </tr>

                <tr class="font-m">
                    <th class="text-center">DATE</th>
                    <th class="text-center">JEV No.</th>
                    <th class="text-center">PARTICULARS</th>
                    <th class="text-center x-5">ACCOUNT NAME</th>
                    <th class="text-center w-code">ACCOUNT CODE</th>
                    <th class="text-center x-5">DEBIT</th>
                    <th class="text-center x-5">CREDIT</th>
                </tr>

                @forelse($journals as $journal)
                <tr class="font-m">
                    <td class="text-center" rowspan="{{ $journal->transactions->count() +1 }}">{{ $journal->jv_date }}</td>
                    <td class="text-center" rowspan="{{ $journal->transactions->count() +1 }}">{{ $journal->jev_no }}</td>
                    <td class="text-left" rowspan="{{ $journal->transactions->count() +1 }}">{{ $journal->generalJournal->particulars }}</td>
                </tr>
                @foreach($journal->transactions as $t)
                <tr class="font-xs">
                    <td class="text-left x-5">{{ $t->accountChart->name }}</td>
                    <td class="text-center w-code-90">{{ $t->accountChart->code }}</td>
                    <td class="text-right x-5">
                        @if($t->debit <> 0)
                        {{ $t->debit }}
                        @endif
                    </td>
                    <td class="text-right x-5">
                        @if($t->credit <> 0)
                        {{ $t->credit }}
                        @endif
                    </td>
                </tr>
                @endforeach
                @empty
                <tr class="subtitle">
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center x-5"></td>
                    <td class="text-center w-code"></td>
                    <td class="text-center x-5"></td>
                    <td class="text-center x-5"></td>
                </tr>
                @endforelse

                @php
                    $debite = 0;
                    $credite = 0;
                @endphp

                @foreach($journals as $journal)
                @foreach($journal->transactions as $d)
                    @php
                        {{ $debite =  $debite + $d->debit;}}
                        {{ $credite =  $credite + $d->credit; }}
                    @endphp
                @endforeach
                @endforeach

                <tr class="subtitle">
                    <td class="text-center"><b>Total:</b></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center w-code"></td>
                    <td class="text-right x-5"><b>{{ number_format($debite,2) }}</b></td>
                    <td class="text-right x-5"><b>{{ number_format($credite,2) }}</b></td>
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
