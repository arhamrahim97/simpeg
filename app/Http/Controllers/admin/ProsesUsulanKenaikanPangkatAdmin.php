<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\UsulanPangkat;
use Illuminate\Http\Request;
use App\Models\BerkasDasar;
use App\Models\JabatanFungsional;
use App\Models\JabatanStruktural;
use App\Models\ProfileGuruPegawai;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProsesUsulanKenaikanPangkatAdmin extends Controller
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
                        if ($request->statusBerkas == 0) {
                            $instance->where('status_tim_penilai', 0);
                            $instance->where('status_kepegawaian', 0);
                            $instance->where('status_kasubag', 0);
                            $instance->where('status_sekretaris', 0);
                            $instance->where('status_kepala_dinas', 0);
                        } else if ($request->statusBerkas == 1) {
                            $instance->where('status_tim_penilai', 2);
                            $instance->where('status_kepegawaian', 0);
                            $instance->where('status_kasubag', 0);
                            $instance->where('status_sekretaris', 0);
                            $instance->where('status_kepala_dinas', 0);
                        } else if ($request->statusBerkas == 2) {
                            $instance->where('status_tim_penilai', 1);
                            $instance->where('status_kepegawaian', 0);
                            $instance->where('status_kasubag', 0);
                            $instance->where('status_sekretaris', 0);
                            $instance->where('status_kepala_dinas', 0);
                        } else if ($request->statusBerkas == 3) {
                            $instance->where('status_tim_penilai', 1);
                            $instance->where('status_kepegawaian', 2);
                            $instance->where('status_kasubag', 0);
                            $instance->where('status_sekretaris', 0);
                            $instance->where('status_kepala_dinas', 0);
                        } else if ($request->statusBerkas == 4) {
                            $instance->where('status_tim_penilai', 1);
                            $instance->where('status_kepegawaian', 1);
                            $instance->where('status_kasubag', 0);
                            $instance->where('status_sekretaris', 0);
                            $instance->where('status_kepala_dinas', 0);
                        } else if ($request->statusBerkas == 5) {
                            $instance->where('status_tim_penilai', 1);
                            $instance->where('status_kepegawaian', 1);
                            $instance->where('status_kasubag', 2);
                            $instance->where('status_sekretaris', 0);
                            $instance->where('status_kepala_dinas', 0);
                        } else if ($request->statusBerkas == 6) {
                            $instance->where('status_tim_penilai', 1);
                            $instance->where('status_kepegawaian', 1);
                            $instance->where('status_kasubag', 1);
                            $instance->where('status_sekretaris', 0);
                            $instance->where('status_kepala_dinas', 0);
                        } else if ($request->statusBerkas == 7) {
                            $instance->where('status_tim_penilai', 1);
                            $instance->where('status_kepegawaian', 1);
                            $instance->where('status_kasubag', 1);
                            $instance->where('status_sekretaris', 2);
                            $instance->where('status_kepala_dinas', 0);
                        } else if ($request->statusBerkas == 8) {
                            $instance->where('status_tim_penilai', 1);
                            $instance->where('status_kepegawaian', 1);
                            $instance->where('status_kasubag', 1);
                            $instance->where('status_sekretaris', 1);
                            $instance->where('status_kepala_dinas', 0);
                        } else if ($request->statusBerkas == 9) {
                            $instance->where('status_tim_penilai', 1);
                            $instance->where('status_kepegawaian', 1);
                            $instance->where('status_kasubag', 1);
                            $instance->where('status_sekretaris', 1);
                            $instance->where('status_kepala_dinas', 2);
                        } else if ($request->statusBerkas == 10) {
                            $instance->where('status_tim_penilai', 1);
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
                    if ($row->status_tim_penilai == 0 && $row->status_kepegawaian == 0 && $row->status_kasubag == 0 && $row->status_sekretaris == 0 && $row->status_kepala_dinas == 0) {
                        $status = '<span class="badge badge-warning">Berkas Sedang Diperiksa Tim Penilai</span>';
                    } else if ($row->status_tim_penilai == 2 && $row->status_kepegawaian == 0 && $row->status_kasubag == 0 && $row->status_sekretaris == 0 && $row->status_kepala_dinas == 0) {
                        $status = '<span class="badge badge-danger">Berkas Ditolak Tim Penilai</span>';
                    } else if ($row->status_tim_penilai == 1 && $row->status_kepegawaian == 0 && $row->status_kasubag == 0 && $row->status_sekretaris == 0 && $row->status_kepala_dinas == 0) {
                        $status = '<span class="badge badge-warning">Berkas Sedang Diperiksa Admin Kepegawaian</span>';
                    } else if ($row->status_tim_penilai == 1 && $row->status_kepegawaian == 2 && $row->status_kasubag == 0 && $row->status_sekretaris == 0 && $row->status_kepala_dinas == 0) {
                        $status = '<span class="badge badge-danger">Berkas Ditolak Admin Kepegawaian</span>';
                    } else if ($row->status_tim_penilai == 1 && $row->status_kepegawaian == 1 && $row->status_kasubag == 0 && $row->status_sekretaris == 0 && $row->status_kepala_dinas == 0) {
                        $status = '<span class="badge badge-warning">Berkas Sedang Diperiksa Kasubag Kepegawaian</span>';
                    } else if ($row->status_tim_penilai == 1 && $row->status_kepegawaian == 1 && $row->status_kasubag == 2 && $row->status_sekretaris == 0 && $row->status_kepala_dinas == 0) {
                        $status = '<span class="badge badge-danger">Berkas Ditolak Kasubag Kepegawaian</span>';
                    } else if ($row->status_tim_penilai == 1 && $row->status_kepegawaian == 1 && $row->status_kasubag == 1 && $row->status_sekretaris == 0 && $row->status_kepala_dinas == 0) {
                        $status = '<span class="badge badge-warning">Berkas Sedang Diperiksa Sekretaris</span>';
                    } else if ($row->status_tim_penilai == 1 && $row->status_kepegawaian == 1 && $row->status_kasubag == 1 && $row->status_sekretaris == 2 && $row->status_kepala_dinas == 0) {
                        $status = '<span class="badge badge-danger">Berkas Ditolak Admin Sekretaris</span>';
                    } else if ($row->status_tim_penilai == 1 && $row->status_kepegawaian == 1 && $row->status_kasubag == 1 && $row->status_sekretaris == 1 && $row->status_kepala_dinas == 0) {
                        $status = '<span class="badge badge-warning">Berkas Sedang Diperiksa Kepala Dinas</span>';
                    } else if ($row->status_tim_penilai == 1 && $row->status_kepegawaian == 1 && $row->status_kasubag == 1 && $row->status_sekretaris == 1 && $row->status_kepala_dinas == 2) {
                        $status = '<span class="badge badge-danger">Berkas Ditolak Kepala Dinas</span>';
                    } else if ($row->status_tim_penilai == 1 && $row->status_kepegawaian == 1 && $row->status_kasubag == 1 && $row->status_sekretaris == 1 && $row->status_kepala_dinas == 1) {
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

        return view('pages.admin.kenaikanPangkat.index');
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
        $user = User::where('id', $usulanPangkat->id_user);

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
        return view('pages.admin.kenaikanPangkat.show', compact('usulanPangkat', 'berkasDasar', 'user', 'listPangkat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UsulanPangkat  $usulanPangkat
     * @return \Illuminate\Http\Response
     */
    public function edit(UsulanPangkat $usulanPangkat)
    {
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
                                                        <a href=" ' . route('proses-usulan-kenaikan-pangkat-admin.show', $usulanPangkat->id) . '" class="btn btn-sm btn-primary mt-2">Lihat Berkas</a>
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
        $btnUbah = '';
        $btnProses = '';
        if ($usulanPangkat->status_kasubag == 0) {
            $btnUbah = '<a href=" ' . route('proses-usulan-kenaikan-pangkat-admin-kepegawaian.edit', $usulanPangkat->id) . '" class="btn btn-sm btn-warning mt-2">Ubah Konfirmasi</a>';
        }
        if ($usulanPangkat->status_tim_penilai == 1 && $usulanPangkat->status_kepegawaian == 0 && $usulanPangkat->status_kasubag == 0   && $usulanPangkat->status_sekretaris == 0 && $usulanPangkat->status_kepala_dinas == 0) {
            $btnProses = '<a href=" ' . url('proses-berkas-usulan-kenaikan-pangkat-admin-kepegawaian', $usulanPangkat->id) . ' " class="btn btn-sm btn-success mt-2 mr-2 ml-3">Proses Berkas</a>';
        }

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
                                                        <div class="row">
                                                        ' . $btnProses . '
                                                        </div>
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
                                                        ' . $btnUbah . '
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
                                                        ' . $btnUbah . '
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }
        $timelineKepegawaian = '<div class="single-timeline-area">
                                    ' . $statusKepegawaian . '
                                    </div>';

        // Timeline Admin Kasubag Kepegawaian
        $btnUbah = '';
        $btnProses = '';
        if ($usulanPangkat->status_sekretaris == 0) {
            $btnUbah = '<a href=" ' . route('proses-usulan-kenaikan-pangkat-kasubag.edit', $usulanPangkat->id) . '" class="btn btn-sm btn-warning mt-2">Ubah Konfirmasi</a>';
        }
        if ($usulanPangkat->status_tim_penilai == 1 && $usulanPangkat->status_kepegawaian == 1 && $usulanPangkat->status_kasubag == 0   && $usulanPangkat->status_sekretaris == 0 && $usulanPangkat->status_kepala_dinas == 0) {
            $btnProses = '<a href=" ' . url('proses-berkas-usulan-kenaikan-pangkat-kasubag', $usulanPangkat->id) . ' " class="btn btn-sm btn-success mt-2 mr-2 ml-3">Proses Berkas</a>';
        }
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
                                                        <div class="row">
                                                        ' . $btnProses . '
                                                        </div>
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
                                                        ' . $btnUbah . '
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
                                                        ' . $btnUbah . '
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
        if ($usulanPangkat->status_kepala_dinas == 0) {
            $btnUbah = '<a href=" ' . route('proses-usulan-kenaikan-pangkat-sekretaris.edit', $usulanPangkat->id) . '" class="btn btn-sm btn-warning mt-2">Ubah Konfirmasi</a>';
        }
        if ($usulanPangkat->status_tim_penilai == 1 && $usulanPangkat->status_kepegawaian == 1 && $usulanPangkat->status_kasubag == 1  && $usulanPangkat->status_sekretaris == 0 && $usulanPangkat->status_kepala_dinas == 0) {
            $btnProses = '<a href=" ' . url('proses-berkas-usulan-kenaikan-pangkat-sekretaris', $usulanPangkat->id) . ' " class="btn btn-sm btn-success mt-2 mr-2 ml-3">Proses Berkas</a>';
        }
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
                                                        <div class="row">
                                                        ' . $btnProses . '
                                                        </div>
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
                                                        ' . $btnUbah . '
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
                                                        ' . $btnUbah . '
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
            $btnUbah = '<a href=" ' . route('proses-usulan-kenaikan-pangkat-kepala-dinas.edit', $usulanPangkat->id) . '" class="btn btn-sm btn-warning mt-2">Ubah Berkas</a>';
        }

        if ($usulanPangkat->status_tim_penilai == 1 && $usulanPangkat->status_kepegawaian == 1 && $usulanPangkat->status_kasubag == 1   && $usulanPangkat->status_sekretaris == 1 && $usulanPangkat->status_kepala_dinas == 0) {
            $btnProses = '<a href=" ' . url('proses-berkas-usulan-kenaikan-pangkat-kepala-dinas', $usulanPangkat->id) . ' " class="btn btn-sm btn-success mt-2 mr-2 ml-3">Proses Berkas</a>';
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
}
