<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\BatchSemesterController;
use App\Http\Controllers\BatchSemesterUserMahasiswaController;
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
use App\Http\Controllers\NoteController;
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
    Route::get('/getBatchSemester/{user}', [MahasiswaController::class, 'getBatchSemester']);
    Route::post('/postBatchSemesterUserMahasiswa/{user_mahasiswa_id}', [BatchSemesterUserMahasiswaController::class, 'store']);
    Route::post('/postBatchSemesterUserMahasiswa/status/{batch_semester_user_mahasiswa}', [BatchSemesterUserMahasiswaController::class, 'updateStatus']);
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/export', [DashboardController::class, 'fileExport'])->name('dashboard.fileExport');
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::post('dashboard/storeUser', [DashboardController::class, 'storeUser'])->name('dashboard.storeUser');
    Route::get('mahasiswa/getData/{userMahasiswa}', [MahasiswaController::class, 'getData'])->name('mahasiswa.getData');
    Route::post('mahasiswa/assignSemester/{userMahasiswa}', [MahasiswaController::class, 'assignSemester'])->name('mahasiswa.assignSemester');
    Route::post('mahasiswa/updatePassword/{userMahasiswa}', [MahasiswaController::class, 'updatePassword'])->name('mahasiswa.updatePassword');
    Route::post('mahasiswa/assignSemester/destroy/{mahasiswaSemester}', [MahasiswaController::class, 'destroySemester'])->name('mahasiswa.destroySemester');
    Route::resource('major', MajorController::class);
    // batch
    Route::resource('batch', BatchController::class);
    Route::get('batchSemester/create/{batch}', [BatchSemesterController::class, 'create'])->name('batchSemester.create');
    Route::post('batchSemester/store/{batch}', [BatchSemesterController::class, 'store'])->name('batchSemester.store');
    Route::get('batchSemester/edit/{batchSemester}/{batch}', [BatchSemesterController::class, 'edit'])->name('batchSemester.edit');
    Route::put('batchSemester/update/{batchSemester}/{batch}', [BatchSemesterController::class, 'update'])->name('batchSemester.update');
    Route::resource('batchSemester', BatchSemesterController::class)->except([
        'create', 'store', 'edit', 'update'
    ]);
    //end batch
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
    Route::get('internationalMahasiswa/{user_mahasiswa_id}', [InternationalMahasiswaController::class, 'index'])->name('internationalMahasiswa.index');
    Route::get('internationalMahasiswa/{user_mahasiswa_id}/create', [InternationalMahasiswaController::class, 'create'])->name('internationalMahasiswa.create');
    Route::get('internationalMahasiswa/{user_mahasiswa_id}/{internationalMahasiswa}/edit', [InternationalMahasiswaController::class, 'edit'])->name('internationalMahasiswa.edit');
    Route::post('internationalMahasiswa/{user_mahasiswa_id}', [InternationalMahasiswaController::class, 'store'])->name('internationalMahasiswa.store');
    Route::post('internationalMahasiswa/{internationalMahasiswa}/destroy', [InternationalMahasiswaController::class, 'destroy'])->name('internationalMahasiswa.destroy');
    Route::put('internationalMahasiswa/update/{user_mahasiswa_id}/{internationalMahasiswa}', [InternationalMahasiswaController::class, 'update'])->name('internationalMahasiswa.update');
    Route::post('admin/reset_password/{admin}', [AdminController::class, 'reset_password'])->name('admin.reset_password');

    //note
    Route::get('note/{user_mahasiswa_id}', [NoteController::class, 'index'])->name('note.index');
    Route::post('note/store/{user_mahasiswa_id}', [NoteController::class, 'store'])->name('note.store');
    Route::get('note/{user_mahasiswa_id}/{note}/edit', [NoteController::class, 'edit'])->name('note.edit');
    Route::post('note/{note}/destroy', [NoteController::class, 'destroy'])->name('note.destroy');
    Route::put('note/update/{user_mahasiswa_id}/{note}', [NoteController::class, 'update'])->name('note.update');

    //export pdf
    Route::get('exportPdf/{user}', [DashboardController::class, 'exportPdf'])->name('exportPdf');
});

require __DIR__ . '/auth.php';
