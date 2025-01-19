<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AccountPatientController;
use App\Http\Controllers\DiscussionAnswerController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RecordMedicalController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ProfileController;

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

Route::view('/', 'home');
Route::view('/about', 'about');
Route::view('/service', 'service');

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


Route::middleware(['auth:doctor'])->group(function () {

    Route::get('/doctor/dashboard', [DoctorController::class, 'index'])->name('doctor.dashboard');
});

Route::middleware(['auth:patient'])->group(function () {
    Route::get('/patient/dashboard', [PatientController::class, 'index'])->name('patient.dashboard');
    Route::get('/patient/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/patient/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/patient/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/patient/hewan/add-hewan', [ProfileController::class, 'createHewan'])->name('hewan.create');
    Route::post('/patient/hewan/store', [ProfileController::class, 'storeHewan'])->name('hewan.store');
    Route::get('/patient/hewan/edit/{id}', [ProfileController::class, 'editHewan'])->name('hewan.edit');
    Route::put('/patient/hewan/update/{id}', [ProfileController::class, 'updateHewan'])->name('hewan.update');
    Route::delete('/patient/hewan/{id}/delete', [ProfileController::class, 'deleteHewan'])->name('hewan.delete');

    Route::get('/patient/reservation', [ReservationController::class, 'index'])->name('reservation.index');
    Route::post('/patient/reservation/getAvailableSlots', [ReservationController::class, 'getAvailableSlots'])->name('reservasi.getAvailableSlots');
    Route::post('/patient/reservation/store', [ReservationController::class, 'store'])->name('reservation.store');

});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/article', [ArticleController::class, 'index'])->name('article.index');
    Route::get('/admin/article/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/admin/article', [ArticleController::class, 'store'])->name('artikel.store');
    Route::get('/admin/article/edit/{id}', [ArticleController::class, 'edit'])->name('article.edit');
    Route::put('/admin/article/{artikel}', [ArticleController::class, 'update'])->name('article.update');
    Route::delete('/admin/article/delete/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');
    Route::get('/admin/article/{id}', [ArticleController::class, 'show'])->name('article.show');

    Route::get('/admin/account-patient', [AccountPatientController::class, 'index'])->name('account-patient.index');
    Route::get('/admin/account-patient/create', [AccountPatientController::class, 'create'])->name('account-patient.create');
    Route::post('/admin/account-patient', [AccountPatientController::class, 'store'])->name('account-patient.store');


});

Route::middleware('multi.guard')->group(function () {
    Route::get('discussions', [DiscussionController::class, 'index'])->name('discussion.index');
    Route::post('discussions', [DiscussionController::class, 'store'])->name('discussion.store');
    Route::get('/discussion-answer/{id}', [DiscussionAnswerController::class, 'show'])->name('discussion_answer.show');
    Route::post('/discussion-answer/{id}', [DiscussionAnswerController::class, 'store'])->name('discussion_answer.store');
});

// Route untuk Akun Pasien
// Route::get('/admin/akun-pasien', [AccountPatientController::class, 'index'])->name('akun-pasien.index');

// Route untuk Reservasi
// Route::get('/reservasi', [ReservationController::class, 'index'])->name('reservasi.index');

// Route untuk Rekam Medis
Route::get('/rekam-medis', [RecordMedicalController::class, 'index'])->name('rekam-medis.index');

// Route untuk Forum
Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
