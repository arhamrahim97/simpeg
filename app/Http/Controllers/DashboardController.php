<?php

namespace App\Http\Controllers;

use App\Models\JabatanFungsional;
use App\Models\JabatanStruktural;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        if ((Auth::user()->role == 'Guru') || (Auth::user()->role == 'Pegawai')) {
            if ((User::find(Auth::user()->id)->profile) != null) {
                return view('pages.dashboard.dashboardGuru');
            } else {
                $data = [
                    'unit_kerja' => UnitKerja::all(),
                ];

                return view('pages.guru_pegawai.lengkapiData', $data);
            }
        } else if (Auth::user()->role == 'Admin') { // Selain role GURU atau PEGAWAI
            return view('pages.dashboard.dashboardAdmin');
        }
    }

    public function getJabatanGolonganPangkat(Request $request)
    {
        // $data = DB::table('min_support_confidences')->first();
        // $count = DB::table('laka_lantas')->count();

        if ($request->role == 'Guru') {
            $jabatan =  JabatanFungsional::all();
            $output = '<option value=""> - Pilih Salah Satu -</option>';
            foreach ($jabatan as $row) {
                $output .= '
                <option value="' . $row->id . '">' . $row->jabatan . ' - ' . $row->golongan . ' - ' . $row->pangkat . '</option>
                ';
            }
            echo $output;
        } else if ($request->role == 'Pegawai') {
            $jabatan =  JabatanStruktural::all();
            $output = '<option value=""> - Pilih Salah Satu -</option>';
            foreach ($jabatan as $row) {
                $output .= '
                <option value="' . $row->id . '">' . $row->jabatan . ' - ' . $row->golongan . ' - ' . $row->pangkat . '</option>
                ';
            }
            echo $output;
        } else {
            $output = '<option value=""> - Pilih Jenis ASN terlebih dahulu -</option>';
            echo $output;
        }

        // return Response()->json(['data' => $request->role]);
    }
}
