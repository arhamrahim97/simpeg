<?php

namespace App\Http\Controllers;

use App\Models\BerkasDasar;
use App\Models\ProfileGuruPegawai;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Profiler\Profile;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $data2 = [
            'user' => $user,
        ];
        if ((Auth::user()->role == 'Guru') || (Auth::user()->role == 'Pegawai')) {
            // if ((User::find(Auth::user()->id)->profile) == null) {
            //     return redirect('/profile-guru-pegawai');
            // } else if (BerkasDasar::where('id_user', '=', Auth::user()->id)->count() == 0) {
            //     return redirect('/berkas-dasar');
            // } else {
            //     $user = User::find(Auth::user()->id);
            //     $data = [
            //         'user' => $user,
            //     ];
            //     return view('pages.dashboard.dashboardGuru', $data);
            // }
            $user = User::find(Auth::user()->id);

            if (($user->profile) == null) {
                return redirect('/profile-guru-pegawai');
            } else if (BerkasDasar::where('id_user', '=', Auth::user()->id)->count() == 0) {
                return redirect('/berkas-dasar');
            } else {
                if ($user->profile != null) {
                    if (($user->profile->status_profile != 1) || ($user->profile->status_berkas_dasar != 1)) {
                        return view('pages.guru_pegawai.lengkapiData.index', ['user' => $user]);
                    } else {
                        return view('pages.dashboard.dashboardGuru', $data2);
                    }
                }
            }
        } else {
            if (Auth::user()->role == 'Admin') { // Selain role GURU atau PEGAWAI
                return view('pages.dashboard.dashboardAdmin', $data2);
            }
            return view('pages.dashboard.dashboardAdmin', $data2);
        }
    }

    // public function getJabatanGolonganPangkat(Request $request)
    // {
    //     // $data = DB::table('min_support_confidences')->first();
    //     // $count = DB::table('laka_lantas')->count();

    //     if ($request->role == 'Guru') {
    //         $jabatan =  JabatanFungsional::all();
    //         $output = '<option value=""> - Pilih Salah Satu -</option>';
    //         foreach ($jabatan as $row) {
    //             $output .= '
    //             <option value="' . $row->id . '">' . $row->jabatan . ' - ' . $row->golongan . ' - ' . $row->pangkat . '</option>
    //             ';
    //         }
    //         echo $output;
    //     } else if ($request->role == 'Pegawai') {
    //         $jabatan =  JabatanStruktural::all();
    //         $output = '<option value=""> - Pilih Salah Satu -</option>';
    //         foreach ($jabatan as $row) {
    //             $output .= '
    //             <option value="' . $row->id . '">' . $row->jabatan . ' - ' . $row->golongan . ' - ' . $row->pangkat . '</option>
    //             ';
    //         }
    //         echo $output;
    //     } else {
    //         $output = '<option value=""> - Pilih Jenis ASN terlebih dahulu -</option>';
    //         echo $output;
    //     }

    //     // return Response()->json(['data' => $request->role]);
    // }
}
