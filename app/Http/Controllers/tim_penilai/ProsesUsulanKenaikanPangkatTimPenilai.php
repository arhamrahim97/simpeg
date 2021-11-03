<?php

namespace App\Http\Controllers\tim_penilai;

use App\Http\Controllers\Controller;
use App\Models\BerkasDasar;
use App\Models\JabatanFungsional;
use App\Models\JabatanStruktural;
use App\Models\User;
use App\Models\UsulanPangkat;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProsesUsulanKenaikanPangkatTimPenilai extends Controller
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
                        $instance->where('status_tim_penilai', $request->statusBerkas);
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
                    if ($row->status_tim_penilai == 0) {
                        $status = '<span class="badge badge-warning">Belum Diperiksa</span>';
                    } else if ($row->status_tim_penilai == 1) {
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

        return view('pages.tim_penilai.kenaikanPangkat.index');
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
        $user = User::find($usulanPangkat->id_user);

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
        return view('pages.tim_penilai.kenaikanPangkat.show', compact('usulanPangkat', 'berkasDasar', 'user', 'listPangkat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UsulanPangkat  $usulanPangkat
     * @return \Illuminate\Http\Response
     */
    public function edit(UsulanPangkat $usulanPangkat)
    {
        if (!($usulanPangkat->status_kepegawaian == 0 && $usulanPangkat->status_tim_penilai != 0)) {
            return redirect()->route('proses-usulan-kenaikan-pangkat-tim-penilai.index');
        }
        $berkasDasar = BerkasDasar::where('id_user', $usulanPangkat->id_user)->get();
        $user = User::find($usulanPangkat->id_user);

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

        return view('pages.tim_penilai.kenaikanPangkat.edit', compact('usulanPangkat', 'berkasDasar', 'user', 'listPangkat'));
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
        $usulanPangkat->status_tim_penilai = $request->konfirmasi_berkas;
        if ($request->has('usulan_pangkat')) {
            $usulanPangkat->pangkat_selanjutnya = $request->usulan_pangkat;
        }
        $usulanPangkat->tanggal_konfirmasi_tim_penilai = now();
        if ($request->konfirmasi_berkas == 2) {
            $usulanPangkat->alasan_tolak_tim_penilai = $request->alasan_ditolak;
        } else if ($request->konfirmasi_berkas == 1) {
            $usulanPangkat->alasan_tolak_tim_penilai = NULL;
        }

        $usulanPangkat->save();

        Toastr::success('Berhasil Memproses Berkas', 'Success');
        return redirect()->route('proses-usulan-kenaikan-pangkat-tim-penilai.index');
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
                                                        <h6>Guru</h6>
                                                        <p>Berkas Selesai Diupload</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
        // Timeline Tim Penilai
        $btnUbah = '';
        if ($usulanPangkat->status_kepegawaian == 0) {
            $btnUbah = '<a href=" ' . route('proses-usulan-kenaikan-pangkat-tim-penilai.edit', $usulanPangkat->id) . '" class="btn btn-sm btn-warning mt-2">Ubah Konfirmasi</a>';
        }
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
                                                        <div class="row">
                                                        <a href=" ' . route('proses-usulan-kenaikan-pangkat-tim-penilai.show', $usulanPangkat->id) . '" class="btn btn-sm btn-primary mt-2 ml-3">Lihat Berkas</a>
                                                            <a href=" ' . url('proses-berkas-usulan-kenaikan-pangkat-tim-penilai', $usulanPangkat->id) . ' " class="btn btn-sm btn-success mt-2 mr-2 ml-3">Proses
                                                                Berkas</a>
                                                        </div>
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
                                                        <a href=" ' . route('proses-usulan-kenaikan-pangkat-tim-penilai.show', $usulanPangkat->id) . '" class="btn btn-sm btn-primary mt-2">Lihat Berkas</a>
                                                        ' . $btnUbah . '
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
                                                        <a href=" ' . route('proses-usulan-kenaikan-pangkat-tim-penilai.show', $usulanPangkat->id) . '" class="btn btn-sm btn-primary mt-2">Lihat Berkas</a>
                                                        ' . $btnUbah . '
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
                                                        <h6>Unduh Berkas</h6>
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
                                                        <h6>Unduh Berkas</h6>
                                                        <div class="row">
                                                        <button class="btn btn-sm btn-success mt-2 mr-2 ml-3">Unduh Berkas</button>
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
        if (!($usulanPangkat->status_tim_penilai == 0)) {
            return redirect()->route('proses-usulan-kenaikan-pangkat-tim-penilai.index');
        }
        $berkasDasar = BerkasDasar::where('id_user', $usulanPangkat->id_user)->get();
        $user = User::find($usulanPangkat->id_user);

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

        return view('pages.tim_penilai.kenaikanPangkat.proses', compact('usulanPangkat', 'berkasDasar', 'user', 'listPangkat'));
    }
}
