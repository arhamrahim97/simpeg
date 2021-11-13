<?php

namespace App\Http\Controllers\guru_pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;
use App\Models\User;
use App\Models\UsulanGaji;
use App\Models\UsulanPangkat;
use Illuminate\Support\Facades\Auth;

class DashboardGuruPegawaiController extends Controller
{
    public function index()
    {
        $berkasUsulanGaji = '';
        $statusGaji = '';

        $berkasUsulanPangkat = '';
        $statusPangkat = '';

        $usulanPangkat = $this->_cekUsulanPangkat();
        $usulanGaji = $this->_cekUsulanGaji();
        if (!$usulanGaji) {
            $berkasUsulanGaji = UsulanGaji::where('id_user', Auth::user()->id)->latest()->first();
            if ($berkasUsulanGaji) {
                if ($berkasUsulanGaji->status_kepegawaian == 0 && $berkasUsulanGaji->status_kasubag == 0 && $berkasUsulanGaji->status_sekretaris == 0 && $berkasUsulanGaji->status_kepala_dinas == 0) {
                    $statusGaji = '<span class="badge p-2 badge-warning">Berkas Sedang Diperiksa Admin Kepegawaian</span>';
                } else if ($berkasUsulanGaji->status_kepegawaian == 2 && $berkasUsulanGaji->status_kasubag == 0 && $berkasUsulanGaji->status_sekretaris == 0 && $berkasUsulanGaji->status_kepala_dinas == 0) {
                    $statusGaji = '<span class="badge p-2 badge-danger">Berkas Ditolak Admin Kepegawaian</span>';
                } else if ($berkasUsulanGaji->status_kepegawaian == 1 && $berkasUsulanGaji->status_kasubag == 0 && $berkasUsulanGaji->status_sekretaris == 0 && $berkasUsulanGaji->status_kepala_dinas == 0) {
                    $statusGaji = '<span class="badge p-2 badge-warning">Berkas Sedang Diperiksa Kasubag Kepegawaian</span>';
                } else if ($berkasUsulanGaji->status_kepegawaian == 1 && $berkasUsulanGaji->status_kasubag == 2 && $berkasUsulanGaji->status_sekretaris == 0 && $berkasUsulanGaji->status_kepala_dinas == 0) {
                    $statusGaji = '<span class="badge p-2 badge-danger">Berkas Ditolak Kasubag Kepegawaian</span>';
                } else if ($berkasUsulanGaji->status_kepegawaian == 1 && $berkasUsulanGaji->status_kasubag == 1 && $berkasUsulanGaji->status_sekretaris == 0 && $berkasUsulanGaji->status_kepala_dinas == 0) {
                    $statusGaji = '<span class="badge p-2 badge-warning">Berkas Sedang Diperiksa Sekretaris</span>';
                } else if ($berkasUsulanGaji->status_kepegawaian == 1 && $berkasUsulanGaji->status_kasubag == 1 && $berkasUsulanGaji->status_sekretaris == 2 && $berkasUsulanGaji->status_kepala_dinas == 0) {
                    $statusGaji = '<span class="badge p-2 badge-danger">Berkas Ditolak Sekretaris</span>';
                } else if ($berkasUsulanGaji->status_kepegawaian == 1 && $berkasUsulanGaji->status_kasubag == 1 && $berkasUsulanGaji->status_sekretaris == 1 && $berkasUsulanGaji->status_kepala_dinas == 0) {
                    $statusGaji = '<span class="badge p-2 badge-warning">Berkas Sedang Diperiksa Kepala Dinas</span>';
                } else if ($berkasUsulanGaji->status_kepegawaian == 1 && $berkasUsulanGaji->status_kasubag == 1 && $berkasUsulanGaji->status_sekretaris == 1 && $berkasUsulanGaji->status_kepala_dinas == 2) {
                    $statusGaji = '<span class="badge p-2 badge-danger">Berkas Ditolak Kepala Dinas</span>';
                } else if ($berkasUsulanGaji->status_kepegawaian == 1 && $berkasUsulanGaji->status_kasubag == 1 && $berkasUsulanGaji->status_sekretaris == 1 && $berkasUsulanGaji->status_kepala_dinas == 1) {
                    $statusGaji = '<span class="badge p-2 badge-success">Berkas Selesai Diperiksa</span>';
                }
            }
        }

        if (!$usulanPangkat) {
            $berkasUsulanPangkat = UsulanPangkat::where('id_user', Auth::user()->id)->latest()->first();
            if ($berkasUsulanPangkat) {
                if ($berkasUsulanPangkat->status_tim_penilai == 0 && $berkasUsulanPangkat->status_kepegawaian == 0 && $berkasUsulanPangkat->status_kasubag == 0 && $berkasUsulanPangkat->status_sekretaris == 0 && $berkasUsulanPangkat->status_kepala_dinas == 0) {
                    $statusPangkat = '<span class="badge p-2 badge-warning">Berkas Sedang Diperiksa Tim Penilai</span>';
                } else if ($berkasUsulanPangkat->status_tim_penilai == 2 && $berkasUsulanPangkat->status_kepegawaian == 0 && $berkasUsulanPangkat->status_kasubag == 0 && $berkasUsulanPangkat->status_sekretaris == 0 && $berkasUsulanPangkat->status_kepala_dinas == 0) {
                    $statusPangkat = '<span class="badge p-2 badge-danger">Berkas Ditolak Tim Penilai</span>';
                } else if ($berkasUsulanPangkat->status_tim_penilai == 1 && $berkasUsulanPangkat->status_kepegawaian == 0 && $berkasUsulanPangkat->status_kasubag == 0 && $berkasUsulanPangkat->status_sekretaris == 0 && $berkasUsulanPangkat->status_kepala_dinas == 0) {
                    $statusPangkat = '<span class="badge p-2 badge-warning">Berkas Sedang Diperiksa Admin Kepegawaian</span>';
                } else if ($berkasUsulanPangkat->status_tim_penilai == 1 && $berkasUsulanPangkat->status_kepegawaian == 2 && $berkasUsulanPangkat->status_kasubag == 0 && $berkasUsulanPangkat->status_sekretaris == 0 && $berkasUsulanPangkat->status_kepala_dinas == 0) {
                    $statusPangkat = '<span class="badge p-2 badge-danger">Berkas Ditolak Admin Kepegawaian</span>';
                } else if ($berkasUsulanPangkat->status_tim_penilai == 1 && $berkasUsulanPangkat->status_kepegawaian == 1 && $berkasUsulanPangkat->status_kasubag == 0 && $berkasUsulanPangkat->status_sekretaris == 0 && $berkasUsulanPangkat->status_kepala_dinas == 0) {
                    $statusPangkat = '<span class="badge p-2 badge-warning">Berkas Sedang Diperiksa Kasubag Kepegawaian</span>';
                } else if ($berkasUsulanPangkat->status_tim_penilai == 1 && $berkasUsulanPangkat->status_kepegawaian == 1 && $berkasUsulanPangkat->status_kasubag == 2 && $berkasUsulanPangkat->status_sekretaris == 0 && $berkasUsulanPangkat->status_kepala_dinas == 0) {
                    $statusPangkat = '<span class="badge p-2 badge-danger">Berkas Ditolak Kasubag Kepegawaian</span>';
                } else if ($berkasUsulanPangkat->status_tim_penilai == 1 && $berkasUsulanPangkat->status_kepegawaian == 1 && $berkasUsulanPangkat->status_kasubag == 1 && $berkasUsulanPangkat->status_sekretaris == 0 && $berkasUsulanPangkat->status_kepala_dinas == 0) {
                    $statusPangkat = '<span class="badge p-2 badge-warning">Berkas Sedang Diperiksa Sekretaris</span>';
                } else if ($berkasUsulanPangkat->status_tim_penilai == 1 && $berkasUsulanPangkat->status_kepegawaian == 1 && $berkasUsulanPangkat->status_kasubag == 1 && $berkasUsulanPangkat->status_sekretaris == 2 && $berkasUsulanPangkat->status_kepala_dinas == 0) {
                    $statusPangkat = '<span class="badge p-2 badge-danger">Berkas Ditolak Admin Sekretaris</span>';
                } else if ($berkasUsulanPangkat->status_tim_penilai == 1 && $berkasUsulanPangkat->status_kepegawaian == 1 && $berkasUsulanPangkat->status_kasubag == 1 && $berkasUsulanPangkat->status_sekretaris == 1 && $berkasUsulanPangkat->status_kepala_dinas == 0) {
                    $statusPangkat = '<span class="badge p-2 badge-warning">Berkas Sedang Diperiksa Kepala Dinas</span>';
                } else if ($berkasUsulanPangkat->status_tim_penilai == 1 && $berkasUsulanPangkat->status_kepegawaian == 1 && $berkasUsulanPangkat->status_kasubag == 1 && $berkasUsulanPangkat->status_sekretaris == 1 && $berkasUsulanPangkat->status_kepala_dinas == 2) {
                    $statusPangkat = '<span class="badge p-2 badge-danger">Berkas Ditolak Kepala Dinas</span>';
                } else if ($berkasUsulanPangkat->status_tim_penilai == 1 && $berkasUsulanPangkat->status_kepegawaian == 1 && $berkasUsulanPangkat->status_kasubag == 1 && $berkasUsulanPangkat->status_sekretaris == 1 && $berkasUsulanPangkat->status_kepala_dinas == 1) {
                    $statusPangkat = '<span class="badge p-2 badge-success">Berkas Selesai Diperiksa</span>';
                }
            }
        }

        return view('pages.dashboard.dashboardGuru', compact('usulanPangkat', 'usulanGaji', 'berkasUsulanGaji', 'statusGaji', 'berkasUsulanPangkat', 'statusPangkat'));
    }

