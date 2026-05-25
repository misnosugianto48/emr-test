<?php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VisitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('patients', PatientController::class);

    Route::resource('visits', VisitController::class);
    Route::patch('visits/{visit}/cancel', [VisitController::class, 'cancel'])->name('visits.cancel');

    Route::resource('assessments', AssessmentController::class)->except(['create']);
    Route::get('assessments/create/{visit}', [AssessmentController::class, 'create'])->name('assessments.create');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
