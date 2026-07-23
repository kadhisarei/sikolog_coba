<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Teams\TeamInvitationController;
use App\Http\Middleware\EnsureTeamMembership;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DoctorManagementController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dokter\ConsultationController as DokterConsultationController;
use App\Http\Controllers\Dokter\DashboardController as DokterDashboardController;
use App\Http\Controllers\User\ConsultationController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// ============ Autentikasi ============
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ============ Area User (Pasien) ============
Route::middleware(['auth', 'role:user'])->prefix('dashboard')->name('user.')->group(function () {
    Route::get('/', [UserDashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/tes', [TestController::class, 'index'])->name('tests.index');
    Route::get('/tes/{test:slug}', [TestController::class, 'show'])->name('tests.show');
    Route::post('/tes/{test:slug}', [TestController::class, 'submit'])->name('tests.submit');
    Route::get('/tes/hasil/{result}', [TestController::class, 'result'])->name('tests.result');

    Route::get('/konsultasi', [ConsultationController::class, 'index'])->name('consultations.index');
    Route::get('/konsultasi/{dokter}/booking', [ConsultationController::class, 'create'])->name('consultations.create');
    Route::post('/konsultasi/{dokter}/booking', [ConsultationController::class, 'store'])->name('consultations.store');
    Route::post('/konsultasi/{consultation}/rating', [ConsultationController::class, 'beriRating'])->name('consultations.rating');
});

// ============ Area Dokter/Psikiater ============
Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/', [DokterDashboardController::class, 'index'])->name('dashboard');
    Route::get('/konsultasi', [DokterConsultationController::class, 'index'])->name('konsultasi.index');
    Route::patch('/konsultasi/{consultation}', [DokterConsultationController::class, 'updateStatus'])->name('konsultasi.update');
});

// ============ Area Admin ============
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dokter', [DoctorManagementController::class, 'index'])->name('dokter.index');
    Route::get('/dokter/tambah', [DoctorManagementController::class, 'create'])->name('dokter.create');
    Route::post('/dokter', [DoctorManagementController::class, 'store'])->name('dokter.store');
    Route::delete('/dokter/{dokter}', [DoctorManagementController::class, 'destroy'])->name('dokter.destroy');
});

