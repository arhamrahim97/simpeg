<?php

use App\Http\Controllers\admin\MasterJabatanFungsionalController;
use App\Http\Controllers\admin\MasterJabatanStrukturalController;
use App\Http\Controllers\admin\MasterUnitKerjaController;
use Illuminate\Support\Facades\Route;
use Brian2694\Toastr\Facades\Toastr;

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

Route::get('dashboard', function () {
    Toastr::success('Menampilkan Notifikasi Toastr', 'Success');
    return view('pages.dashboard.dashboard');
});

Route::get('/', function () {
    return view('pages.welcome.welcome');
});

Route::resource('master-jabatan-struktural', MasterJabatanStrukturalController::class)->parameters([
    'master-jabatan-struktural' => 'jabatan_struktural'
]);

Route::resource('master-jabatan-fungsional', MasterJabatanFungsionalController::class)->parameters([
    'master-jabatan-fungsional' => 'jabatan_fungsional'
]);

Route::resource('master-unit-kerja', MasterUnitKerjaController::class)->parameters([
    'master-unit-kerja' => 'unit_kerja'
]);

Route::get('upload', function () {
    return view('pages.guru.kenaikanGaji.index');
});
