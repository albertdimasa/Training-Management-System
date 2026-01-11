@extends('layouts.default')

@section('title', 'Chart of Accounts')

@section('breadcrumb')
    <li class="breadcrumb-item">Financial</li>
    <li class="breadcrumb-item active">Chart of Accounts</li>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-no-border">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3>Chart of Accounts</h3>
                            <p class="desc mb-0 mt-1">Kelola daftar akun keuangan</p>
                        </div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAccountModal">
                            <i class="fa-solid fa-plus me-2"></i>Tambah Akun
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Akun</th>
                                    <th>Nama Akun</th>
                                    <th>Tipe</th>
                                    <th>Parent</th>
                                    <th>Normal Side</th>
                                    <th>Header</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($accounts as $account)
                                    <tr>
                                        <td>{{ $loop->iteration + ($accounts->currentPage() - 1) * $accounts->perPage() }}
                                        </td>
                                        <td><code>{{ $account->account_code }}</code></td>
                                        <td>{{ $account->account_name }}</td>
                                        <td><span
                                                class="badge badge-light-primary">{{ $account->account_type?->value }}</span>
                                        </td>
                                        <td>{{ $account->parent?->account_name ?? '-' }}</td>
                                        <td><span class="badge badge-light-info">{{ $account->normal_side?->value }}</span>
                                        </td>
                                        <td>
                                            @if ($account->is_header)
                                                <span class="badge badge-light-success">Ya</span>
                                            @else
                                                <span class="badge badge-light-secondary">Tidak</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal"
                                                data-bs-target="#editAccountModal{{ $account->id }}">
                                                <i class="fa-solid fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger btn-delete"
                                                data-name="{{ $account->account_name }}"
                                                data-url="{{ route('financial.account.destroy', $account) }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @include('financial.account._edit_modal', [
                                        'account' => $account,
                                        'parentAccounts' => $parentAccounts,
                                    ])
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <p class="text-muted mb-0">Belum ada data akun</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @include('partials.pagination', ['paginator' => $accounts])
                </div>
            </div>
        </div>
    </div>

    @include('financial.account._add_modal', ['parentAccounts' => $parentAccounts])

    <form id="deleteForm" method="POST" style="display: none;">@csrf @method('DELETE')</form>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.btn-delete').forEach(function(button) {
            button.addEventListener('click', function() {
                const name = this.getAttribute('data-name');
                const url = this.getAttribute('data-url');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Akun "${name}" akan dihapus!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('deleteForm').action = url;
                        document.getElementById('deleteForm').submit();
                    }
                });
            });
        });
        @if (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#5C61F2'
            });
        @endif
    </script>
@endpush
