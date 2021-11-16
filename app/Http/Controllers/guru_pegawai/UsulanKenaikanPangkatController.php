<?php

namespace App\Http\Controllers\guru_pegawai;

use App\Http\Controllers\Controller;
use App\Models\BerkasDasar;
use App\Models\BerkasUsulanPangkat;
use App\Models\JabatanFungsional;
use App\Models\JabatanStruktural;
use App\Models\Persyaratan;
use App\Models\User;
use App\Models\UsulanPangkat;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class UsulanKenaikanPangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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


        if ($request->ajax()) {
            $data = UsulanPangkat::with('berkasUsulanPangkat')->where('id_user', Auth::id())->orderBy('id', 'desc')->get();
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
                ->rawColumns(['action', 'tahun', 'status', 'daftarBerkas'])
                ->make(true);
        }

        $usulanPangkat = UsulanPangkat::count();
        return view('pages.guru_pegawai.kenaikanPangkat.index', compact('usulan', 'usulanPangkat'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sekarang = new DateTime("now");
        $tmt_pangkat = new DateTime(Auth::user()->profile->tmt_pangkat);
        $tahun = $tmt_pangkat->diff($sekarang)->format('%r%y');

        $cekUsulanPangkat = UsulanPangkat::where('tmt_pangkat_sebelumnya', Auth::user()->profile->tmt_pangkat)->first();
        // Cek Apakah TMT Pangkat sudah lebih dari 2 tahun dan cek apakah usulan dengan tmt user sekarang sudah ada atau belum
        if (Auth::user()->role == "Guru") {
            if ($tahun < 2 && !($cekUsulanPangkat)) {
                return redirect()->route('usulan-kenaikan-pangkat.index');
            }
        } else if (Auth::user()->role == "Pegawai") {
            if ($tahun < 4 && !($cekUsulanPangkat)) {
                return redirect()->route('usulan-kenaikan-pangkat.index');
            }
        }
        if ($cekUsulanPangkat) {
            return redirect()->route('usulan-kenaikan-pangkat.index');
        }
        $berkasDasar = BerkasDasar::where('id_user', Auth::id())->get();
        if (Auth::user()->role == "Guru") {
            $listPangkat = JabatanFungsional::where('no_urut', '>', Auth::user()->profile->jabatanFungsional->no_urut)->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('persyaratan')
                    ->whereColumn('persyaratan.ke_golongan', 'jabatan_fungsional.id');
            })->get();
        } else {
            $listPangkat = JabatanStruktural::where('no_urut', '>', Auth::user()->profile->jabatanStruktural->no_urut)->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('persyaratan')
                    ->whereColumn('persyaratan.ke_golongan', 'jabatan_fungsional.id');
            })->get();
        }

        $user = User::find(Auth::id());
        return view('pages.guru_pegawai.kenaikanPangkat.create', compact('berkasDasar', 'user', 'listPangkat'));
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

        $usulanPangkat = new UsulanPangkat();
        $usulanPangkat->id_user = Auth::id();
        $usulanPangkat->nama = "Surat Pengantar Kenaikan Pangkat " . Auth::user()->nama . " " . Carbon::now()->year;
        $usulanPangkat->status_tim_penilai = 0;
        $usulanPangkat->status_kepegawaian = 0;
        $usulanPangkat->status_kasubag = 0;
        $usulanPangkat->status_sekretaris = 0;
        $usulanPangkat->status_kepala_dinas = 0;
        $usulanPangkat->tmt_pangkat_sebelumnya = Auth::user()->profile->tmt_pangkat;
        $usulanPangkat->pangkat_sebelumnya = Auth::user()->profile->jabatan_pangkat_golongan;
        $usulanPangkat->pangkat_selanjutnya = $request->usulan_pangkat;
        $usulanPangkat->unique_id = uniqid();

        $tanggal_kerja = new DateTime(Auth::user()->profile->tanggal_kerja);
        $sekarang = new DateTime("today");
        $thn = $sekarang->diff($tanggal_kerja)->y;
        $bln = $sekarang->diff($tanggal_kerja)->m;

        $usulanPangkat->jumlah_tahun_kerja_lama = $thn;
        $usulanPangkat->jumlah_bulan_kerja_lama = $bln;

        $usulanPangkat->save();

        $usulanPangkatId = $usulanPangkat->id;

        for ($i = 0; $i < $lengthBerkas; $i++) {
            $namaFileBerkas = Str::slug($request->namaBerkas[$i], '-') . "-" . $i . Carbon::now()->format('YmdHs') . rand(1, 9999) . ".pdf";
            $request->file('fileBerkas')[$i]->storeAs(
                'upload/berkas-usulan-pangkat',
                $namaFileBerkas
            );

            $berkasPangkat = new BerkasUsulanPangkat();
            $berkasPangkat->id_usulan_pangkat = $usulanPangkatId;
            $berkasPangkat->nama = $request->namaBerkas[$i];
            $berkasPangkat->file = $namaFileBerkas;
            $berkasPangkat->save();
        }
        Toastr::success('Berhasil Mengupload Berkas', 'Success');
        return redirect()->route('usulan-kenaikan-pangkat.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UsulanPangkat  $usulanPangkat
     * @return \Illuminate\Http\Response
     */
    public function show(UsulanPangkat $usulanPangkat)
    {
        $berkasDasar = BerkasDasar::where('id_user', Auth::id())->get();
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
        return view('pages.guru_pegawai.kenaikanPangkat.show', compact('usulanPangkat', 'berkasDasar', 'user', 'listPangkat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UsulanPangkat  $usulanPangkat
     * @return \Illuminate\Http\Response
     */
    public function edit(UsulanPangkat $usulanPangkat)
    {
        if ($usulanPangkat->status_tim_penilai != 0) {
            if (!($usulanPangkat->status_tim_penilai == 2 || $usulanPangkat->status_kepegawaian == 2 || $usulanPangkat->status_kasubag == 2 || $usulanPangkat->status_sekretaris || $usulanPangkat->kepala_dinas == 2)) {
                return redirect()->route('usulan-kenaikan-pangkat.index');
            }
        }
        $berkasPangkat = $usulanPangkat->berkasUsulanPangkat;
        $berkasDasar = BerkasDasar::where('id_user', Auth::id())->get();
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
        return view('pages.guru_pegawai.kenaikanPangkat.edit', compact('usulanPangkat', 'berkasDasar', 'user', 'listPangkat', 'berkasPangkat'));
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
        // dd($request->file('fileBerkasUpdate'));
        $lengthBerkasUpdate = count($request->namaBerkasUpdate);
        // Update
        if ($request->namaBerkasUpdate) {
            for ($i = 0; $i < $lengthBerkasUpdate; $i++) {
                $berkasPangkat = BerkasUsulanPangkat::find($request->idBerkasUpdate[$i]);
                $namaFileBerkasUpdate = Str::slug($request->namaBerkasUpdate[$i], '-') . "-" . $i . Carbon::now()->format('YmdHs') . rand(1, 9999) . ".pdf";

                if (isset($request->file('fileBerkasUpdate')[$i])) {
                    if (Storage::exists('upload/berkas-usulan-pangkat/' . $berkasPangkat->file)) {
                        Storage::delete('upload/berkas-usulan-pangkat/' . $berkasPangkat->file);
                    }
                    $request->file('fileBerkasUpdate')[$i]->storeAs(
                        'upload/berkas-usulan-pangkat',
                        $namaFileBerkasUpdate
                    );
                    $berkasPangkat->file = $namaFileBerkasUpdate;
                }

                $berkasPangkat->nama = $request->namaBerkasUpdate[$i];
                $berkasPangkat->save();
            }
        }
        // Tambahkan Berkas Baru
        if ($request->namaBerkas) {
            $lengthBerkas = count($request->namaBerkas);
            if ($request->namaBerkas) {
                for ($i = 0; $i < $lengthBerkas; $i++) {
                    $namaFileBerkas = Str::slug($request->namaBerkas[$i], '-') . "-" . $i . Carbon::now()->format('YmdHs') . ".pdf";
                    $request->file('fileBerkas')[$i]->storeAs(
                        'upload/berkas-usulan-pangkat',
                        $namaFileBerkas
                    );

                    $berkasPangkat = new BerkasUsulanPangkat();
                    $berkasPangkat->id_usulan_pangkat = $usulanPangkat->id;
                    $berkasPangkat->nama = $request->namaBerkas[$i];
                    $berkasPangkat->file = $namaFileBerkas;
                    $berkasPangkat->save();
                }
            }
        }

        $usulanPangkat->pangkat_selanjutnya = $request->usulan_pangkat;
        $usulanPangkat->save();

        if ($usulanPangkat->status_tim_penilai == 2) {
            $usulanPangkat->status_tim_penilai = 0;
            $usulanPangkat->alasan_tolak_tim_penilai = NULL;
            $usulanPangkat->save();
        } else if ($usulanPangkat->status_kepegawaian == 2) {
            $usulanPangkat->status_kepegawaian = 0;
            $usulanPangkat->alasan_tolak_kepegawaian = NULL;
            $usulanPangkat->save();
        } else if ($usulanPangkat->status_kasubag == 2) {
            $usulanPangkat->status_kasubag = 0;
            $usulanPangkat->alasan_tolak_kasubag = NULL;
            $usulanPangkat->save();
        } else if ($usulanPangkat->status_sekretaris == 2) {
            $usulanPangkat->status_sekretaris = 0;
            $usulanPangkat->alasan_tolak_sekretaris = NULL;
            $usulanPangkat->save();
        } else if ($usulanPangkat->status_kepala_dinas == 2) {
            $usulanPangkat->status_kepala_dinas = 0;
            $usulanPangkat->alasan_tolak_kepala_dinas = NULL;
            $usulanPangkat->save();
        }

        Toastr::success('Berhasil Mengubah Berkas', 'Success');
        return redirect()->route('usulan-kenaikan-pangkat.index');
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

    public function hapusBerkas(BerkasUsulanPangkat $berkasUsulanPangkat)
    {
        if (Storage::exists('upload/berkas-usulan-pangkat/' . $berkasUsulanPangkat->file)) {
            Storage::delete('upload/berkas-usulan-pangkat/' . $berkasUsulanPangkat->file);
        }

        $berkasUsulanPangkat->delete();

        return response()->json([
            'res' => 'success',
            'data' => $berkasUsulanPangkat
        ]);
    }

    public function getPersyaratanBerkas(Request $request)
    {
        $pangkat = $request->pangkat;
        if (Auth::user()->role == "Guru" || Auth::user()->role == "Pegawai") {
            $role = Auth::user()->role;
        } else {
            $role = $request->role;
        }
        $persyaratan = Persyaratan::where('jenis_asn', $role)->where('kategori', 'Usulan Kenaikan Pangkat')->where('ke_golongan', $pangkat)->first();
        $daftarPersyaratan = '<h6 class="my-2 font-weight-bold">Berikut beberapa berkas yang harus di upload:</h6><ul class="list-group list-group-bordered list my-4">';
        $form = '';
        $readOnlyDeskripsi = '';
        $btnHapus = '';

        $i = 1;
        foreach ($persyaratan->deskripsiPersyaratan as $syarat) {
            $daftarPersyaratan .= '<li class="list-group-item">
                <span class="name">' . $i  . '. ' . $syarat->deskripsi . '</span>
            </li>';

            if ($syarat->deskripsi == 'SK Pangkat Terakhir') {
                $readOnlyDeskripsi = 'readonly';
                $btnHapus = '';
            } else {
                $readOnlyDeskripsi = '';
                $btnHapus = '<button href="" class="btn btn-danger btn-sm btnHapusFitur" id="' . $i . '">
                                <i class="fas fa-trash-alt"></i>
                                Hapus</button>';
            }

            $form .= '<div class="form-group border border-grey shadow-lg rounded p-3"
                        id="daftarBerkas' . $i . '">
                        <label for="exampleInputEmail1">Nama Berkas</label>
                        <input type="text" class="form-control namaBerkas" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Nama Berkas" name="namaBerkas[]"
                            value="' . $syarat->deskripsi . '" ' . $readOnlyDeskripsi . '>
                        <div class="mb-3 mt-3"><label for="formFileSm" class="form-label">File
                                Berkas</label><input class="form-control form-control-sm fileBerkas" id="formFileSm"
                                type="file" name="fileBerkas[]"></div>
                        <div class="div d-flex justify-content-end">
                            ' . $btnHapus . '
                        </div>
                    </div>';
            $i++;
        }


        $daftarPersyaratan .= '</ul>';

        if ($persyaratan) {
            return response()->json([
                'res' => 'success',
                'daftarPersyaratan' => $daftarPersyaratan,
                'formPersyaratan' => $form,
                'jumlahForm' => count($persyaratan->deskripsiPersyaratan)
            ]);
        } else {
            return response()->json([
                'res' => 'error'
            ]);
        }
    }

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
        if ($usulanPangkat->status_tim_penilai == 0) {
            $ubahBerkas = '<a href=" ' . route('usulan-kenaikan-pangkat.edit', $usulanPangkat->id) . '" class="btn btn-sm btn-warning mt-2">Ubah
                                                                Berkas</a>';
        } else {
            $ubahBerkas = '';
        }
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
                                                        <div class="row">
                                                            <a target="_blank" href=" ' . route('usulan-kenaikan-pangkat.show', $usulanPangkat->id) . ' " class="btn btn-sm btn-primary mt-2 mr-2 ml-3">Lihat
                                                                Berkas</a>
                                                                ' . $ubahBerkas . '
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';

        // Timeline Tim Penilai
        if ($usulanPangkat->status_tim_penilai == 2) {
            $ubahBerkas = '<a href=" ' . route('usulan-kenaikan-pangkat.edit', $usulanPangkat->id) . '" class="btn btn-sm btn-warning mt-2 ml-3">Ubah
                                                                Berkas</a>';
        } else {
            $ubahBerkas = '';
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
                                                        <p>Berkas Masih Diperiksa</p>
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
                                                        <div class="row">
                                                        ' . $ubahBerkas . '
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }
        $timelineTimPenilai = '<div class="single-timeline-area">
                                    ' . $statusTimPenilai . '
                                    </div>';

        // Timeline Kepegawaian
        if ($usulanPangkat->status_kepegawaian == 2) {
            $ubahBerkas = '<a href=" ' . route('usulan-kenaikan-gaji.edit', $usulanPangkat->id) . '" class="btn btn-sm btn-warning mt-2 ml-3">Upload Kembali
                                                                Berkas</a>';
        } else {
            $ubahBerkas = '';
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
                                                        <p>Berkas Masih Diperiksa</p>
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
        if ($usulanPangkat->status_kasubag == 2) {
            $ubahBerkas = '<a href=" ' . route('usulan-kenaikan-gaji.edit', $usulanPangkat->id) . '" class="btn btn-sm btn-warning mt-2 ml-3">Upload Kembali
                                                                Berkas</a>';
        } else {
            $ubahBerkas = '';
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
                                                        <p>Berkas Masih Diperiksa</p>
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
        if ($usulanPangkat->status_sekretaris == 2) {
            $ubahBerkas = '<a href=" ' . route('usulan-kenaikan-gaji.edit', $usulanPangkat->id) . '" class="btn btn-sm btn-warning mt-2 ml-3">Upload Kembali
                                                                Berkas</a>';
        } else {
            $ubahBerkas = '';
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
                                                        <p>Berkas Masih Diperiksa</p>
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
        if ($usulanPangkat->status_kepala_dinas == 2) {
            $ubahBerkas = '<a href=" ' . route('usulan-kenaikan-gaji.edit', $usulanPangkat->id) . '" class="btn btn-sm btn-warning mt-2 ml-3">Upload Kembali
                                                                Berkas</a>';
        } else {
            $ubahBerkas = '';
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
                                                        <p>Berkas Masih Diperiksa</p>
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
                                                        <p>Berkas Masih Diperiksa</p>
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

        $timeline = $startSection  . $timelineGuru . $timelineTimPenilai . $timelineKepegawaian . $timelineKasubag . $timelineSekretaris . $timelineKepalaDinas . $timelineBerkas . $endSection;
        return response()->json([
            'res' => 'success',
            'html' => $timeline
        ]);
    }
}
