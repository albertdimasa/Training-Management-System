@extends('layouts.default')

@section('title', 'Training Batch')

@section('breadcrumb')
    <li class="breadcrumb-item">Education</li>
    <li class="breadcrumb-item active">Training Batch</li>
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
                            <h3>Daftar Training Batch</h3>
                            <p class="desc mb-0 mt-1">Jadwal batch pelatihan</p>
                        </div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBatchModal">
                            <i class="fa-solid fa-plus me-2"></i>Tambah Batch
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Batch</th>
                                    <th>Course</th>
                                    <th>Instruktur</th>
                                    <th>Venue</th>
                                    <th>Tipe</th>
                                    <th>Tanggal</th>
                                    <th>Quota</th>
                                    <th>Enrolled</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($batches as $batch)
                                    <tr>
                                        <td>{{ $loop->iteration + ($batches->currentPage() - 1) * $batches->perPage() }}
                                        </td>
                                        <td><code>{{ $batch->batch_code }}</code></td>
                                        <td>{{ $batch->course->course_title ?? '-' }}</td>
                                        <td>{{ $batch->instructor->trainer_name ?? '-' }}</td>
                                        <td>{{ $batch->venue->venue_name ?? '-' }}</td>
                                        <td>
                                            @switch($batch->execution_type?->value)
                                                @case('PUBLIC')
                                                    <span class="badge badge-light-primary">Public</span>
                                                @break

                                                @case('INHOUSE')
                                                    <span class="badge badge-light-success">Inhouse</span>
                                                @break

                                                @case('ONLINE')
                                                    <span class="badge badge-light-info">Online</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td>{{ $batch->start_date->format('d M Y') }}</td>
                                        <td>{{ $batch->quota }}</td>
                                        <td>{{ $batch->enrollments_count ?? 0 }}</td>
                                        <td>
                                            @switch($batch->status?->value)
                                                @case('PLANNED')
                                                    <span class="badge badge-light-secondary">Planned</span>
                                                @break

                                                @case('OPEN')
                                                    <span class="badge badge-light-primary">Open</span>
                                                @break

                                                @case('ONGOING')
                                                    <span class="badge badge-light-warning">Ongoing</span>
                                                @break

                                                @case('COMPLETED')
                                                    <span class="badge badge-light-success">Completed</span>
                                                @break

                                                @case('CANCELLED')
                                                    <span class="badge badge-light-danger">Cancelled</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal"
                                                data-bs-target="#editBatchModal{{ $batch->id }}">
                                                <i class="fa-solid fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger btn-delete"
                                                data-name="{{ $batch->batch_code }}"
                                                data-url="{{ route('education.batch.destroy', $batch) }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editBatchModal{{ $batch->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <form action="{{ route('education.batch.update', $batch) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h3 class="modal-title fs-5">Edit Batch</h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Kode Batch</label>
                                                                <input type="text" class="form-control" name="batch_code"
                                                                    value="{{ $batch->batch_code }}" required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Course</label>
                                                                <select class="form-select" name="course_id" required>
                                                                    @foreach ($courses as $course)
                                                                        <option value="{{ $course->id }}"
                                                                            {{ $batch->course_id == $course->id ? 'selected' : '' }}>
                                                                            {{ $course->course_title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Instruktur</label>
                                                                <select class="form-select" name="trainer_id">
                                                                    <option value="">-- Pilih Instruktur --</option>
                                                                    @foreach ($instructors as $instructor)
                                                                        <option value="{{ $instructor->id }}"
                                                                            {{ $batch->trainer_id == $instructor->id ? 'selected' : '' }}>
                                                                            {{ $instructor->trainer_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Venue</label>
                                                                <select class="form-select" name="venue_id">
                                                                    <option value="">-- Pilih Venue --</option>
                                                                    @foreach ($venues as $venue)
                                                                        <option value="{{ $venue->id }}"
                                                                            {{ $batch->venue_id == $venue->id ? 'selected' : '' }}>
                                                                            {{ $venue->venue_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <label class="form-label">Tipe Eksekusi</label>
                                                                <select class="form-select" name="execution_type" required>
                                                                    <option value="PUBLIC"
                                                                        {{ $batch->execution_type?->value == 'PUBLIC' ? 'selected' : '' }}>
                                                                        Public</option>
                                                                    <option value="INHOUSE"
                                                                        {{ $batch->execution_type?->value == 'INHOUSE' ? 'selected' : '' }}>
                                                                        Inhouse</option>
                                                                    <option value="ONLINE"
                                                                        {{ $batch->execution_type?->value == 'ONLINE' ? 'selected' : '' }}>
                                                                        Online</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label class="form-label">Quota</label>
                                                                <input type="number" class="form-control" name="quota"
                                                                    value="{{ $batch->quota }}" min="5"
                                                                    max="100" required>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label class="form-label">Status</label>
                                                                <select class="form-select" name="status" required>
                                                                    <option value="PLANNED"
                                                                        {{ $batch->status?->value == 'PLANNED' ? 'selected' : '' }}>
                                                                        Planned</option>
                                                                    <option value="OPEN"
                                                                        {{ $batch->status?->value == 'OPEN' ? 'selected' : '' }}>
                                                                        Open</option>
                                                                    <option value="ONGOING"
                                                                        {{ $batch->status?->value == 'ONGOING' ? 'selected' : '' }}>
                                                                        Ongoing</option>
                                                                    <option value="COMPLETED"
                                                                        {{ $batch->status?->value == 'COMPLETED' ? 'selected' : '' }}>
                                                                        Completed</option>
                                                                    <option value="CANCELLED"
                                                                        {{ $batch->status?->value == 'CANCELLED' ? 'selected' : '' }}>
                                                                        Cancelled</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Tanggal Mulai</label>
                                                                <input type="date" class="form-control"
                                                                    name="start_date"
                                                                    value="{{ $batch->start_date->format('Y-m-d') }}"
                                                                    required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Tanggal Selesai</label>
                                                                <input type="date" class="form-control"
                                                                    name="end_date"
                                                                    value="{{ $batch->end_date->format('Y-m-d') }}"
                                                                    required>
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
                                            <td colspan="11" class="text-center py-4">
                                                <p class="text-muted mb-0">Belum ada data batch</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @include('partials.pagination', ['paginator' => $batches])
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Batch Modal -->
        <div class="modal fade" id="addBatchModal" tabindex="-1" aria-labelledby="addBatchModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <form action="{{ route('education.batch.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h3 class="modal-title fs-5">Tambah Batch Baru</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kode Batch</label>
                                    <input type="text" class="form-control" name="batch_code" placeholder="BATCH0001"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Course</label>
                                    <select class="form-select" name="course_id" required>
                                        <option value="">-- Pilih Course --</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->course_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Instruktur</label>
                                    <select class="form-select" name="trainer_id">
                                        <option value="">-- Pilih Instruktur --</option>
                                        @foreach ($instructors as $instructor)
                                            <option value="{{ $instructor->id }}">{{ $instructor->trainer_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Venue</label>
                                    <select class="form-select" name="venue_id">
                                        <option value="">-- Pilih Venue --</option>
                                        @foreach ($venues as $venue)
                                            <option value="{{ $venue->id }}">{{ $venue->venue_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Tipe Eksekusi</label>
                                    <select class="form-select" name="execution_type" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="PUBLIC">Public</option>
                                        <option value="INHOUSE">Inhouse</option>
                                        <option value="ONLINE">Online</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Quota</label>
                                    <input type="number" class="form-control" name="quota" value="20" min="5"
                                        max="100" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" name="status" required>
                                        <option value="PLANNED">Planned</option>
                                        <option value="OPEN">Open</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Mulai</label>
                                    <input type="date" class="form-control" name="start_date" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Selesai</label>
                                    <input type="date" class="form-control" name="end_date" required>
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
                        text: `Batch "${name}" akan dihapus!`,
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
