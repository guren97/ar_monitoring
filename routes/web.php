<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccomplishmentReportController;
use Illuminate\Support\Facades\Route;

// Redirect root to login view
Route::get('/', function () {
    return view('auth.login');
});

// Dashboard route with middleware for authenticated and verified users
Route::get('/dashboard', 
    [AccomplishmentReportController::class, 'show_counts'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard'); 

// Group routes requiring authentication
Route::middleware('auth')->group(function () {
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Monitoring dashboard
    Route::get('/monitoring', [AccomplishmentReportController::class,'index'])->name('monitoring');

    // CRUD for Accomplishment Reports
    Route::get('/accomplishment-reports/{id}/edit', [AccomplishmentReportController::class, 'edit'])->name('accomplishment_reports.edit');
    Route::put('/accomplishment-reports/{id}', [AccomplishmentReportController::class, 'update']); 
    Route::delete('/accomplishment-reports/{id}', [AccomplishmentReportController::class, 'destroy'])->name('accomplishment_reports.destroy');
    
    // Store a new accomplishment report
    Route::post('/accomplishment-reports', [AccomplishmentReportController::class, 'store'])->name('accomplishment_reports.store');
});

require __DIR__.'/auth.php';
