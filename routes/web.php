<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Master Controllers
use App\Http\Controllers\Master\ClientController;
use App\Http\Controllers\Master\ContactController;
use App\Http\Controllers\Master\VenueController;

// Education Controllers
use App\Http\Controllers\Education\CourseController;
use App\Http\Controllers\Education\InstructorController;
use App\Http\Controllers\Education\TrainingBatchController;
use App\Http\Controllers\Education\ParticipantController;

// Operation Controllers
use App\Http\Controllers\Operation\OrderController;
use App\Http\Controllers\Operation\InvoiceController;
use App\Http\Controllers\Operation\PaymentController;

// Financial Controllers
use App\Http\Controllers\Financial\AccountController;
use App\Http\Controllers\Financial\JournalController;
use App\Http\Controllers\Financial\BalanceSheetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Auth Routes
// return redirect / to login
Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ============================================================
    // MASTER MENU
    // ============================================================
    Route::middleware(['role:admin'])->prefix('master')->name('master.')->group(function () {
        // Client routes
        Route::get('/client', [ClientController::class, 'index'])->name('client');
        Route::post('/client', [ClientController::class, 'store'])->name('client.store');
        Route::put('/client/{client}', [ClientController::class, 'update'])->name('client.update');
        Route::delete('/client/{client}', [ClientController::class, 'destroy'])->name('client.destroy');

        // Contact routes
        Route::get('/contact', [ContactController::class, 'index'])->name('contact');
        Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
        Route::put('/contact/{contact}', [ContactController::class, 'update'])->name('contact.update');
        Route::delete('/contact/{contact}', [ContactController::class, 'destroy'])->name('contact.destroy');

        // Venue routes
        Route::get('/venue', [VenueController::class, 'index'])->name('venue');
        Route::post('/venue', [VenueController::class, 'store'])->name('venue.store');
        Route::put('/venue/{venue}', [VenueController::class, 'update'])->name('venue.update');
        Route::delete('/venue/{venue}', [VenueController::class, 'destroy'])->name('venue.destroy');
    });

    // ============================================================
    // EDUCATION MENU
    // ============================================================
    Route::middleware(['role:admin'])->prefix('education')->name('education.')->group(function () {
        // Course routes
        Route::get('/course', [CourseController::class, 'index'])->name('course');
        Route::post('/course', [CourseController::class, 'store'])->name('course.store');
        Route::put('/course/{course}', [CourseController::class, 'update'])->name('course.update');
        Route::delete('/course/{course}', [CourseController::class, 'destroy'])->name('course.destroy');

        // Instructor routes
        Route::get('/instructor', [InstructorController::class, 'index'])->name('instructor');
        Route::post('/instructor', [InstructorController::class, 'store'])->name('instructor.store');
        Route::put('/instructor/{instructor}', [InstructorController::class, 'update'])->name('instructor.update');
        Route::delete('/instructor/{instructor}', [InstructorController::class, 'destroy'])->name('instructor.destroy');

        // Training Batch routes
        Route::get('/batch', [TrainingBatchController::class, 'index'])->name('batch');
        Route::post('/batch', [TrainingBatchController::class, 'store'])->name('batch.store');
        Route::put('/batch/{batch}', [TrainingBatchController::class, 'update'])->name('batch.update');
        Route::delete('/batch/{batch}', [TrainingBatchController::class, 'destroy'])->name('batch.destroy');

        // Participant routes
        Route::get('/participant', [ParticipantController::class, 'index'])->name('participant');
        Route::post('/participant', [ParticipantController::class, 'store'])->name('participant.store');
        Route::put('/participant/{participant}', [ParticipantController::class, 'update'])->name('participant.update');
        Route::delete('/participant/{participant}', [ParticipantController::class, 'destroy'])->name('participant.destroy');
    });

    // ============================================================
    // OPERATION MENU (Read Only)
    // ============================================================
    Route::middleware(['role:admin'])->prefix('operation')->name('operation.')->group(function () {
        // Order routes
        Route::get('/order', [OrderController::class, 'index'])->name('order');

        // Invoice routes
        Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice');

        // Payment routes
        Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
    });

    // ============================================================
    // FINANCIAL MENU
    // ============================================================
    Route::middleware(['role:admin'])->prefix('financial')->name('financial.')->group(function () {
        // Account routes
        Route::get('/account', [AccountController::class, 'index'])->name('account');
        Route::post('/account', [AccountController::class, 'store'])->name('account.store');
        Route::put('/account/{account}', [AccountController::class, 'update'])->name('account.update');
        Route::delete('/account/{account}', [AccountController::class, 'destroy'])->name('account.destroy');

        // Journal routes
        Route::get('/trial-balance', [JournalController::class, 'index'])->name('trial-balance');

        // Balance Sheet routes
        Route::get('/balance-sheet', [BalanceSheetController::class, 'index'])->name('balance-sheet');
        Route::get('/balance-sheet/pdf', [BalanceSheetController::class, 'generatePdf'])->name('balance-sheet.pdf');
        Route::get('/balance-sheet/excel', [BalanceSheetController::class, 'exportExcel'])->name('balance-sheet.excel');
    });
});
