<?php

namespace App\Http\Controllers\guru_pegawai;

use App\Http\Controllers\Controller;
use App\Models\BerkasUsulanGaji;
use App\Models\UsulanGaji;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UsulanKenaikanGajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usulanGaji = UsulanGaji::where('id_user', Auth::id())->orderBy('id', 'desc')->get(); //Nanti Ganti Ke Where id user login
        return view('pages.guru_pegawai.kenaikanGaji.index', compact('usulanGaji'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.guru_pegawai.kenaikanGaji.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(count($request->namaBerkas));
        // dd($request->file('fileBerkas'));
        // dd($request->file('fileBerkas')[0]);
        $lengthBerkas = count($request->namaBerkas);

        $usulanGaji = new UsulanGaji();
        $usulanGaji->id_user = Auth::id();
        $usulanGaji->status_kepegawaian = 0;
        $usulanGaji->status_kasubag = 0;
        $usulanGaji->status_sekretaris = 0;
        $usulanGaji->status_kepala_dinas = 0;
        $usulanGaji->save();

        $usulanGajiId = $usulanGaji->id;

        for ($i = 0; $i < $lengthBerkas; $i++) {
            $namaFileBerkas = Str::slug($request->namaBerkas[$i], '-') . "-" . $i . Carbon::now()->format('YmdHs') . ".pdf";
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
        return view('pages.guru_pegawai.kenaikanGaji.show', compact('usulanGaji'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UsulanGaji  $usulanGaji
     * @return \Illuminate\Http\Response
     */
    public function edit(UsulanGaji $usulanGaji)
    {
        $berkasGaji = $usulanGaji->berkasUsulanGaji;
        return view('pages.guru_pegawai.kenaikanGaji.edit', compact(['berkasGaji', 'usulanGaji']));
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
                $namaFileBerkasUpdate = Str::slug($request->namaBerkasUpdate[$i], '-') . "-" . $i . Carbon::now()->format('YmdHs') . ".pdf";


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
        if ($usulanGaji->status_kepegawaian != 1) {
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
                                                        <h6>Guru</h6>
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }
        $timelineKepegawaian = '<div class="single-timeline-area">
                                    ' . $statusKepegawaian . '
                                    </div>';

        // Timeline Admin Kasubag Kepegawaian
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }
        $timelineKasubag = '<div class="single-timeline-area">
                                    ' . $statusKasubag . '
                                    </div>';

        // Timeline Sekretaris
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }
        $timelineSekretaris = '<div class="single-timeline-area">
                                    ' . $statusSekretaris . '
                                    </div>';

        // Timeline Kepala Dinas
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }
        $timelineKepalaDinas = '<div class="single-timeline-area">
                                    ' . $statusKepalaDinas . '
                                    </div>';

        // Timeline Berkas
        if ($usulanGaji->status_kepala_dinas == 0) {
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
                                                        <button class="btn btn-sm btn-success mt-2 mr-2 ml-3">Unduh Berkas</button>
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
