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
    public function index(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $data2 = [
            'user' => $user,
        ];

        if (Auth::user()->status != 1) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return back()->with('tidakAktif', 'Maaf, akun anda sekarang dalam status "Tidak Aktif", hubungi admin untuk mengaktifkan akun anda.');
            // echo 'akun anda tidak aktif';
        } else {
            if ((Auth::user()->role == 'Guru') || (Auth::user()->role == 'Pegawai')) {
                // $status_kepegawaian = Auth::user()->status_kepegawaian;
                $user = User::find(Auth::user()->id);
                if (($user->profile) == null) {
                    return redirect('/profile-guru-pegawai');
                } else {
                    if ((in_array($user->status_kepegawaian, array('PNS', 'PNS Depag', 'PNS Diperbantukan'))) && (BerkasDasar::where('id_user', '=', Auth::user()->id)->count() == 0)) {
                        // if ((($user->status_kepegawaian == 'PNS') || ($user->status_kepegawaian == 'PNS Depag') || ($user->status_kepegawaian == 'PNS Diperbantukan')) && (BerkasDasar::where('id_user', '=', Auth::user()->id)->count() == 0)) {
                        return redirect('/berkas-dasar');
                    } //
                    else {
                        if ($user->profile != null) {
                            if (!in_array($user->status_kepegawaian, array('PNS', 'PNS Depag', 'PNS Diperbantukan'))) { //Non PNS
                                return redirect(route('info-profile', $user->profile->id));
                            } else { // PNS
                                if (($user->profile->status_profile != 1) || ($user->profile->status_berkas_dasar != 1)) {
                                    return view('pages.guru_pegawai.lengkapiData.index', ['user' => $user]);
                                }  //
                                else {
                                    // return view('pages.dashboard.dashboardGuru', $data2);
                                    return redirect('/dashboard-guru-pegawai');
                                }
                            }
                        }
                    }
                }
            } else {
                if (Auth::user()->role == 'Admin') { // Selain role GURU atau PEGAWAI
                    return redirect('/dashboard-admin');
                } else if (Auth::user()->role == "Tim Penilai") {
                    return redirect('/dashboard-tim-penilai');
                } else if (Auth::user()->role == "Admin Kepegawaian") {
                    return redirect('/dashboard-admin-kepegawaian');
                } else if (Auth::user()->role == "KASUBAG Kepegawaian dan Umum") {
                    return redirect('/dashboard-kasubag');
                } else if (Auth::user()->role == "Sekretaris") {
                    return redirect('/dashboard-sekretaris');
                } else if (Auth::user()->role == "Kepala Dinas") {
                    return redirect('/dashboard-kepala-dinas');
                }
                return view('pages.dashboard.dashboardAdmin', $data2);
            }
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
