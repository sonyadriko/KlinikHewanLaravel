<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AccountPatientController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RecordMedicalController;
use App\Http\Controllers\ForumController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/service', function () {
    return view('service');
});

Route::get('/login', function () {
    return view('auth/login');
})->name('login');

Route::post('/login', [LoginController::class, 'processLogin'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return 'Dashboard';
})->name('dashboard');

Route::get('/register', function () {
    return view('auth/register');
})->name('register');
Route::post('/register', [RegisterController::class, 'processRegister'])->name('register.process');

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
// });
// Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
// });

Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/doctor/dashboard', [DoctorController::class, 'index'])->name('doctor.dashboard');
});

Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/patient/dashboard', [PatientController::class, 'index'])->name('patient.dashboard');
});

// Route::middleware(['auth'])->group(function () {
// Route untuk Artikel
    Route::get('/article', [ArticleController::class, 'index'])->name('article.index');
    Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/article', [ArticleController::class, 'store'])->name('artikel.store');
    Route::get('/article/edit/{id}', [ArticleController::class, 'edit'])->name('article.edit');
    Route::put('/article/{artikel}', [ArticleController::class, 'update'])->name('article.update');
    Route::delete('/article/delete/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');
    Route::get('/artikel/{id}', [ArticleController::class, 'show'])->name('artikel.show');
// });
// Route untuk Akun Pasien
Route::get('/akun-pasien', [AccountPatientController::class, 'index'])->name('akun-pasien.index');

// Route untuk Reservasi
Route::get('/reservasi', [ReservationController::class, 'index'])->name('reservasi.index');

// Route untuk Rekam Medis
Route::get('/rekam-medis', [RecordMedicalController::class, 'index'])->name('rekam-medis.index');

// Route untuk Forum
Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