    private function _cekUsulanPangkat()
    {
        $sekarang = new DateTime("now");
        $tmt_pangkat = new DateTime(Auth::user()->profile->tmt_pangkat);
        $tahun = $tmt_pangkat->diff($sekarang)->format('%r%y');

        $cekUsulanPangkat = UsulanPangkat::where('tmt_pangkat_sebelumnya', Auth::user()->profile->tmt_pangkat)->first();
        // Cek Apakah TMT Gaji sudah lebih dari 2 tahun dan cek apakah usulan dengan tmt user sekarang sudah ada atau belum
        $usulan = '';
        if (Auth::user()->role == "Guru") {
            if ($tahun >= 2 && !($cekUsulanPangkat)) {
                $usulan = true;
            }
        } else if (Auth::user()->role == "Pegawai") {
            if ($tahun >= 4 && !($cekUsulanPangkat)) {
                $usulan = true;
            }
        }
        return $usulan;
    }

    private function _cekUsulanGaji()
    {
        $sekarang = new DateTime("now");
        $tmt_gaji = new DateTime(Auth::user()->profile->tmt_gaji);
        $tahun = $tmt_gaji->diff($sekarang)->format('%r%y');

        $cekUsulanGaji = UsulanGaji::where('tmt_gaji_sebelumnya', Auth::user()->profile->tmt_gaji)->first();
        $usulan = '';
        // Cek Apakah TMT Gaji sudah lebih dari 2 tahun dan cek apakah usulan dengan tmt user sekarang sudah ada atau belum
        if ($tahun > 2 && !($cekUsulanGaji)) {
            $usulan = true;
        }
        return $usulan;
    }
}
