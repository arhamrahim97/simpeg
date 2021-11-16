<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileGuruPegawai;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Exports\daftarUsulanKenaikanGaji;
use App\Exports\daftarUsulanKenaikanPangkat;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpKernel\Profiler\Profile;

class WelcomeController extends Controller
{
    public function index()
    {
        $status = DB::table('profile_guru_pegawai')
            ->selectRaw('status, count(status) as jumlah')
            ->groupBy('status')
            ->get();
        $namaStatus = [];
        $jumlahTiapStatus = [];
        foreach ($status as $row) {
            array_push($namaStatus, $row->status);
            array_push($jumlahTiapStatus, $row->jumlah);
        }

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
            'profileAll' => ProfileGuruPegawai::all(),
            'profilePNS' => ProfileGuruPegawai::where('status', 'like', 'PNS'),
            'profileNonPNS' => ProfileGuruPegawai::where('status', 'not like', 'PNS'),
            'namaStatus' => json_encode($namaStatus),
            'jumlahTiapStatus' => json_encode($jumlahTiapStatus),

            'guruBKTotal' => ProfileGuruPegawai::where('jenis_guru', 'Guru BK'),
            'guruBKLakilaki' => ProfileGuruPegawai::where('jenis_guru', 'Guru BK')->where('jenis_kelamin', 'Laki-laki'),
            'guruBKPerempuan' => ProfileGuruPegawai::where('jenis_guru', 'Guru BK')->where('jenis_kelamin', 'Perempuan'),
            'guruBKPNS' => ProfileGuruPegawai::where('jenis_guru', 'Guru BK')->where('status', 'like', 'PNS'),
            'guruBKNonPNS' => ProfileGuruPegawai::where('jenis_guru', 'Guru BK')->where('status', 'not like', 'PNS'),

            'guruKelasTotal' => ProfileGuruPegawai::where('jenis_guru', 'Guru Kelas'),
            'guruKelasLakilaki' => ProfileGuruPegawai::where('jenis_guru', 'Guru Kelas')->where('jenis_kelamin', 'Laki-laki'),
            'guruKelasPerempuan' => ProfileGuruPegawai::where('jenis_guru', 'Guru Kelas')->where('jenis_kelamin', 'Perempuan'),
            'guruKelasPNS' => ProfileGuruPegawai::where('jenis_guru', 'Guru Kelas')->where('status', 'like', 'PNS'),
            'guruKelasNonPNS' => ProfileGuruPegawai::where('jenis_guru', 'Guru Kelas')->where('status', 'not like', 'PNS'),

            'guruMapelTotal' => ProfileGuruPegawai::where('jenis_guru', 'Guru Mapel'),
            'guruMapelLakilaki' => ProfileGuruPegawai::where('jenis_guru', 'Guru Mapel')->where('jenis_kelamin', 'Laki-laki'),
            'guruMapelPerempuan' => ProfileGuruPegawai::where('jenis_guru', 'Guru Mapel')->where('jenis_kelamin', 'Perempuan'),
            'guruMapelPNS' => ProfileGuruPegawai::where('jenis_guru', 'Guru Mapel')->where('status', 'like', 'PNS'),
            'guruMapelNonPNS' => ProfileGuruPegawai::where('jenis_guru', 'Guru Mapel')->where('status', 'not like', 'PNS'),

            'guruPendampingTotal' => ProfileGuruPegawai::where('jenis_guru', 'Guru Pendamping'),
            'guruPendampingLakilaki' => ProfileGuruPegawai::where('jenis_guru', 'Guru Pendamping')->where('jenis_kelamin', 'Laki-laki'),
            'guruPendampingPerempuan' => ProfileGuruPegawai::where('jenis_guru', 'Guru Pendamping')->where('jenis_kelamin', 'Perempuan'),
            'guruPendampingPNS' => ProfileGuruPegawai::where('jenis_guru', 'Guru Pendamping')->where('status', 'like', 'PNS'),
            'guruPendampingNonPNS' => ProfileGuruPegawai::where('jenis_guru', 'Guru Pendamping')->where('status', 'not like', 'PNS'),

            'guruPendampingKhususTotal' => ProfileGuruPegawai::where('jenis_guru', 'Guru Pendamping Khusus'),
            'guruPendampingKhususLakilaki' => ProfileGuruPegawai::where('jenis_guru', 'Guru Pendamping Khusus')->where('jenis_kelamin', 'Laki-laki'),
            'guruPendampingKhususPerempuan' => ProfileGuruPegawai::where('jenis_guru', 'Guru Pendamping Khusus')->where('jenis_kelamin', 'Perempuan'),
            'guruPendampingKhususPNS' => ProfileGuruPegawai::where('jenis_guru', 'Guru Pendamping Khusus')->where('status', 'like', 'PNS'),
            'guruPendampingKhususNonPNS' => ProfileGuruPegawai::where('jenis_guru', 'Guru Pendamping Khusus')->where('status', 'not like', 'PNS'),

            'guruPenggantiTotal' => ProfileGuruPegawai::where('jenis_guru', 'Guru Pengganti'),
            'guruPenggantiLakilaki' => ProfileGuruPegawai::where('jenis_guru', 'Guru Pengganti')->where('jenis_kelamin', 'Laki-laki'),
            'guruPenggantiPerempuan' => ProfileGuruPegawai::where('jenis_guru', 'Guru Pengganti')->where('jenis_kelamin', 'Perempuan'),
            'guruPenggantiPNS' => ProfileGuruPegawai::where('jenis_guru', 'Guru Pengganti')->where('status', 'like', 'PNS'),
            'guruPenggantiNonPNS' => ProfileGuruPegawai::where('jenis_guru', 'Guru Pengganti')->where('status', 'not like', 'PNS'),

            'guruPenggantiTotal' => ProfileGuruPegawai::where('jenis_guru', 'Guru Pengganti'),
            'guruPenggantiLakilaki' => ProfileGuruPegawai::where('jenis_guru', 'Guru Pengganti')->where('jenis_kelamin', 'Laki-laki'),
            'guruPenggantiPerempuan' => ProfileGuruPegawai::where('jenis_guru', 'Guru Pengganti')->where('jenis_kelamin', 'Perempuan'),
            'guruPenggantiPNS' => ProfileGuruPegawai::where('jenis_guru', 'Guru Pengganti')->where('status', 'like', 'PNS'),
            'guruPenggantiNonPNS' => ProfileGuruPegawai::where('jenis_guru', 'Guru Pengganti')->where('status', 'not like', 'PNS'),

            'guruTIKTotal' => ProfileGuruPegawai::where('jenis_guru', 'Guru TIK'),
            'guruTIKLakilaki' => ProfileGuruPegawai::where('jenis_guru', 'Guru TIK')->where('jenis_kelamin', 'Laki-laki'),
            'guruTIKPerempuan' => ProfileGuruPegawai::where('jenis_guru', 'Guru TIK')->where('jenis_kelamin', 'Perempuan'),
            'guruTIKPNS' => ProfileGuruPegawai::where('jenis_guru', 'Guru TIK')->where('status', 'like', 'PNS'),
            'guruTIKNonPNS' => ProfileGuruPegawai::where('jenis_guru', 'Guru TIK')->where('status', 'not like', 'PNS'),

            'instrukturTotal' => ProfileGuruPegawai::where('jenis_guru', 'Instruktur'),
            'instrukturLakilaki' => ProfileGuruPegawai::where('jenis_guru', 'Instruktur')->where('jenis_kelamin', 'Laki-laki'),
            'instrukturPerempuan' => ProfileGuruPegawai::where('jenis_guru', 'Instruktur')->where('jenis_kelamin', 'Perempuan'),
            'instrukturPNS' => ProfileGuruPegawai::where('jenis_guru', 'Instruktur')->where('status', 'like', 'PNS'),
            'instrukturNonPNS' => ProfileGuruPegawai::where('jenis_guru', 'Instruktur')->where('status', 'not like', 'PNS'),

            'kepalaSekolahTotal' => ProfileGuruPegawai::where('jenis_guru', 'Kepala Sekolah'),
            'kepalaSekolahLakilaki' => ProfileGuruPegawai::where('jenis_guru', 'Kepala Sekolah')->where('jenis_kelamin', 'Laki-laki'),
            'kepalaSekolahPerempuan' => ProfileGuruPegawai::where('jenis_guru', 'Kepala Sekolah')->where('jenis_kelamin', 'Perempuan'),
            'kepalaSekolahPNS' => ProfileGuruPegawai::where('jenis_guru', 'Kepala Sekolah')->where('status', 'like', 'PNS'),
            'kepalaSekolahNonPNS' => ProfileGuruPegawai::where('jenis_guru', 'Kepala Sekolah')->where('status', 'not like', 'PNS'),

            'laboranTotal' => ProfileGuruPegawai::where('jenis_guru', 'Laboran'),
            'laboranLakilaki' => ProfileGuruPegawai::where('jenis_guru', 'Laboran')->where('jenis_kelamin', 'Laki-laki'),
            'laboranPerempuan' => ProfileGuruPegawai::where('jenis_guru', 'Laboran')->where('jenis_kelamin', 'Perempuan'),
            'laboranPNS' => ProfileGuruPegawai::where('jenis_guru', 'Laboran')->where('status', 'like', 'PNS'),
            'laboranNonPNS' => ProfileGuruPegawai::where('jenis_guru', 'Laboran')->where('status', 'not like', 'PNS'),

            'penjagaSekolahTotal' => ProfileGuruPegawai::where('jenis_guru', 'Penjaga Sekolah'),
            'penjagaSekolahLakilaki' => ProfileGuruPegawai::where('jenis_guru', 'Penjaga Sekolah')->where('jenis_kelamin', 'Laki-laki'),
            'penjagaSekolahPerempuan' => ProfileGuruPegawai::where('jenis_guru', 'Penjaga Sekolah')->where('jenis_kelamin', 'Perempuan'),
            'penjagaSekolahPNS' => ProfileGuruPegawai::where('jenis_guru', 'Penjaga Sekolah')->where('status', 'like', 'PNS'),
            'penjagaSekolahNonPNS' => ProfileGuruPegawai::where('jenis_guru', 'Penjaga Sekolah')->where('status', 'not like', 'PNS'),

            'pesuruhTotal' => ProfileGuruPegawai::where('jenis_guru', 'Pesuruh/Office Boy'),
            'pesuruhLakilaki' => ProfileGuruPegawai::where('jenis_guru', 'Pesuruh/Office Boy')->where('jenis_kelamin', 'Laki-laki'),
            'pesuruhPerempuan' => ProfileGuruPegawai::where('jenis_guru', 'Pesuruh/Office Boy')->where('jenis_kelamin', 'Perempuan'),
            'pesuruhPNS' => ProfileGuruPegawai::where('jenis_guru', 'Pesuruh/Office Boy')->where('status', 'like', 'PNS'),
            'pesuruhNonPNS' => ProfileGuruPegawai::where('jenis_guru', 'Pesuruh/Office Boy')->where('status', 'not like', 'PNS'),

            'petugasKeamananTotal' => ProfileGuruPegawai::where('jenis_guru', 'Petugas Keamanan'),
            'petugasKeamananLakilaki' => ProfileGuruPegawai::where('jenis_guru', 'Petugas Keamanan')->where('jenis_kelamin', 'Laki-laki'),
            'petugasKeamananPerempuan' => ProfileGuruPegawai::where('jenis_guru', 'Petugas Keamanan')->where('jenis_kelamin', 'Perempuan'),
            'petugasKeamananPNS' => ProfileGuruPegawai::where('jenis_guru', 'Petugas Keamanan')->where('status', 'like', 'PNS'),
            'petugasKeamananNonPNS' => ProfileGuruPegawai::where('jenis_guru', 'Petugas Keamanan')->where('status', 'not like', 'PNS'),

            'tenagaAdministrasiTotal' => ProfileGuruPegawai::where('jenis_guru', 'Tenaga Administrasi Sekolah'),
            'tenagaAdministrasiLakilaki' => ProfileGuruPegawai::where('jenis_guru', 'Tenaga Administrasi Sekolah')->where('jenis_kelamin', 'Laki-laki'),
            'tenagaAdministrasiPerempuan' => ProfileGuruPegawai::where('jenis_guru', 'Tenaga Administrasi Sekolah')->where('jenis_kelamin', 'Perempuan'),
            'tenagaAdministrasiPNS' => ProfileGuruPegawai::where('jenis_guru', 'Tenaga Administrasi Sekolah')->where('status', 'like', 'PNS'),
            'tenagaAdministrasiNonPNS' => ProfileGuruPegawai::where('jenis_guru', 'Tenaga Administrasi Sekolah')->where('status', 'not like', 'PNS'),

            'tenagaPerpustakaanTotal' => ProfileGuruPegawai::where('jenis_guru', 'Tenaga Perpustakaan'),
            'tenagaPerpustakaanLakilaki' => ProfileGuruPegawai::where('jenis_guru', 'Tenaga Perpustakaan')->where('jenis_kelamin', 'Laki-laki'),
            'tenagaPerpustakaanPerempuan' => ProfileGuruPegawai::where('jenis_guru', 'Tenaga Perpustakaan')->where('jenis_kelamin', 'Perempuan'),
            'tenagaPerpustakaanPNS' => ProfileGuruPegawai::where('jenis_guru', 'Tenaga Perpustakaan')->where('status', 'like', 'PNS'),
            'tenagaPerpustakaanNonPNS' => ProfileGuruPegawai::where('jenis_guru', 'Tenaga Perpustakaan')->where('status', 'not like', 'PNS'),

            'tukangKebunTotal' => ProfileGuruPegawai::where('jenis_guru', 'Tukang Kebun'),
            'tukangKebunLakilaki' => ProfileGuruPegawai::where('jenis_guru', 'Tukang Kebun')->where('jenis_kelamin', 'Laki-laki'),
            'tukangKebunPerempuan' => ProfileGuruPegawai::where('jenis_guru', 'Tukang Kebun')->where('jenis_kelamin', 'Perempuan'),
            'tukangKebunPNS' => ProfileGuruPegawai::where('jenis_guru', 'Tukang Kebun')->where('status', 'like', 'PNS'),
            'tukangKebunNonPNS' => ProfileGuruPegawai::where('jenis_guru', 'Tukang Kebun')->where('status', 'not like', 'PNS'),

            'tutorTotal' => ProfileGuruPegawai::where('jenis_guru', 'Tutor'),
            'tutorLakilaki' => ProfileGuruPegawai::where('jenis_guru', 'Tutor')->where('jenis_kelamin', 'Laki-laki'),
            'tutorPerempuan' => ProfileGuruPegawai::where('jenis_guru', 'Tutor')->where('jenis_kelamin', 'Perempuan'),
            'tutorPNS' => ProfileGuruPegawai::where('jenis_guru', 'Tutor')->where('status', 'like', 'PNS'),
            'tutorNonPNS' => ProfileGuruPegawai::where('jenis_guru', 'Tutor')->where('status', 'not like', 'PNS'),

            'lainnyaTotal' => ProfileGuruPegawai::where('jenis_guru', 'Lainnya'),
            'lainnyaLakilaki' => ProfileGuruPegawai::where('jenis_guru', 'Lainnya')->where('jenis_kelamin', 'Laki-laki'),
            'lainnyaPerempuan' => ProfileGuruPegawai::where('jenis_guru', 'Lainnya')->where('jenis_kelamin', 'Perempuan'),
            'lainnyaPNS' => ProfileGuruPegawai::where('jenis_guru', 'Lainnya')->where('status', 'like', 'PNS'),
            'lainnyaNonPNS' => ProfileGuruPegawai::where('jenis_guru', 'Lainnya')->where('status', 'not like', 'PNS'),


        ];




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
