@extends('layouts.default')

@section('page_title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="row">
        <!-- Summary Cards -->
        <div class="col-xl-3 col-md-6">
            <div class="card o-hidden">
                <div class="card-body bg-primary">
                    <div class="d-flex static-widget">
                        <div class="flex-grow-1">
                            <span class="m-0 text-white">Total Instruktor</span>
                            <h3 class="mb-0 f-w-700 text-white counter">12</h3>
                        </div>
                        <svg class="svg-color fill-icon">
                            <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#Profile"></use>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card o-hidden">
                <div class="card-body bg-success">
                    <div class="d-flex static-widget">
                        <div class="flex-grow-1">
                            <span class="m-0 text-white">Total Course</span>
                            <h3 class="mb-0 f-w-700 text-white counter">25</h3>
                        </div>
                        <svg class="svg-color fill-icon">
                            <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#Document"></use>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card o-hidden">
                <div class="card-body bg-warning">
                    <div class="d-flex static-widget">
                        <div class="flex-grow-1">
                            <span class="m-0 text-white">Peserta Aktif</span>
                            <h3 class="mb-0 f-w-700 text-white counter">150</h3>
                        </div>
                        <svg class="svg-color fill-icon">
                            <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#Usersinglegroup"></use>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card o-hidden">
                <div class="card-body bg-info">
                    <div class="d-flex static-widget">
                        <div class="flex-grow-1">
                            <span class="m-0 text-white">Training Bulan Ini</span>
                            <h3 class="mb-0 f-w-700 text-white counter">8</h3>
                        </div>
                        <svg class="svg-color fill-icon">
                            <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#Calendar"></use>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Training Terbaru -->
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header pb-0">
                    <h3>Training Terbaru</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Instruktor</th>
                                    <th>Tanggal</th>
                                    <th>Peserta</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Dasar Pemrograman Web</td>
                                    <td>John Doe</td>
                                    <td>08 Jan 2026</td>
                                    <td>15</td>
                                    <td><span class="badge bg-success">Berlangsung</span></td>
                                </tr>
                                <tr>
                                    <td>Flutter Mobile Development</td>
                                    <td>Jane Smith</td>
                                    <td>10 Jan 2026</td>
                                    <td>12</td>
                                    <td><span class="badge bg-primary">Terjadwal</span></td>
                                </tr>
                                <tr>
                                    <td>Machine Learning Fundamentals</td>
                                    <td>Ahmad Fauzi</td>
                                    <td>15 Jan 2026</td>
                                    <td>20</td>
                                    <td><span class="badge bg-primary">Terjadwal</span></td>
                                </tr>
                                <tr>
                                    <td>UI/UX Design Principles</td>
                                    <td>Sarah Wilson</td>
                                    <td>05 Jan 2026</td>
                                    <td>18</td>
                                    <td><span class="badge bg-secondary">Selesai</span></td>
                                </tr>
                                <tr>
                                    <td>Database Management</td>
                                    <td>John Doe</td>
                                    <td>03 Jan 2026</td>
                                    <td>10</td>
                                    <td><span class="badge bg-secondary">Selesai</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Instruktor Terbaik -->
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h3>Top Instruktor</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle me-3" src="{{ asset('assets/images/profile.png') }}"
                                    alt="user" width="40">
                                <div>
                                    <h6 class="mb-0">John Doe</h6>
                                    <small class="text-muted">Web Development</small>
                                </div>
                            </div>
                            <span class="badge bg-primary rounded-pill">45 Training</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle me-3" src="{{ asset('assets/images/profile.png') }}"
                                    alt="user" width="40">
                                <div>
                                    <h6 class="mb-0">Jane Smith</h6>
                                    <small class="text-muted">Mobile Development</small>
                                </div>
                            </div>
                            <span class="badge bg-primary rounded-pill">38 Training</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle me-3" src="{{ asset('assets/images/profile.png') }}"
                                    alt="user" width="40">
                                <div>
                                    <h6 class="mb-0">Ahmad Fauzi</h6>
                                    <small class="text-muted">Data Science</small>
                                </div>
                            </div>
                            <span class="badge bg-primary rounded-pill">32 Training</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle me-3" src="{{ asset('assets/images/profile.png') }}"
                                    alt="user" width="40">
                                <div>
                                    <h6 class="mb-0">Sarah Wilson</h6>
                                    <small class="text-muted">UI/UX Design</small>
                                </div>
                            </div>
                            <span class="badge bg-primary rounded-pill">28 Training</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Course Populer -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header pb-0">
                    <h3>Course Populer</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Kategori</th>
                                    <th>Total Peserta</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Dasar Pemrograman Web</td>
                                    <td><span class="badge bg-light text-dark">Web Development</span></td>
                                    <td>120</td>
                                </tr>
                                <tr>
                                    <td>Flutter Mobile Development</td>
                                    <td><span class="badge bg-light text-dark">Mobile</span></td>
                                    <td>95</td>
                                </tr>
                                <tr>
                                    <td>Machine Learning Fundamentals</td>
                                    <td><span class="badge bg-light text-dark">Data Science</span></td>
                                    <td>88</td>
                                </tr>
                                <tr>
                                    <td>UI/UX Design Principles</td>
                                    <td><span class="badge bg-light text-dark">Design</span></td>
                                    <td>72</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header pb-0">
                    <h3>Aktivitas Terbaru</h3>
                </div>
                <div class="card-body">
                    <ul class="activity-timeline">
                        <li class="d-flex align-items-start">
                            <div class="activity-line"></div>
                            <div class="activity-dot-primary"></div>
                            <div class="flex-grow-1">
                                <h6 class="f-w-600">Peserta baru mendaftar</h6>
                                <p class="mb-0">Budi Santoso mendaftar course "Dasar Pemrograman Web"</p>
                                <small class="text-muted">2 jam yang lalu</small>
                            </div>
                        </li>
                        <li class="d-flex align-items-start">
                            <div class="activity-dot-success"></div>
                            <div class="flex-grow-1">
                                <h6 class="f-w-600">Training selesai</h6>
                                <p class="mb-0">Training "UI/UX Design Principles" telah selesai</p>
                                <small class="text-muted">5 jam yang lalu</small>
                            </div>
                        </li>
                        <li class="d-flex align-items-start">
                            <div class="activity-dot-warning"></div>
                            <div class="flex-grow-1">
                                <h6 class="f-w-600">Course baru ditambahkan</h6>
                                <p class="mb-0">Admin menambahkan course "DevOps Fundamentals"</p>
                                <small class="text-muted">1 hari yang lalu</small>
                            </div>
                        </li>
                        <li class="d-flex align-items-start">
                            <div class="activity-dot-info"></div>
                            <div class="flex-grow-1">
                                <h6 class="f-w-600">Instruktor baru bergabung</h6>
                                <p class="mb-0">Maria Garcia bergabung sebagai instruktor</p>
                                <small class="text-muted">2 hari yang lalu</small>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
