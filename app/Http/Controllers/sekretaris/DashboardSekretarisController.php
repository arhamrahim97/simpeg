<?php

namespace App\Http\Controllers\sekretaris;

use App\Http\Controllers\Controller;
use App\Models\UsulanGaji;
use App\Models\UsulanPangkat;
use Illuminate\Http\Request;

class DashboardSekretarisController extends Controller
{
    public function index()
    {
        // Pangkat
        $pangkatBelumDiproses = UsulanPangkat::where('status_tim_penilai', 1)->where('status_kepegawaian', 1)->where('status_kasubag', 1)->where('status_sekretaris', 0)->count();
        $pangkatDisetujui = UsulanPangkat::where('status_tim_penilai', 1)->where('status_kepegawaian', 1)->where('status_kasubag', 1)->where('status_sekretaris', 1)->count();
        $pangkatDitolak = UsulanPangkat::where('status_tim_penilai', 1)->where('status_kepegawaian', 1)->where('status_kasubag', 1)->where('status_sekretaris', 2)->count();
        $pangkatTotalBerkas = UsulanPangkat::count();

        // Gaji
        $gajiBelumDiproses = UsulanGaji::where('status_kepegawaian', 1)->where('status_kasubag', 1)->where('status_sekretaris', 0)->count();
        $gajiDisetujui = UsulanGaji::where('status_kepegawaian', 1)->where('status_kasubag', 1)->where('status_sekretaris', 1)->count();
        $gajiDitolak = UsulanGaji::where('status_kepegawaian', 1)->where('status_kasubag', 1)->where('status_sekretaris', 2)->count();
        $gajiTotalBerkas = UsulanGaji::count();

        $pangkat = ['pangkatBelumDiproses', 'pangkatDisetujui', 'pangkatDitolak', 'pangkatTotalBerkas'];
        $gaji = ['gajiBelumDiproses', 'gajiDisetujui', 'gajiDitolak', 'gajiTotalBerkas'];

        return view('pages.dashboard.dashboardSekretaris', compact($pangkat, $gaji));
    }
}
