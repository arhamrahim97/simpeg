<?php

use App\Http\Controllers\admin\MasterJabatanFungsionalController;
use App\Http\Controllers\admin\MasterJabatanStrukturalController;
use App\Http\Controllers\admin\MasterUnitKerjaController;
use App\Http\Controllers\admin\MasterPersyaratanController;
use App\Http\Controllers\admin\ProsesUsulanKenaikanGajiAdmin;
use App\Http\Controllers\admin\ProsesUsulanKenaikanPangkatAdmin;
use App\Http\Controllers\admin_kepegawaian\ProsesUsulanKenaikanGajiAdminKepegawaian;
use App\Http\Controllers\admin_kepegawaian\ProsesUsulanKenaikanPangkatAdminKepegawaian;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\guru_pegawai\UsulanKenaikanGajiController;
use App\Http\Controllers\guru_pegawai\BerkasDasarController;
use App\Http\Controllers\guru_pegawai\ProfileGuruPegawaiController;
use App\Http\Controllers\guru_pegawai\UsulanKenaikanPangkatController;
use App\Http\Controllers\kasubag\ProsesUsulanKenaikanGajiKasubag;
use App\Http\Controllers\kasubag\ProsesUsulanKenaikanPangkatKasubag;
use App\Http\Controllers\kepala_dinas\ProsesUsulanKenaikanGajiKepalaDinas;
use App\Http\Controllers\kepala_dinas\ProsesUsulanKenaikanPangkatKepalaDinas;
use App\Http\Controllers\sekretaris\ProsesUsulanKenaikanGajiSekretaris;
use App\Http\Controllers\sekretaris\ProsesUsulanKenaikanPangkatSekretaris;
use App\Http\Controllers\semua\CetakUsulanController;
use App\Http\Controllers\tim_penilai\ProsesUsulanKenaikanPangkatTimPenilai;
use Barryvdh\DomPDF\PDF;
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
    // Kenaikan Gaji
    Route::resource('usulan-kenaikan-gaji', UsulanKenaikanGajiController::class)->parameters([
        'usulan-kenaikan-gaji' => 'usulan_gaji'
    ]);
    Route::post('get-timeline-usulan-kenaikan-gaji', [UsulanKenaikanGajiController::class, 'getTimelineUsulanGaji']);
    Route::delete('/hapus-berkas/{berkas_usulan_gaji}', [UsulanKenaikanGajiController::class, 'hapusBerkas']);

    // Kenaikan Pangkat
    Route::resource('usulan-kenaikan-pangkat', UsulanKenaikanPangkatController::class)->parameters([
        'usulan-kenaikan-pangkat' => 'usulan_pangkat'
    ]);
    Route::post('get-timeline-usulan-kenaikan-pangkat', [UsulanKenaikanPangkatController::class, 'getTimelineUsulanPangkat']);
    Route::delete('/hapus-berkas-pangkat/{berkas_usulan_pangkat}', [UsulanKenaikanPangkatController::class, 'hapusBerkas']);

    Route::resource('profile-guru-pegawai', ProfileGuruPegawaiController::class);
    Route::resource('berkas-dasar', BerkasDasarController::class);

    Route::post('get-persyaratan-berkas', [UsulanKenaikanPangkatController::class, 'getPersyaratanBerkas']);
});

// Proses Usulan Gaji Admin
Route::resource('proses-usulan-kenaikan-gaji-admin', ProsesUsulanKenaikanGajiAdmin::class)->parameters([
    'proses-usulan-kenaikan-gaji-admin' => 'usulan_gaji'
]);
Route::get('proses-berkas-usulan-kenaikan-gaji-admin/{usulan_gaji}', [ProsesUsulanKenaikanGajiAdmin::class, 'prosesBerkas']);
Route::post('get-timeline-usulan-kenaikan-gaji-admin', [ProsesUsulanKenaikanGajiAdmin::class, 'getTimelineUsulanGaji']);

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

