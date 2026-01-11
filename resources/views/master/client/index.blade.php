@extends('layouts.default')

@section('title', 'Master Client')

@section('breadcrumb')
    <li class="breadcrumb-item">Master</li>
    <li class="breadcrumb-item active">Client</li>
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
                            <h3>Daftar Client</h3>
                            <p class="desc mb-0 mt-1">Kelola data client/pelanggan</p>
                        </div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClientModal">
                            <i class="fa-solid fa-plus me-2"></i>Tambah Client
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama Client</th>
                                    <th>Tipe</th>
                                    <th>Industri</th>
                                    <th>Kota</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($clients as $client)
                                    <tr>
                                        <td>{{ $loop->iteration + ($clients->currentPage() - 1) * $clients->perPage() }}
                                        </td>
                                        <td><code>{{ $client->client_code }}</code></td>
                                        <td>{{ $client->client_name }}</td>
                                        <td><span
                                                class="badge badge-light-primary">{{ $client->client_type?->value }}</span>
                                        </td>
                                        <td>{{ $client->industry }}</td>
                                        <td>{{ $client->city }}</td>
                                        <td>
                                            @if ($client->status?->value == 'ACTIVE')
                                                <span class="badge badge-light-success">Aktif</span>
                                            @else
                                                <span class="badge badge-light-danger">Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal"
                                                data-bs-target="#editClientModal{{ $client->id }}">
                                                <i class="fa-solid fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger btn-delete"
                                                data-id="{{ $client->id }}" data-name="{{ $client->client_name }}"
                                                data-url="{{ route('master.client.destroy', $client) }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editClientModal{{ $client->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <form action="{{ route('master.client.update', $client) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h3 class="modal-title fs-5">Edit Client</h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Kode Client</label>
                                                                <input type="text" class="form-control"
                                                                    name="client_code" value="{{ $client->client_code }}"
                                                                    required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Nama Client</label>
                                                                <input type="text" class="form-control"
                                                                    name="client_name" value="{{ $client->client_name }}"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Tipe Client</label>
                                                                <select class="form-select" name="client_type" required>
                                                                    <option value="CORPORATE"
                                                                        {{ $client->client_type?->value == 'CORPORATE' ? 'selected' : '' }}>
                                                                        Corporate</option>
                                                                    <option value="GOVERNMENT"
                                                                        {{ $client->client_type?->value == 'GOVERNMENT' ? 'selected' : '' }}>
                                                                        Government</option>
                                                                    <option value="EDUCATION"
                                                                        {{ $client->client_type?->value == 'EDUCATION' ? 'selected' : '' }}>
                                                                        Education</option>
                                                                    <option value="INDIVIDUAL_RESELLER"
                                                                        {{ $client->client_type?->value == 'INDIVIDUAL_RESELLER' ? 'selected' : '' }}>
                                                                        Individual/Reseller</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Industri</label>
                                                                <input type="text" class="form-control" name="industry"
                                                                    value="{{ $client->industry }}">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Kota</label>
                                                                <input type="text" class="form-control" name="city"
                                                                    value="{{ $client->city }}" required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Status</label>
                                                                <select class="form-select" name="status" required>
                                                                    <option value="ACTIVE"
                                                                        {{ $client->status?->value == 'ACTIVE' ? 'selected' : '' }}>
                                                                        Aktif</option>
                                                                    <option value="INACTIVE"
                                                                        {{ $client->status?->value == 'INACTIVE' ? 'selected' : '' }}>
                                                                        Tidak Aktif</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <p class="text-muted mb-0">Belum ada data client</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @include('partials.pagination', ['paginator' => $clients])
                </div>
            </div>
        </div>
    </div>

    <!-- Add Client Modal -->
    <div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form action="{{ route('master.client.store') }}" method="POST" class="w-100">
                    @csrf
                    <div class="modal-header">
                        <h3 class="modal-title fs-5" id="addClientModalLabel">Tambah Client Baru</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kode Client</label>
                                <input type="text" class="form-control" name="client_code" placeholder="CL0001"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Client</label>
                                <input type="text" class="form-control" name="client_name"
                                    placeholder="Masukkan nama client" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tipe Client</label>
                                <select class="form-select" name="client_type" required>
                                    <option value="">Pilih Tipe</option>
                                    <option value="CORPORATE">Corporate</option>
                                    <option value="GOVERNMENT">Government</option>
                                    <option value="EDUCATION">Education</option>
                                    <option value="INDIVIDUAL_RESELLER">Individual/Reseller</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Industri</label>
                                <input type="text" class="form-control" name="industry"
                                    placeholder="Masukkan industri">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kota</label>
                                <input type="text" class="form-control" name="city" placeholder="Masukkan kota"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="ACTIVE">Aktif</option>
                                    <option value="INACTIVE">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Form (Hidden) -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.btn-delete').forEach(function(button) {
            button.addEventListener('click', function() {
                const name = this.getAttribute('data-name');
                const url = this.getAttribute('data-url');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Data client "${name}" akan dihapus!`,
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
