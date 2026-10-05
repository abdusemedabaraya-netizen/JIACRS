<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Breeze dashboard (redirects staff to the AdminLTE dashboard)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = auth()->user();

    // Staff go to the AdminLTE dashboard
    if ($user->hasAnyRole(['Super Admin', 'Admin', 'Investigator'])) {
        return redirect()->route('admin.dashboard');
    }

    // Normal users keep the simple page for now
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin area (AdminLTE) - staff only
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:Super Admin|Admin|Investigator'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    });

require __DIR__.'/auth.php';