<?php

namespace App\Http\Controllers\tim_penilai;

use App\Http\Controllers\Controller;
use App\Models\UsulanPangkat;
use Illuminate\Http\Request;

class DashboardTimPenilaiController extends Controller
{
    public function index()
    {
        $belumDiproses = UsulanPangkat::where('status_tim_penilai', 0)->count();
        $disetujui = UsulanPangkat::where('status_tim_penilai', 1)->count();
        $ditolak = UsulanPangkat::where('status_tim_penilai', 2)->count();
        $totalBerkas = UsulanPangkat::count();
        return view('pages.dashboard.dashboardTimPenilai', compact('belumDiproses', 'disetujui', 'ditolak', 'totalBerkas'));
    }
}
