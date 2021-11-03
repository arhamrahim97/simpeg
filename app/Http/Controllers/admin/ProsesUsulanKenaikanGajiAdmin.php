<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\UsulanGaji;
use Illuminate\Http\Request;
use App\Models\BerkasDasar;
use App\Models\Persyaratan;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProsesUsulanKenaikanGajiAdmin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = UsulanGaji::with(['user', 'profileGuruPegawai'])->orderBy('id', 'desc');
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
                        if ($request->statusBerkas == 0) {
                            $instance->where('status_kepegawaian', 0);
                            $instance->where('status_kasubag', 0);
                            $instance->where('status_sekretaris', 0);
                            $instance->where('status_kepala_dinas', 0);
                        } else if ($request->statusBerkas == 1) {
                            $instance->where('status_kepegawaian', 2);
                            $instance->where('status_kasubag', 0);
                            $instance->where('status_sekretaris', 0);
                            $instance->where('status_kepala_dinas', 0);
                        } else if ($request->statusBerkas == 2) {
                            $instance->where('status_kepegawaian', 1);
                            $instance->where('status_kasubag', 0);
                            $instance->where('status_sekretaris', 0);
                            $instance->where('status_kepala_dinas', 0);
                        } else if ($request->statusBerkas == 3) {
                            $instance->where('status_kepegawaian', 1);
                            $instance->where('status_kasubag', 2);
                            $instance->where('status_sekretaris', 0);
                            $instance->where('status_kepala_dinas', 0);
                        } else if ($request->statusBerkas == 4) {
                            $instance->where('status_kepegawaian', 1);
                            $instance->where('status_kasubag', 1);
                            $instance->where('status_sekretaris', 0);
                            $instance->where('status_kepala_dinas', 0);
                        } else if ($request->statusBerkas == 5) {
                            $instance->where('status_kepegawaian', 1);
                            $instance->where('status_kasubag', 1);
                            $instance->where('status_sekretaris', 2);
                            $instance->where('status_kepala_dinas', 0);
                        } else if ($request->statusBerkas == 6) {
                            $instance->where('status_kepegawaian', 1);
                            $instance->where('status_kasubag', 1);
                            $instance->where('status_sekretaris', 1);
                            $instance->where('status_kepala_dinas', 0);
                        } else if ($request->statusBerkas == 7) {
                            $instance->where('status_kepegawaian', 1);
                            $instance->where('status_kasubag', 1);
                            $instance->where('status_sekretaris', 1);
                            $instance->where('status_kepala_dinas', 2);
                        } else if ($request->statusBerkas == 8) {
                            $instance->where('status_kepegawaian', 1);
                            $instance->where('status_kasubag', 1);
                            $instance->where('status_sekretaris', 1);
                            $instance->where('status_kepala_dinas', 1);
                        }
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
                ->addColumn('daftarBerkas', function (UsulanGaji $usulanGaji) {
                    $daftarBerkas = '';
                    $i = 1;
                    foreach ($usulanGaji->berkasUsulanGaji as $berkasGaji) {
                        $daftarBerkas .= '<div class="d-block">
                                    <p>' . $i .  " . " . $berkasGaji->nama . '</p>
                                </div>';
                        $i++;
                    }
                    return $daftarBerkas;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status_kepegawaian == 0 && $row->status_kasubag == 0 && $row->status_sekretaris == 0 && $row->status_kepala_dinas == 0) {
                        $status = '<span class="badge badge-warning">Berkas Sedang Diperiksa Admin Kepegawaian</span>';
                    } else if ($row->status_kepegawaian == 2 && $row->status_kasubag == 0 && $row->status_sekretaris == 0 && $row->status_kepala_dinas == 0) {
                        $status = '<span class="badge badge-danger">Berkas Ditolak Admin Kepegawaian</span>';
                    } else if ($row->status_kepegawaian == 1 && $row->status_kasubag == 0 && $row->status_sekretaris == 0 && $row->status_kepala_dinas == 0) {
                        $status = '<span class="badge badge-warning">Berkas Sedang Diperiksa Kasubag Kepegawaian</span>';
                    } else if ($row->status_kepegawaian == 1 && $row->status_kasubag == 2 && $row->status_sekretaris == 0 && $row->status_kepala_dinas == 0) {
                        $status = '<span class="badge badge-danger">Berkas Ditolak Kasubag Kepegawaian</span>';
                    } else if ($row->status_kepegawaian == 1 && $row->status_kasubag == 1 && $row->status_sekretaris == 0 && $row->status_kepala_dinas == 0) {
                        $status = '<span class="badge badge-warning">Berkas Sedang Diperiksa Sekretaris</span>';
                    } else if ($row->status_kepegawaian == 1 && $row->status_kasubag == 1 && $row->status_sekretaris == 2 && $row->status_kepala_dinas == 0) {
                        $status = '<span class="badge badge-danger">Berkas Ditolak Sekretaris</span>';
                    } else if ($row->status_kepegawaian == 1 && $row->status_kasubag == 1 && $row->status_sekretaris == 1 && $row->status_kepala_dinas == 0) {
                        $status = '<span class="badge badge-warning">Berkas Sedang Diperiksa Kepala Dinas</span>';
                    } else if ($row->status_kepegawaian == 1 && $row->status_kasubag == 1 && $row->status_sekretaris == 1 && $row->status_kepala_dinas == 2) {
                        $status = '<span class="badge badge-danger">Berkas Ditolak Kepala Dinas</span>';
                    } else if ($row->status_kepegawaian == 1 && $row->status_kasubag == 1 && $row->status_sekretaris == 1 && $row->status_kepala_dinas == 1) {
                        $status = '<span class="badge badge-success">Berkas Selesai Diperiksa</span>';
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

        return view('pages.admin.kenaikanGaji.index');
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
     * @param  \App\Models\UsulanGaji  $usulanGaji
     * @return \Illuminate\Http\Response
     */
    public function show(UsulanGaji $usulanGaji)
    {
        $user = User::find($usulanGaji->id_user);
        $persyaratan = Persyaratan::with('deskripsiPersyaratan')->where('jenis_asn', $user->role)->where('kategori', 'Usulan Kenaikan Gaji Berkala')->get();
        $berkasDasar = BerkasDasar::where('id_user', Auth::id())->get();
        return view('pages.admin.kenaikanGaji.show', compact(['usulanGaji', 'user', 'persyaratan', 'berkasDasar']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UsulanGaji  $usulanGaji
     * @return \Illuminate\Http\Response
     */
    public function edit(UsulanGaji $usulanGaji)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UsulanGaji  $usulanGaji
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UsulanGaji $usulanGaji)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UsulanGaji  $usulanGaji
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsulanGaji $usulanGaji)
    {
        //
    }

    public function getTimelineUsulanGaji(Request $request)
    {
        $id = $request->id;
        $usulanGaji = UsulanGaji::where('id', $id)->first();

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
                                            <p class="text-center">' . date('d-m-Y H:i:s', strtotime($usulanGaji->created_at)) . '</p>
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
                                                        <a href=" ' . route('proses-usulan-kenaikan-gaji-admin.show', $usulanGaji->id) . '" class="btn btn-sm btn-primary mt-2 mr-1">Lihat Berkas</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';

        // Timeline Kepegawaian
        $btnUbah = '';
        if ($usulanGaji->status_kasubag == 0) {
            $btnUbah = '<a href=" ' . route('proses-usulan-kenaikan-gaji-admin-kepegawaian.edit', $usulanGaji->id) . '" class="btn btn-sm btn-warning mt-2">Ubah Konfirmasi</a>';
        }
        if ($usulanGaji->status_kepegawaian == 0) {
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
                                                        <div class="row">
                                                            <a href=" ' . url('proses-berkas-usulan-kenaikan-gaji-admin-kepegawaian', $usulanGaji->id) . ' " class="btn btn-sm btn-success mt-2 mr-2 ml-3">Proses
                                                                Berkas</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        } else if ($usulanGaji->status_kepegawaian == 1) {
            $statusKepegawaian = '<div class="timeline-date timeline-date-accept wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p class="text-center">' . date('d-m-Y H:i:s', strtotime($usulanGaji->tanggal_konfirmasi_kepegawaian))  . '</p>
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
                                                        ' . $btnUbah . '
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $statusKepegawaian = '<div class="timeline-date timeline-date-reject wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p class="text-center">' . date('d-m-Y H:i:s', strtotime($usulanGaji->tanggal_konfirmasi_kepegawaian))  . '</p>
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
                                                        <p>Alasan : ' . $usulanGaji->alasan_tolak_kepegawaian . '</p>
                                                        ' . $btnUbah . '
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }
        $timelineKepegawaian = '<div class="single-timeline-area">
                                    ' . $statusKepegawaian . '
                                    </div>';
        // Timeline Kasubag
        $btnUbah = '';
        $btnProses = '';
        if ($usulanGaji->status_kasubag != 0 && $usulanGaji->status_sekretaris == 0) {
            $btnUbah = '<a href=" ' . route('proses-usulan-kenaikan-gaji-kasubag.edit', $usulanGaji->id) . '" class="btn btn-sm btn-warning mt-2 ml-3">Ubah Konfirmasi</a>';
        }

        if ($usulanGaji->status_kasubag == 0 && $usulanGaji->status_sekretaris == 0 && $usulanGaji->status_kepegawaian == 1) {
            $btnProses = '<div class="row"><a href=" ' . url('proses-berkas-usulan-kenaikan-gaji-kasubag', $usulanGaji->id) . ' " class="btn btn-sm btn-success mt-2 mr-2 ml-3">Proses Berkas</a></div>';
        }

        if ($usulanGaji->status_kasubag == 0) {
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
                                                        ' . $btnProses . '
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        } else if ($usulanGaji->status_kasubag == 1) {
            $statusKasubag = '<div class="timeline-date timeline-date-accept wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p class="text-center">' . date('d-m-Y H:i:s', strtotime($usulanGaji->tanggal_konfirmasi_kasubag))  . '</p>
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
                                                        <div class="row">
                                                        ' . $btnUbah . '
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $statusKasubag = '<div class="timeline-date timeline-date-reject wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p class="text-center">' . date('d-m-Y H:i:s', strtotime($usulanGaji->tanggal_konfirmasi_kasubag))  . '</p>
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
                                                        <p>Alasan : ' . $usulanGaji->alasan_tolak_kasubag . '</p>
                                                        <div class="row">
                                                        <a href=" ' . route('proses-usulan-kenaikan-gaji-kasubag.show', $usulanGaji->id) . '" class="btn btn-sm btn-primary mt-2 mr-1 ml-3">Lihat Berkas</a>
                                                        ' . $btnUbah . '
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }
        $timelineKasubag = '<div class="single-timeline-area">
                                    ' . $statusKasubag . '
                                    </div>';

        // Timeline Sekretaris
        $btnUbah = '';
        $btnProses = '';
        if ($usulanGaji->status_sekretaris != 0 && $usulanGaji->status_kepala_dinas == 0) {
            $btnUbah = '<a href=" ' . route('proses-usulan-kenaikan-gaji-sekretaris.edit', $usulanGaji->id) . '" class="btn btn-sm btn-warning mt-2 ml-3">Ubah Konfirmasi</a>';
        }

        if ($usulanGaji->status_kasubag == 1 && $usulanGaji->status_sekretaris == 0 && $usulanGaji->status_kepegawaian == 1) {
            $btnProses = '<div class="row"><a href=" ' . url('proses-berkas-usulan-kenaikan-gaji-sekretaris', $usulanGaji->id) . ' " class="btn btn-sm btn-success mt-2 mr-2 ml-3">Proses Berkas</a></div>';
        }

        if ($usulanGaji->status_sekretaris == 0) {
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
                                                        ' . $btnProses . '
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        } else if ($usulanGaji->status_sekretaris == 1) {
            $statusSekretaris = '<div class="timeline-date timeline-date-accept wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p class="text-center">' . date('d-m-Y H:i:s', strtotime($usulanGaji->tanggal_konfirmasi_sekretaris))  . '</p>
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
                                                        <div class="row">
                                                        ' . $btnUbah . '
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $statusSekretaris = '<div class="timeline-date timeline-date-reject wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p class="text-center">' . date('d-m-Y H:i:s', strtotime($usulanGaji->tanggal_konfirmasi_sekretaris))  . '</p>
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
                                                        <p>Alasan : ' . $usulanGaji->alasan_tolak_sekretaris . '</p>
                                                        <div class="row">
                                                        ' . $btnUbah . '
                                                        </div>
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
        if ($usulanGaji->status_kepala_dinas != 0) {
            $btnUbah = '<a href=" ' . route('proses-usulan-kenaikan-gaji-kepala-dinas.edit', $usulanGaji->id) . '" class="btn btn-sm btn-warning mt-2">Ubah Proses</a>';
        }

        if ($usulanGaji->status_kasubag == 1 && $usulanGaji->status_kepala_dinas == 0 && $usulanGaji->status_kepegawaian == 1 && $usulanGaji->status_sekretaris == 1) {
            $btnProses = '<div class="row"><a href=" ' . url('proses-berkas-usulan-kenaikan-gaji-kepala-dinas', $usulanGaji->id) . ' " class="btn btn-sm btn-success mt-2 mr-2 ml-3">Proses Berkas</a></div>';
        }
        if ($usulanGaji->status_kepala_dinas == 0) {
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
                                                        ' . $btnProses . '
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        } else if ($usulanGaji->status_kepala_dinas == 1) {
            $statusKepalaDinas = '<div class="timeline-date timeline-date-accept wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p class="text-center">' . date('d-m-Y H:i:s', strtotime($usulanGaji->tanggal_konfirmasi_kepala_dinas))  . '</p>
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
                                                        ' . $btnUbah . '
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $statusKepalaDinas = '<div class="timeline-date timeline-date-reject wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p class="text-center">' . date('d-m-Y H:i:s', strtotime($usulanGaji->tanggal_konfirmasi_kepala_dinas))  . '</p>
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
                                                        <p>Alasan : ' . $usulanGaji->alasan_tolak_kepala_dinas . '</p>

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
        if ($usulanGaji->status_kepala_dinas == 0 || $usulanGaji->status_kepala_dinas == 2) {
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
        } else if ($usulanGaji->status_kepala_dinas == 1) {
            $statusBerkas = '<div class="timeline-date timeline-date-accept wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p class="text-center">' . date('d-m-Y H:i:s', strtotime($usulanGaji->tanggal_konfirmasi_kepala_dinas))  . '</p>
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

        $timeline = $startSection . $timelineGuru . $timelineKepegawaian . $timelineKasubag . $timelineSekretaris . $timelineKepalaDinas . $timelineBerkas . $endSection;
        return response()->json([
            'res' => 'success',
            'html' => $timeline
        ]);
    }
}
