@extends('layouts.default')

@section('page_title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="row">
        <!-- Summary Cards -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="text-white mb-1">12</h4>
                            <p class="text-white mb-0">Total Instruktor</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fa-solid fa-chalkboard-teacher fa-2x text-white opacity-50"></i>
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
                            <h4 class="text-white mb-1">150</h4>
                            <p class="text-white mb-0">Peserta Aktif</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fa-solid fa-users fa-2x text-white opacity-50"></i>
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
                            <h4 class="text-white mb-1">8</h4>
                            <p class="text-white mb-0">Training Bulan Ini</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fa-solid fa-calendar fa-2x text-white opacity-50"></i>
                        </div>
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
        <!-- Course Populer Chart -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header card-no-border pb-0">
                    <div class="header-top">
                        <h3>Course Populer</h3>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" id="courseDropdown" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                2026
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="courseDropdown">
                                <a class="dropdown-item" href="#">2025</a>
                                <a class="dropdown-item" href="#">2026</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div id="coursePopularChart"></div>
                </div>
            </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header card-no-border pb-0">
                    <h3>Aktivitas Terbaru</h3>
                </div>
                <div class="card-body pt-2">
                    <ul class="notification">
                        <li class="d-flex">
                            <div class="activity-dot-primary"></div>
                            <div class="w-100 ms-3">
                                <p class="d-flex justify-content-between mb-2">
                                    <span class="date-content bg-light-primary">08 Jan 2026</span>
                                    <span>Hari ini</span>
                                </p>
                                <h6 class="f-w-600">Peserta baru mendaftar<span class="dot-notification"></span></h6>
                                <p class="f-m-light mb-0">Budi Santoso mendaftar course "Dasar Pemrograman Web"</p>
                            </div>
                        </li>
                        <li class="d-flex">
                            <div class="activity-dot-success"></div>
                            <div class="w-100 ms-3">
                                <p class="d-flex justify-content-between mb-2">
                                    <span class="date-content bg-light-success">08 Jan 2026</span>
                                    <span>5 jam lalu</span>
                                </p>
                                <h6 class="f-w-600">Training selesai<span class="dot-notification"></span></h6>
                                <p class="f-m-light mb-0">Training "UI/UX Design Principles" telah selesai</p>
                            </div>
                        </li>
                        <li class="d-flex">
                            <div class="activity-dot-warning"></div>
                            <div class="w-100 ms-3">
                                <p class="d-flex justify-content-between mb-2">
                                    <span class="date-content bg-light-warning">07 Jan 2026</span>
                                    <span>1 hari lalu</span>
                                </p>
                                <h6 class="f-w-600">Course baru ditambahkan<span class="dot-notification"></span></h6>
                                <p class="f-m-light mb-0">Admin menambahkan course "DevOps Fundamentals"</p>
                            </div>
                        </li>
                        <li class="d-flex">
                            <div class="activity-dot-secondary"></div>
                            <div class="w-100 ms-3">
                                <p class="d-flex justify-content-between mb-2">
                                    <span class="date-content bg-light-secondary">06 Jan 2026</span>
                                    <span>2 hari lalu</span>
                                </p>
                                <h6 class="f-w-600">Instruktor baru bergabung<span class="dot-notification"></span></h6>
                                <p class="f-m-light mb-0">Maria Garcia bergabung sebagai instruktor</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script>
        // Course Populer Chart
        var options = {
            series: [{
                data: [120, 95, 88, 72]
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    horizontal: true,
                    distributed: true,
                    barHeight: '85%',
                }
            },
            dataLabels: {
                enabled: true,
                textAnchor: 'start',
                style: {
                    colors: ['#fff']
                },
                formatter: function(val, opt) {
                    return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
                },
                offsetX: 0,
            },
            colors: ['#7366ff', '#51bb25', '#f73164', '#f8d62b'],
            xaxis: {
                categories: ['Web Development', 'Mobile Dev', 'Data Science', 'UI/UX Design'],
            },
            yaxis: {
                labels: {
                    show: false
                }
            },
            grid: {
                show: false,
            },
            legend: {
                show: false
            },
            tooltip: {
                theme: 'dark',
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function() {
                            return ''
                        }
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#coursePopularChart"), options);
        chart.render();
    </script>
@endpush
