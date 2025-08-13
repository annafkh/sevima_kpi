<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\KpiIndicatorController;
use App\Http\Controllers\KpiScoreController;
use App\Http\Controllers\KpiCategoryController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\KpiSummaryController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\DashboardKaryawanController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProgressTaskController;

Route::get('/', function () {
    return redirect()->route('login');
});
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/chart-data', [ChartController::class, 'getChartData'])->middleware('auth');
    Route::get('/chart-data/semester', [KpiSummaryController::class, 'getSemesterSummary']);
    Route::get('/chart-detail/{tahun}/{semester}', [ChartController::class, 'chartDetail']);
    Route::get('/leader/chart-data/semester', [ChartController::class, 'semesterForLeader']);
    Route::get('/leader/chart-detail/{tahun}/{semester}', [ChartController::class, 'detailForLeader']);
});

Route::get('/leader/chart-data/semester', [ChartController::class, 'semesterForLeader']);

Route::middleware(['auth', RoleMiddleware::class . ':hc'])->group(function () {
    Route::resource('karyawans', KaryawanController::class);
});


Route::middleware(['auth', RoleMiddleware::class . ':hc,leader'])->group(function () {
    Route::resource('kpi_indicators', KpiIndicatorController::class);
});

Route::middleware(['auth', RoleMiddleware::class . ':hc,leader'])->group(function () {
    Route::resource('kpi_scores', KpiScoreController::class);
     Route::delete('/kpi_scores/{id}', [KpiScoreController::class, 'destroy'])->name('kpi_scores.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/progress', [ProgressTaskController::class, 'index'])->name('progress.index');
    Route::post('/progress', [ProgressTaskController::class, 'store'])->name('progress.store');
    Route::post('/progress/nilai/{karyawan}', [ProgressTaskController::class, 'nilaiOtomatis'])->name('progress.nilaiOtomatis');
    Route::get('/progress/{id}/edit', [ProgressTaskController::class, 'edit'])->name('progress.edit');
    Route::delete('/progress/{id}', [ProgressTaskController::class, 'destroy'])->name('progress.destroy');
    Route::put('/progress/{id}', [ProgressTaskController::class, 'update'])->name('progress.update');
    Route::get('/pelanggaran/{id}/edit', [ProgressTaskController::class, 'editPelanggaran'])->name('pelanggaran.edit');
    Route::put('/pelanggaran/{id}', [ProgressTaskController::class, 'updatePelanggaran'])->name('pelanggaran.update');
    Route::delete('/pelanggaran/{id}', [ProgressTaskController::class, 'destroyPelanggaran'])->name('pelanggaran.destroy');
});


Route::middleware(['auth', RoleMiddleware::class . ':hc'])->group(function () {
    Route::resource('kpi_categories', KpiCategoryController::class);
});


Route::middleware(['auth', RoleMiddleware::class . ':hc,leader'])->group(function () {
    Route::get('/kpi/summary', [KpiSummaryController::class, 'index'])->name('kpi.summary');
    Route::get('/kpi/summary/{karyawanId}/detail', [KpiSummaryController::class, 'show'])->name('kpi.summary.detail');
    Route::delete('/kpi_scores/{id}', [KpiSummaryController::class, 'destroy'])->name('kpi_scores.destroy');
    Route::get('/kpi/summary/detail', [KpiSummaryController::class, 'summary'])->name('kpi.summary.detail');
});


Route::middleware(['auth', RoleMiddleware::class . ':hc,leader'])->group(function () {
    Route::get('/admin/register-user', [AdminUserController::class, 'create'])->name('admin.register-user');
    Route::post('/admin/register-user', [AdminUserController::class, 'store'])->name('admin.register-user.store');
});


// Route::resource('users', UserController::class);
// Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

Route::middleware(['auth', RoleMiddleware::class . ':hc,leader'])->group(function () {
    Route::resource('users', UserController::class);
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/karyawan', [DashboardKaryawanController::class, 'index'])->name('dashboard.kpikaryawan');
});
