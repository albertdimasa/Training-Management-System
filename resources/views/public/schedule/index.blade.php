@extends('layouts.public')

@section('title', 'Training Schedules')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0 card-no-border">
                    <h3>Available Training Schedules</h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="table-responsive user-datatable">
                        <table class="table display dataTable">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Course</th>
                                    <th>Instructor</th>
                                    <th>Capacity</th>
                                    <th>Spots Left</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $schedule)
                                    @php
                                        $registered = $schedule->registrations->count();
                                        $spotsLeft = $schedule->capacity - $registered;
                                    @endphp
                                    <tr>
                                        <td>{{ $schedule->date->format('d M Y') }}</td>
                                        <td>{{ $schedule->course->name ?? '-' }}</td>
                                        <td>{{ $schedule->instructor->name ?? '-' }}</td>
                                        <td>{{ $schedule->capacity }}</td>
                                        <td>{{ $spotsLeft }}</td>
                                        <td>
                                            @if ($spotsLeft > 0)
                                                <a href="{{ route('public.register', $schedule->id) }}"
                                                    class="btn btn-primary btn-sm">Register</a>
                                            @else
                                                <button class="btn btn-secondary btn-sm" disabled>Full</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($schedules->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">No upcoming schedules found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
