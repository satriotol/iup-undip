<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\InternationalCategoryController;
use App\Http\Controllers\InternationalFundingController;
use App\Http\Controllers\InternationalMahasiswaController;
use App\Http\Controllers\InternationalProgramController;
use App\Http\Controllers\InternationalStatusController;
use App\Http\Controllers\InternationalUniversityController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MahasiswaSemesterController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SemesterStatusController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/.env', function () {
    return 'Hayoooo';
});
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/export', [DashboardController::class, 'fileExport'])->name('dashboard.fileExport');
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::post('mahasiswa/assignSemester/{userMahasiswa}', [MahasiswaController::class, 'assignSemester'])->name('mahasiswa.assignSemester');
    Route::delete('mahasiswa/assignSemester/destroy/{mahasiswaSemester}', [MahasiswaController::class, 'destroySemester'])->name('mahasiswa.destroySemester');
    Route::resource('major', MajorController::class);
    Route::resource('batch', BatchController::class);
    Route::resource('country', CountryController::class);
    Route::resource('semester', SemesterController::class);
    Route::resource('semesterStatus', SemesterStatusController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);
    Route::resource('admin', AdminController::class);
    Route::resource('internationalUniversity', InternationalUniversityController::class);
    Route::resource('internationalProgram', InternationalProgramController::class);
    Route::resource('internationalCategory', InternationalCategoryController::class);
    Route::resource('internationalFunding', InternationalFundingController::class);
    Route::resource('internationalStatus', InternationalStatusController::class);
    Route::resource('mahasiswaSemester', MahasiswaSemesterController::class);
    Route::resource('faculty', FacultyController::class);
    Route::get('internationalMahasiswa/{user_mahasiswa_id}', [InternationalMahasiswaController::class, 'create'])->name('internationalMahasiswa.create');
    Route::get('internationalMahasiswa/{user_mahasiswa_id}/{internationalMahasiswa}', [InternationalMahasiswaController::class, 'edit'])->name('internationalMahasiswa.edit');
    Route::post('internationalMahasiswa/{user_mahasiswa_id}', [InternationalMahasiswaController::class, 'store'])->name('internationalMahasiswa.store');
    Route::put('internationalMahasiswa/update/{user_mahasiswa_id}/{internationalMahasiswa}', [InternationalMahasiswaController::class, 'update'])->name('internationalMahasiswa.update');
    Route::post('admin/reset_password/{admin}', [AdminController::class, 'reset_password'])->name('admin.reset_password');
});

require __DIR__ . '/auth.php';
