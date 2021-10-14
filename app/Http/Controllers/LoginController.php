<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.login.index', ['title' => 'Login', 'active' => 'login_register']);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // if ((Auth::user()->role == 'Guru') || (Auth::user()->role == 'Pegawai')) {
            //     if ((User::find(Auth::user()->id)->profile) != null) {
            return redirect()->intended('/dashboard');
            //     } else {
            //         return redirect()->intended('/lengkapi-data');
            //     }
            // }
            // else { // ROLE SELAIN GURU dan PEGAWAI
            //     return redirect()->intended('/');
            // }
        }
        return back()->with('loginError', 'Username atau Password salah !');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
