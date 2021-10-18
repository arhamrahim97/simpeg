<?php

use App\Http\Controllers\admin\MasterJabatanFungsionalController;
use App\Http\Controllers\admin\MasterJabatanStrukturalController;
use App\Http\Controllers\admin\MasterUnitKerjaController;
use App\Http\Controllers\admin\MasterPersyaratanController;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\guru_pegawai\UsulanKenaikanGajiController;

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


Route::middleware(['auth'])->group(function () {
    Route::get('/lengkapi-data', function () {
        return view('pages.guru.dashboard.lengkapiData');
    });

    Route::post('/lengkapi-data/jabatan-golongan-pangkat', [DashboardController::class, 'getJabatanGolonganPangkat'])->name('lengkapiData.jabatanGolonganPangkat');

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/logout', [LoginController::class, 'logout']);

    // Role Admin
    Route::resource('/master-persyaratan', MasterPersyaratanController::class)->parameters([
        'master-persyaratan' => 'persyaratan'
    ]);
});

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
    Route::post('get-timeline-usulan-kenaikan-gaji', [UsulanKenaikanGajiController::class, 'getTimelineUsulanGaji']);
    Route::delete('/hapus-berkas/{berkas_usulan_gaji}', [UsulanKenaikanGajiController::class, 'hapusBerkas']);
});
