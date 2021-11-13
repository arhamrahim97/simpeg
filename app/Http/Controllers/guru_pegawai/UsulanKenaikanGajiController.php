<?php

namespace App\Http\Controllers\guru_pegawai;

use App\Http\Controllers\Controller;
use App\Models\BerkasDasar;
use App\Models\BerkasUsulanGaji;
use App\Models\Persyaratan;
use App\Models\User;
use App\Models\UsulanGaji;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class UsulanKenaikanGajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sekarang = new DateTime("now");
        $tmt_gaji = new DateTime(Auth::user()->profile->tmt_gaji);
        $tahun = $tmt_gaji->diff($sekarang)->format('%r%y');

        $cekUsulanGaji = UsulanGaji::where('tmt_gaji_sebelumnya', Auth::user()->profile->tmt_gaji)->first();
        // Cek Apakah TMT Gaji sudah lebih dari 2 tahun dan cek apakah usulan dengan tmt user sekarang sudah ada atau belum
        $usulan = '';
        if ($tahun >= 2 && !($cekUsulanGaji)) {
            $usulan = true;
        }

        if ($request->ajax()) {
            $data = UsulanGaji::with('berkasUsulanGaji')->where('id_user', Auth::id())->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<button type="button" class="btn btn-sm btn-primary lihatTimeline" id="' . $row->id . '">
                            Lihat
                        </button>';
                    return $actionBtn;
                })
                ->addColumn('tahun', function ($row) {
                    $tahun = date('Y', strtotime($row->created_at));
                    return $tahun;
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
                ->rawColumns(['action', 'tahun', 'status', 'daftarBerkas',])
                ->make(true);
        }

        $usulanGaji = UsulanGaji::count();
        return view('pages.guru_pegawai.kenaikanGaji.index', compact('usulan', 'usulanGaji'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sekarang = new DateTime("now");
        $tmt_gaji = new DateTime(Auth::user()->profile->tmt_gaji);
        $tahun = $tmt_gaji->diff($sekarang)->format('%r%y');

        $cekUsulanGaji = UsulanGaji::where('tmt_gaji_sebelumnya', Auth::user()->profile->tmt_gaji)->first();
        // Cek Apakah TMT Gaji sudah lebih dari 2 tahun dan cek apakah usulan dengan tmt user sekarang sudah ada atau belum
        if ($tahun < 2) {
            return redirect()->route('usulan-kenaikan-gaji.index');
        }
        if ($cekUsulanGaji) {
            return redirect()->route('usulan-kenaikan-gaji.index');
        }
        $persyaratan = Persyaratan::with('deskripsiPersyaratan')->where('jenis_asn', Auth::user()->role)->where('kategori', 'Usulan Kenaikan Gaji Berkala')->first();
        $berkasDasar = BerkasDasar::where('id_user', Auth::id())->get();
        $user = User::find(Auth::id());
        return view('pages.guru_pegawai.kenaikanGaji.create', compact('berkasDasar', 'persyaratan', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lengthBerkas = count($request->namaBerkas);

        $usulanGaji = new UsulanGaji();
        $usulanGaji->id_user = Auth::id();
        $usulanGaji->nama = "Surat Pengantar Kenaikan Gaji " . Auth::user()->nama . " " . Carbon::now()->year;
        $usulanGaji->status_kepegawaian = 0;
        $usulanGaji->status_kasubag = 0;
        $usulanGaji->status_sekretaris = 0;
        $usulanGaji->status_kepala_dinas = 0;
        $usulanGaji->tmt_gaji_sebelumnya = Auth::user()->profile->tmt_gaji;
        $usulanGaji->nilai_gaji_sebelumnya = Auth::user()->profile->nilai_gaji;
        $usulanGaji->unique_id = uniqid();

        $tanggal_kerja = new DateTime(Auth::user()->profile->tanggal_kerja);
        $sekarang = new DateTime("today");
        $thn = $sekarang->diff($tanggal_kerja)->y;
        $bln = $sekarang->diff($tanggal_kerja)->m;

        $usulanGaji->jumlah_tahun_kerja_lama = $thn;
        $usulanGaji->jumlah_bulan_kerja_lama = $bln;

        $usulanGaji->save();

        $usulanGajiId = $usulanGaji->id;

        for ($i = 0; $i < $lengthBerkas; $i++) {
            $namaFileBerkas = Str::slug($request->namaBerkas[$i], '-') . "-" . $i . Carbon::now()->format('YmdHs') . rand(1, 9999) . ".pdf";
            $request->file('fileBerkas')[$i]->storeAs(
                'upload/berkas-usulan-gaji',
                $namaFileBerkas
            );

            $berkasGaji = new BerkasUsulanGaji();
            $berkasGaji->id_usulan_gaji = $usulanGajiId;
            $berkasGaji->nama = $request->namaBerkas[$i];
            $berkasGaji->file = $namaFileBerkas;
            $berkasGaji->save();
        }
        Toastr::success('Berhasil Mengupload Berkas', 'Success');
        return redirect()->route('usulan-kenaikan-gaji.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UsulanGaji  $usulanGaji
     * @return \Illuminate\Http\Response
     */
    public function show(UsulanGaji $usulanGaji)
    {
        $berkasDasar = BerkasDasar::where('id_user', Auth::id())->get();
        $persyaratan = Persyaratan::with('deskripsiPersyaratan')->where('jenis_asn', Auth::user()->role)->where('kategori', 'Usulan Kenaikan Gaji Berkala')->get();
        $user = User::find($usulanGaji->id_user);
        return view('pages.guru_pegawai.kenaikanGaji.show', compact('usulanGaji', 'berkasDasar', 'persyaratan', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UsulanGaji  $usulanGaji
     * @return \Illuminate\Http\Response
     */
    public function edit(UsulanGaji $usulanGaji)
    {
        if ($usulanGaji->status_kepegawaian != 0) {
            if (!($usulanGaji->status_kepegawaian == 2 || $usulanGaji->status_kasubag == 2 || $usulanGaji->status_sekretaris || $usulanGaji->kepala_dinas == 2)) {
                return redirect()->route('usulan-kenaikan-gaji.index');
            }
        }
        $berkasGaji = $usulanGaji->berkasUsulanGaji;
        $berkasDasar = BerkasDasar::where('id_user', Auth::id())->get();
        $persyaratan = Persyaratan::with('deskripsiPersyaratan')->where('jenis_asn', Auth::user()->role)->where('kategori', 'Usulan Kenaikan Gaji Berkala')->get();
        $user = User::find($usulanGaji->id_user);
        return view('pages.guru_pegawai.kenaikanGaji.edit', compact(['berkasGaji', 'usulanGaji', 'berkasDasar', 'persyaratan', 'user']));
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
        // dd($request->file('fileBerkasUpdate'));
        $lengthBerkasUpdate = count($request->namaBerkasUpdate);
        // Update
        if ($request->namaBerkasUpdate) {
            for ($i = 0; $i < $lengthBerkasUpdate; $i++) {
                $berkasGaji = BerkasUsulanGaji::find($request->idBerkasUpdate[$i]);
                $namaFileBerkasUpdate = Str::slug($request->namaBerkasUpdate[$i], '-') . "-" . $i . Carbon::now()->format('YmdHs') . rand(1, 9999) . ".pdf";


                if (isset($request->file('fileBerkasUpdate')[$i])) {
                    if (Storage::exists('upload/berkas-usulan-gaji/' . $berkasGaji->file)) {
                        Storage::delete('upload/berkas-usulan-gaji/' . $berkasGaji->file);
                    }
                    $request->file('fileBerkasUpdate')[$i]->storeAs(
                        'upload/berkas-usulan-gaji',
                        $namaFileBerkasUpdate
                    );
                    $berkasGaji->file = $namaFileBerkasUpdate;
                }

                $berkasGaji->nama = $request->namaBerkasUpdate[$i];
                $berkasGaji->save();
            }
        }
        // Tambahkan Berkas Baru
        if ($request->namaBerkas) {
            $lengthBerkas = count($request->namaBerkas);
            if ($request->namaBerkas) {
                for ($i = 0; $i < $lengthBerkas; $i++) {
                    $namaFileBerkas = Str::slug($request->namaBerkas[$i], '-') . "-" . $i . Carbon::now()->format('YmdHs') . ".pdf";
                    $request->file('fileBerkas')[$i]->storeAs(
                        'upload/berkas-usulan-gaji',
                        $namaFileBerkas
                    );

                    $berkasGaji = new BerkasUsulanGaji();
                    $berkasGaji->id_usulan_gaji = $usulanGaji->id;
                    $berkasGaji->nama = $request->namaBerkas[$i];
                    $berkasGaji->file = $namaFileBerkas;
                    $berkasGaji->save();
                }
            }
        }

        if ($usulanGaji->status_kepegawaian == 2) {
            $usulanGaji->status_kepegawaian = 0;
            $usulanGaji->alasan_tolak_kepegawaian = NULL;
            $usulanGaji->save();
        } else if ($usulanGaji->status_kasubag == 2) {
            $usulanGaji->status_kasubag = 0;
            $usulanGaji->alasan_tolak_kasubag = NULL;
            $usulanGaji->save();
        } else if ($usulanGaji->status_sekretaris == 2) {
            $usulanGaji->status_sekretaris = 0;
            $usulanGaji->alasan_tolak_sekretaris = NULL;
            $usulanGaji->save();
        } else if ($usulanGaji->status_kepala_dinas == 2) {
            $usulanGaji->status_kepala_dinas = 0;
            $usulanGaji->alasan_tolak_kepala_dinas = NULL;
            $usulanGaji->save();
        }

        Toastr::success('Berhasil Mengubah Berkas', 'Success');
        return redirect()->route('usulan-kenaikan-gaji.index');
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

    // Custom Function
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
        if ($usulanGaji->status_kepegawaian == 0) {
            $ubahBerkas = '<a href=" ' . route('usulan-kenaikan-gaji.edit', $usulanGaji->id) . '" class="btn btn-sm btn-warning mt-2">Ubah
                                                                Berkas</a>';
        } else {
            $ubahBerkas = '';
        }
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
                                                        <h6>Guru/Pegawai</h6>
                                                        <p>Berkas Selesai Diupload</p>
                                                        <div class="row">
                                                            <a target="_blank" href=" ' . route('usulan-kenaikan-gaji.show', $usulanGaji->id) . ' " class="btn btn-sm btn-primary mt-2 mr-2 ml-3">Lihat
                                                                Berkas</a>
                                                                ' . $ubahBerkas . '
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';

        // Timeline Kepegawaian
        if ($usulanGaji->status_kepegawaian == 2) {
            $ubahBerkas = '<a href=" ' . route('usulan-kenaikan-gaji.edit', $usulanGaji->id) . '" class="btn btn-sm btn-warning mt-2 ml-3">Upload Kembali
                                                                Berkas</a>';
        } else {
            $ubahBerkas = '';
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
                                                        <p>Berkas Masih Diperiksa</p>
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
                                                        <div class="row">
                                                        ' . $ubahBerkas . '
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }
        $timelineKepegawaian = '<div class="single-timeline-area">
                                    ' . $statusKepegawaian . '
                                    </div>';

        // Timeline Admin Kasubag Kepegawaian
        if ($usulanGaji->status_kasubag == 2) {
            $ubahBerkas = '<a href=" ' . route('usulan-kenaikan-gaji.edit', $usulanGaji->id) . '" class="btn btn-sm btn-warning mt-2 ml-3">Upload Kembali
                                                                Berkas</a>';
        } else {
            $ubahBerkas = '';
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
                                                        <p>Berkas Masih Diperiksa</p>
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
                                                        ' . $ubahBerkas . '
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
        if ($usulanGaji->status_sekretaris == 2) {
            $ubahBerkas = '<a href=" ' . route('usulan-kenaikan-gaji.edit', $usulanGaji->id) . '" class="btn btn-sm btn-warning mt-2 ml-3">Upload Kembali
                                                                Berkas</a>';
        } else {
            $ubahBerkas = '';
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
                                                        <p>Berkas Masih Diperiksa</p>
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
                                                        ' . $ubahBerkas . '
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
        if ($usulanGaji->status_kepala_dinas == 2) {
            $ubahBerkas = '<a href=" ' . route('usulan-kenaikan-gaji.edit', $usulanGaji->id) . '" class="btn btn-sm btn-warning mt-2 ml-3">Upload Kembali
                                                                Berkas</a>';
        } else {
            $ubahBerkas = '';
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
                                                        <p>Berkas Masih Diperiksa</p>
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
                                                        <div class="row">
                                                        ' . $ubahBerkas . '
                                                        </div>
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
                                                        <p>Berkas Masih Diperiksa</p>
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
                                                        <h6>Unduh Surat Pengantar Kenaikan Gaji</h6>
                                                        <div class="row">
                                                        <a href="' . url('cetak-usulan-kenaikan-gaji', $usulanGaji->id) . '"class="btn btn-sm btn-success mt-2 mr-2 ml-3">Unduh Surat</a>
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

    public function hapusBerkas(BerkasUsulanGaji $berkasUsulanGaji)
    {
        if (Storage::exists('upload/berkas-usulan-gaji/' . $berkasUsulanGaji->file)) {
            Storage::delete('upload/berkas-usulan-gaji/' . $berkasUsulanGaji->file);
        }

        $berkasUsulanGaji->delete();

        return response()->json([
            'res' => 'success',
            'data' => $berkasUsulanGaji
        ]);
    }

    public function getBerkasUsulanGaji(Request $request)
    {
        $id = $request->id;
        $fileBerkas = BerkasUsulanGaji::find($id)->file;
        $urlFileBerkas = Storage::url('upload/berkas-usulan-gaji/' . $fileBerkas);
        return response()->json([
            'res' => 'success',
            'urlPdf' => $urlFileBerkas
        ]);
    }
}
