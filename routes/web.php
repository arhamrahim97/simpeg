<?php

use Illuminate\Support\Facades\Route;
use Brian2694\Toastr\Facades\Toastr;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('dashboard', function () {
    Toastr::success('Menampilkan Notifikasi Toastr', 'Success');
    return view('pages.dashboard.dashboard');
});

Route::get('/', function () {

    return view('pages.welcome.welcome');
});
