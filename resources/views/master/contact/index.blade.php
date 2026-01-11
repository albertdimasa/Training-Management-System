@extends('layouts.default')

@section('title', 'Master Contact')

@section('breadcrumb')
    <li class="breadcrumb-item">Master</li>
    <li class="breadcrumb-item active">Contact</li>
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
                            <h3>Daftar Contact</h3>
                            <p class="desc mb-0 mt-1">Kelola data kontak dari client</p>
                        </div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addContactModal">
                            <i class="fa-solid fa-plus me-2"></i>Tambah Contact
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Client</th>
                                    <th>Nama Contact</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Jabatan</th>
                                    <th>Primary</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($contacts as $contact)
                                    <tr>
                                        <td>{{ $loop->iteration + ($contacts->currentPage() - 1) * $contacts->perPage() }}
                                        </td>
                                        <td>{{ $contact->client->client_name ?? '-' }}</td>
                                        <td>{{ $contact->contact_name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->phone }}</td>
                                        <td>{{ $contact->role_title }}</td>
                                        <td>
                                            @if ($contact->is_primary)
                                                <span class="badge badge-light-success">Ya</span>
                                            @else
                                                <span class="badge badge-light-secondary">Tidak</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal"
                                                data-bs-target="#editContactModal{{ $contact->id }}">
                                                <i class="fa-solid fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger btn-delete"
                                                data-name="{{ $contact->contact_name }}"
                                                data-url="{{ route('master.contact.destroy', $contact) }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @include('master.contact._edit_modal', [
                                        'contact' => $contact,
                                        'clients' => $clients,
                                    ])
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <p class="text-muted mb-0">Belum ada data contact</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @include('partials.pagination', ['paginator' => $contacts])
                </div>
            </div>
        </div>
    </div>

    @include('master.contact._add_modal', ['clients' => $clients])

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
                    text: `Data contact "${name}" akan dihapus!`,
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
