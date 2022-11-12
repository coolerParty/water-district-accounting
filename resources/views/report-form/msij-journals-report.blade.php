<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MSIJ Report : Date : {{ $date_start }} - {{ $date_end }}</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
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
                font-size: 0.8em;
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

            .border-none {
                border: none;
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
                        <th colspan="18" class="text-center text-bold">
                            <div>MATERIALS STOCKS ISSUED JOURNAL</div>
                            <div class="subtitle">
                                Municipality of Tarangnan
                            </div>
                            <div class="subtitle">
                                Date : {{ $date_start }} - {{ $date_end }}
                            </div>
                            <div class="subtitle">Sheet No.1</div>
                        </th>
                    </tr>

                    <tr class="subtitle">
                        <th class="text-center">Date</th>
                        <th class="text-center" rowspan="2">RSMI</th>
                        <th class="text-center" colspan="6">CREDIT</th>
                        <th class="text-center" colspan="5">DEBIT</th>
                        <th class="text-center" colspan="4">SUNDRY</th>
                    </tr>
                    <tr class="subtitle">
                        <th class="text-center">{{ Carbon\Carbon::createFromFormat('Y-m-d', $date_start)->format('Y') }}</th>
                        <th class="text-center">1-04-04-130</th>
                        <th class="text-center">1-04-04-990</th>
                        <th class="text-center">1-04-04-120</th>
                        <th class="text-center">1-04-04-080</th>
                        <th class="text-center">1-04-04-020</th>
                        <th class="text-center">1-04-04-010</th>
                        <th class="text-center">5-02-13-030</th>
                        <th class="text-center">5-02-03-130</th>
                        <th class="text-center">5-02-03-090</th>
                        <th class="text-center">5-02-03-020</th>
                        <th class="text-center">5-02-03-010</th>
                        <th class="text-center">Account Code</th>
                        <th class="text-center">PR</th>
                        <th class="text-center">Debit</th>
                        <th class="text-center">Credit</th>
                    </tr>
                    @forelse($journals as $journal)
                    <tr class="subtitle">
                        @php
                            $accountExist = true;
                            $rowspanCount = 0;
                            foreach($journal->transactions as $d) {
                                 if($d->credit <> 0 && $d->accountChart->code == '1-04-04-130'){
                                        $accountExist = false;
                                    }elseif($d->credit <> 0 && $d->accountChart->code == '1-04-04-990'){
                                        $accountExist = false;
                                    }elseif($d->credit <> 0 && $d->accountChart->code == '1-04-04-120'){
                                        $accountExist = false;
                                    }elseif($d->credit <> 0 && $d->accountChart->code == '1-04-04-080'){
                                        $accountExist = false;
                                    }elseif($d->credit <> 0 && $d->accountChart->code == '1-04-04-020'){
                                        $accountExist = false;
                                    }elseif($d->credit <> 0 && $d->accountChart->code == '1-04-04-010'){
                                        $accountExist = false;
                                    }elseif($d->debit <> 0 && $d->accountChart->code == '5-02-13-030'){
                                        $accountExist = false;
                                    }elseif($d->debit <> 0 && $d->accountChart->code == '5-02-03-130'){
                                        $accountExist = false;
                                    }elseif($d->debit <> 0 && $d->accountChart->code == '5-02-03-090'){
                                        $accountExist = false;
                                    }elseif($d->debit <> 0 && $d->accountChart->code == '5-02-03-020'){
                                        $accountExist = false;
                                    }elseif($d->debit <> 0 && $d->accountChart->code == '5-02-03-010'){
                                        $accountExist = false;
                                    }else{
                                        $rowspanCount = $rowspanCount + 1;
                                    }
                                }
                        @endphp
                        <td
                            rowspan="{{ ($accountExist)? $journal->transactions->count() + 1 : $rowspanCount + 1 }}"
                            class="text-center"
                        >
                            {{ $journal->jv_date }}
                        </td>
                        <td
                            rowspan="{{ ($accountExist)? $journal->transactions->count() + 1 : $rowspanCount + 1 }}"
                            class="text-center"
                        >
                            {{ $journal->materialIssuedJournal->rsmi_no }}
                        </td>
                        <td
                            rowspan="{{ ($accountExist)? $journal->transactions->count() + 1 : $rowspanCount + 1 }}"
                            class="text-right x-5"
                        >
                            @foreach($journal->transactions as $d)
                                @if($d->credit <> 0 && $d->accountChart->code == '1-04-04-130')
                                    <div class="pd-5">
                                        {{ number_format($d->credit,2) }}
                                    </div>
                                @endif
                            @endforeach
                        </td>
                        <td
                            rowspan="{{ ($accountExist)? $journal->transactions->count() + 1 : $rowspanCount + 1 }}"
                            class="text-right x-5"
                        >
                            @foreach($journal->transactions as $d)
                                @if($d->credit <> 0 && $d->accountChart->code == '1-04-04-990')
                                    <div class="pd-5">
                                        {{ number_format($d->credit,2) }}
                                    </div>
                                @endif
                            @endforeach
                        </td>
                        <td
                            rowspan="{{ ($accountExist)? $journal->transactions->count() + 1 : $rowspanCount + 1 }}"
                            class="text-right x-5"
                        >
                            @foreach($journal->transactions as $d)
                                @if($d->credit <> 0 && $d->accountChart->code == '1-04-04-120')
                                    <div class="pd-5">
                                        {{ number_format($d->credit,2) }}
                                    </div>
                                @endif
                            @endforeach
                        </td>
                        <td
                            rowspan="{{ ($accountExist)? $journal->transactions->count() + 1 : $rowspanCount + 1 }}"
                            class="text-right x-5"
                        >
                            @foreach($journal->transactions as $d)
                                @if($d->credit <> 0 && $d->accountChart->code == '1-04-04-080')
                                    <div class="pd-5">
                                        {{ number_format($d->credit,2) }}
                                    </div>
                                @endif
                            @endforeach
                        </td>
                        <td
                            rowspan="{{ ($accountExist)? $journal->transactions->count() + 1 : $rowspanCount + 1 }}"
                            class="text-right x-5"
                        >
                            @foreach($journal->transactions as $d)
                                @if($d->credit <> 0 && $d->accountChart->code == '1-04-04-020')
                                    <div class="pd-5">
                                        {{ number_format($d->credit,2) }}
                                    </div>
                                @endif
                            @endforeach
                        </td>
                        <td
                            rowspan="{{ ($accountExist)? $journal->transactions->count() + 1 : $rowspanCount + 1 }}"
                            class="text-right x-5"
                        >
                            @foreach($journal->transactions as $d)
                                @if($d->credit <> 0 && $d->accountChart->code == '1-04-04-010')
                                    <div class="pd-5">
                                        {{ number_format($d->credit,2) }}
                                    </div>
                                @endif
                            @endforeach
                        </td>
                        <td
                            rowspan="{{ ($accountExist)? $journal->transactions->count() + 1 : $rowspanCount + 1 }}"
                            class="text-right x-5"
                        >
                            @foreach($journal->transactions as $d)
                                @if($d->debit <> 0 && $d->accountChart->code == '5-02-13-030')
                                    <div class="pd-5">
                                        {{ number_format($d->debit,2) }}
                                    </div>
                                @endif
                            @endforeach
                        </td>
                        <td
                            rowspan="{{ ($accountExist)? $journal->transactions->count() + 1 : $rowspanCount + 1 }}"
                            class="text-right x-5"
                        >
                            @foreach($journal->transactions as $d)
                                @if($d->debit <> 0 && $d->accountChart->code == '5-02-03-130')
                                    <div class="pd-5">
                                        {{ number_format($d->debit,2) }}
                                    </div>
                                @endif
                            @endforeach
                        </td>
                        <td
                            rowspan="{{ ($accountExist)? $journal->transactions->count() + 1 : $rowspanCount + 1 }}"
                            class="text-right x-5"
                        >
                            @foreach($journal->transactions as $d)
                                @if($d->debit <> 0 && $d->accountChart->code == '5-02-03-090')
                                    <div class="pd-5">
                                        {{ number_format($d->debit,2) }}
                                    </div>
                                @endif
                            @endforeach
                        </td>
                        <td
                            rowspan="{{ ($accountExist)? $journal->transactions->count() + 1 : $rowspanCount + 1 }}"
                            class="text-right x-5"
                        >
                            @foreach($journal->transactions as $d)
                                @if($d->debit <> 0 && $d->accountChart->code == '5-02-03-020')
                                    <div class="pd-5">
                                        {{ number_format($d->debit,2) }}
                                    </div>
                                @endif
                            @endforeach
                        </td>
                        <td
                            rowspan="{{ ($accountExist)? $journal->transactions->count() + 1 : $rowspanCount + 1 }}"
                            class="text-right x-5"
                        >
                            @foreach($journal->transactions as $d)
                                @if($d->debit <> 0 && $d->accountChart->code == '5-02-03-010')
                                    <div class="pd-5">
                                        {{ number_format($d->debit,2) }}
                                    </div>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    @foreach($journal->transactions as $d)
                    @if(
                        (
                                (
                                    $d->accountChart->code == '1-04-04-130' or $d->accountChart->code == '1-04-04-990' or $d->accountChart->code == '1-04-04-120' or
                                    $d->accountChart->code == '1-04-04-080' or $d->accountChart->code == '1-04-04-020' or $d->accountChart->code == '1-04-04-010'
                                ) and $d->credit <>0
                            )
                            or
                            (
                                (
                                $d->accountChart->code == '5-02-13-030' or $d->accountChart->code == '5-02-03-130' or $d->accountChart->code == '5-02-03-090' or
                                $d->accountChart->code == '5-02-03-020' or $d->accountChart->code == '5-02-03-010'
                                ) and $d->debit <>0
                            )
                        )
                    @else
                    <tr>
                        <!-- sundry START-->
                        <!-- code -->
                        <td class="text-center x-5">
                            @if(($d->accountChart->code == '1-01-02-010' or
                            $d->accountChart->code == '2-02-01-010') and
                            $d->credit<>0) @else
                            <div class="text-center x-5 pd-5">
                                {{ $d->accountChart->code }}
                            </div>
                            @endif
                        </td>
                        <!-- pr -->
                        <td class="text-center"></td>
                        <!-- Debit -->
                        <td class="text-right">
                            @if(($d->accountChart->code == '1-01-02-010' or
                            $d->accountChart->code == '2-02-01-010') and
                            $d->credit<>0) @elseif($d->debit <> 0)
                            <div class="pd-5">
                                {{ number_format($d->debit,2) }}
                            </div>
                            @endif
                        </td>
                        <!-- Credit -->
                        <td class="text-right">
                            @if(($d->accountChart->code == '1-01-02-010' or
                            $d->accountChart->code == '2-02-01-010') and
                            $d->credit<>0) @elseif($d->credit <> 0)
                            <div class="pd-5">
                                {{ number_format($d->credit,2) }}
                            </div>
                            @endif
                        </td>
                        <!-- sundry END-->
                    </tr>
                    @endif @endforeach @empty
                    <tr class="subtitle">
                        <td  colspan="18" class="text-center"></td>
                    </tr>
                    @endforelse
                        @php
                            $creditOne = 0;
                            $creditTwo = 0;
                            $creditThree = 0;
                            $creditFour = 0;
                            $creditFive = 0;
                            $creditSix = 0;

                            $debitOne = 0;
                            $debitTwo = 0;
                            $debitThree = 0;
                            $debitFour = 0;
                            $debitFive = 0;

                            $creditSundry = 0;
                            $DebitSundry = 0;
                        @endphp
                        @foreach($journals as $journal)
                            @foreach($journal->transactions as $d)
                                @if($d->credit <> 0 && $d->accountChart->code == '1-04-04-130')
                                    @php
                                    $creditOne = $creditOne + $d->credit
                                    @endphp
                                @endif
                                @if($d->credit <> 0 && $d->accountChart->code == '1-04-04-990')
                                    @php
                                        $creditTwo = $creditTwo + $d->credit
                                    @endphp
                                @endif
                                @if($d->credit <> 0 && $d->accountChart->code == '1-04-04-120')
                                    @php
                                        $creditThree = $creditThree + $d->credit
                                    @endphp
                                @endif
                                @if($d->credit <> 0 && $d->accountChart->code == '1-04-04-080')
                                    @php
                                        $creditFour = $creditFour + $d->credit
                                    @endphp
                                @endif
                                @if($d->credit <> 0 && $d->accountChart->code == '1-04-04-020')
                                    @php
                                        $creditFive = $creditFive + $d->credit
                                    @endphp
                                @endif
                                @if($d->credit <> 0 && $d->accountChart->code == '1-04-04-010')
                                    @php
                                        $creditSix = $creditSix + $d->credit
                                    @endphp
                                @endif
                                @if($d->debit <> 0 && $d->accountChart->code == '5-02-13-030')
                                    @php
                                        $debitOne = $debitOne + $d->debit
                                    @endphp
                                @endif
                                @if($d->debit <> 0 && $d->accountChart->code == '5-02-03-130')
                                    @php
                                        $debitTwo = $debitTwo + $d->debit
                                    @endphp
                                @endif
                                @if($d->debit <> 0 && $d->accountChart->code == '5-02-03-090')
                                    @php
                                        $debitThree = $debitThree + $d->debit
                                    @endphp
                                @endif
                                @if($d->debit <> 0 && $d->accountChart->code == '5-02-03-020')
                                    @php
                                        $debitFour = $debitFour + $d->debit
                                    @endphp
                                @endif
                                @if($d->debit <> 0 && $d->accountChart->code == '5-02-03-010')
                                    @php
                                        $debitFive = $debitFive + $d->debit
                                    @endphp
                                @endif
                                @if(
                                        (
                                            $d->accountChart->code <> '1-04-04-130' and $d->accountChart->code <> '1-04-04-990' and $d->accountChart->code <> '1-04-04-120' and
                                            $d->accountChart->code <> '1-04-04-080' and $d->accountChart->code <> '1-04-04-020' and $d->accountChart->code <> '1-04-04-010'
                                        )
                                        and $d->credit <>0
                                    )
                                    @php
                                    $creditSundry = $creditSundry + $d->credit
                                    @endphp
                                @endif
                                @if(
                                        (
                                            $d->accountChart->code <> '5-02-13-030' and $d->accountChart->code <> '5-02-03-130' and $d->accountChart->code <> '5-02-03-090' and
                                            $d->accountChart->code <> '5-02-03-020' and $d->accountChart->code <> '5-02-03-010'
                                        )
                                        and $d->debit <>0
                                    )
                                    @php
                                        $DebitSundry = $DebitSundry + $d->debit
                                    @endphp
                                @endif
                            @endforeach
                        @endforeach

                    <tr class="subtitle">
                        <td class="text-center" colspan="2"><b>Total:</b></td>
                        <td class="text-right">
                            <b>{{ number_format($creditOne, 2) }}</b>
                        </td>
                        <td class="text-right">
                            <b>{{ number_format($creditTwo, 2) }}</b>
                        </td>
                        <td class="text-right">
                            <b>{{ number_format($creditThree, 2) }}</b>
                        </td>
                        <td class="text-right">
                            <b>{{ number_format($creditFour, 2) }}</b>
                        </td>
                        <td class="text-right">
                            <b>{{ number_format($creditFive, 2) }}</b>
                        </td>
                        <td class="text-right">
                            <b>{{ number_format($creditSix, 2) }}</b>
                        </td>
                        <td class="text-right">
                            <b>{{ number_format($debitOne, 2) }}</b>
                        </td>
                        <td class="text-right">
                            <b>{{ number_format($debitTwo, 2) }}</b>
                        </td>
                        <td class="text-right">
                            <b>{{ number_format($debitThree, 2) }}</b>
                        </td>
                        <td class="text-right">
                            <b>{{ number_format($debitFour, 2) }}</b>
                        </td>
                        <td class="text-right">
                            <b>{{ number_format($debitFive, 2) }}</b>
                        </td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-right">
                            <b>{{ number_format($DebitSundry, 2) }}</b>
                        </td>
                        <td class="text-right">
                            <b>{{ number_format($creditSundry, 2) }}</b>
                        </td>
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
                        <td class="text-right">
                            <b>{{ number_format($recaps->sum('tdebit'),2) }}</b>
                        </td>
                        <td class="text-right">
                            <b
                                >{{ number_format($recaps->sum('tcredit'),2) }}</b
                            >
                        </td>
                    </tr>
                </table>
            </div>
            <div class="p-10 subtitle">
                <table>
                    <tr>
                        <td class="border-none">
                            <div>Prepared by:</div>
                            <div class="text-center text-bold">
                                Angerlyn Colonia, CPA
                            </div>
                            <div class="text-center">
                                Corporate Accounts Analyst
                            </div>
                        </td>
                        <td class="border-none">
                            <div>Certified by:</div>
                            <div class="text-center text-bold">
                                Eleonor A. Villarta, MBA
                            </div>
                            <div class="text-center">AGSD Manager</div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>
