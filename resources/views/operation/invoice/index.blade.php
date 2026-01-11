@extends('layouts.default')

@section('title', 'Invoice')

@section('breadcrumb')
    <li class="breadcrumb-item">Operation</li>
    <li class="breadcrumb-item active">Invoice</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-no-border">
                    <div>
                        <h3>Daftar Invoice</h3>
                        <p class="desc mb-0 mt-1">Data invoice (read-only)</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>No. Invoice</th>
                                    <th>Order</th>
                                    <th>Client</th>
                                    <th>Tgl Invoice</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Grand Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($invoices as $invoice)
                                    <tr>
                                        <td>{{ $loop->iteration + ($invoices->currentPage() - 1) * $invoices->perPage() }}
                                        </td>
                                        <td><code>{{ $invoice->invoice_no }}</code></td>
                                        <td>{{ $invoice->order->order_no ?? '-' }}</td>
                                        <td>{{ $invoice->order->client->client_name ?? '-' }}</td>
                                        <td>{{ $invoice->invoice_date->format('d M Y') }}</td>
                                        <td>{{ $invoice->due_date->format('d M Y') }}</td>
                                        <td>Rp {{ number_format($invoice->grand_total, 0, ',', '.') }}</td>
                                        <td>
                                            @switch($invoice->status?->value)
                                                @case('UNPAID')
                                                    <span class="badge badge-light-warning">Unpaid</span>
                                                @break

                                                @case('PARTIAL')
                                                    <span class="badge badge-light-info">Partial</span>
                                                @break

                                                @case('PAID')
                                                    <span class="badge badge-light-success">Paid</span>
                                                @break

                                                @case('VOID')
                                                    <span class="badge badge-light-danger">Void</span>
                                                @break
                                            @endswitch
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <p class="text-muted mb-0">Belum ada data invoice</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @include('partials.pagination', ['paginator' => $invoices])
                    </div>
                </div>
            </div>
        </div>
    @endsection
