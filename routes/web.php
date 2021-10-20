<?php

use App\Http\Controllers\admin\MasterJabatanFungsionalController;
use App\Http\Controllers\admin\MasterJabatanStrukturalController;
use App\Http\Controllers\admin\MasterUnitKerjaController;
use App\Http\Controllers\admin_kepegawaian\ProsesUsulanKenaikanGajiAdminKepegawaian;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\guru_pegawai\UsulanKenaikanGajiController;
use App\Http\Controllers\kasubag\ProsesUsulanKenaikanGajiKasubag;
use App\Http\Controllers\kepala_dinas\ProsesUsulanKenaikanGajiKepalaDinas;
use App\Http\Controllers\sekretaris\ProsesUsulanKenaikanGajiSekretaris;

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



Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/lengkapi-data', function () {
    return view('pages.guru.dashboard.lengkapiData');
})->middleware('auth');

Route::get('/', function () {
    return view('pages.welcome.welcome');
});

Route::middleware(['admin'])->group(function () {
    Route::resource('master-jabatan-struktural', MasterJabatanStrukturalController::class)->parameters([
        'master-jabatan-struktural' => 'jabatan_struktural'
    ]);

    Route::resource('master-jabatan-fungsional', MasterJabatanFungsionalController::class)->parameters([
        'master-jabatan-fungsional' => 'jabatan_fungsional'
    ]);

    Route::resource('master-unit-kerja', MasterUnitKerjaController::class)->parameters([
        'master-unit-kerja' => 'unit_kerja'
    ]);
});


Route::middleware(['gurudanpegawai'])->group(function () {
    Route::resource('usulan-kenaikan-gaji', UsulanKenaikanGajiController::class)->parameters([
        'usulan-kenaikan-gaji' => 'usulan_gaji'
    ]);
    Route::post('get-timeline-usulan-kenaikan-gaji-guru', [UsulanKenaikanGajiController::class, 'getTimelineUsulanGaji']);
    Route::delete('/hapus-berkas/{berkas_usulan_gaji}', [UsulanKenaikanGajiController::class, 'hapusBerkas']);
});

// Proses Usulan Gaji Admin Kepegawaian
Route::resource('proses-usulan-kenaikan-gaji-admin-kepegawaian', ProsesUsulanKenaikanGajiAdminKepegawaian::class)->parameters([
    'proses-usulan-kenaikan-gaji-admin-kepegawaian' => 'usulan_gaji'
]);
Route::get('proses-berkas-usulan-kenaikan-gaji-admin-kepegawaian/{usulan_gaji}', [ProsesUsulanKenaikanGajiAdminKepegawaian::class, 'prosesBerkas']);
Route::post('get-timeline-usulan-kenaikan-gaji-admin-kepegawaian', [ProsesUsulanKenaikanGajiAdminKepegawaian::class, 'getTimelineUsulanGaji']);

// Proses Usulan Gaji Kasubag
Route::resource('proses-usulan-kenaikan-gaji-kasubag', ProsesUsulanKenaikanGajiKasubag::class)->parameters([
    'proses-usulan-kenaikan-gaji-kasubag' => 'usulan_gaji'
]);
Route::get('proses-berkas-usulan-kenaikan-gaji-kasubag/{usulan_gaji}', [ProsesUsulanKenaikanGajiKasubag::class, 'prosesBerkas']);
Route::post('get-timeline-usulan-kenaikan-gaji-kasubag', [ProsesUsulanKenaikanGajiKasubag::class, 'getTimelineUsulanGaji']);

// Proses Usulan Gaji Sekretaris
Route::resource('proses-usulan-kenaikan-gaji-sekretaris', ProsesUsulanKenaikanGajiSekretaris::class)->parameters([
    'proses-usulan-kenaikan-gaji-sekretaris' => 'usulan_gaji'
]);
Route::get('proses-berkas-usulan-kenaikan-gaji-sekretaris/{usulan_gaji}', [ProsesUsulanKenaikanGajiSekretaris::class, 'prosesBerkas']);
Route::post('get-timeline-usulan-kenaikan-gaji-sekretaris', [ProsesUsulanKenaikanGajiSekretaris::class, 'getTimelineUsulanGaji']);

// Proses Usulan Gaji Kepala Dinas
Route::resource('proses-usulan-kenaikan-gaji-kepala-dinas', ProsesUsulanKenaikanGajiKepalaDinas::class)->parameters([
    'proses-usulan-kenaikan-gaji-kepala-dinas' => 'usulan_gaji'
]);
Route::get('proses-berkas-usulan-kenaikan-gaji-kepala-dinas/{usulan_gaji}', [ProsesUsulanKenaikanGajiKepalaDinas::class, 'prosesBerkas']);
Route::post('get-timeline-usulan-kenaikan-gaji-kepala-dinas', [ProsesUsulanKenaikanGajiKepalaDinas::class, 'getTimelineUsulanGaji']);
