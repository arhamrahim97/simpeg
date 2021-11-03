<?php

namespace App\Http\Controllers\semua;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UsulanGaji;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class CetakUsulanController extends Controller
{
    public function cetakUsulanKenaikanGaji(UsulanGaji $usulanGaji)
    {
        $user = User::find($usulanGaji->id_user);
        // return view('pages.semua.suratUsulanKenaikanGaji', compact('usulanGaji', 'user'));
        $random = rand(1000, 9999);
        $pdf = PDF::loadView('pages.semua.suratUsulanKenaikanGaji', compact('usulanGaji', 'user'))->setPaper('f4', 'portrait');
        return $pdf->download($random . '.pdf');
    }
}
