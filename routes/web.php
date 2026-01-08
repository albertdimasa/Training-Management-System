<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\InstructorController;
use App\Http\Controllers\Master\CourseController;
use App\Http\Controllers\Report\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('master')->name('master.')->group(function () {
    // Instructor routes
    Route::get('/instructor', [InstructorController::class, 'index'])->name('instructor');
    Route::post('/instructor', [InstructorController::class, 'store'])->name('instructor.store');
    Route::put('/instructor/{instructor}', [InstructorController::class, 'update'])->name('instructor.update');
    Route::delete('/instructor/{instructor}', [InstructorController::class, 'destroy'])->name('instructor.destroy');

    // Course routes
    Route::get('/course', [CourseController::class, 'index'])->name('course');
    Route::post('/course', [CourseController::class, 'store'])->name('course.store');
    Route::put('/course/{course}', [CourseController::class, 'update'])->name('course.update');
    Route::delete('/course/{course}', [CourseController::class, 'destroy'])->name('course.destroy');
});

Route::get('/report', [ReportController::class, 'index'])->name('report');
