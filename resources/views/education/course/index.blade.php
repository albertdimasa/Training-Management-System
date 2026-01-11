@extends('layouts.default')

@section('title', 'Master Course')

@section('breadcrumb')
    <li class="breadcrumb-item">Education</li>
    <li class="breadcrumb-item active">Course</li>
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
                            <h3>Daftar Course</h3>
                            <p class="desc mb-0 mt-1">Kelola data course untuk pelatihan</p>
                        </div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                            <i class="fa-solid fa-plus me-2"></i>Tambah Course
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
                                    <th>Judul Course</th>
                                    <th>Kategori</th>
                                    <th>Sertifikator</th>
                                    <th>Durasi</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($courses as $course)
                                    <tr>
                                        <td>{{ $loop->iteration + ($courses->currentPage() - 1) * $courses->perPage() }}
                                        </td>
                                        <td><code>{{ $course->course_code }}</code></td>
                                        <td>{{ $course->course_title }}</td>
                                        <td><span class="badge badge-light-primary">{{ $course->category }}</span></td>
                                        <td>{{ $course->certificator }}</td>
                                        <td>{{ $course->duration_days }} hari</td>
                                        <td>Rp {{ number_format($course->base_price, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($course->status?->value == 'ACTIVE')
                                                <span class="badge badge-light-success">Aktif</span>
                                            @else
                                                <span class="badge badge-light-danger">Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal"
                                                data-bs-target="#editCourseModal{{ $course->id }}">
                                                <i class="fa-solid fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger btn-delete"
                                                data-id="{{ $course->id }}" data-name="{{ $course->course_title }}"
                                                data-url="{{ route('education.course.destroy', $course) }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editCourseModal{{ $course->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <form action="{{ route('education.course.update', $course) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h3 class="modal-title fs-5">Edit Course</h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Kode Course</label>
                                                                <input type="text" class="form-control"
                                                                    name="course_code" value="{{ $course->course_code }}"
                                                                    required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Judul Course</label>
                                                                <input type="text" class="form-control"
                                                                    name="course_title" value="{{ $course->course_title }}"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Kategori</label>
                                                                <select class="form-select" name="category" required>
                                                                    <option value="SAFETY"
                                                                        {{ $course->category == 'SAFETY' ? 'selected' : '' }}>
                                                                        Safety</option>
                                                                    <option value="TECHNICAL"
                                                                        {{ $course->category == 'TECHNICAL' ? 'selected' : '' }}>
                                                                        Technical</option>
                                                                    <option value="MANAGEMENT"
                                                                        {{ $course->category == 'MANAGEMENT' ? 'selected' : '' }}>
                                                                        Management</option>
                                                                    <option value="COMPLIANCE"
                                                                        {{ $course->category == 'COMPLIANCE' ? 'selected' : '' }}>
                                                                        Compliance</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Sertifikator</label>
                                                                <select class="form-select" name="certificator" required>
                                                                    <option value="INTERNAL"
                                                                        {{ $course->certificator == 'INTERNAL' ? 'selected' : '' }}>
                                                                        Internal</option>
                                                                    <option value="GOV"
                                                                        {{ $course->certificator == 'GOV' ? 'selected' : '' }}>
                                                                        Government</option>
                                                                    <option value="VENDOR"
                                                                        {{ $course->certificator == 'VENDOR' ? 'selected' : '' }}>
                                                                        Vendor</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <label class="form-label">Durasi (hari)</label>
                                                                <input type="number" class="form-control"
                                                                    name="duration_days"
                                                                    value="{{ $course->duration_days }}" min="1"
                                                                    required>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label class="form-label">Harga Dasar (Rp)</label>
                                                                <input type="number" class="form-control" name="base_price"
                                                                    value="{{ $course->base_price }}" required>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label class="form-label">Status</label>
                                                                <select class="form-select" name="status" required>
                                                                    <option value="ACTIVE"
                                                                        {{ $course->status?->value == 'ACTIVE' ? 'selected' : '' }}>
                                                                        Aktif</option>
                                                                    <option value="INACTIVE"
                                                                        {{ $course->status?->value == 'INACTIVE' ? 'selected' : '' }}>
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
                                        <td colspan="9" class="text-center py-4">
                                            <p class="text-muted mb-0">Belum ada data course</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @include('partials.pagination', ['paginator' => $courses])
                </div>
            </div>
        </div>

        <!-- Add Course Modal -->
        <div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <form action="{{ route('education.course.store') }}" method="POST" class="w-100">
                        @csrf
                        <div class="modal-header">
                            <h3 class="modal-title fs-5" id="addCourseModalLabel">Tambah Course Baru</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kode Course</label>
                                    <input type="text" class="form-control" name="course_code" placeholder="CRS001"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Judul Course</label>
                                    <input type="text" class="form-control" name="course_title"
                                        placeholder="Masukkan judul course" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kategori</label>
                                    <select class="form-select" name="category" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="SAFETY">Safety</option>
                                        <option value="TECHNICAL">Technical</option>
                                        <option value="MANAGEMENT">Management</option>
                                        <option value="COMPLIANCE">Compliance</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Sertifikator</label>
                                    <select class="form-select" name="certificator" required>
                                        <option value="">Pilih Sertifikator</option>
                                        <option value="INTERNAL">Internal</option>
                                        <option value="GOV">Government</option>
                                        <option value="VENDOR">Vendor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Durasi (hari)</label>
                                    <input type="number" class="form-control" name="duration_days" placeholder="1"
                                        min="1" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Harga Dasar (Rp)</label>
                                    <input type="number" class="form-control" name="base_price" placeholder="0"
                                        required>
                                </div>
                                <div class="col-md-4 mb-3">
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
                        text: `Course "${name}" akan dihapus!`,
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
