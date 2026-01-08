<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\InstructorController;
use App\Http\Controllers\Master\CourseController;
use App\Http\Controllers\Report\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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
});
