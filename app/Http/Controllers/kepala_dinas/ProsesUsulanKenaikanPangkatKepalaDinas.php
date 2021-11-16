<?php

namespace App\Http\Controllers\kepala_dinas;

use App\Http\Controllers\Controller;
use App\Models\UsulanPangkat;
use Illuminate\Http\Request;
use App\Models\BerkasDasar;
use App\Models\BerkasUsulanPangkat;
use App\Models\JabatanFungsional;
use App\Models\JabatanStruktural;
use App\Models\ProfileGuruPegawai;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProsesUsulanKenaikanPangkatKepalaDinas extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = UsulanPangkat::with(['user', 'profileGuruPegawai'])->orderBy('id', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<button type="button" class="btn btn-sm btn-primary lihatTimeline" id="' . $row->id . '">
                            Lihat
                        </button>';
                    return $actionBtn;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->statusBerkas != '') {
                        $instance->where('status_kepala_dinas', $request->statusBerkas);
                    }

                    if ($request->jenisAsn != '') {
                        $instance->whereHas('profileGuruPegawai', function ($profile) use ($request) {
                            $profile->where('jenis_asn', $request->jenisAsn);
                        });
                    }

                    if ($request->search != '') {
                        $instance->where('nama', "LIKE", "%$request->search%");
                    }
                })
                ->addColumn('daftarBerkas', function (UsulanPangkat $usulanPangkat) {
                    $daftarBerkas = '';
                    $i = 1;
                    foreach ($usulanPangkat->berkasUsulanPangkat as $berkasPangkat) {
                        $daftarBerkas .= '<div class="d-block">
                                    <p>' . $i .  " . " . $berkasPangkat->nama . '</p>
                                </div>';
                        $i++;
                    }
                    return $daftarBerkas;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status_kepala_dinas == 0) {
                        $status = '<span class="badge badge-warning">Belum Diperiksa</span>';
                    } else if ($row->status_kepala_dinas == 1) {
                        $status = '<span class="badge badge-success">Selesai Diperiksa</span>';
                    } else {
                        $status = '<span class="badge badge-danger">Berkas Ditolak</span>';
                    }
                    return $status;
                })
                ->addColumn('jenisAsn', function ($row) {
                    return $row->profileGuruPegawai->jenis_asn;
                })
                ->addColumn('tanggal', function ($row) {
                    return date('d-m-Y', strtotime($row->created_at));
                })
                ->rawColumns(['action', 'status', 'daftarBerkas', 'tanggal', 'jenisAsn'])
                ->make(true);
        }

        return view('pages.kepala_dinas.kenaikanPangkat.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UsulanPangkat  $usulanPangkat
     * @return \Illuminate\Http\Response
     */
    public function show(UsulanPangkat $usulanPangkat)
    {
        $berkasDasar = BerkasDasar::where('id_user', $usulanPangkat->id_user)->get();
        $user = User::where('id', $usulanPangkat->id_user)->first();

        if ($usulanPangkat->user->role == "Guru") {
            $listPangkat = JabatanFungsional::where('no_urut', '>', $usulanPangkat->pangkatFungsionalSebelumnya->no_urut)->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('persyaratan')
                    ->whereColumn('persyaratan.ke_golongan', 'jabatan_fungsional.id');
            })->get();
        } else {
            $listPangkat = JabatanStruktural::where('no_urut', '>', $usulanPangkat->pangkatStrukturalSebelumnya->no_urut)->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('persyaratan')
                    ->whereColumn('persyaratan.ke_golongan', 'jabatan_fungsional.id');
            })->get();
        }
        return view('pages.kepala_dinas.kenaikanPangkat.show', compact('usulanPangkat', 'berkasDasar', 'user', 'listPangkat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UsulanPangkat  $usulanPangkat
     * @return \Illuminate\Http\Response
     */
    public function edit(UsulanPangkat $usulanPangkat)
    {
        if (!($usulanPangkat->status_kepala_dinas != 0  && $usulanPangkat->status_sekretaris == 1)) {
            return redirect()->route('proses-usulan-kenaikan-pangkat-kepala-dinas.index');
        }
        $berkasDasar = BerkasDasar::where('id_user', $usulanPangkat->id_user)->get();
        $user = User::where('id', $usulanPangkat->id_user)->first();

        if ($usulanPangkat->user->role == "Guru") {
            $listPangkat = JabatanFungsional::where('no_urut', '>', $usulanPangkat->pangkatFungsionalSebelumnya->no_urut)->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('persyaratan')
                    ->whereColumn('persyaratan.ke_golongan', 'jabatan_fungsional.id');
            })->get();
        } else {
            $listPangkat = JabatanStruktural::where('no_urut', '>', $usulanPangkat->pangkatStrukturalSebelumnya->no_urut)->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('persyaratan')
                    ->whereColumn('persyaratan.ke_golongan', 'jabatan_fungsional.id');
            })->get();
        }

        return view('pages.kepala_dinas.kenaikanPangkat.edit', compact('usulanPangkat', 'berkasDasar', 'user', 'listPangkat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UsulanPangkat  $usulanPangkat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UsulanPangkat $usulanPangkat)
    {
        $profile = ProfileGuruPegawai::where('id_user', $usulanPangkat->id_user)->first();
        $usulanPangkat->status_kepala_dinas = $request->konfirmasi_berkas;
        if ($request->has('usulan_pangkat')) {
            $usulanPangkat->pangkat_selanjutnya = $request->usulan_pangkat;
        }
        $usulanPangkat->tanggal_konfirmasi_kepala_dinas = now();
        if ($request->konfirmasi_berkas == 2) {
            $usulanPangkat->alasan_tolak_kepala_dinas = $request->alasan_ditolak;
            $profile->tmt_pangkat = $usulanPangkat->tmt_pangkat_sebelumnya;
            $profile->jabatan_pangkat_golongan = $usulanPangkat->pangkat_sebelumnya;
        } else if ($request->konfirmasi_berkas == 1) {
            $usulanPangkat->alasan_tolak_kepala_dinas = NULL;
            $profile->tmt_pangkat = $usulanPangkat->tmt_pangkat_selanjutnya;
            $profile->jabatan_pangkat_golongan = $usulanPangkat->pangkat_selanjutnya;

            $berkasDasarSkPangkat = BerkasDasar::where('id_user', $usulanPangkat->id_user)
                ->where('nama', 'SK Kenaikan Pangkat')
                ->first();

            $skPangkatTerakhir = BerkasUsulanPangkat::where('id_usulan_pangkat', $usulanPangkat->id)
                ->where('nama', 'SK Pangkat Terakhir')
                ->first();

            Storage::delete('upload/berkas-dasar/' . $berkasDasarSkPangkat->file);
            Storage::copy('upload/berkas-usulan-pangkat/' . $skPangkatTerakhir->file, 'upload/berkas-dasar/' . $berkasDasarSkPangkat->file);
        }

        $totalUsulanPangkat = UsulanPangkat::count();
        $usulanPangkatTerakhir = DB::table('usulan_pangkat')->where('nomor_surat', '!=', NULL)->latest('id')->first();
        if (!$usulanPangkat->nomor_surat) {
            if ($totalUsulanPangkat == 1) {
                $usulanPangkat->nomor_surat = 1;
            } else {
                $usulanPangkat->nomor_surat = ($usulanPangkatTerakhir->nomor_surat + 1);
            }
        }


        $usulanPangkat->save();
        $profile->save();

        Toastr::success('Berhasil Memproses Berkas', 'Success');
        if (Auth::user()->role == "Kepala Dinas") {
            return redirect()->route('proses-usulan-kenaikan-pangkat-kepala-dinas.index');
        } else if (Auth::user()->role == "Admin") {
            return redirect()->route('proses-usulan-kenaikan-pangkat-admin.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UsulanPangkat  $usulanPangkat
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsulanPangkat $usulanPangkat)
    {
        //
    }

    // Custom Function
    public function getTimelineUsulanPangkat(Request $request)
    {
        $id = $request->id;
        $usulanPangkat = UsulanPangkat::where('id', $id)->first();

        $startSection = '<section class="timeline_area section_padding_130">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <!-- Timeline Area-->
                                <div class="apland-timeline-area">';

        $endSection = '
                            </div>
                        </div>
                    </div>
                </section>';

        // Timeline Guru
        $timelineGuru = '<div class="single-timeline-area">
                                        <div class="timeline-date timeline-date-accept wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p class="text-center">' . date('d-m-Y H:i:s', strtotime($usulanPangkat->created_at)) . '</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="single-timeline-content d-flex wow fadeInLeft"
                                                    data-wow-delay="0.3s"
                                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                    <div class="timeline-icon timeline-icon-accept"><i
                                                            class="fas fa-check"></i></div>
                                                    <div class="timeline-text">
                                                        <h6>Guru/Pegawai</h6>
                                                        <p>Berkas Selesai Diupload</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
        // Timeline Tim Penilai
        if ($usulanPangkat->status_tim_penilai == 0) {
            $statusTimPenilai = '<div class="timeline-date wow fadeInLeft" data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p>---</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="single-timeline-content d-flex wow fadeInLeft"
                                                    data-wow-delay="0.3s"
                                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                    <div class="timeline-icon timeline-icon"><i
                                                            class="far fa-clock"></i></div>
                                                    <div class="timeline-text">
                                                        <h6>Tim Penilai</h6>
                                                        <p>Berkas Masih Diproses</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        } else if ($usulanPangkat->status_tim_penilai == 1) {
            $statusTimPenilai = '<div class="timeline-date timeline-date-accept wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p class="text-center">' . date('d-m-Y H:i:s', strtotime($usulanPangkat->tanggal_konfirmasi_tim_penilai))  . '</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="single-timeline-content d-flex wow fadeInLeft"
                                                    data-wow-delay="0.3s"
                                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                    <div class="timeline-icon timeline-icon-accept"><i
                                                            class="fas fa-check"></i></div>
                                                    <div class="timeline-text">
                                                        <h6>Tim Penilai</h6>
                                                        <p>Menyetujui Berkas</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $statusTimPenilai = '<div class="timeline-date timeline-date-reject wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p class="text-center">' . date('d-m-Y H:i:s', strtotime($usulanPangkat->tanggal_konfirmasi_tim_penilai))  . '</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="single-timeline-content d-flex wow fadeInLeft"
                                                    data-wow-delay="0.3s"
                                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                    <div class="timeline-icon timeline-icon-reject"><i
                                                            class="fas fa-times"></i></div>
                                                    <div class="timeline-text">
                                                        <h6>Tim Penilai</h6>
                                                        <p>Berkas Ditolak</p>
                                                        <p>Alasan : ' . $usulanPangkat->alasan_tolak_tim_penilai . '</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }
        $timelineTimPenilai = '<div class="single-timeline-area">
                                    ' . $statusTimPenilai . '
                                    </div>';


        // Timeline Kepegawaian
        if ($usulanPangkat->status_kepegawaian == 0) {
            $statusKepegawaian = '<div class="timeline-date wow fadeInLeft" data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p>---</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="single-timeline-content d-flex wow fadeInLeft"
                                                    data-wow-delay="0.3s"
                                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                    <div class="timeline-icon timeline-icon"><i
                                                            class="far fa-clock"></i></div>
                                                    <div class="timeline-text">
                                                        <h6>Admin Kepegawaian</h6>
                                                        <p>Berkas Masih Diproses</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        } else if ($usulanPangkat->status_kepegawaian == 1) {
            $statusKepegawaian = '<div class="timeline-date timeline-date-accept wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p class="text-center">' . date('d-m-Y H:i:s', strtotime($usulanPangkat->tanggal_konfirmasi_kepegawaian))  . '</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="single-timeline-content d-flex wow fadeInLeft"
                                                    data-wow-delay="0.3s"
                                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                    <div class="timeline-icon timeline-icon-accept"><i
                                                            class="fas fa-check"></i></div>
                                                    <div class="timeline-text">
                                                        <h6>Admin Kepegawaian</h6>
                                                        <p>Menyetujui Berkas</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $statusKepegawaian = '<div class="timeline-date timeline-date-reject wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p class="text-center">' . date('d-m-Y H:i:s', strtotime($usulanPangkat->tanggal_konfirmasi_kepegawaian))  . '</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="single-timeline-content d-flex wow fadeInLeft"
                                                    data-wow-delay="0.3s"
                                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                    <div class="timeline-icon timeline-icon-reject"><i
                                                            class="fas fa-times"></i></div>
                                                    <div class="timeline-text">
                                                        <h6>Admin Kepegawaian</h6>
                                                        <p>Berkas Ditolak</p>
                                                        <p>Alasan : ' . $usulanPangkat->alasan_tolak_kepegawaian . '</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }
        $timelineKepegawaian = '<div class="single-timeline-area">
                                    ' . $statusKepegawaian . '
                                    </div>';

        // Timeline Admin Kasubag Kepegawaian
        if ($usulanPangkat->status_kasubag == 0) {
            $statusKasubag = '<div class="timeline-date wow fadeInLeft" data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p>---</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="single-timeline-content d-flex wow fadeInLeft"
                                                    data-wow-delay="0.3s"
                                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                    <div class="timeline-icon timeline-icon"><i
                                                            class="far fa-clock"></i></div>
                                                    <div class="timeline-text">
                                                        <h6>Kasubag Kepegawaian</h6>
                                                        <p>Berkas Masih Diproses</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        } else if ($usulanPangkat->status_kasubag == 1) {
            $statusKasubag = '<div class="timeline-date timeline-date-accept wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p class="text-center">' . date('d-m-Y H:i:s', strtotime($usulanPangkat->tanggal_konfirmasi_kasubag))  . '</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="single-timeline-content d-flex wow fadeInLeft"
                                                    data-wow-delay="0.3s"
                                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                    <div class="timeline-icon timeline-icon-accept"><i
                                                            class="fas fa-check"></i></div>
                                                    <div class="timeline-text">
                                                        <h6>Kasubag Kepegawaian</h6>
                                                        <p>Menyetujui Berkas</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $statusKasubag = '<div class="timeline-date timeline-date-reject wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p class="text-center">' . date('d-m-Y H:i:s', strtotime($usulanPangkat->tanggal_konfirmasi_kasubag))  . '</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="single-timeline-content d-flex wow fadeInLeft"
                                                    data-wow-delay="0.3s"
                                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                    <div class="timeline-icon timeline-icon-reject"><i
                                                            class="fas fa-times"></i></div>
                                                    <div class="timeline-text">
                                                        <h6>Kasubag Kepegawaian</h6>
                                                        <p>Berkas Ditolak</p>
                                                        <p>Alasan : ' . $usulanPangkat->alasan_tolak_kasubag . '</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }
        $timelineKasubag = '<div class="single-timeline-area">
                                    ' . $statusKasubag . '
                                    </div>';

        // Timeline Sekretaris
        if ($usulanPangkat->status_sekretaris == 0) {
            $statusSekretaris = '<div class="timeline-date wow fadeInLeft" data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p>---</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="single-timeline-content d-flex wow fadeInLeft"
                                                    data-wow-delay="0.3s"
                                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                    <div class="timeline-icon timeline-icon"><i
                                                            class="far fa-clock"></i></div>
                                                    <div class="timeline-text">
                                                        <h6>Sekretaris</h6>
                                                        <p>Berkas Masih Diproses</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        } else if ($usulanPangkat->status_sekretaris == 1) {
            $statusSekretaris = '<div class="timeline-date timeline-date-accept wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p class="text-center">' . date('d-m-Y H:i:s', strtotime($usulanPangkat->tanggal_konfirmasi_sekretaris))  . '</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="single-timeline-content d-flex wow fadeInLeft"
                                                    data-wow-delay="0.3s"
                                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                    <div class="timeline-icon timeline-icon-accept"><i
                                                            class="fas fa-check"></i></div>
                                                    <div class="timeline-text">
                                                        <h6>Sekretaris</h6>
                                                        <p>Menyetujui Berkas</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $statusSekretaris = '<div class="timeline-date timeline-date-reject wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p class="text-center">' . date('d-m-Y H:i:s', strtotime($usulanPangkat->tanggal_konfirmasi_sekretaris))  . '</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="single-timeline-content d-flex wow fadeInLeft"
                                                    data-wow-delay="0.3s"
                                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                    <div class="timeline-icon timeline-icon-reject"><i
                                                            class="fas fa-times"></i></div>
                                                    <div class="timeline-text">
                                                        <h6>Sekretaris</h6>
                                                        <p>Berkas Ditolak</p>
                                                        <p>Alasan : ' . $usulanPangkat->alasan_tolak_sekretaris . '</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }
        $timelineSekretaris = '<div class="single-timeline-area">
                                    ' . $statusSekretaris . '
                                    </div>';

        // Timeline Kepala Dinas
        $btnUbah = '';
        $btnProses = '';
        if ($usulanPangkat->status_kepala_dinas != 0) {
            $btnUbah = '<a href=" ' . route('proses-usulan-kenaikan-pangkat-kepala-dinas.edit', $usulanPangkat->id) . '" class="btn btn-sm btn-warning mt-2 ml-2">Ubah Berkas</a>';
        }

        if ($usulanPangkat->status_kasubag == 1 && $usulanPangkat->status_kepala_dinas == 0 && $usulanPangkat->status_kepegawaian == 1 && $usulanPangkat->status_sekretaris == 1) {
            $btnProses = '<div class="row"><a href=" ' . url('proses-berkas-usulan-kenaikan-pangkat-kepala-dinas', $usulanPangkat->id) . ' " class="btn btn-sm btn-success mt-2 mr-2 ml-3">Proses Berkas</a></div>';
        }
        if ($usulanPangkat->status_kepala_dinas == 0) {
            $statusKepalaDinas = '<div class="timeline-date wow fadeInLeft" data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p>---</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="single-timeline-content d-flex wow fadeInLeft"
                                                    data-wow-delay="0.3s"
                                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                    <div class="timeline-icon timeline-icon"><i
                                                            class="far fa-clock"></i></div>
                                                    <div class="timeline-text">
                                                        <h6>Kepala Dinas</h6>
                                                        <p>Berkas Masih Diproses</p>
                                                        <div class="row">
                                                        <a href=" ' . route('proses-usulan-kenaikan-pangkat-kepala-dinas.show', $usulanPangkat->id) . '" class="btn btn-sm btn-primary mt-2 ml-3 mr-2">Lihat Berkas</a>
                                                            ' . $btnProses . '
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        } else if ($usulanPangkat->status_kepala_dinas == 1) {
            $statusKepalaDinas = '<div class="timeline-date timeline-date-accept wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p class="text-center">' . date('d-m-Y H:i:s', strtotime($usulanPangkat->tanggal_konfirmasi_kepala_dinas))  . '</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="single-timeline-content d-flex wow fadeInLeft"
                                                    data-wow-delay="0.3s"
                                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                    <div class="timeline-icon timeline-icon-accept"><i
                                                            class="fas fa-check"></i></div>
                                                    <div class="timeline-text">
                                                        <h6>Kepala Dinas</h6>
                                                        <p>Menyetujui Berkas</p>
                                                        <a href=" ' . route('proses-usulan-kenaikan-pangkat-kepala-dinas.show', $usulanPangkat->id) . '" class="btn btn-sm btn-primary mt-2">Lihat Berkas</a>
                                                        ' . $btnUbah . '
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $statusKepalaDinas = '<div class="timeline-date timeline-date-reject wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p class="text-center">' . date('d-m-Y H:i:s', strtotime($usulanPangkat->tanggal_konfirmasi_kepala_dinas))  . '</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="single-timeline-content d-flex wow fadeInLeft"
                                                    data-wow-delay="0.3s"
                                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                    <div class="timeline-icon timeline-icon-reject"><i
                                                            class="fas fa-times"></i></div>
                                                    <div class="timeline-text">
                                                        <h6>Kepala Dinas</h6>
                                                        <p>Berkas Ditolak</p>
                                                        <p>Alasan : ' . $usulanPangkat->alasan_tolak_kepala_dinas . '</p>
                                                        <a href=" ' . route('proses-usulan-kenaikan-pangkat-kepala-dinas.show', $usulanPangkat->id) . '" class="btn btn-sm btn-primary mt-2">Lihat Berkas</a>
                                                        ' . $btnUbah . '
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }
        $timelineKepalaDinas = '<div class="single-timeline-area">
                                    ' . $statusKepalaDinas . '
                                    </div>';

        // Timeline Berkas
        if ($usulanPangkat->status_kepala_dinas == 0 || $usulanPangkat->status_kepala_dinas == 2) {
            $statusBerkas = '<div class="timeline-date wow fadeInLeft" data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p>---</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="single-timeline-content d-flex wow fadeInLeft"
                                                    data-wow-delay="0.3s"
                                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                    <div class="timeline-icon timeline-icon"><i
                                                            class="far fa-clock"></i></div>
                                                    <div class="timeline-text">
                                                        <h6>Unduh Surat Pengantar Kenaikan Pangkat</h6>
                                                        <p>Berkas Masih Diproses</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        } else if ($usulanPangkat->status_kepala_dinas == 1) {
            $statusBerkas = '<div class="timeline-date timeline-date-accept wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p class="text-center">' . date('d-m-Y H:i:s', strtotime($usulanPangkat->tanggal_konfirmasi_kepala_dinas))  . '</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="single-timeline-content d-flex wow fadeInLeft"
                                                    data-wow-delay="0.3s"
                                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                    <div class="timeline-icon timeline-icon-accept"><i
                                                            class="fas fa-check"></i></div>
                                                    <div class="timeline-text">
                                                        <h6>Unduh Surat Pengantar Kenaikan Pangkat</h6>
                                                        <div class="row">
                                                        <a href="' . url('cetak-usulan-kenaikan-pangkat', $usulanPangkat->id) . '"class="btn btn-sm btn-success mt-2 mr-2 ml-3">Unduh Surat</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        };
        $timelineBerkas = '<div class="single-timeline-area">
                                    ' . $statusBerkas . '
                                    </div>';

        $timeline = $startSection . $timelineGuru . $timelineTimPenilai . $timelineKepegawaian . $timelineKasubag . $timelineSekretaris . $timelineKepalaDinas . $timelineBerkas . $endSection;
        return response()->json([
            'res' => 'success',
            'html' => $timeline
        ]);
    }

    public function prosesBerkas(UsulanPangkat $usulanPangkat)
    {
        if (!($usulanPangkat->status_kepala_dinas == 0 && $usulanPangkat->status_tim_penilai == 1 && $usulanPangkat->status_kepegawaian == 1 && $usulanPangkat->status_kasubag == 1 && $usulanPangkat->status_sekretaris == 1)) {
            return redirect()->route('proses-usulan-kenaikan-pangkat-kepala-dinas.index');
        }
        $berkasDasar = BerkasDasar::where('id_user', $usulanPangkat->id_user)->get();
        $user = User::where('id', $usulanPangkat->id_user)->first();

        if ($usulanPangkat->user->role == "Guru") {
            $listPangkat = JabatanFungsional::where('no_urut', '>', $usulanPangkat->pangkatFungsionalSebelumnya->no_urut)->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('persyaratan')
                    ->whereColumn('persyaratan.ke_golongan', 'jabatan_fungsional.id');
            })->get();
        } else {
            $listPangkat = JabatanStruktural::where('no_urut', '>', $usulanPangkat->pangkatStrukturalSebelumnya->no_urut)->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('persyaratan')
                    ->whereColumn('persyaratan.ke_golongan', 'jabatan_fungsional.id');
            })->get();
        }

        return view('pages.kepala_dinas.kenaikanPangkat.proses', compact('usulanPangkat', 'berkasDasar', 'user', 'listPangkat'));
    }
}
