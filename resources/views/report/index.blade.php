@extends('layouts.default')

@section('title', 'Laporan')

@section('breadcrumb')
    <li class="breadcrumb-item active">Laporan</li>
@endsection

@section('content')
    <div class="row">
        <!-- Summary Cards -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="text-white mb-1">150</h4>
                            <p class="text-white mb-0">Total Peserta</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fa-solid fa-users fa-2x text-white opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="text-white mb-1">25</h4>
                            <p class="text-white mb-0">Total Course</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fa-solid fa-book fa-2x text-white opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="text-white mb-1">12</h4>
                            <p class="text-white mb-0">Instruktor Aktif</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fa-solid fa-chalkboard-teacher fa-2x text-white opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="text-white mb-1">Rp 45.5 Jt</h4>
                            <p class="text-white mb-0">Pendapatan Bulan Ini</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fa-solid fa-money-bill-wave fa-2x text-white opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Filter Section -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h3>Filter Laporan</h3>
                </div>
                <div class="card-body">
                    <form class="row g-3">
                        <div class="col-md-3">
                            <label for="tanggalMulai" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tanggalMulai">
                        </div>
                        <div class="col-md-3">
                            <label for="tanggalSelesai" class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="tanggalSelesai">
                        </div>
                        <div class="col-md-3">
                            <label for="filterCourse" class="form-label">Course</label>
                            <select class="form-select" id="filterCourse">
                                <option selected value="">Semua Course</option>
                                <option value="1">Dasar Pemrograman Web</option>
                                <option value="2">Flutter Mobile Development</option>
                                <option value="3">Machine Learning Fundamentals</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filterStatus" class="form-label">Status</label>
                            <select class="form-select" id="filterStatus">
                                <option selected value="">Semua Status</option>
                                <option value="selesai">Selesai</option>
                                <option value="berlangsung">Berlangsung</option>
                                <option value="batal">Dibatalkan</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fa-solid fa-search me-2"></i>Cari
                            </button>
                            <button type="button" class="btn btn-success me-2">
                                <i class="fa-solid fa-file-excel me-2"></i>Export Excel
                            </button>
                            <button type="button" class="btn btn-danger">
                                <i class="fa-solid fa-file-pdf me-2"></i>Export PDF
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Report Table -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h3>Data Laporan Training</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th width="50">No</th>
                                    <th>Tanggal</th>
                                    <th>Course</th>
                                    <th>Peserta</th>
                                    <th>Instruktor</th>
                                    <th>Durasi</th>
                                    <th>Status</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>05 Jan 2026</td>
                                    <td>Dasar Pemrograman Web</td>
                                    <td>Budi Santoso</td>
                                    <td>John Doe</td>
                                    <td>40 Jam</td>
                                    <td><span class="badge bg-success">Lulus</span></td>
                                    <td>85</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>05 Jan 2026</td>
                                    <td>Dasar Pemrograman Web</td>
                                    <td>Siti Aminah</td>
                                    <td>John Doe</td>
                                    <td>40 Jam</td>
                                    <td><span class="badge bg-success">Lulus</span></td>
                                    <td>92</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>06 Jan 2026</td>
                                    <td>Flutter Mobile Development</td>
                                    <td>Andi Pratama</td>
                                    <td>Jane Smith</td>
                                    <td>50 Jam</td>
                                    <td><span class="badge bg-warning text-dark">Berlangsung</span></td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>07 Jan 2026</td>
                                    <td>Machine Learning Fundamentals</td>
                                    <td>Rini Wulandari</td>
                                    <td>Ahmad Fauzi</td>
                                    <td>60 Jam</td>
                                    <td><span class="badge bg-danger">Tidak Lulus</span></td>
                                    <td>55</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>08 Jan 2026</td>
                                    <td>Dasar Pemrograman Web</td>
                                    <td>Dedi Kurniawan</td>
                                    <td>John Doe</td>
                                    <td>40 Jam</td>
                                    <td><span class="badge bg-secondary">Dibatalkan</span></td>
                                    <td>-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation" class="mt-4">
                        <ul class="pagination justify-content-end">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
