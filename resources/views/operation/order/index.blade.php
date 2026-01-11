@extends('layouts.default')

@section('title', 'Order')

@section('breadcrumb')
    <li class="breadcrumb-item">Operation</li>
    <li class="breadcrumb-item active">Order</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-no-border">
                    <div>
                        <h3>Daftar Order</h3>
                        <p class="desc mb-0 mt-1">Data order pelatihan (read-only)</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>No. Order</th>
                                    <th>Tanggal</th>
                                    <th>Client</th>
                                    <th>Resource Type</th>
                                    <th>Status</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration + ($orders->currentPage() - 1) * $orders->perPage() }}</td>
                                        <td><code>{{ $order->order_no }}</code></td>
                                        <td>{{ $order->order_date->format('d M Y') }}</td>
                                        <td>{{ $order->client->client_name ?? '-' }}</td>
                                        <td>
                                            @if ($order->resource_type?->value == 'TRANSACTION_BASED')
                                                <span class="badge badge-light-primary">Transaction Based</span>
                                            @else
                                                <span class="badge badge-light-info">Accrual Based</span>
                                            @endif
                                        </td>
                                        <td>
                                            @switch($order->status?->value)
                                                @case('DRAFT')
                                                    <span class="badge badge-light-secondary">Draft</span>
                                                @break

                                                @case('CONFIRMED')
                                                    <span class="badge badge-light-primary">Confirmed</span>
                                                @break

                                                @case('COMPLETED')
                                                    <span class="badge badge-light-success">Completed</span>
                                                @break

                                                @case('CANCELLED')
                                                    <span class="badge badge-light-danger">Cancelled</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td>{{ Str::limit($order->notes, 30) }}</td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">
                                                <p class="text-muted mb-0">Belum ada data order</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @include('partials.pagination', ['paginator' => $orders])
                    </div>
                </div>
            </div>
        </div>
    @endsection
