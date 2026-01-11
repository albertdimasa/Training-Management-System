<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance Sheet - {{ $period['label'] }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 10px;
            line-height: 1.4;
            color: #333;
            background: #fff;
        }

        .container {
            padding: 20px;
            max-width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .header h1 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .header .subtitle {
            font-size: 11px;
            color: #666;
        }

        .header .period {
            font-size: 12px;
            font-weight: 600;
            margin-top: 5px;
        }

        .content {
            display: flex;
            gap: 20px;
        }

        .column {
            flex: 1;
        }

        .section {
            margin-bottom: 15px;
        }

        .section-title {
            background: #2d3436;
            color: #fff;
            padding: 6px 10px;
            font-weight: bold;
            font-size: 11px;
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 4px 8px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        th {
            background: #f5f5f5;
            font-weight: 600;
            font-size: 9px;
        }

        .account-code {
            width: 80px;
            color: #666;
        }

        .account-name {
            font-weight: 500;
        }

        .amount {
            text-align: right;
            width: 100px;
            font-family: 'Consolas', monospace;
        }

        .child-row td {
            padding-left: 20px;
            font-size: 9px;
            color: #555;
        }

        .total-row {
            background: #0984e3;
            color: #fff;
            font-weight: bold;
        }

        .total-row td {
            border: none;
            padding: 6px 8px;
        }

        .grand-total-row {
            background: #6c5ce7;
            color: #fff;
            font-weight: bold;
            font-size: 11px;
        }

        .grand-total-row td {
            border: none;
            padding: 8px;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 9px;
            color: #999;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>BALANCE SHEET <span style="font-weight: normal; font-size: 12px;">{{ strtoupper($type) }}</span></h1>
            <div class="subtitle">Training Management System</div>
            <div class="period">Periode: {{ $period['label'] }}</div>
        </div>

        <div class="content">
            {{-- Left Column: Assets --}}
            <div class="column">
                <div class="section">
                    <div class="section-title">ASET</div>
                    <table>
                        <thead>
                            <tr>
                                <th class="account-code">Kode</th>
                                <th>Nama Akun</th>
                                <th class="amount">Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assets['accounts'] as $group)
                                @if ($group['header'])
                                    <tr>
                                        <td class="account-code">{{ $group['header']->account_code }}</td>
                                        <td class="account-name">{{ $group['header']->account_name }}</td>
                                        <td class="amount">{{ number_format(abs($group['header_total']), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endif
                                @if ($type === 'detail' && isset($group['children']))
                                    @foreach ($group['children'] as $child)
                                        <tr class="child-row">
                                            <td class="account-code">{{ $child->account_code }}</td>
                                            <td>{{ $child->account_name }}</td>
                                            <td class="amount">{{ number_format(abs($child->balance), 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach
                            <tr class="total-row">
                                <td colspan="2">TOTAL ASET</td>
                                <td class="amount">{{ number_format(abs($assets['total']), 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Right Column: Liabilities & Equity --}}
            <div class="column">
                <div class="section">
                    <div class="section-title">LIABILITAS</div>
                    <table>
                        <thead>
                            <tr>
                                <th class="account-code">Kode</th>
                                <th>Nama Akun</th>
                                <th class="amount">Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($liabilities['accounts'] as $group)
                                @if ($group['header'])
                                    <tr>
                                        <td class="account-code">{{ $group['header']->account_code }}</td>
                                        <td class="account-name">{{ $group['header']->account_name }}</td>
                                        <td class="amount">
                                            {{ number_format(abs($group['header_total']), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endif
                                @if ($type === 'detail' && isset($group['children']))
                                    @foreach ($group['children'] as $child)
                                        <tr class="child-row">
                                            <td class="account-code">{{ $child->account_code }}</td>
                                            <td>{{ $child->account_name }}</td>
                                            <td class="amount">{{ number_format(abs($child->balance), 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach
                            <tr class="total-row">
                                <td colspan="2">TOTAL LIABILITAS</td>
                                <td class="amount">{{ number_format(abs($liabilities['total']), 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="section">
                    <div class="section-title">EKUITAS</div>
                    <table>
                        <thead>
                            <tr>
                                <th class="account-code">Kode</th>
                                <th>Nama Akun</th>
                                <th class="amount">Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($equity['accounts'] as $group)
                                @if ($group['header'])
                                    <tr>
                                        <td class="account-code">{{ $group['header']->account_code }}</td>
                                        <td class="account-name">{{ $group['header']->account_name }}</td>
                                        <td class="amount">
                                            {{ number_format(abs($group['header_total']), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endif
                                @if ($type === 'detail' && isset($group['children']))
                                    @foreach ($group['children'] as $child)
                                        <tr class="child-row">
                                            <td class="account-code">{{ $child->account_code }}</td>
                                            <td>{{ $child->account_name }}</td>
                                            <td class="amount">{{ number_format(abs($child->balance), 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach
                            <tr class="total-row">
                                <td colspan="2">TOTAL EKUITAS</td>
                                <td class="amount">{{ number_format(abs($equity['total']), 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                @php
                    $totalLiabilitiesEquity = $liabilities['total'] + $equity['total'];
                @endphp
                <table>
                    <tr class="grand-total-row">
                        <td>TOTAL LIABILITAS + EKUITAS</td>
                        <td class="amount" style="width: 100px;">
                            {{ number_format(abs($totalLiabilitiesEquity), 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="footer">
            Dicetak pada: {{ now()->translatedFormat('d F Y H:i') }}
        </div>
    </div>
</body>

</html>
