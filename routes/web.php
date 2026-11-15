<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\ProjectExportController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\UserController;
use App\http\Controllers\DocumentCommentController;
use Illuminate\Support\Facades\Route;

// Root redirect
Route::get('/', fn() => redirect()->route('dashboard'));

// Language Switcher (no auth required)
Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/chart-data', [DashboardController::class, 'chartData'])->name('dashboard.chartData');

    // Monitoring (resource: index, create, store, show, edit, update, destroy)
    Route::resource('monitoring', MonitoringController::class);

    // Download dokumen project (Design Engineering)
    Route::get('monitoring/{monitoring}/document/download', [MonitoringController::class, 'downloadDocument'])
        ->name('monitoring.document.download');

    // Export project (PDF & Excel)
    Route::get('monitoring/{monitoring}/export/pdf',   [ProjectExportController::class, 'pdf'])->name('monitoring.export.pdf');
    Route::get('monitoring/{monitoring}/export/excel', [ProjectExportController::class, 'excel'])->name('monitoring.export.excel');

    // Documents 
    Route::get('documents', [DocumentsController::class, 'index'])->name('documents');

    // Document Comments
    Route::post('/documents/comments', [DocumentCommentController::class, 'store'])
    ->name('documents.comments.store')
    ->middleware('auth');
    Route::delete('/documents/comments/{id}', [DocumentCommentController::class, 'destroy'])
    ->name('documents.comments.destroy')
    ->middleware('auth');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update')->middleware(\App\Http\Middleware\CheckDireksi::class);
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware(\App\Http\Middleware\CheckDireksi::class);

    // Settings
    Route::get('/settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
    Route::put('/settings/profile', [\App\Http\Controllers\SettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::put('/settings/password', [\App\Http\Controllers\SettingsController::class, 'updatePassword'])->name('settings.password');
});