// Usulan Pangkat
// Proses Usulan Pangkat Admin
Route::resource('proses-usulan-kenaikan-pangkat-admin', ProsesUsulanKenaikanPangkatAdmin::class)->parameters([
    'proses-usulan-kenaikan-pangkat-admin' => 'usulan_pangkat'
]);
Route::get('proses-berkas-usulan-kenaikan-pangkat-admin/{usulan_pangkat}', [ProsesUsulanKenaikanPangkatAdmin::class, 'prosesBerkas']);
Route::post('get-timeline-usulan-kenaikan-pangkat-admin', [ProsesUsulanKenaikanPangkatAdmin::class, 'getTimelineUsulanPangkat']);

// Proses Usulan Pangkat Tim Penilai
Route::resource('proses-usulan-kenaikan-pangkat-tim-penilai', ProsesUsulanKenaikanPangkatTimPenilai::class)->parameters([
    'proses-usulan-kenaikan-pangkat-tim-penilai' => 'usulan_pangkat'
]);
Route::get('proses-berkas-usulan-kenaikan-pangkat-tim-penilai/{usulan_pangkat}', [ProsesUsulanKenaikanPangkatTimPenilai::class, 'prosesBerkas']);
Route::post('get-timeline-usulan-kenaikan-pangkat-tim-penilai', [ProsesUsulanKenaikanPangkatTimPenilai::class, 'getTimelineUsulanPangkat']);

// Proses Usulan Pangkat Admin Kepegawaian
Route::resource('proses-usulan-kenaikan-pangkat-admin-kepegawaian', ProsesUsulanKenaikanPangkatAdminKepegawaian::class)->parameters([
    'proses-usulan-kenaikan-pangkat-admin-kepegawaian' => 'usulan_pangkat'
]);
Route::get('proses-berkas-usulan-kenaikan-pangkat-admin-kepegawaian/{usulan_pangkat}', [ProsesUsulanKenaikanPangkatAdminKepegawaian::class, 'prosesBerkas']);
Route::post('get-timeline-usulan-kenaikan-pangkat-admin-kepegawaian', [ProsesUsulanKenaikanPangkatAdminKepegawaian::class, 'getTimelineUsulanPangkat']);

// Proses Usulan Pangkat Kasubag
Route::resource('proses-usulan-kenaikan-pangkat-kasubag', ProsesUsulanKenaikanPangkatKasubag::class)->parameters([
    'proses-usulan-kenaikan-pangkat-kasubag' => 'usulan_pangkat'
]);
Route::get('proses-berkas-usulan-kenaikan-pangkat-kasubag/{usulan_pangkat}', [ProsesUsulanKenaikanPangkatKasubag::class, 'prosesBerkas']);
Route::post('get-timeline-usulan-kenaikan-pangkat-kasubag', [ProsesUsulanKenaikanPangkatKasubag::class, 'getTimelineUsulanPangkat']);

// Proses Usulan Pangkat Sekretaris
Route::resource('proses-usulan-kenaikan-pangkat-sekretaris', ProsesUsulanKenaikanPangkatSekretaris::class)->parameters([
    'proses-usulan-kenaikan-pangkat-sekretaris' => 'usulan_pangkat'
]);
Route::get('proses-berkas-usulan-kenaikan-pangkat-sekretaris/{usulan_pangkat}', [ProsesUsulanKenaikanPangkatSekretaris::class, 'prosesBerkas']);
Route::post('get-timeline-usulan-kenaikan-pangkat-sekretaris', [ProsesUsulanKenaikanPangkatSekretaris::class, 'getTimelineUsulanPangkat']);

// Proses Usulan Pangkat Kepala Dinas
Route::resource('proses-usulan-kenaikan-pangkat-kepala-dinas', ProsesUsulanKenaikanPangkatKepalaDinas::class)->parameters([
    'proses-usulan-kenaikan-pangkat-kepala-dinas' => 'usulan_pangkat'
]);
Route::get('proses-berkas-usulan-kenaikan-pangkat-kepala-dinas/{usulan_pangkat}', [ProsesUsulanKenaikanPangkatKepalaDinas::class, 'prosesBerkas']);
Route::post('get-timeline-usulan-kenaikan-pangkat-kepala-dinas', [ProsesUsulanKenaikanPangkatKepalaDinas::class, 'getTimelineUsulanPangkat']);

// Cetak Surat Usulan
Route::get('cetak-usulan-kenaikan-gaji/{usulan_gaji}', [CetakUsulanController::class, 'cetakUsulanKenaikanGaji']);
