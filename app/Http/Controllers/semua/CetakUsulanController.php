<?php

namespace App\Http\Controllers\semua;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UsulanGaji;
use App\Models\UsulanPangkat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class CetakUsulanController extends Controller
{
    public function cetakUsulanKenaikanGaji(UsulanGaji $usulanGaji)
    {
        $user = User::find($usulanGaji->id_user);
        $kepalaDinas = User::where('role', 'Kepala Dinas')->where('status', 1)->first();
        $hariIni = \Carbon\Carbon::now()->locale('id');
        // return view('pages.semua.suratUsulanKenaikanGaji', compact('usulanGaji', 'user', 'hariIni', 'kepalaDinas'));
        // $hariIni = \Carbon\Carbon::createFromFormat('Y-m-d', $user->profile->tanggal_lahir)->locale('id');
        $random = rand(1000, 9999);
        $pdf = PDF::loadView('pages.semua.suratUsulanKenaikanGaji', compact('usulanGaji', 'user', 'kepalaDinas', 'hariIni'))->setPaper('f4', 'portrait');
        return $pdf->download($usulanGaji->nama . '.pdf');
        // echo $hariIni->dayName . ", " . $hariIni->day . ' ' . $hariIni->monthName . ' ' . $hariIni->year;
    }

    public function cetakUsulanKenaikanPangkat(UsulanPangkat $usulanPangkat)
    {
        $user = User::where('id', $usulanPangkat->id_user)->first();
        $hariIni = \Carbon\Carbon::now()->locale('id');
        $sekretaris = User::where('role', 'Sekretaris')->where('status', 1)->first();
        $random = rand(1000, 9999);
        $pdf = PDF::loadView('pages.semua.suratUsulanKenaikanPangkat', compact('user', 'usulanPangkat', 'sekretaris', 'hariIni'))->setPaper('f4', 'portrait');
        return $pdf->download($usulanPangkat->nama . "-" . $usulanPangkat->unique_id . '.pdf');
        // return view('pages.semua.suratUsulanKenaikanPangkat', compact('user', 'usulanPangkat', 'sekretaris'));
    }
}
