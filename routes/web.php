<?php

use App\Models\BerkasDasar;
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
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\ProfilePejabatController;
use App\Http\Controllers\admin\MasterUnitKerjaController;
use App\Http\Controllers\admin\MasterPersyaratanController;
use App\Http\Controllers\admin\DataBerkasDasarController;
use App\Http\Controllers\admin\MasterJabatanFungsionalController;
use App\Http\Controllers\admin\MasterJabatanStrukturalController;

use App\Http\Controllers\guru_pegawai\BerkasDasarController;

use App\Http\Controllers\admin_kepegawaian\ProsesUsulanKenaikanGajiAdminKepegawaian;
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

    Route::resource('/user', UserController::class);
    Route::get('/user-tambah-guru-pegawai',  [UserController::class, 'createGuru']);
    Route::get('/user-tambah-non-guru-pegawai',  [UserController::class, 'createNonGuru']);

    Route::get('/profile-guru-pegawai-',  [ProfileGuruPegawaiController::class, 'indexProfileGuruPegawai']);
    Route::get('/edit-profile-guru-pegawai/{profile_guru_pegawai}',  [ProfileGuruPegawaiController::class, 'editProfileGuruPegawai'])->name('edit-profile-guru-pegawai');
    Route::put('/update-profile-guru-pegawai/{profile_guru_pegawai}',  [ProfileGuruPegawaiController::class, 'updateProfileGuruPegawai'])->name('update-profile-guru-pegawai');
    Route::get('/proses-profile-guru-pegawai/{profile_guru_pegawai}',  [ProfileGuruPegawaiController::class, 'prosesProfileGuruPegawai'])->name('proses-profile-guru-pegawai');
    Route::put('/konfirmasi-profile-guru-pegawai/{profile_guru_pegawai}',  [ProfileGuruPegawaiController::class, 'konfirmasiProfileGuruPegawai'])->name('konfirmasi-profile-guru-pegawai');

    Route::get('/profile-non-guru-pegawai',  [ProfilePejabatController::class, 'indexNonProfileGuruPegawai']);
    Route::get('/edit-profile-non-guru-pegawai/{profile_non_guru_pegawai}',  [ProfilePejabatController::class, 'editProfileNonGuruPegawai'])->name('edit-profile-non-guru-pegawai');
    Route::put('/update-profile-non-guru-pegawai/{profile_non_guru_pegawai}',  [ProfilePejabatController::class, 'updateProfileNonGuruPegawai'])->name('update-profile-non-guru-pegawai');

    Route::post('/import-excel',  [UserController::class, 'importExcel']);
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
    Route::resource('berkas-dasar', BerkasDasarController::class)->parameters([
        'berkas-dasar' => 'user'
    ]);

    Route::get('/berkas-dasar/revisi-berkas/{user}', [BerkasDasarController::class, 'revisiBerkas']);

    Route::delete('/hapus-berkas-dasar/{berkas_dasar}', [BerkasDasarController::class, 'hapusBerkas']);

    Route::get('/user/{user}/edit-akun',  [UserController::class, 'editAkun'])->name('user.edit_akun');
    Route::put('/user/{user}/update-akun',  [UserController::class, 'updateAkun'])->name('user.update_akun');
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
Route::resource('data-berkas-dasar', DataBerkasDasarController::class)->parameters([
    'data-berkas-dasar' => 'profile_guru_pegawai'
]);



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

Route::get('/user/{user}/edit-akun-pejabat',  [UserController::class, 'editAkunPejabat'])->name('user.edit_akun_pejabat');
Route::put('/user/{user}/update-akun-pejabat',  [UserController::class, 'updateAkunPejabat'])->name('user.update_akun_pejabat');

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

