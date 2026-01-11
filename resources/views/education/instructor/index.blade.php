@extends('layouts.default')

@section('title', 'Master Instruktur')

@section('breadcrumb')
    <li class="breadcrumb-item">Education</li>
    <li class="breadcrumb-item active">Instruktur</li>
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
                            <h3>Daftar Instruktur</h3>
                            <p class="desc mb-0 mt-1">Kelola data instruktur untuk pelatihan</p>
                        </div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInstructorModal">
                            <i class="fa-solid fa-plus me-2"></i>Tambah Instruktur
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
                                    <th>Nama</th>
                                    <th>Spesialisasi</th>
                                    <th>Level</th>
                                    <th>Daily Rate</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($instructors as $instructor)
                                    <tr>
                                        <td>{{ $loop->iteration + ($instructors->currentPage() - 1) * $instructors->perPage() }}
                                        </td>
                                        <td><code>{{ $instructor->trainer_code }}</code></td>
                                        <td>{{ $instructor->trainer_name }}</td>
                                        <td>
                                            <span class="badge badge-light-primary">{{ $instructor->specialization }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-info">{{ $instructor->level?->value }}</span>
                                        </td>
                                        <td>Rp {{ number_format($instructor->daily_rate, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($instructor->status?->value == 'ACTIVE')
                                                <span class="badge badge-light-success">Aktif</span>
                                            @else
                                                <span class="badge badge-light-danger">Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal"
                                                data-bs-target="#editInstructorModal{{ $instructor->id }}">
                                                <i class="fa-solid fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger btn-delete"
                                                data-id="{{ $instructor->id }}" data-name="{{ $instructor->trainer_name }}"
                                                data-url="{{ route('education.instructor.destroy', $instructor) }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editInstructorModal{{ $instructor->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <form action="{{ route('education.instructor.update', $instructor) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h3 class="modal-title fs-5">Edit Instruktur</h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Kode Trainer</label>
                                                                <input type="text" class="form-control"
                                                                    name="trainer_code"
                                                                    value="{{ $instructor->trainer_code }}" required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Nama Lengkap</label>
                                                                <input type="text" class="form-control"
                                                                    name="trainer_name"
                                                                    value="{{ $instructor->trainer_name }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Spesialisasi</label>
                                                                <input type="text" class="form-control"
                                                                    name="specialization"
                                                                    value="{{ $instructor->specialization }}" required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Level</label>
                                                                <select class="form-select" name="level" required>
                                                                    <option value="JUNIOR"
                                                                        {{ $instructor->level?->value == 'JUNIOR' ? 'selected' : '' }}>
                                                                        Junior</option>
                                                                    <option value="MID"
                                                                        {{ $instructor->level?->value == 'MID' ? 'selected' : '' }}>
                                                                        Mid</option>
                                                                    <option value="SENIOR"
                                                                        {{ $instructor->level?->value == 'SENIOR' ? 'selected' : '' }}>
                                                                        Senior</option>
                                                                    <option value="EXPERT"
                                                                        {{ $instructor->level?->value == 'EXPERT' ? 'selected' : '' }}>
                                                                        Expert</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Daily Rate (Rp)</label>
                                                                <input type="number" class="form-control" name="daily_rate"
                                                                    value="{{ $instructor->daily_rate }}" required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Status</label>
                                                                <select class="form-select" name="status" required>
                                                                    <option value="ACTIVE"
                                                                        {{ $instructor->status?->value == 'ACTIVE' ? 'selected' : '' }}>
                                                                        Aktif</option>
                                                                    <option value="INACTIVE"
                                                                        {{ $instructor->status?->value == 'INACTIVE' ? 'selected' : '' }}>
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
                                            <p class="text-muted mb-0">Belum ada data instruktur</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @include('partials.pagination', ['paginator' => $instructors])
                </div>
            </div>
        </div>
    </div>

    <!-- Add Instructor Modal -->
    <div class="modal fade" id="addInstructorModal" tabindex="-1" aria-labelledby="addInstructorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form action="{{ route('education.instructor.store') }}" method="POST" class="w-100">
                    @csrf
                    <div class="modal-header">
                        <h3 class="modal-title fs-5" id="addInstructorModalLabel">Tambah Instruktur Baru</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kode Trainer</label>
                                <input type="text" class="form-control" name="trainer_code" placeholder="TRN-001"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="trainer_name"
                                    placeholder="Masukkan nama lengkap" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Spesialisasi</label>
                                <input type="text" class="form-control" name="specialization"
                                    placeholder="Masukkan spesialisasi" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Level</label>
                                <select class="form-select" name="level" required>
                                    <option value="">Pilih Level</option>
                                    <option value="JUNIOR">Junior</option>
                                    <option value="MID">Mid</option>
                                    <option value="SENIOR">Senior</option>
                                    <option value="EXPERT">Expert</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Daily Rate (Rp)</label>
                                <input type="number" class="form-control" name="daily_rate" placeholder="0" required>
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
                    text: `Instruktur "${name}" akan dihapus!`,
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
