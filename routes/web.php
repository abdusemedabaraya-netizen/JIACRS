<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EvidenceController;
use App\Http\Controllers\InvestigationController;
use App\Http\Controllers\MyReportController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SubmitReportController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/* ---------- Public ---------- */
Route::get('/', fn () => view('welcome'));

Route::get('/report', [SubmitReportController::class, 'create'])->name('report.create');
Route::post('/report', [SubmitReportController::class, 'store'])
    ->middleware('throttle:5,1')->name('report.store');
Route::get('/report/submitted', [SubmitReportController::class, 'submitted'])->name('report.submitted');

Route::get('/track', [TrackController::class, 'index'])->name('track.index');
Route::post('/track', [TrackController::class, 'search'])
    ->middleware('throttle:10,1')->name('track.search');

/* ---------- Breeze ---------- */
Route::get('/dashboard', function () {
    if (auth()->user()->hasAnyRole(['Super Admin', 'Admin', 'Investigator'])) {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('my.reports.index');
})->middleware(['auth', 'verified'])->name('dashboard');

/* ---------- Any logged-in user ---------- */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/my/reports', [MyReportController::class, 'index'])->name('my.reports.index');
    Route::get('/my/reports/{report}', [MyReportController::class, 'show'])->name('my.reports.show');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.readAll');
});

/* ---------- Staff: Admin, Super Admin, Investigator ---------- */
Route::middleware(['auth', 'verified', 'role:Super Admin|Admin|Investigator'])
    ->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::resource('reports', ReportController::class)->only(['index', 'show', 'update', 'destroy']);
        Route::post('reports/{report}/evidence', [EvidenceController::class, 'store'])->name('evidence.store');
        Route::get('evidence/{evidence}/download', [EvidenceController::class, 'download'])->name('evidence.download');

        Route::resource('investigations', InvestigationController::class)->except(['edit']);
    });

/* ---------- Admin and Super Admin ---------- */
Route::middleware(['auth', 'verified', 'role:Super Admin|Admin'])
    ->prefix('admin')->group(function () {
        Route::resource('departments', DepartmentController::class)->except(['show']);
        Route::resource('users', UserController::class)->only(['index', 'show']);
    });

/* ---------- Super Admin only ---------- */
Route::middleware(['auth', 'verified', 'role:Super Admin'])
    ->prefix('admin')->group(function () {
        Route::get('audit-logs', [AuditLogController::class, 'index'])->name('audit-logs.index');
    });

require __DIR__.'/auth.php';
