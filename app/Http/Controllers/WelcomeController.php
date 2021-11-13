<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileGuruPegawai;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Exports\daftarUsulanKenaikanGaji;
use App\Exports\daftarUsulanKenaikanPangkat;
use Maatwebsite\Excel\Facades\Excel;

class WelcomeController extends Controller
{
    public function index()
    {
        $data = [
            'usulanGaji' => DB::table('profile_guru_pegawai')
                ->join('unit_kerja', 'profile_guru_pegawai.unit_kerja', '=', 'unit_kerja.id')
                ->select('profile_guru_pegawai.*', 'unit_kerja.nama as sekolah')
                ->whereRaw('tmt_gaji < (now() - interval 2 year) AND status LIKE "%PNS%"')
                ->orderBy('tmt_gaji', 'desc'),
            'usulanPangkat' => DB::table('profile_guru_pegawai')
                ->join('unit_kerja', 'profile_guru_pegawai.unit_kerja', '=', 'unit_kerja.id')
                ->select('profile_guru_pegawai.*', 'unit_kerja.nama as sekolah')
                ->whereRaw('tmt_pangkat < (now() - interval 2 year) and jenis_asn = "Guru" and status LIKE "%PNS%"')
                ->orWhereRaw('tmt_pangkat < (now() - interval 4 year) and jenis_asn = "Pegawai" and status LIKE "%PNS%"')
                ->orderBy('tmt_pangkat', 'desc'),


        ];
        // dd($data);

        return view('pages.welcome.welcome', $data);
        // return view('pages.welcome.welcome');
    }

    public function daftarUsulanKenaikanGaji(Request $request)
    {

        $usulanGaji = DB::table('profile_guru_pegawai')
            ->join('unit_kerja', 'profile_guru_pegawai.unit_kerja', '=', 'unit_kerja.id')
            ->join('jabatan_fungsional', 'profile_guru_pegawai.jabatan_pangkat_golongan', '=', 'jabatan_fungsional.id')
            ->join('jabatan_struktural', 'profile_guru_pegawai.jabatan_pangkat_golongan', '=', 'jabatan_struktural.id')
            ->select('profile_guru_pegawai.*', 'unit_kerja.nama as sekolah', 'jabatan_struktural.golongan as golongan_jabatan_struktural', 'jabatan_fungsional.golongan as golongan_jabatan_fungsional');

        if ($request->cari) {
            $usulanGaji->whereRaw('tmt_gaji < (now() - interval 2 year) AND status LIKE "%PNS%" AND profile_guru_pegawai.nama LIKE "%' . $request->cari . '%"')
                ->orderBy('tmt_gaji', 'desc');
        } else {
            $usulanGaji->whereRaw('tmt_gaji < (now() - interval 2 year) AND status LIKE "%PNS%"')
                ->orderBy('tmt_gaji', 'desc');
        }

        $data = [
            'usulanGaji' => $usulanGaji
        ];
        return view('pages.welcome.daftarKenaikanGaji', $data);
    }

    public function daftarUsulanKenaikanPangkat(Request $request)
    {

        $usulanPangkat = DB::table('profile_guru_pegawai')
            ->join('unit_kerja', 'profile_guru_pegawai.unit_kerja', '=', 'unit_kerja.id')
            ->join('jabatan_fungsional', 'profile_guru_pegawai.jabatan_pangkat_golongan', '=', 'jabatan_fungsional.id')
            ->join('jabatan_struktural', 'profile_guru_pegawai.jabatan_pangkat_golongan', '=', 'jabatan_struktural.id')
            ->select('profile_guru_pegawai.*', 'unit_kerja.nama as sekolah', 'jabatan_struktural.golongan as golongan_jabatan_struktural', 'jabatan_fungsional.golongan as golongan_jabatan_fungsional');

        if ($request->cari) {
            $usulanPangkat->whereRaw('tmt_pangkat < (now() - interval 2 year) and jenis_asn = "Guru" and status LIKE "%PNS%" AND profile_guru_pegawai.nama LIKE "%' . $request->cari . '%"')
                ->orWhereRaw('tmt_pangkat < (now() - interval 4 year) and jenis_asn = "Pegawai" and status LIKE "%PNS%" AND profile_guru_pegawai.nama LIKE "%' . $request->cari . '%"')
                ->orderBy('tmt_pangkat', 'desc');
        } else {
            $usulanPangkat->whereRaw('tmt_pangkat < (now() - interval 2 year) and jenis_asn = "Guru" and status LIKE "%PNS%"')
                ->orWhereRaw('tmt_pangkat < (now() - interval 4 year) and jenis_asn = "Pegawai" and status LIKE "%PNS%"')
                ->orderBy('tmt_pangkat', 'desc');
        }
        $data = [
            'usulanPangkat' => $usulanPangkat
        ];
        return view('pages.welcome.daftarKenaikanPangkat', $data);
    }

    public function exportDaftarUsulanKenaikanGaji()
    {
        return Excel::download(new daftarUsulanKenaikanGaji, 'Daftar Usulan Kenaikan Gaji.xlsx');
    }

    public function exportDaftarUsulanKenaikanPangkat()
    {
        return Excel::download(new daftarUsulanKenaikanPangkat, 'Daftar Usulan Kenaikan Pangkat.xlsx');
    }
}
