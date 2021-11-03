<?php

namespace App\Http\Controllers\guru_pegawai;

use App\Models\User;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use App\Models\JabatanFungsional;
use App\Models\JabatanStruktural;
use App\Models\ProfileGuruPegawai;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProfileGuruPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id)->profile;
        if ($user == null) {
            if (Auth::user()->role == 'Guru') {
                $jabatanGolonganPangkat = JabatanFungsional::all();
            } else if (Auth::user()->role == 'Pegawai') {
                $jabatanGolonganPangkat = JabatanStruktural::all();
            }
            $data = [
                'unit_kerja' => UnitKerja::all(),
                'jabatanGolonganPangkat' => $jabatanGolonganPangkat,
                'role' => Auth::user()->role
            ];
            return view('pages.guru_pegawai.lengkapiData.profile', $data);
        } else {
            return redirect('/dashboard');
        }






        // return view('components.dashboard.guru_pegawai.mainLengkapiData', $data);
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
        if (Auth::user()->role == 'Guru') {
            $jenis_guru_req = ['required'];
            $nuptk_req = ['required'];
        } else {
            $jenis_guru_req = '';
            $nuptk_req = '';
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
                'pendidikan_terakhir' => 'required',
                'jenis_asn' => 'required',
                'jenis_guru' => $jenis_guru_req,
                // 'nip' => 'required',
                'nuptk' => $nuptk_req,
                'unit_kerja' => 'required',
                'status' => 'required',
                'jabatan_pangkat_golongan' => 'required',
                'tanggal_kerja' => 'required',
                'nilai_gaji' => 'required',
                'tmt_gaji' => 'required',
                'tmt_pangkat' => 'required',
                'foto' => 'required|image|file|max:1024'
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
                'pendidikan_terakhir.required' => 'Pendidikan Terakhir Tidak Boleh Kosong',
                'jenis_asn.required' => 'Jenis Asn Tidak Boleh Kosong',
                'jenis_guru.required' => 'Jenis Guru Tidak Boleh Kosong',
                // 'nip.required' => 'Kategori Tidak Boleh Kosong',
                'nuptk.required' => 'NUPTK Tidak Boleh Kosong',
                'unit_kerja.required' => 'Unit Kerja Tidak Boleh Kosong',
                'status.required' => 'Status Tidak Boleh Kosong',
                'jabatan_pangkat_golongan.required' => 'Jabatan - Pangkat - Golongan Tidak Boleh Kosong',
                'tanggal_kerja.required' => 'Tanggal Awal Kerja Tidak Boleh Kosong',
                'nilai_gaji.required' => 'Nilai Gaji Tidak Boleh Kosong',
                'tmt_gaji.required' => 'TMT Gaji Tidak Boleh Kosong',
                'tmt_pangkat.required' => 'TMT Pangkat Tidak Boleh Kosong',
                'foto.required' => 'Foto Profil Tidak Boleh Kosong',
                'foto.max' => 'Foto Profil Tidak Boleh Melebihi 1MB',

            ]
        );

        $request->file('foto')->storeAs(
            'upload/foto-profil',
            Auth::user()->id .
                '.' . $request->file('foto')->extension()
        );

        $data['id_user'] = $request->user()->id;
        if (Auth::user()->role == 'Guru') {
            $data['jenis_jabatan'] = 'Fungsional';
        } else {
            $data['jenis_jabatan'] = 'Struktural';
            $data['jenis_guru'] = '-';
        }
        $data['nip'] = $request->nip;
        $data['tanggal_lahir'] = date("Y-m-d", strtotime($request->tanggal_lahir));
        $data['tanggal_kerja'] = date("Y-m-d", strtotime($request->tanggal_kerja));
        $data['tmt_gaji'] = date("Y-m-d", strtotime($request->tmt_gaji));
        $data['tmt_pangkat'] = date("Y-m-d", strtotime($request->tmt_pangkat));
        $data['foto'] = Auth::user()->id . '.' . $request->file('foto')->extension();
        $data['status_profile'] = 0;
        $data['konfirmasi_profile'] = Carbon::now();

        ProfileGuruPegawai::create($data);

        User::where('id', Auth::user()->id)
            ->update(['nama' => $request->nama, 'nip' => $request->nip]);

        Toastr::success('Berhasil Melengkapi Profil, Data Anda Akan di Cek Terlebih Dahulu Oleh Admin', 'Success');
        return redirect('/berkas-dasar');


        // dd($data);
        // 
        // echo 'berhasil';

        // $persyaratan = [
        //     'jenis_asn' => $request->jenis_asn,
        //     'kategori' => $request->kategori,
        //     'ke_golongan' => $request->ke_golongan,
        // ];
        // ProfileGuruPegawai::create($persyaratan);
    }

    public function indexProfileGuruPegawai(Request $request)
    {
        if ($request->ajax()) {
            $data = ProfileGuruPegawai::with(['jabatanStruktural', 'jabatanFungsional', 'unitKerja'])->orderBy('created_at', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (ProfileGuruPegawai $profileGuruPegawai) {
                    if ($profileGuruPegawai->status_profile != 1) {
                        // ' . route('user.edit', $row->id) . '
                        // $actionBtn = '<a href="/show-profile-guru-pegawai/' . $profileGuruPegawai->id . '/showProfileGuruPegawai" class="edit btn shadow btn-success btn-sm my-2">Proses Profil</a>';
                        $actionBtn = '<a href="' . route('proses-profile-guru-pegawai', $profileGuruPegawai->id) . '" class="edit btn shadow btn-success btn-sm my-2">Proses</a>';
                        return $actionBtn;
                    } else {
                        $actionBtn = '<a href="' . route('edit-profile-guru-pegawai', $profileGuruPegawai->id) . '" class="edit btn shadow btn-success btn-sm my-2">Edit</a>';
                        return $actionBtn;
                    }
                })
                ->addColumn('status_profile_', function (ProfileGuruPegawai $profileGuruPegawai) {
                    if ($profileGuruPegawai->status_profile == 0) {
                        $actionBtn = '<span class="badge badge-warning p-2">Menunggu Konfirmasi</span>';
                        return $actionBtn;
                    } else if ($profileGuruPegawai->status_profile == 1) {
                        $actionBtn = '<span class="badge badge-success p-2">Sudah Lengkap dan Disetujui</span>';
                        return $actionBtn;
                    } else if ($profileGuruPegawai->status_profile == 2) {
                        $actionBtn = '<span class="badge badge-danger p-2 mr-2">Ditolak</span>';
                        return $actionBtn;
                    }
                })
                ->addColumn('unit_kerja', function (ProfileGuruPegawai $profileGuruPegawai) {
                    $actionBtn = $profileGuruPegawai->unitKerja->nama;
                    return $actionBtn;
                })
                ->addColumn('golongan_jabatan_pangkat', function (ProfileGuruPegawai $profileGuruPegawai) {
                    if ($profileGuruPegawai->jabatan_pangkat_golongan == 0) {
                        return 'Belum Ada Data';
                    }
                    if ($profileGuruPegawai->jenis_asn == 'Pegawai') {
                        $actionBtn = $profileGuruPegawai->jabatanStruktural->golongan . ' - ' . $profileGuruPegawai->jabatanStruktural->jabatan . ' - ' . $profileGuruPegawai->jabatanStruktural->pangkat;
                        return $actionBtn;
                    } else if ($profileGuruPegawai->jenis_asn == 'Guru') {

                        $actionBtn = $profileGuruPegawai->jabatanFungsional->golongan . ' - ' . $profileGuruPegawai->jabatanFungsional->jabatan . ' - ' . $profileGuruPegawai->jabatanFungsional->pangkat;
                        return $actionBtn;
                    }
                })
                ->filter(function ($query) use ($request) {
                    if ($request->search != '') {
                        $query->where('nama', "LIKE", "%$request->search%")->orWhere('nip', "LIKE", "%$request->search%");
                    }

                    if (!empty($request->jenisAsn)) {
                        $query->where('jenis_asn', $request->jenisAsn);
                    }

                    if (!empty($request->unitKerja)) {
                        $query->where('unit_kerja', $request->unitKerja);
                    }

                    if (!empty($request->statusProfile)) {
                        if ($request->statusProfile == 3) {
                            $query->where('status_profile', '0');
                        } else {
                            $query->where('status_profile', $request->statusProfile);
                        }
                    }
                })


                ->rawColumns(['action', 'golongan_jabatan_pangkat', 'status_profile_'])
                ->make(true);
        }

        $data = [
            'unit_kerja' => UnitKerja::all(),
            'profile' => ProfileGuruPegawai::all(),
        ];
        return view('pages.admin.profile.indexGuruPegawai', $data);
    }

    public function editProfileGuruPegawai(ProfileGuruPegawai $profileGuruPegawai)
    {
        // echo ('test');
        if ($profileGuruPegawai->jenis_asn == 'Guru') {
            $jabatanGolonganPangkat = JabatanFungsional::all();
        } else if ($profileGuruPegawai->jenis_asn == 'Pegawai') {
            $jabatanGolonganPangkat = JabatanStruktural::all();
        }
        $data = [
            'profile' => $profileGuruPegawai,
            'jabatanGolonganPangkat' => $jabatanGolonganPangkat,
            'unit_kerja' => UnitKerja::all()
        ];
        return view('pages.admin.profile.editGuruPegawai', $data);
    }

    public function updateProfileGuruPegawai(Request $request, ProfileGuruPegawai $profileGuruPegawai)
    {
        if ($profileGuruPegawai->jenis_asn == 'Guru') {
            $jenis_guru_req = ['required'];
            $nuptk_req = ['required'];
        } else {
            $jenis_guru_req = '';
            $nuptk_req = '';
        }

        if ($request->file('foto') != null) {
            $foto_req = ['required', 'image', 'file', 'max:1024'];
        } else {
            $foto_req = '';
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
                'pendidikan_terakhir' => 'required',
                'jenis_asn' => 'required',
                'jenis_guru' => $jenis_guru_req,
                // 'nip' => 'required',
                'nuptk' => $nuptk_req,
                'unit_kerja' => 'required',
                'status' => 'required',
                'jabatan_pangkat_golongan' => 'required',
                'tanggal_kerja' => 'required',
                'nilai_gaji' => 'required',
                'tmt_gaji' => 'required',
                'tmt_pangkat' => 'required',
                'foto' => $foto_req,
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
                'pendidikan_terakhir.required' => 'Pendidikan Terakhir Tidak Boleh Kosong',
                'jenis_asn.required' => 'Jenis Asn Tidak Boleh Kosong',
                'jenis_guru.required' => 'Jenis Guru Tidak Boleh Kosong',
                // 'nip.required' => 'Kategori Tidak Boleh Kosong',
                'nuptk.required' => 'NUPTK Tidak Boleh Kosong',
                'unit_kerja.required' => 'Unit Kerja Tidak Boleh Kosong',
                'status.required' => 'Status Tidak Boleh Kosong',
                'jabatan_pangkat_golongan.required' => 'Jabatan - Pangkat - Golongan Tidak Boleh Kosong',
                'tanggal_kerja.required' => 'Tanggal Awal Kerja Tidak Boleh Kosong',
                'nilai_gaji.required' => 'Nilai Gaji Tidak Boleh Kosong',
                'tmt_gaji.required' => 'TMT Gaji Tidak Boleh Kosong',
                'tmt_pangkat.required' => 'TMT Pangkat Tidak Boleh Kosong',
                'foto.required' => 'Foto Profil Tidak Boleh Kosong',
                'foto.max' => 'Foto Profil Tidak Boleh Melebihi 1MB',

            ]
        );

        $data['id_user'] = $profileGuruPegawai->id_user;
        if ($profileGuruPegawai->jenis_asn == 'Guru') {
            $data['jenis_jabatan'] = 'Fungsional';
        } else {
            $data['jenis_jabatan'] = 'Struktural';
            $data['jenis_guru'] = '-';
        }

        if ($request->file('foto')) {
            if (Storage::exists('upload/foto-profil/' . $profileGuruPegawai->foto)) {
                Storage::delete('upload/foto-profil/' . $profileGuruPegawai->foto);
            }
            $request->file('foto')->storeAs(
                'upload/foto-profil',
                $profileGuruPegawai->id_user .
                    '.' . $request->file('foto')->extension()
            );
            $data['foto'] = $profileGuruPegawai->id_user . '.' . $request->file('foto')->extension();
        } else {
            $data['foto'] = $profileGuruPegawai->foto;
        }


        $data['nip'] = $request->nip;
        $data['tanggal_lahir'] = date("Y-m-d", strtotime($request->tanggal_lahir));
        $data['tanggal_kerja'] = date("Y-m-d", strtotime($request->tanggal_kerja));
        $data['tmt_gaji'] = date("Y-m-d", strtotime($request->tmt_gaji));
        $data['tmt_pangkat'] = date("Y-m-d", strtotime($request->tmt_pangkat));
        $data['status_profile'] = "1";
        $data['konfirmasi_profile'] = Carbon::now();

        ProfileGuruPegawai::where('id', $profileGuruPegawai->id)
            ->update($data);

        User::where('id', $profileGuruPegawai->id_user)
            ->update(['nip' => $request->nip, 'nama' => $request->nama]);

        Toastr::success('Berhasil Mengubah Profil', 'Success');
        return redirect('/profile-guru-pegawai-');
    }

    public function prosesProfileGuruPegawai(ProfileGuruPegawai $profileGuruPegawai)
    {
        if ($profileGuruPegawai->jenis_asn == 'Guru') {
            $jabatan = JabatanFungsional::find($profileGuruPegawai->jabatan_pangkat_golongan);
        } else if ($profileGuruPegawai->jenis_asn == 'Pegawai') {
            $jabatan = JabatanStruktural::find($profileGuruPegawai->jabatan_pangkat_golongan);
        }
        $data = [
            'jabatan' => $jabatan,
            'profile' => $profileGuruPegawai,
        ];
        return view('pages.admin.profile.prosesGuruPegawai', $data);
    }

    public function konfirmasiProfileGuruPegawai(Request $request, ProfileGuruPegawai $profileGuruPegawai)
    {
        if ($request->status_profile == 2) {
            $alasan = ['required'];
        } else {
            $alasan = '';
        }
        $data = $request->validate(
            [
                'status_profile' => 'required',
                'alasan_profile' => $alasan,
            ],
            [
                'status_profile.required' => 'Status Konfirmasi Profil Harus Dipilih',
                'alasan_profile.required' => 'Alasan Ditolak Tidak Boleh Kosong',
            ]
        );

        $data['konfirmasi_profile'] = now();

        ProfileGuruPegawai::where('id', $profileGuruPegawai->id)
            ->update($data);

        Toastr::success('Berhasil Mengonfirmasi Profil', 'Success');
        return redirect('/profile-guru-pegawai-');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProfileGuruPegawai  $profileGuruPegawai
     * @return \Illuminate\Http\Response
     */
    public function show(ProfileGuruPegawai $profileGuruPegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProfileGuruPegawai  $profileGuruPegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfileGuruPegawai $profileGuruPegawai)
    {
        if ($profileGuruPegawai->id_user == Auth::user()->id) {
            if ($profileGuruPegawai->jenis_asn == 'Guru') {
                $jabatanGolonganPangkat = JabatanFungsional::all();
            } else if ($profileGuruPegawai->jenis_asn == 'Pegawai') {
                $jabatanGolonganPangkat = JabatanStruktural::all();
            }
            $data = [
                'profile' => $profileGuruPegawai,
                'unit_kerja' => UnitKerja::all(),
                'jabatanGolonganPangkat' => $jabatanGolonganPangkat,
            ];
            return view('pages.guru_pegawai.lengkapiData.profileEdit', $data);
            // dd($profileGuruPegawai);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProfileGuruPegawai  $profileGuruPegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfileGuruPegawai $profileGuruPegawai)
    {


        if ($profileGuruPegawai->jenis_asn == 'Guru') {
            $jenis_guru_req = ['required'];
            $nuptk_req = ['required'];
        } else {
            $jenis_guru_req = '';
            $nuptk_req = '';
        }

        if ($request->file('foto') != null) {
            $foto_req = ['required', 'image', 'file', 'max:1024'];
        } else {
            $foto_req = '';
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
                'pendidikan_terakhir' => 'required',
                'jenis_asn' => 'required',
                'jenis_guru' => $jenis_guru_req,
                // 'nip' => 'required',
                'nuptk' => $nuptk_req,
                'unit_kerja' => 'required',
                'status' => 'required',
                'jabatan_pangkat_golongan' => 'required',
                'tanggal_kerja' => 'required',
                'nilai_gaji' => 'required',
                'tmt_gaji' => 'required',
                'tmt_pangkat' => 'required',
                'foto' => $foto_req,
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
                'pendidikan_terakhir.required' => 'Pendidikan Terakhir Tidak Boleh Kosong',
                'jenis_asn.required' => 'Jenis Asn Tidak Boleh Kosong',
                'jenis_guru.required' => 'Jenis Guru Tidak Boleh Kosong',
                // 'nip.required' => 'Kategori Tidak Boleh Kosong',
                'nuptk.required' => 'NUPTK Tidak Boleh Kosong',
                'unit_kerja.required' => 'Unit Kerja Tidak Boleh Kosong',
                'status.required' => 'Status Tidak Boleh Kosong',
                'jabatan_pangkat_golongan.required' => 'Jabatan - Pangkat - Golongan Tidak Boleh Kosong',
                'tanggal_kerja.required' => 'Tanggal Awal Kerja Tidak Boleh Kosong',
                'nilai_gaji.required' => 'Nilai Gaji Tidak Boleh Kosong',
                'tmt_gaji.required' => 'TMT Gaji Tidak Boleh Kosong',
                'tmt_pangkat.required' => 'TMT Pangkat Tidak Boleh Kosong',
                'foto.required' => 'Foto Profil Tidak Boleh Kosong',
                'foto.max' => 'Foto Profil Tidak Boleh Melebihi 1MB',

            ]
        );

        $data['id_user'] = $profileGuruPegawai->id_user;
        if ($profileGuruPegawai->jenis_asn == 'Guru') {
            $data['jenis_jabatan'] = 'Fungsional';
        } else {
            $data['jenis_jabatan'] = 'Struktural';
            $data['jenis_guru'] = '-';
        }

        if ($request->file('foto')) {
            if (Storage::exists('upload/foto-profil/' . $profileGuruPegawai->foto)) {
                Storage::delete('upload/foto-profil/' . $profileGuruPegawai->foto);
            }
            $request->file('foto')->storeAs(
                'upload/foto-profil',
                $profileGuruPegawai->id_user .
                    '.' . $request->file('foto')->extension()
            );
            $data['foto'] = $profileGuruPegawai->id_user . '.' . $request->file('foto')->extension();
        } else {
            $data['foto'] = $profileGuruPegawai->foto;
        }


        $data['nip'] = $request->nip;
        $data['tanggal_lahir'] = date("Y-m-d", strtotime($request->tanggal_lahir));
        $data['tanggal_kerja'] = date("Y-m-d", strtotime($request->tanggal_kerja));
        $data['tmt_gaji'] = date("Y-m-d", strtotime($request->tmt_gaji));
        $data['tmt_pangkat'] = date("Y-m-d", strtotime($request->tmt_pangkat));
        $data['status_profile'] = "0";
        $data['konfirmasi_profile'] = Carbon::now();

        ProfileGuruPegawai::where('id', $profileGuruPegawai->id)
            ->update($data);

        User::where('id', $profileGuruPegawai->id_user)
            ->update(['nip' => $request->nip, 'nama' => $request->nama]);

        Toastr::success('Berhasil Melengkapi Profil, Data Anda Akan di Cek Terlebih Dahulu Oleh Admin', 'Success');
        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProfileGuruPegawai  $profileGuruPegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfileGuruPegawai $profileGuruPegawai)
    {
        //
    }
}
