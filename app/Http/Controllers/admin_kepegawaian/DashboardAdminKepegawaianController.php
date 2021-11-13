<?php

namespace App\Http\Controllers\admin_kepegawaian;

use App\Http\Controllers\Controller;
use App\Models\BerkasDasar;
use App\Models\ProfileGuruPegawai;
use App\Models\User;
use App\Models\UsulanGaji;
use App\Models\UsulanPangkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardAdminKepegawaianController extends Controller
{
    public function index()
    {
        // Pangkat
        $pangkatBelumDiproses = UsulanPangkat::where('status_tim_penilai', 1)->where('status_kepegawaian', 0)->count();
        $pangkatDisetujui = UsulanPangkat::where('status_tim_penilai', 1)->where('status_kepegawaian', 1)->count();
        $pangkatDitolak = UsulanPangkat::where('status_tim_penilai', 1)->where('status_kepegawaian', 2)->count();
        $pangkatTotalBerkas = UsulanPangkat::count();

        // Gaji
        $gajiBelumDiproses = UsulanGaji::where('status_kepegawaian', 0)->count();
        $gajiDisetujui = UsulanGaji::where('status_kepegawaian', 1)->count();
        $gajiDitolak = UsulanGaji::where('status_kepegawaian', 2)->count();
        $gajiTotalBerkas = UsulanGaji::count();

        $totalUser = User::where('role', 'Pegawai')->orWhere('role', 'Guru')->count();
        // Berkas Dasar
        $totalBerkasDasar = BerkasDasar::count();
        $berkasDasarBelumDiproses = ProfileGuruPegawai::where('status_berkas_dasar', 0)->count();
        $berkasDasarDisetujui = ProfileGuruPegawai::where('status_berkas_dasar', 1)->count();
        $berkasDasarDitolak = ProfileGuruPegawai::where('status_berkas_dasar', 2)->count();
        $berkasDasarBelumUpload = ($totalUser - $totalBerkasDasar);
        if ($berkasDasarBelumUpload < 0) {
            $berkasDasarBelumUpload = 0;
        }

        // Profil
        $totalProfil = ProfileGuruPegawai::count();
        $profilBelumDiproses = ProfileGuruPegawai::where('status_profile', 0)->count();
        $profilDisetujui = ProfileGuruPegawai::where('status_profile', 1)->count();
        $profilDitolak = ProfileGuruPegawai::where('status_profile', 2)->count();
        $profilBelumAda = ($totalUser - $totalProfil);
        if ($profilBelumAda < 0) {
            $profilBelumAda = 0;
        }

        $pangkat = ['pangkatBelumDiproses', 'pangkatDisetujui', 'pangkatDitolak', 'pangkatTotalBerkas'];
        $gaji = ['gajiBelumDiproses', 'gajiDisetujui', 'gajiDitolak', 'gajiTotalBerkas'];
        $berkasDasar = ['berkasDasarBelumDiproses', 'berkasDasarDisetujui', 'berkasDasarDitolak', 'berkasDasarBelumUpload', 'totalUser'];
        $profil = ['profilBelumDiproses', 'profilDisetujui', 'profilDitolak', 'profilBelumAda', 'totalUser'];

        return view('pages.dashboard.dashboardAdminKepegawaian', compact($pangkat, $gaji, $berkasDasar, $profil));
    }
}
