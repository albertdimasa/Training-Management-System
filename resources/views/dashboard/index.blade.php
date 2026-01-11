@extends('layouts.default')

@section('page_title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    {{-- KPI Summary Cards Row 1 --}}
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="text-white mb-1">Rp {{ number_format($totalRevenue / 1000000, 1) }}M</h4>
                            <p class="text-white mb-0">Total Revenue (Paid)</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fa-solid fa-money-bill-wave fa-2x text-white opacity-50"></i>
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
                            <h4 class="text-white mb-1">Rp {{ number_format($pendingRevenue / 1000000, 1) }}M</h4>
                            <p class="text-white mb-0">Pending Revenue</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fa-solid fa-clock fa-2x text-white opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="text-white mb-1">{{ $invoiceOutstanding }}</h4>
                            <p class="text-white mb-0">Invoice Outstanding</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fa-solid fa-file-invoice fa-2x text-white opacity-50"></i>
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
                            <h4 class="text-white mb-1">{{ $totalBatches }}</h4>
                            <p class="text-white mb-0">Total Training Batch</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fa-solid fa-layer-group fa-2x text-white opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- KPI Summary Cards Row 2 --}}
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="text-info mb-1">{{ $totalClients }}</h4>
                            <p class="text-muted mb-0">Active Clients</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fa-solid fa-building fa-2x text-info opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="text-primary mb-1">{{ $totalParticipants }}</h4>
                            <p class="text-muted mb-0">Total Participants</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fa-solid fa-users fa-2x text-primary opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="text-success mb-1">{{ $totalInstructors }}</h4>
                            <p class="text-muted mb-0">Active Instructors</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fa-solid fa-chalkboard-teacher fa-2x text-success opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="text-warning mb-1">{{ $trainingThisMonth }}</h4>
                            <p class="text-muted mb-0">Training Bulan Ini</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fa-solid fa-calendar fa-2x text-warning opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts Row --}}
    <div class="row">
        {{-- Monthly Revenue Chart --}}
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header pb-0">
                    <h3>Trend Revenue (6 Bulan Terakhir)</h3>
                </div>
                <div class="card-body">
                    <div id="revenueChart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
        {{-- Revenue by Category Chart --}}
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h3>Revenue by Category</h3>
                </div>
                <div class="card-body">
                    <div id="categoryChart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Ranking Tables Row --}}
    <div class="row">
        {{-- Top Clients by Revenue --}}
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header pb-0">
                    <h3><i class="fa-solid fa-trophy text-warning me-2"></i>Top 5 Client by Revenue</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Client</th>
                                    <th>Industry</th>
                                    <th class="text-end">Total Revenue</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($topClientsByRevenue as $client)
                                    <tr>
                                        <td>
                                            @if ($loop->iteration == 1)
                                                <span class="badge bg-warning">1</span>
                                            @elseif ($loop->iteration == 2)
                                                <span class="badge bg-secondary">2</span>
                                            @elseif ($loop->iteration == 3)
                                                <span class="badge bg-danger">3</span>
                                            @else
                                                {{ $loop->iteration }}
                                            @endif
                                        </td>
                                        <td><strong>{{ $client->client_name }}</strong></td>
                                        <td><span class="badge badge-light-info">{{ $client->industry ?? '-' }}</span></td>
                                        <td class="text-end text-success fw-bold">Rp
                                            {{ number_format($client->total_revenue, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Belum ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Top Courses by Enrollment --}}
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header pb-0">
                    <h3><i class="fa-solid fa-book text-primary me-2"></i>Top 5 Course by Enrollment</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Course</th>
                                    <th>Category</th>
                                    <th class="text-end">Enrollments</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($topCoursesByEnrollment as $course)
                                    <tr>
                                        <td>
                                            @if ($loop->iteration == 1)
                                                <span class="badge bg-warning">1</span>
                                            @elseif ($loop->iteration == 2)
                                                <span class="badge bg-secondary">2</span>
                                            @elseif ($loop->iteration == 3)
                                                <span class="badge bg-danger">3</span>
                                            @else
                                                {{ $loop->iteration }}
                                            @endif
                                        </td>
                                        <td><strong>{{ $course->course_title }}</strong></td>
                                        <td><span class="badge badge-light-primary">{{ $course->category ?? '-' }}</span>
                                        </td>
                                        <td class="text-end"><span
                                                class="badge bg-primary">{{ $course->enrollment_count }} peserta</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Belum ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Training & Top Instructors Row --}}
    <div class="row">
        {{-- Training Terbaru --}}
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
                                    <th>Batch</th>
                                    <th>Course</th>
                                    <th>Instruktur</th>
                                    <th>Tanggal</th>
                                    <th>Peserta</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentBatches as $batch)
                                    <tr>
                                        <td><code>{{ $batch->batch_code }}</code></td>
                                        <td>{{ $batch->course->course_title ?? '-' }}</td>
                                        <td>{{ $batch->instructor->trainer_name ?? '-' }}</td>
                                        <td>{{ $batch->start_date->format('d M Y') }}</td>
                                        <td>{{ $batch->enrollments_count }}</td>
                                        <td>
                                            @switch($batch->status?->value)
                                                @case('PLANNED')
                                                    <span class="badge bg-secondary">Planned</span>
                                                @break

                                                @case('OPEN')
                                                    <span class="badge bg-primary">Open</span>
                                                @break

                                                @case('ONGOING')
                                                    <span class="badge bg-success">Berlangsung</span>
                                                @break

                                                @case('COMPLETED')
                                                    <span class="badge bg-info">Selesai</span>
                                                @break

                                                @case('CANCELLED')
                                                    <span class="badge bg-danger">Batal</span>
                                                @break
                                            @endswitch
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Belum ada training</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Top Instruktor --}}
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h3><i class="fa-solid fa-star text-warning me-2"></i>Top Instruktur</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @forelse ($topInstructors as $instructor)
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3">
                                            <span class="avatar-title rounded-circle bg-primary px-2">
                                                {{ strtoupper(substr($instructor->trainer_name, 0, 1)) }}
                                            </span>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $instructor->trainer_name }}</h6>
                                            <small class="text-muted">{{ $instructor->specialization }}</small>
                                        </div>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">{{ $instructor->batches_count }} Batch</span>
                                </li>
                            @empty
                                <li class="list-group-item text-center">Belum ada instruktur</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            // Revenue Trend Chart (Bar)
            var revenueData = @json($monthlyRevenue);
            var revenueOptions = {
                series: [{
                    name: 'Revenue',
                    data: revenueData.map(item => item.value)
                }],
                chart: {
                    type: 'bar',
                    height: 300,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 8,
                        columnWidth: '50%',
                    }
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: revenueData.map(item => item.label),
                },
                yaxis: {
                    labels: {
                        formatter: function(val) {
                            return 'Rp ' + (val / 1000000).toFixed(1) + 'M';
                        }
                    }
                },
                colors: ['#5C61F2'],
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return 'Rp ' + val.toLocaleString('id-ID');
                        }
                    }
                }
            };
            var revenueChart = new ApexCharts(document.querySelector("#revenueChart"), revenueOptions);
            revenueChart.render();

            // Category Pie Chart
            var categoryData = @json($revenueByCategory);
            var categoryOptions = {
                series: categoryData.map(item => parseFloat(item.total_revenue)),
                chart: {
                    type: 'donut',
                    height: 300
                },
                labels: categoryData.map(item => item.category || 'Uncategorized'),
                colors: ['#5C61F2', '#F99B0D', '#51BB25', '#DC3545', '#17A2B8', '#6C757D'],
                legend: {
                    position: 'bottom'
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '60%'
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return 'Rp ' + val.toLocaleString('id-ID');
                        }
                    }
                }
            };
            var categoryChart = new ApexCharts(document.querySelector("#categoryChart"), categoryOptions);
            categoryChart.render();
        </script>
    @endpush
