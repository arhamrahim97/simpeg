<?php

namespace App\Http\Controllers;

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
                return view('pages.guru_pegawai.lengkapiData');
            }
        } else if (Auth::user()->role == 'Admin') { // Selain role GURU atau PEGAWAI
            return view('pages.dashboard.dashboardAdmin');
        }
    }
}
