@extends('layouts.default')

@section('title', 'Master Venue')

@section('breadcrumb')
    <li class="breadcrumb-item">Master</li>
    <li class="breadcrumb-item active">Venue</li>
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
                            <h3>Daftar Venue</h3>
                            <p class="desc mb-0 mt-1">Kelola data tempat pelatihan</p>
                        </div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVenueModal">
                            <i class="fa-solid fa-plus me-2"></i>Tambah Venue
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Venue</th>
                                    <th>Kota</th>
                                    <th>Kapasitas</th>
                                    <th>Tipe</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($venues as $venue)
                                    <tr>
                                        <td>{{ $loop->iteration + ($venues->currentPage() - 1) * $venues->perPage() }}</td>
                                        <td>{{ $venue->venue_name }}</td>
                                        <td>{{ $venue->city }}</td>
                                        <td>{{ $venue->capacity }} orang</td>
                                        <td>
                                            @switch($venue->venue_type?->value)
                                                @case('INHOUSE')
                                                    <span class="badge badge-light-primary">In-House</span>
                                                @break

                                                @case('CLIENT_SITE')
                                                    <span class="badge badge-light-success">Client Site</span>
                                                @break

                                                @case('HOTEL')
                                                    <span class="badge badge-light-warning">Hotel</span>
                                                @break

                                                @case('ONLINE')
                                                    <span class="badge badge-light-info">Online</span>
                                                @break

                                                @default
                                                    <span
                                                        class="badge badge-light-secondary">{{ $venue->venue_type?->value }}</span>
                                            @endswitch
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal"
                                                data-bs-target="#editVenueModal{{ $venue->id }}">
                                                <i class="fa-solid fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger btn-delete"
                                                data-id="{{ $venue->id }}" data-name="{{ $venue->venue_name }}"
                                                data-url="{{ route('master.venue.destroy', $venue) }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editVenueModal{{ $venue->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('master.venue.update', $venue) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h3 class="modal-title fs-5">Edit Venue</h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Venue</label>
                                                            <input type="text" class="form-control" name="venue_name"
                                                                value="{{ $venue->venue_name }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Kota</label>
                                                            <input type="text" class="form-control" name="city"
                                                                value="{{ $venue->city }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Kapasitas</label>
                                                            <input type="number" class="form-control" name="capacity"
                                                                value="{{ $venue->capacity }}" min="1" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Tipe Venue</label>
                                                            <select class="form-select" name="venue_type" required>
                                                                <option value="INHOUSE"
                                                                    {{ $venue->venue_type?->value == 'INHOUSE' ? 'selected' : '' }}>
                                                                    In-House</option>
                                                                <option value="CLIENT_SITE"
                                                                    {{ $venue->venue_type?->value == 'CLIENT_SITE' ? 'selected' : '' }}>
                                                                    Client Site</option>
                                                                <option value="HOTEL"
                                                                    {{ $venue->venue_type?->value == 'HOTEL' ? 'selected' : '' }}>
                                                                    Hotel</option>
                                                                <option value="ONLINE"
                                                                    {{ $venue->venue_type?->value == 'ONLINE' ? 'selected' : '' }}>
                                                                    Online</option>
                                                            </select>
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
                                            <td colspan="6" class="text-center py-4">
                                                <p class="text-muted mb-0">Belum ada data venue</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @include('partials.pagination', ['paginator' => $venues])
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Venue Modal -->
        <div class="modal fade" id="addVenueModal" tabindex="-1" aria-labelledby="addVenueModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('master.venue.store') }}" method="POST" class="w-100">
                        @csrf
                        <div class="modal-header">
                            <h3 class="modal-title fs-5" id="addVenueModalLabel">Tambah Venue Baru</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Venue</label>
                                <input type="text" class="form-control" name="venue_name"
                                    placeholder="Masukkan nama venue" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kota</label>
                                <input type="text" class="form-control" name="city" placeholder="Masukkan kota"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kapasitas</label>
                                <input type="number" class="form-control" name="capacity" placeholder="100" min="1"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tipe Venue</label>
                                <select class="form-select" name="venue_type" required>
                                    <option value="">Pilih Tipe</option>
                                    <option value="INHOUSE">In-House</option>
                                    <option value="CLIENT_SITE">Client Site</option>
                                    <option value="HOTEL">Hotel</option>
                                    <option value="ONLINE">Online</option>
                                </select>
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
                        text: `Data venue "${name}" akan dihapus!`,
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
