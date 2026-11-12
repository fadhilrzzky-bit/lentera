<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Halaman publik (sebelum login)
Route::get('/', [AuthController::class, 'landing'])->name('landing');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard (wajib login)
Route::middleware('auth.session')->group(function () {
    Route::get('/overview', [DashboardController::class, 'overview'])->name('overview');
    Route::get('/scholarships', [DashboardController::class, 'scholarships'])->name('scholarships');
    Route::get('/funnel', [DashboardController::class, 'funnel'])->name('funnel');
    Route::get('/assistant', [DashboardController::class, 'assistant'])->name('assistant');
    Route::get('/export', [DashboardController::class, 'export'])->name('export');

    Route::get('/manage', [DashboardController::class, 'manage'])->name('manage');
    Route::post('/manage', [DashboardController::class, 'store'])->name('manage.store');
    Route::put('/manage/{id}', [DashboardController::class, 'update'])->name('manage.update');
    Route::delete('/manage/{id}', [DashboardController::class, 'destroy'])->name('manage.destroy');
});
