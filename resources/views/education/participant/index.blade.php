@extends('layouts.default')

@section('title', 'Peserta')

@section('breadcrumb')
    <li class="breadcrumb-item">Education</li>
    <li class="breadcrumb-item active">Peserta</li>
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
                            <h3>Daftar Peserta</h3>
                            <p class="desc mb-0 mt-1">Data peserta pelatihan</p>
                        </div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addParticipantModal">
                            <i class="fa-solid fa-plus me-2"></i>Tambah Peserta
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
                                    <th>Nama Lengkap</th>
                                    <th>Gender</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Kota</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($participants as $participant)
                                    <tr>
                                        <td>{{ $loop->iteration + ($participants->currentPage() - 1) * $participants->perPage() }}
                                        </td>
                                        <td><code>{{ $participant->participant_code }}</code></td>
                                        <td>{{ $participant->full_name }}</td>
                                        <td>
                                            @if ($participant->gender?->value == 'M')
                                                <span class="badge badge-light-primary">Laki-laki</span>
                                            @else
                                                <span class="badge badge-light-danger">Perempuan</span>
                                            @endif
                                        </td>
                                        <td>{{ $participant->dob?->format('d M Y') ?? '-' }}</td>
                                        <td>{{ $participant->city }}</td>
                                        <td>{{ $participant->phone }}</td>
                                        <td>{{ $participant->email }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal"
                                                data-bs-target="#editParticipantModal{{ $participant->id }}">
                                                <i class="fa-solid fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger btn-delete"
                                                data-name="{{ $participant->full_name }}"
                                                data-url="{{ route('education.participant.destroy', $participant) }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editParticipantModal{{ $participant->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <form action="{{ route('education.participant.update', $participant) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h3 class="modal-title fs-5">Edit Peserta</h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Kode Peserta</label>
                                                                <input type="text" class="form-control"
                                                                    name="participant_code"
                                                                    value="{{ $participant->participant_code }}" required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Nama Lengkap</label>
                                                                <input type="text" class="form-control" name="full_name"
                                                                    value="{{ $participant->full_name }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <label class="form-label">Gender</label>
                                                                <select class="form-select" name="gender" required>
                                                                    <option value="M"
                                                                        {{ $participant->gender?->value == 'M' ? 'selected' : '' }}>
                                                                        Laki-laki</option>
                                                                    <option value="F"
                                                                        {{ $participant->gender?->value == 'F' ? 'selected' : '' }}>
                                                                        Perempuan</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label class="form-label">Tanggal Lahir</label>
                                                                <input type="date" class="form-control" name="dob"
                                                                    value="{{ $participant->dob?->format('Y-m-d') }}">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label class="form-label">Kota</label>
                                                                <input type="text" class="form-control" name="city"
                                                                    value="{{ $participant->city }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Phone</label>
                                                                <input type="text" class="form-control" name="phone"
                                                                    value="{{ $participant->phone }}">
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Email</label>
                                                                <input type="email" class="form-control" name="email"
                                                                    value="{{ $participant->email }}">
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
                                            <p class="text-muted mb-0">Belum ada data peserta</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @include('partials.pagination', ['paginator' => $participants])
                </div>
            </div>
        </div>
    </div>

    <!-- Add Participant Modal -->
    <div class="modal fade" id="addParticipantModal" tabindex="-1" aria-labelledby="addParticipantModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form action="{{ route('education.participant.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h3 class="modal-title fs-5">Tambah Peserta Baru</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kode Peserta</label>
                                <input type="text" class="form-control" name="participant_code" placeholder="P00001"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="full_name"
                                    placeholder="Masukkan nama lengkap" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Gender</label>
                                <select class="form-select" name="gender" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="M">Laki-laki</option>
                                    <option value="F">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="dob">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Kota</label>
                                <input type="text" class="form-control" name="city" placeholder="Masukkan kota"
                                    required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" placeholder="08xxxxxxxxxx">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email"
                                    placeholder="email@example.com">
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
                    text: `Peserta "${name}" akan dihapus!`,
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
