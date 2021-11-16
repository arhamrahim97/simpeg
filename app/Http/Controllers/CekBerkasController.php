<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UsulanGaji;
use App\Models\UsulanPangkat;
use Illuminate\Http\Request;
use \Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Storage;

class CekBerkasController extends Controller
{
    public function index()
    {
        return view('pages.welcome.cekBerkas');
    }

    public function getCekBerkas(Request $request)
    {
        $idDokumen = $request->idDokumen;
        $hariIni = \Carbon\Carbon::now()->locale('id');
        $usulanGaji = UsulanGaji::where('unique_id', $idDokumen)->first();
        $usulanPangkat = UsulanPangkat::where('unique_id', $idDokumen)->first();
        $barcode = new DNS2D;
        $barcode->setStorPath(__DIR__ . '/cache/');
        $ttdKepalaDinas = '';
        $dataHtml = '';
        if ($usulanGaji) {

            $mulaiBerlaku = \Carbon\Carbon::createFromFormat('Y-m-d', $usulanGaji->tmt_gaji_sebelumnya)->locale('id');
            $user = User::where('id', $usulanGaji->id_user)->first();
            $tanggalLahir = \Carbon\Carbon::createFromFormat('Y-m-d', $user->profile->tanggal_lahir)->locale('id');
            $mulaiTanggal = \Carbon\Carbon::createFromFormat('Y-m-d', $usulanGaji->tmt_gaji_selanjutnya)->locale('id');
            $kepalaDinas = User::where('role', 'Kepala Dinas')->where('status', 1)->first();
            if ($kepalaDinas) {
                $ttdKepalaDinas = '<p class="mb-0 fw-bold text-uppercase" style="border-bottom:1px solid black "> ' . $kepalaDinas->nama . '
                    </p>
                    <p class="mb-0">' . $kepalaDinas->profilePejabat->jabatanStruktural->jabatan . '</p>
                    <p class="mb-0">NIP. ' . $kepalaDinas->profilePejabat->nip . '</p>
                    <div class="gambarTtd">
                        <img src=" ' . Storage::url('upload/foto-ttd/' . $kepalaDinas->profilePejabat->foto_ttd) . '" alt=""
                            width="225px">
                    </div>
                    <div class="cap">
                        <img src="assets/dashboard/img/cap.png" alt="" width="125px">
                    </div>';
            }


            if ($user->role == 'Guru') {
                $jabatanPangkat = '<td width="75%">
                <p class=""> : ' . $user->profile->jabatanFungsional->pangkat . ' /
                    ' . $user->profile->jabatanFungsional->golongan . '</p>
            </td>';
            } else if ($user->role == 'Pegawai') {
                $jabatanPangkat = '<td width="75%">
                <p class=""> : ' . $user->profile->jabatanStruktural->pangkat . ' /' .
                    $user->profile->jabatanStruktural->golongan . '</p>
            </td>';
            }



            $dataHtml .= '<table width="100%" style="border-bottom: 3px solid black">
        <tr>
            <td width="20%" align="center"><img src="' . asset('assets/dashboard/img/kota_palu.png') . '" width="50px"></td>
            <td width="80%" align="center" class="mb-2">
                <p class="mb-0 fw-bold" style="font-size: 15px">PEMERINTAH KOTA PALU</p>
                <p class="mb-0 fw-bold" style="font-size: 17px">DINAS PENDIDIKAN DAN KEBUDAYAAN</p>
                <p class="mb-0" style="font-size: 12px">Jalan Bantilan Kelurahan Lere Telepon (0451) 4021542 Kode Pos
                    94221</p>
                <p style="font-size: 12px">E-Mail : <a href="">disdikpalu.kota@gmail.com</a> Website : <a
                        href="">www.disdikbudkotapalu.com</a>
                </p>
            </td>
        </tr>
    </table>

    <table width="100%" class="times">
        <tr>
            <td width="10%">
                No.Pend
                Perihal
            </td>
            <td width="40%">
                : ' . $usulanGaji->nomor_surat . '.3 / 149-KB/ PT / DIKBUD <br>
                : Kenaikan Gaji Berkala
            </td>
            <td width="20%"></td>
            <td width="30%">
                <p class="mb-0"><span class="tab3"></span>Palu,
                    ' . $hariIni->day . ' ' . $hariIni->monthName . ' ' . $hariIni->year . '</p>
                <p class="mb-0"><span class="tab3"></span>Kepada</p>
                <p class="mb-0"> Yth. Kepala Pengelolaan Keuangan</p>
                <p class="mb-0"><span class="tab3"></span>dan Aset Daerah Kota Palu</p>
                <p class="mb-0"><span class="tab2"></span>Di-</p>
                <p class="mb-0"><span class="tab4"></span>Palu</p>
            </td>
        </tr>
    </table>

    <p class="times mt-3"> <span class="tab"></span>Dengan ini diberitahukan bahwa dengan telah
        dipenuhinya masa kerja
        dan
        syarat-syarat lainnya
        kepada :
    </p>

    <table width="100%" class="times">
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>1. Nama</p>
            </td>
            <td width="75%">
                <p class=""> : <span class="fw-bold">' . $user->nama . '</span></p>
            </td>
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>2. NIP</p>
            </td>
            <td width="75%">
                <p class=""> : ' . $user->profile->nip . '</p>
            </td>
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>3. Tempat / Tanggal Lahir</p>
            </td>
            <td width="75%">
                <p class=""> :
                    ' . $user->profile->tempat_lahir . ',' . $tanggalLahir->day . ' ' . $tanggalLahir->monthName . ' ' . $tanggalLahir->year . '
                </p>
            </td>
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>4. Pangkat/Gol</p>
            </td>
            ' . $jabatanPangkat . '
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>5. Jenis Guru</p>
            </td>
            <td width="75%">
                <p class=""> : ' . $user->profile->jenis_guru . '</p>
            </td>
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>6. Jabatan</p>
            </td>
            <td width="75%">
                <p class=""> : ' . $user->profile->jabatanStruktural->jabatan . '</p>
            </td>
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>7. Tempat Tugas</p>
            </td>
            <td width="75%">
                <p class=""> : ' . $user->profile->unitKerja->nama . '</p>
            </td>
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>8. Gaji Pokok Lama</p>
            </td>
            <td width="75%">
                <p class=""> : Rp. ' . number_format($usulanGaji->nilai_gaji_sebelumnya, 0, ',', '.') . '</p>
            </td>
        </tr>
    </table>

    <p class="times"><span class="tab"></span>Atas dasar Surat Keputusan terakhir tentang Kenaikan Berkala /
        Kenaikan
        Pangkat Pegawai Negeri Sipil yang ditetapkan :
    </p>

    <table width="100%" class="times">
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>a. Oleh Pejabat</p>
            </td>
            <td width="75%">
                <p class=""> : Kepala Dinas Pendidikan dan Kebudayaan</p>
            </td>
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>b. Nomor dan Tanggal</p>
            </td>
            <td width="75%">
                <p class=""> : ' . $usulanGaji->nomor_surat . ' / 186/PS/Dikbud <span
                        class="tab2"></span> ' . $hariIni->day . ' ' . $hariIni->monthName . ' ' . $hariIni->year . '</p>
            </td>
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>c. Tanggal Mulai Berlaku<br><span class="tab2"></span>Gaji
                    Tersebut </p>
            </td>
            <td width="75%" class="align-bottom">
                <p class=""> : ' . $mulaiBerlaku->day . ' ' . $mulaiBerlaku->monthName . ' ' .
                $mulaiBerlaku->year . '
            </td>
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>d. Masa Kerja Golongan<br><span class="tab2"></span>Pada
                    tanggal
                    tersebut </p>
            </td>
            <td width="75%" class="align-bottom">
                <p class=""> : ' . $usulanGaji->jumlah_tahun_kerja_lama . ' Tahun
                     ' . $usulanGaji->jumlah_bulan_kerja_lama . ' Bulan</p>
            </td>
        </tr>
    </table>
    <p class="mb-0 times"><span class="tab2"></span>Diberikan Kenaikan Gaji Berkala hingga memperoleh : </p>
    <table width="100%" class="times">
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>e. Gaji Pokok Baru</p>
            </td>
            <td width="75%">
                <p class=""> : Rp. ' . number_format($usulanGaji->nilai_gaji_selanjutnya, 0, ',', '.') . '</p>
            </td>
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>f. Berdasarkan Masa Kerja</p>
            </td>
            <td width="75%">
                <p class=""> : ' . ($usulanGaji->jumlah_tahun_kerja_lama + 2) . ' Tahun
                    ' . $usulanGaji->jumlah_bulan_kerja_lama . ' Bulan</p>
            </td>
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>g. Dalam Golongan</p>
            </td>
            ' . $jabatanPangkat . '
        </tr>
        <tr>
            <td width="35%">
                <p class=""><span class="tab"></span>h. Mulai Tanggal</p>
            </td>
            <td width="75%">
                <p class=""> :
                                        ' . $mulaiTanggal->day . ' ' . $mulaiTanggal->monthName . ' ' .
                $mulaiTanggal->year . '
                </p>
            </td>
        </tr>
    </table>


    <p class="times "><span class="tab"></span>Dapat dibayarkan penghasilannya berdasarkan gaji pokoknya yang baru
        sesuai dengan Peraturan Pemerintah No. 15 Tahun 2019
    </p>

    <table width="100%" class="times mt-3">
        <tr>
            <td width="60%"></td>
            <td width="40%" class="text-center">
                <div class="ttd">
                    <p>Plt. Kepala Dinas Pendidikan dan Kebudayaan Kota Palu,</p>
                    <br>
                    <br>
                    <br>
                    ' . $ttdKepalaDinas . '
                </div>

            </td>
        </tr>
    </table>
    <br>
    <table width="100%" class="times">
        <tr>
            <td width="90%">
                <p class="mb-0">Tembusan surat ini disampaikan kepada :</p>
                <ol type="1">
                    <li>Menteri Dalam Negeri di Jakarta</li>
                    <li>Kepala BKN Up. Deputi Bidang Informasi Kepegawaian di Jakarta</li>
                    <li>Direktur Jenderal Anggaran Departemen Keuangan di Jakarta</li>
                    <li>Direktur Pembendaharaan dan Kas Negara di Jakarta</li>
                    <li>Kepala Kantor Regional IV BKN di Makassar</li>
                    <li>Kepala PT Taspen (PERSERO) Cabang Palu di Palu</li>
                    <li>Bendaharawan Gaji Pegawai Negeri Sipil yang bersangkutan</li>
                    <li>Sdr./i : <span class="fw-bold text-uppercase">' . $user->nama . '</span></li>
                </ol>
            </td>
            <td width="10%" class="text-center align-items-center">
                <img src="data:image/png;base64,' . $barcode->getBarcodePNG($usulanGaji->unique_id, 'QRCODE') . '"
                    alt="barcode" /><br>
                    <p>ID Dokumen : ' . $usulanGaji->unique_id . '</p><br><br>
            </td>
        </tr>
    </table>';
        } else if ($usulanPangkat) {

            $user = User::where('id', $usulanPangkat->id_user)->first();
            $hariIni = \Carbon\Carbon::now()->locale('id');
            $sekretaris = User::where('role', 'Sekretaris')->where('status', 1)->first();
            if ($user->role == "Guru") {
                $pangkatSelanjutnya = '<p>' . $usulanPangkat->pangkatFungsionalSelanjutnya->jabatan . '</p>';
            } else {
                $pangkatSelanjutnya = '<p>' . $usulanPangkat->pangkatStrukturalSelanjutnya->jabatan . '</p>';
            }
            $ttdSekretaris = '';
            if ($sekretaris) {
                $ttdSekretaris = '<p class="mb-0 fw-bold text-uppercase" style="border-bottom:2px solid black ">' . $sekretaris->nama . '
                    </p>
                    <p class="mb-0">' . $sekretaris->profilePejabat->jabatanStruktural->jabatan . '</p>
                    <p class="mb-0">NIP. ' . $sekretaris->profilePejabat->nip . '  </p>
                    <div class="gambarTtd">
                        <img src="' . Storage::url('upload/foto-ttd/' . $sekretaris->profilePejabat->foto_ttd) . '" alt=""
                            width="225px">
                    </div>
                    <div class="cap">
                        <img src="assets/dashboard/img/cap.png" alt="" width="125px">
                    </div>';
            }
            $dataHtml .= '<table width="100%" style="border-bottom: 3px solid black">
        <tr>
            <td width="20%" align="center"><img src="' . asset('assets/dashboard/img/kota_palu.png') . '" width="50px"></td>
            <td width="80%" align="center" class="mb-2">
                <p class="mb-0 fw-bold" style="font-size: 15px">PEMERINTAH KOTA PALU</p>
                <p class="mb-0 fw-bold" style="font-size: 17px">DINAS PENDIDIKAN DAN KEBUDAYAAN</p>
                <p class="mb-0" style="font-size: 12px">Jalan Bantilan Kelurahan Lere Telepon (0451) 4021542 Kode Pos
                    94221</p>
                <p style="font-size: 12px">E-Mail : <a href="">disdikpalu.kota@gmail.com</a> Website : <a
                        href="">www.disdikbudkotapalu.com</a>
                </p>
            </td>
        </tr>
    </table>

    <table width="100%" class="times">
        <tr>
            <td width="60%"></td>
            <td width="40%">
                <p class="mb-0"><span style="display: inline-block;
                    margin-left: 22px;"></span>Palu,
                    ' . $hariIni->day . ' ' . $hariIni->monthName . ' ' . $hariIni->year . '</p>
                <p class="mb-0"><span style="display: inline-block;
                    margin-left: 22px;"></span>Kepada</p>
                <p class="mb-0"> Yth. Kepala Badan Kepegawaian dan Pengembangan</p>
                <p class="mb-0"><span style="display: inline-block;
                    margin-left: 20px;"></span> Sumber Daya Manusia Daerah Kota Palu</p>
                <p class="mb-0"><span style="display: inline-block;
                    margin-left: 23px;"></span>Di-</p>
                <p class="mb-0"><span class="tab4"></span>Palu</p>
            </td>
        </tr>
    </table>

    <p class="text-center fw-bold times text-decoration-underline mb-0 mt-3">SURAT PENGANTAR</p>
    <p class="text-center times mt-0">Nomor : ' . $usulanPangkat->nomor_surat . '.2/ABCTES/Dikbud</p>

    <table style="width:100%" class="table-content times mt-3">
        <tr class="fw-bold text-center">
            <td width="5%">No</td>
            <td>Jenis Yang Dikirim</td>
            <td>Banyaknya</td>
            <td>Keterangan</td>
        </tr>
        <tr style="border-bottom : 0px !important">
            <td style="border-bottom : 0px !important"></td>
            <td style="border-bottom : 0px !important" class="p-2">Pengusulan Berkas Kenaikan Pangkat a.n :</td>
            <td style="border-bottom : 0px !important"></td>
            <td style="border-bottom : 0px !important"></td>
        </tr>
        <tr style="border-top : 0px !important">
            <td style="border-top : 0px !important" class="text-center">1</td>
            <td style="border-top : 0px !important" class="p-2">
                <p class="fw-bold">' . $user->nama . '</p>
                <p>' . $user->profile->nip . '</p>
                ' . $pangkatSelanjutnya . '
                <p>' . $user->profile->unitKerja->nama . '</p>
            </td>
            <td style="border-top : 0px !important" class="p-2">
                <p>1 (Satu)</p>
                <p>Berkas</p>
            </td>
            <td style="border-top : 0px !important" class="p-2">Dikirim dengan hormat untuk proses selanjutnya</td>
        </tr>
    </table>

    <table width="100%" class="times mt-3">
        <tr>
            <td width="60%" class="text-center align-items-center">
                <img src="data:image/png;base64,' . $barcode->getBarcodePNG($usulanPangkat->unique_id, 'QRCODE') . '"
                    alt="barcode" /><br>
                <p>ID Dokumen : ' . $usulanPangkat->unique_id . '</p><br>
            </td>
            <td width="40%" class="text-center">
                <div class="ttd">
                    <p>a.n. Kepala Dinas Pendidikan dan Kebudayaan Kota Palu</p>
                    <p>Sekretaris,</p>
                    <br>
                    <br>
                    <br>
                    ' . $ttdSekretaris . '
                </div>

            </td>
        </tr>
    </table>

    <table width="100%" class="times mt-3" style="border-bottom: 2px solid black">
        <tr>
            <td width="15%" class="text-decoration-underline">Yang Membawa</td>
            <td width="85%">

            </td>
        </tr>
        <tr>
            <td width="15%">Nama</td>
            <td width="85%">
                :
            </td>
        </tr>
        <tr>
            <td width="15%">Nip</td>
            <td width="85%">
                :
            </td>
        </tr>
        <tr>
            <td width="15%">Tanda Tangan</td>
            <td width="85%">
                :
            </td>
        </tr>
        <tr>
            <td width="15%">No. Hp</td>
            <td width="85%">
                :
            </td>
        </tr>
    </table>
    <table width="100%" class="times mt-2">
        <tr>
            <td width="15%" class="text-decoration-underline">Pemeriksa</td>
            <td width="85%">

            </td>
        </tr>
        <tr>
            <td width="15%">Nama</td>
            <td width="85%">
                :
            </td>
        </tr>
        <tr>
            <td width="15%">Nip</td>
            <td width="85%">
                :
            </td>
        </tr>
        <tr>
            <td width="15%">Tanda Tangan</td>
            <td width="85%">
                :
            </td>
        </tr>
    </table>';
        }
        if ($usulanGaji || $usulanPangkat) {
            return response()->json([
                'res' => 'success',
                'dataHtml' => $dataHtml
            ]);
        } else {
            $dataHtml .= '<p class="text-center">Data Tidak Ada</p>';
            return response()->json([
                'res' => 'error',
                'dataHtml' => $dataHtml
            ]);
        }
    }
}
