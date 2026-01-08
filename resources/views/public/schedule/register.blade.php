@extends('layouts.public')

@section('title', 'Register for Training')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('public.index') }}">Schedules</a></li>
    <li class="breadcrumb-item active">Register</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header pb-0 card-no-border">
                    <h3>Register for {{ $schedule->course->name ?? 'Course' }}</h3>
                    <p class="mt-2 text-muted">
                        Date: {{ $schedule->date->format('d M Y') }} <br>
                        Instructor: {{ $schedule->instructor->name ?? '-' }}
                    </p>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ route('public.store', $schedule->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="user_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control @error('user_name') is-invalid @enderror"
                                id="user_name" name="user_name" value="{{ old('user_name') }}" required>
                            @error('user_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="user_phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control @error('user_phone') is-invalid @enderror"
                                id="user_phone" name="user_phone" value="{{ old('user_phone') }}" required>
                            @error('user_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Submit Registration</button>
                            <a href="{{ route('public.index') }}" class="btn btn-light">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
