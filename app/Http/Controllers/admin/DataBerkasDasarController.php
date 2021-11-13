<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\BerkasDasar;
use App\Models\Persyaratan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\JabatanFungsional;
use App\Models\JabatanStruktural;
use App\Models\ProfileGuruPegawai;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpKernel\Profiler\Profile;

class DataBerkasDasarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function latest($column = 'updated_at')
    {
        return $this->orderBy($column, 'desc');
    }

    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = User::with(['berkasDasar', 'profile'])->whereIn('role', ['Guru', 'Pegawai']);
    //         return DataTables::of($data)
    //             // ->eloquent($this->query())
    //             ->addIndexColumn()
    //             ->addColumn('file_upload', function (User $user) {
    //                 if ($user->profile) {
    //                     $listBerkas = '';
    //                     $listBerkas .= '<ol style="margin-top: 15px">';
    //                     if ($user->berkasDasar->where('id_user', '=', $user->id)->count() != 0) {
    //                         foreach ($user->berkasDasar as $row) {
    //                             $listBerkas .= '<li>'
    //                                 . $row->nama .
    //                                 '</li>';
    //                         }
    //                         $listBerkas .= '</ol>';
    //                         return $listBerkas;
    //                     } else {
    //                         $listBerkas = '<span class="badge badge-secondary p-2">Belum Ada Berkas Dasar</span>';
    //                         return $listBerkas;
    //                     }
    //                 } //
    //                 else {
    //                     $actionBtn = '<span class="badge badge-secondary p-2">Profile Belum Lengkap Dan Belum Ada Berkas Dasar</span>';
    //                     return $actionBtn;
    //                 }
    //             })
    //             ->addColumn('action', function (User $user) {
    //                 if ($user->profile) {
    //                     if ($user->profile->status_berkas_dasar == -1) {
    //                         $actionBtn = '<span class="badge badge-secondary p-2">Belum Ada Berkas Dasar</span>';
    //                         return $actionBtn;
    //                     } else if ($user->profile->status_berkas_dasar == 0) {
    //                         $actionBtn = '<a href="' . route('data-berkas-dasar.show', $user->id) . '" class="edit btn shadow btn-success btn-sm my-2">Proses Berkas</a>';
    //                         return $actionBtn;
    //                     } else {
    //                         $actionBtn = '<a href="' . route('data-berkas-dasar.show', $user->id) . '" class="edit btn shadow btn-primary btn-sm my-2">Lihat Berkas</a>';
    //                         return $actionBtn;
    //                     }
    //                 } //
    //                 else {
    //                     $actionBtn = '<span class="badge badge-secondary p-2">Profile Belum Lengkap Dan Belum Ada Berkas Dasar</span>';
    //                     return $actionBtn;
    //                 }
    //             })
    //             ->addColumn('status_berkas', function (User $user) {
    //                 if ($user->profile) {
    //                     if ($user->profile->status_berkas_dasar == -1) {
    //                         $actionBtn = '<span class="badge badge-secondary p-2">Belum Ada Berkas Dasar</span>';
    //                         return $actionBtn;
    //                     } else if ($user->profile->status_berkas_dasar == 0) {
    //                         $actionBtn = '<span class="badge badge-warning p-2">Menunggu Konfirmasi</span>';
    //                         return $actionBtn;
    //                     } else if ($user->profile->status_berkas_dasar == 1) {
    //                         $actionBtn = '<span class="badge badge-success p-2">Disetujui</span>';
    //                         return $actionBtn;
    //                     } else if ($user->profile->status_berkas_dasar == 2) {
    //                         $actionBtn = '<span class="badge badge-danger p-2 mr-2">Ditolak</span>';
    //                         return $actionBtn;
    //                     }
    //                 } //
    //                 else {
    //                     $actionBtn = '<span class="badge badge-secondary p-2">Profile Belum Lengkap Dan Belum Ada Berkas Dasar</span>';
    //                     return $actionBtn;
    //                 }
    //             })

    //             ->filter(function ($query) use ($request) {
    //                 if ($request->search != '') {
    //                     $query->where('nama', "LIKE", "%$request->search%")->orWhere('nip', "LIKE", "%$request->search%");
    //                 }

    //                 if (!empty($request->jenisAsn)) {
    //                     $query->where('role', $request->jenisAsn);
    //                 }

    //                 if (!empty($request->statusBerkas)) {
    //                     $query->whereHas('profile', function ($query) use ($request) {
    //                         if ($request->statusBerkas == 3) {
    //                             $query->where("profile_guru_pegawai.status_berkas_dasar", "0");
    //                         } else {
    //                             $query->where('profile_guru_pegawai.status_berkas_dasar', $request->statusBerkas);
    //                         }
    //                     });
    //                 }
    //             })
    //             ->rawColumns(['action', 'file_upload', 'status_berkas'])
    //             ->make(true);
    //     }
    //     return view('pages.admin.berkasDasar.index');
    // }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ProfileGuruPegawai::with('berkasDasar')->whereIn('status', ['PNS', 'PNS Depag', 'PNS Diperbantukan'])->orderBy('updated_at', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('file_upload', function (ProfileGuruPegawai $profile) {
                    $listBerkas = '';
                    $listBerkas .= '<ol style="margin-top: 15px">';
                    if ($profile->berkasDasar->where('id_user', '=', $profile->id_user)->count() != 0) {
                        foreach ($profile->berkasDasar as $row) {
                            $listBerkas .= '<li>'
                                . $row->nama .
                                '</li>';
                        }
                        $listBerkas .= '</ol>';
                        return $listBerkas;
                    } else {
                        $listBerkas = '<span class="badge badge-secondary p-2">Belum Ada Berkas Dasar</span>';
                        return $listBerkas;
                    }
                })
                ->addColumn('action', function (ProfileGuruPegawai $profile) {
                    if ($profile->status_berkas_dasar == -1) {
                        $actionBtn = '<span class="badge badge-secondary p-2">Belum Ada Berkas Dasar</span>';
                        return $actionBtn;
                    } else if ($profile->status_berkas_dasar == 0) {
                        $actionBtn = '<a href="' . route('data-berkas-dasar.show', $profile->id) . '" class="edit btn shadow btn-success btn-sm my-2">Proses</a>';
                        return $actionBtn;
                    } else {
                        $actionBtn = '<a href="' . route('data-berkas-dasar.show', $profile->id) . '" class="edit btn shadow btn-primary btn-sm my-2">Lihat</a>';
                        return $actionBtn;
                    }
                })
                ->addColumn('status_berkas', function (ProfileGuruPegawai $profile) {
                    if ($profile->status_berkas_dasar == -1) {
                        $actionBtn = '<span class="badge badge-secondary p-2">Belum Ada Berkas Dasar</span>';
                        return $actionBtn;
                    } else if ($profile->status_berkas_dasar == 0) {
                        $actionBtn = '<span class="badge badge-warning p-2">Menunggu Konfirmasi</span>';
                        return $actionBtn;
                    } else if ($profile->status_berkas_dasar == 1) {
                        $actionBtn = '<span class="badge badge-success p-2">Disetujui</span>';
                        return $actionBtn;
                    } else if ($profile->status_berkas_dasar == 2) {
                        $actionBtn = '<span class="badge badge-danger p-2 mr-2">Ditolak</span>';
                        return $actionBtn;
                    }
                })

                ->filter(function ($query) use ($request) {
                    // if (!empty($request->jenisAsn)) {
                    //     $query->whereHas('profile', function ($query) use ($request) {
                    //         $query->where('profile_guru_pegawai.jenis_asn', $request->jenisAsn);
                    //     });
                    // }
                    if (!empty($request->jenisGuru)) {
                        $query->where('jenis_guru', $request->jenisGuru);
                    }

                    if (!empty($request->statusKepegawaian)) {
                        $query->where('status', $request->statusKepegawaian);
                    }

                    if (!empty($request->statusBerkas)) {
                        if ($request->statusBerkas == 3) {
                            $query->where("status_berkas_dasar", "0");
                        } else {
                            $query->where('status_berkas_dasar', $request->statusBerkas);
                        }
                    }
                    if ($request->search != '') {
                        $query->where('nama', "LIKE", "%$request->search%")->orWhere('nip', "LIKE", "%$request->search%");
                    }
                })
                ->rawColumns(['action', 'file_upload', 'status_berkas'])
                ->make(true);
        }
        return view('pages.admin.berkasDasar.index');
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
     * @param  \App\Models\BerkasDasar  $berkasDasar
     * @return \Illuminate\Http\Response
     */
    // public function show(BerkasDasar $berkasDasar)
    // {
    //     $berkasDasarArr = BerkasDasar::where('id_user', '=', $berkasDasar->id_user)->get();
    //     $user = User::with('profile')->find($berkasDasar->id_user);
    //     if ($user->profile->jenis_asn == 'Guru') {
    //         $jabatan = JabatanFungsional::find($user->profile->jabatan_pangkat_golongan);
    //     } else {
    //         $jabatan = JabatanStruktural::find($user->profile->jabatan_pangkat_golongan);
    //     }
    //     $data = [
    //         'berkasDasar' => $berkasDasarArr,
    //         'user' => $user,
    //         'jabatan' => $jabatan
    //     ];


    //     return view('pages.admin_kepegawaian.berkasDasar.show', $data);
    // }

    public function show(ProfileGuruPegawai $profile_guru_pegawai)
    {

        // dd($profile_guru_pegawai);
        if ($profile_guru_pegawai->jenis_asn == 'Guru') {
            $jabatan = JabatanFungsional::find($profile_guru_pegawai->jabatan_pangkat_golongan);
        } else {
            $jabatan = JabatanStruktural::find($profile_guru_pegawai->jabatan_pangkat_golongan);
        }
        $data = [
            'persyaratan' => Persyaratan::with('deskripsiPersyaratan')->where('jenis_asn', $profile_guru_pegawai->jenis_asn)
                ->where('kategori', 'Berkas Dasar')->get(),
            'berkasDasar' => $profile_guru_pegawai->berkasDasar,
            'profile' => $profile_guru_pegawai,
            'jabatan' => $jabatan
        ];
        return view('pages.admin.berkasDasar.show', $data);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BerkasDasar  $berkasDasar
     * @return \Illuminate\Http\Response
     */
    public function edit(BerkasDasar $berkasDasar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BerkasDasar  $berkasDasar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfileGuruPegawai $profile_guru_pegawai)
    {
        // dd($profile_guru_pegawai);
        if ($request->status_berkas_dasar == 2) {
            $alasan = ['required'];
        } else {
            $alasan = '';
        }
        $data = $request->validate(
            [
                'status_berkas_dasar' => 'required',
                'alasan_berkas_dasar' => $alasan,
            ],
            [
                'status_berkas_dasar.required' => 'Status Konfirmasi Berkas Harus Dipilih',
                'alasan_berkas_dasar.required' => 'Alasan Ditolak Tidak Boleh Kosong',
            ]
        );

        $data['konfirmasi_berkas_dasar'] = now();

        ProfileGuruPegawai::where('id', $profile_guru_pegawai->id)
            ->update($data);
        return redirect('/data-berkas-dasar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BerkasDasar  $berkasDasar
     * @return \Illuminate\Http\Response
     */
    public function destroy(BerkasDasar $berkasDasar)
    {
        //
    }
}
