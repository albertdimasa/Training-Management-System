@extends('layouts.default')

@section('title', 'Trial Balance')

@section('breadcrumb')
    <li class="breadcrumb-item">Financial</li>
    <li class="breadcrumb-item active">Trial Balance</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-no-border">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <h3>Trial Balance</h3>
                            <p class="desc mb-0 mt-1">Laporan saldo akun berdasarkan kategori</p>
                        </div>
                        <form method="GET" class="d-flex gap-2 align-items-end flex-wrap">
                            <div>
                                <label class="form-label mb-1 small">Dari Tanggal</label>
                                <input type="date" name="start_date" class="form-control form-control-sm"
                                    value="{{ $startDate ?? '' }}">
                            </div>
                            <div>
                                <label class="form-label mb-1 small">Sampai Tanggal</label>
                                <input type="date" name="end_date" class="form-control form-control-sm"
                                    value="{{ $endDate ?? '' }}">
                            </div>
                            <div class="d-flex gap-1">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    Filter
                                </button>
                                <a href="{{ url()->current() }}" class="btn btn-outline-secondary btn-sm">
                                    Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover balance-sheet-table" id="balanceSheetTable">
                            <thead class="table-dark">
                                <tr>
                                    <th width="150">Kode Akun</th>
                                    <th>Nama Akun</th>
                                    <th class="text-end" width="150">Debit</th>
                                    <th class="text-end" width="150">Kredit</th>
                                    <th class="text-end" width="180">Total Header</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $grandTotalDebit = 0;
                                    $grandTotalCredit = 0;
                                @endphp
                                @foreach ($groupedAccounts as $typeKey => $typeData)
                                    @if (!empty($typeData['accounts']))
                                        @php
                                            $typeTotalDebit = 0;
                                            $typeTotalCredit = 0;
                                        @endphp
                                        @foreach ($typeData['accounts'] as $group)
                                            @if ($group['header'])
                                                @php
                                                    // Determine if header total is debit or credit
                                                    $headerIsDebit = $group['header']->normal_side?->value === 'DEBIT';
                                                    if ($headerIsDebit) {
                                                        $typeTotalDebit += abs($group['header_total']);
                                                    } else {
                                                        $typeTotalCredit += abs($group['header_total']);
                                                    }
                                                @endphp
                                                {{-- Header Row --}}
                                                <tr class="account-header-row">
                                                    <td class="fw-bold">{{ $group['header']->account_code }}</td>
                                                    <td class="fw-bold text-uppercase">{{ $group['header']->account_name }}
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-end fw-bold">
                                                        Rp {{ number_format(abs($group['header_total']), 0, ',', '.') }}
                                                        <small class="ms-1">({{ $headerIsDebit ? 'D' : 'K' }})</small>
                                                    </td>
                                                </tr>
                                            @endif

                                            {{-- Detail Rows --}}
                                            @foreach ($group['children'] as $child)
                                                @php
                                                    $isDebit = $child->normal_side?->value === 'DEBIT';
                                                    $absBalance = abs($child->balance);
                                                @endphp
                                                <tr class="account-detail-row">
                                                    <td class="ps-4 fst-italic text-muted">{{ $child->account_code }}</td>
                                                    <td class="fst-italic">{{ $child->account_name }}</td>
                                                    <td class="text-end text-success">
                                                        @if ($child->balance != 0 && $isDebit)
                                                            Rp {{ number_format($absBalance, 0, ',', '.') }}
                                                        @endif
                                                    </td>
                                                    <td class="text-end text-danger">
                                                        @if ($child->balance != 0 && !$isDebit)
                                                            Rp {{ number_format($absBalance, 0, ',', '.') }}
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                        @endforeach

                                        @php
                                            $grandTotalDebit += $typeTotalDebit;
                                            $grandTotalCredit += $typeTotalCredit;
                                        @endphp

                                        {{-- Type Total Row --}}
                                        <tr class="account-type-total-row">
                                            <td colspan="2" class="fw-bold">TOTAL {{ $typeData['label'] }}</td>
                                            <td class="text-end fw-bold">
                                                @if ($typeTotalDebit > 0)
                                                    Rp {{ number_format($typeTotalDebit, 0, ',', '.') }}
                                                @endif
                                            </td>
                                            <td class="text-end fw-bold">
                                                @if ($typeTotalCredit > 0)
                                                    Rp {{ number_format($typeTotalCredit, 0, ',', '.') }}
                                                @endif
                                            </td>
                                            <td class="text-end fw-bold">
                                                Rp {{ number_format($typeData['total'], 0, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr class="spacer-row">
                                            <td colspan="5" style="height: 15px; border: none;"></td>
                                        </tr>
                                    @endif
                                @endforeach

                                {{-- Grand Total Row --}}
                                <tr class="grand-total-row">
                                    <td colspan="2" class="fw-bold">GRAND TOTAL</td>
                                    <td class="text-end fw-bold">Rp {{ number_format($grandTotalDebit, 0, ',', '.') }}</td>
                                    <td class="text-end fw-bold">Rp {{ number_format($grandTotalCredit, 0, ',', '.') }}
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .balance-sheet-table {
            font-size: 14px;
        }

        .balance-sheet-table thead th {
            background-color: #343a40 !important;
            color: #fff;
            font-weight: 600;
            padding: 12px 15px;
        }

        .account-header-row {
            background-color: #2d3436 !important;
            color: #fff;
        }

        .account-header-row td {
            padding: 10px 15px;
            border-color: #3d4446 !important;
        }

        .account-detail-row {
            background-color: #1e272e !important;
            color: #b2bec3;
        }

        .account-detail-row td {
            padding: 8px 15px;
            border-color: #353b48 !important;
        }

        .account-detail-row .text-success {
            color: #00b894 !important;
        }

        .account-detail-row .text-danger {
            color: #ff7675 !important;
        }

        .account-type-total-row {
            background-color: #0984e3 !important;
            color: #fff !important;
        }

        .account-type-total-row td {
            padding: 12px 15px;
            border: none !important;
        }

        .grand-total-row {
            background-color: #6c5ce7 !important;
            color: #fff !important;
        }

        .grand-total-row td {
            padding: 14px 15px;
            border: none !important;
        }

        .spacer-row td {
            background-color: transparent !important;
        }
    </style>
@endpush
