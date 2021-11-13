<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use App\Models\ProfilePejabat;
use Illuminate\Support\Carbon;
use App\Models\JabatanFungsional;
use App\Models\JabatanStruktural;
use App\Models\ProfileGuruPegawai;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProfilePejabatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function indexNonProfileGuruPegawai(Request $request)
    {
        if ($request->ajax()) {
            $data = ProfilePejabat::with(['jabatanStruktural', 'user'])->orderBy('updated_at', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (ProfilePejabat $profilePejabat) {
                    $actionBtn = '<a href="' . route('edit-profile-non-guru-pegawai', $profilePejabat->id) . '" class="edit btn btn-success btn-sm my-2">Edit</a>';
                    return $actionBtn;
                })
                ->addColumn('golongan_jabatan_pangkat', function (ProfilePejabat $profilePejabat) {
                    $actionBtn = $profilePejabat->jabatanStruktural->golongan . ' - ' . $profilePejabat->jabatanStruktural->jabatan . ' - ' . $profilePejabat->jabatanStruktural->pangkat;
                    return $actionBtn;
                })
                ->addColumn('role', function (ProfilePejabat $profilePejabat) {
                    $actionBtn = $profilePejabat->user->role;
                    return $actionBtn;
                })
                ->filter(function ($query) use ($request) {
                    if ($request->search != '') {
                        $query->where('nama', "LIKE", "%$request->search%")->orWhere('nip', "LIKE", "%$request->search%");
                    }

                    if (!empty($request->role)) {
                        $query->whereHas('user', function ($query) use ($request) {
                            $query->where('user.role', $request->role);
                        });
                    }

                    // if (!empty($request->unitKerja)) {
                    //     $query->where('unit_kerja', $request->unitKerja);
                    // }
                })

                ->rawColumns(['action', 'role', 'golongan_jabatan_pangkat'])
                ->make(true);
        }

        // $data = [
        //     'unit_kerja' => UnitKerja::all(),
        //     'profile' => ProfilePejabat::all(),
        // ];
        return view('pages.admin.profile.indexNonGuruPegawai');
    }


    public function editProfileNonGuruPegawai(ProfilePejabat $profileNonGuruPegawai)
    {
        // dd($profileNonGuruPegawai);
        // echo ('test');
        // if ($profileGuruPegawai->jenis_asn == 'Guru') {
        //     $jabatanGolonganPangkat = JabatanFungsional::all();
        // } else if ($profileGuruPegawai->jenis_asn == 'Pegawai') {
        //     $jabatanGolonganPangkat = JabatanStruktural::all();
        // }
        $data = [
            'profile' => $profileNonGuruPegawai,
            'jabatanGolonganPangkat' => JabatanStruktural::all(),
            'unit_kerja' => UnitKerja::all()
        ];
        return view('pages.admin.profile.editNonGuruPegawai', $data);
    }

    public function updateProfileNonGuruPegawai(Request $request, ProfilePejabat $profileNonGuruPegawai)
    {
        // dd($request);
        if ($request->file('foto') != null) {
            $foto_req = ['required', 'image', 'file', 'max:1024'];
        } else {
            $foto_req = '';
        }

        if ($request->file('foto_ttd') != null) {
            $foto_ttd_req = ['required', 'mimes:png', 'file', 'max:1024'];
        } else {
            $foto_ttd_req = '';
        }

        $data = $request->validate(
            [
                'nama' => 'required',
                'jenis_kelamin' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'no_hp' => 'required',
                'email' => 'required|email',
                'alamat' => 'required',
                'nip' => 'required',
                'jabatan_pangkat_golongan' => 'required',
                'foto' => $foto_req,
                'foto_ttd' => $foto_ttd_req
            ],
            [
                'nama.required' => 'Nama Tidak Boleh Kosong',
                'jenis_kelamin.required' => 'Jenis Kelamin Tidak Boleh Kosong',
                'tempat_lahir.required' => 'Tempat Lahir Tidak Boleh Kosong',
                'tanggal_lahir.required' => 'Tanggal Lahir Tidak Boleh Kosong',
                'no_hp.required' => 'Nomor HP Tidak Boleh Kosong',
                'email.required' => 'Email Tidak Boleh Kosong',
                'email.email' => 'Email Tidak Valid',
                'alamat.required' => 'Alamat Tidak Boleh Kosong',
                'nip.required' => 'NIP Tidak Boleh Kosong',
                'nip.unique' => 'NIP Telah Digunakan',
                'jabatan_pangkat_golongan.required' => 'Jabatan - Pangkat - Golongan Tidak Boleh Kosong',
                'foto.required' => 'Foto Profil Tidak Boleh Kosong',
                'foto.max' => 'Foto Profil Tidak Boleh Melebihi 1MB',
                'foto_ttd.required' => 'Foto TTD Tidak Boleh Kosong',
                'foto_ttd.max' => 'Foto TTD Tidak Boleh Melebihi 1MB',
                'foto_ttd.mimes' => 'Foto TTD Harus Format PNG (Background Transparan)',
            ]
        );

        $data['id_user'] = $profileNonGuruPegawai->id_user;

        if ($request->file('foto')) {
            if (Storage::exists('upload/foto-profil/' . $profileNonGuruPegawai->foto)) {
                Storage::delete('upload/foto-profil/' . $profileNonGuruPegawai->foto);
            }
            $request->file('foto')->storeAs(
                'upload/foto-profil',
                $profileNonGuruPegawai->id_user .
                    '.' . $request->file('foto')->extension()
            );
            $data['foto'] = $profileNonGuruPegawai->id_user . '.' . $request->file('foto')->extension();
        } else {
            $data['foto'] = $profileNonGuruPegawai->foto;
        }

        if ($request->file('foto_ttd')) {
            if (Storage::exists('upload/foto-ttd/' . $profileNonGuruPegawai->foto_ttd)) {
                Storage::delete('upload/foto-ttd/' . $profileNonGuruPegawai->foto_ttd);
            }
            $request->file('foto_ttd')->storeAs(
                'upload/foto-ttd',
                $profileNonGuruPegawai->id_user .
                    '.' . $request->file('foto_ttd')->extension()
            );
            $data['foto_ttd'] = $profileNonGuruPegawai->id_user . '.' . $request->file('foto_ttd')->extension();
        } else {
            $data['foto_ttd'] = $profileNonGuruPegawai->foto_ttd;
        }


        // $data['nip'] = $request->nip;
        $data['tanggal_lahir'] = date("Y-m-d", strtotime($request->tanggal_lahir));
        // $data['tanggal_kerja'] = date("Y-m-d", strtotime($request->tanggal_kerja));
        // $data['tmt_gaji'] = date("Y-m-d", strtotime($request->tmt_gaji));
        // $data['tmt_pangkat'] = date("Y-m-d", strtotime($request->tmt_pangkat));
        // $data['status_profile'] = "1";
        // $data['konfirmasi_profile'] = Carbon::now();

        ProfilePejabat::where('id', $profileNonGuruPegawai->id)
            ->update($data);

        User::where('id', $profileNonGuruPegawai->id_user)
            ->update(['nip' => $request->nip, 'nama' => $request->nama]);

        Toastr::success('Berhasil Mengubah Profil', 'Success');
        return redirect('/profile-non-guru-pegawai');
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
     * @param  \App\Models\ProfilePejabat  $profilePejabat
     * @return \Illuminate\Http\Response
     */
    public function show(ProfilePejabat $profilePejabat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProfilePejabat  $profilePejabat
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfilePejabat $profilePejabat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProfilePejabat  $profilePejabat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfilePejabat $profilePejabat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProfilePejabat  $profilePejabat
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfilePejabat $profilePejabat)
    {
        //
    }
}
