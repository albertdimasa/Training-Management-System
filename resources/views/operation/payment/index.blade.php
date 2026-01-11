@extends('layouts.default')

@section('title', 'Payment')

@section('breadcrumb')
    <li class="breadcrumb-item">Operation</li>
    <li class="breadcrumb-item active">Payment</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-no-border">
                    <div>
                        <h3>Daftar Payment</h3>
                        <p class="desc mb-0 mt-1">Data pembayaran (read-only)</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>No. Payment</th>
                                    <th>Invoice</th>
                                    <th>Client</th>
                                    <th>Tgl Payment</th>
                                    <th>Method</th>
                                    <th>Amount</th>
                                    <th>Reference</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($payments as $payment)
                                    <tr>
                                        <td>{{ $loop->iteration + ($payments->currentPage() - 1) * $payments->perPage() }}
                                        </td>
                                        <td><code>{{ $payment->payment_no }}</code></td>
                                        <td>{{ $payment->invoice->invoice_no ?? '-' }}</td>
                                        <td>{{ $payment->invoice->order->client->client_name ?? '-' }}</td>
                                        <td>{{ $payment->payment_date->format('d M Y') }}</td>
                                        <td>
                                            @switch($payment->method?->value)
                                                @case('TRANSFER')
                                                    <span class="badge badge-light-primary">Transfer</span>
                                                @break

                                                @case('CASH')
                                                    <span class="badge badge-light-success">Cash</span>
                                                @break

                                                @case('VA')
                                                    <span class="badge badge-light-info">Virtual Account</span>
                                                @break

                                                @case('GIRO')
                                                    <span class="badge badge-light-warning">Giro</span>
                                                @break

                                                @case('CARD')
                                                    <span class="badge badge-light-secondary">Card</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                        <td>{{ $payment->reference_no ?? '-' }}</td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <p class="text-muted mb-0">Belum ada data payment</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @include('partials.pagination', ['paginator' => $payments])
                    </div>
                </div>
            </div>
        </div>
    @endsection
