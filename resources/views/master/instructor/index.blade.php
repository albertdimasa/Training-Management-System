@extends('layouts.default')

@section('title', 'Master Instruktor')

@section('breadcrumb')
    <li class="breadcrumb-item">Master</li>
    <li class="breadcrumb-item active">Instruktor</li>
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
            <div class="card overflow-hidden">
                <div class="card-header card-no-border">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3>Daftar Instruktor</h3>
                            <p class="desc mb-0 mt-1">Kelola data instruktor untuk pelatihan</p>
                        </div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInstructorModal">
                            <i class="fa-solid fa-plus me-2"></i>Tambah Instruktor
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="border-bottom-primary">
                                <th scope="col">No</th>
                                <th scope="col">Nama Instruktor</th>
                                <th scope="col">Spesialisasi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($instructors as $index => $instructor)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $instructor->name }}</td>
                                    <td>
                                        @if ($instructor->specialization)
                                            <span class="badge badge-light-primary">{{ $instructor->specialization }}</span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal"
                                            data-bs-target="#editInstructorModal{{ $instructor->id }}">
                                            <i class="fa-solid fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger btn-delete"
                                            data-id="{{ $instructor->id }}" data-name="{{ $instructor->name }}"
                                            data-url="{{ route('master.instructor.destroy', $instructor) }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editInstructorModal{{ $instructor->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('master.instructor.update', $instructor) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h3 class="modal-title fs-5">Edit Instruktor</h3>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Nama Lengkap</label>
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ $instructor->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="specialization" class="form-label">Spesialisasi</label>
                                                        <input type="text" class="form-control" name="specialization"
                                                            value="{{ $instructor->specialization }}">
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
                                    <td colspan="4" class="text-center py-4">
                                        <p class="text-muted mb-0">Belum ada data instruktor</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Instructor Modal -->
    <div class="modal fade" id="addInstructorModal" tabindex="-1" aria-labelledby="addInstructorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('master.instructor.store') }}" method="POST" class="w-100">
                    @csrf
                    <div class="modal-header">
                        <h3 class="modal-title fs-5" id="addInstructorModalLabel">Tambah Instruktor Baru</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="name" placeholder="Masukkan nama lengkap"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="specialization" class="form-label">Spesialisasi</label>
                            <input type="text" class="form-control" name="specialization"
                                placeholder="Masukkan spesialisasi">
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
        // SweetAlert2 Delete Confirmation
        document.querySelectorAll('.btn-delete').forEach(function(button) {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const url = this.getAttribute('data-url');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Data instruktor "${name}" akan dihapus secara permanen!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById('deleteForm');
                        form.action = url;
                        form.submit();
                    }
                });
            });
        });

        // Show success message with SweetAlert2 if session has success
        @if (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#5C61F2',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
@endpush
