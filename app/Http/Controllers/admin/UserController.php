<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Models\ProfilePejabat;
use App\Models\JabatanStruktural;
use App\Models\ProfileGuruPegawai;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with(['profile', 'profilePejabat'])->orderBy('updated_at', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (User $user) {
                    $actionBtn = '<a href="' . route('user.edit', $user->id) . '" class="edit btn btn-success btn-sm my-2">Edit</a>';
                    if ($user->role != 'Admin') {
                        $actionBtn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $user->id . '" data-original-title="Delete" class="btn btn-danger btn-sm hapusData">Hapus</a>';
                    }
                    return $actionBtn;
                })
                // ->addColumn('profile', function (User $user) {
                //     if ($user->profile) {
                //         if (($user->role == 'Guru') || ($user->role == 'Pegawai')) {
                //             if ($user->profile->status_profile == 0) {
                //                 $actionBtn = '<span class="badge badge-warning p-2">Menunggu Konfirmasi</span>';
                //                 return $actionBtn;
                //             } else if ($user->profile->status_profile == 1) {
                //                 $actionBtn = '<span class="badge badge-success p-2">Sudah Lengkap dan Disetujui</span>';
                //                 return $actionBtn;
                //             } else if ($user->profile->status_profile == 2) {
                //                 $actionBtn = '<span class="badge badge-danger p-2 mr-2">Ditolak</span>';
                //                 return $actionBtn;
                //             }
                //         } else {
                //             $actionBtn = '<span class="badge badge-success p-2">Sudah Lengkap dan Disetujui</span>';
                //             return $actionBtn;
                //         }
                //     } //
                //     else {
                //         $actionBtn = '<span class="badge badge-secondary p-2">Belum Lengkap</span>';
                //         return $actionBtn;
                //     }
                // })
                ->addColumn('status_akun', function (User $user) {
                    if ($user->status == 1) {
                        $actionBtn = '<span class="badge badge-success p-2">Aktif</span>';
                        return $actionBtn;
                    } else {
                        $actionBtn = '<span class="badge badge-danger p-2">Tidak Aktif</span>';
                        return $actionBtn;
                    }
                })
                ->filter(function ($query) use ($request) {
                    if ($request->search != '') {
                        $query->where('nama', "LIKE", "%$request->search%")->orWhere('nip', "LIKE", "%$request->search%");
                    }

                    if (!empty($request->role)) {
                        $query->where('role', $request->role);
                    }

                    if (!empty($request->statusAkun)) {
                        $query->where('status', $request->statusAkun);
                    }

                    // if (!empty($request->statusProfil)) {
                    //     $query->whereHas('profile', function ($query) use ($request) {
                    //         if ($request->statusBerkas == 3) {
                    //             $query->where("profile_guru_pegawai.status_berkas_dasar", "0");
                    //         } else {
                    //             $query->where('profile_guru_pegawai.status_berkas_dasar', $request->statusBerkas);
                    //         }
                    //     });
                    // }
                })
                ->rawColumns(['action', 'profile', 'status_akun'])
                ->make(true);
        }
        return view('pages.admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createGuru()
    {
        return view('pages.admin.user.createGuruPegawai');
    }

    public function createNonGuru()
    {
        $data = [
            'jabatanGolonganPangkat' => JabatanStruktural::all(),

        ];
        return view('pages.admin.user.createNonGuru', $data);
        // $data = [
        //     'jabatanGolonganPangkat' => JabatanStruktural::all(),

        // ];
        // return view('pages.admin.user.create', $data);        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if (($request->role == 'Guru') || ($request->role == 'Pegawai')) {
        if (($request->createAkun == 1)) {
            $request->validate(
                [
                    'nama' => 'required',
                    'username' => 'required|min:6|unique:user',
                    'password_text' => 'required|min:6',
                    'status_kepegawaian' => 'required',
                    'jenis_guru' => 'required',
                    'role' => 'required',
                    'status' => 'required',
                ],
                [
                    'nama.required' => 'Nama Tidak Boleh Kosong',
                    'username.required' => 'Username Tidak Boleh Kosong',
                    'username.min' => 'Username Minimal 6 Karakter',
                    'username.unique' => 'Username Telah Digunakan',
                    'password_text.required' => 'Password Tidak Boleh Kosong',
                    'password_text.min' => 'Password Minimal 6 Karakter',
                    'status_kepegawaian.required' => 'Status Kepegawaian Tidak Boleh Kosong',
                    'jenis_guru.required' => 'Jenis Guru Tidak Boleh Kosong',
                    'role.required' => 'Role Tidak Boleh Kosong',
                    'status.required' => 'Status Tidak Boleh Kosong',
                ]
            );

            $user = [
                'nama' => $request->nama,
                'username' => $request->username,
                'password' =>  Hash::make($request->password_text),
                'status_kepegawaian' => $request->status_kepegawaian,
                'jenis_guru' => $request->jenis_guru,
                'role' => $request->role,
                'status' => $request->status,
            ];

            // dd($user);

            User::create($user);
            Toastr::success('Berhasil Menambahkan Akun', 'Success');
            return redirect('/user');
        }  ////
        else {
            $request->validate(
                [
                    'nama' => 'required',
                    'jenis_kelamin' => 'required',
                    'tempat_lahir' => 'required',
                    'tanggal_lahir' => 'required',
                    'no_hp' => 'required',
                    'email' => 'required|email',
                    'alamat' => 'required',
                    'nip' => 'required|unique:user|size:18',
                    'jabatan_pangkat_golongan' => 'required',
                    'role' => 'required',
                    'username' => 'required|min:6|unique:user',
                    'password_text' => 'required|min:6',
                    'status' => 'required',
                    'foto' => 'required|image|file|max:1024',
                    'foto_ttd' => 'required|mimes:png|file|max:1024'
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
                    'nip.size' => 'NIP harus 18 karakter',
                    'nip.unique' => 'NIP Telah Digunakan',
                    'jabatan_pangkat_golongan.required' => 'Jabatan - Pangkat - Golongan Tidak Boleh Kosong',
                    'role.required' => 'Role Tidak Boleh Kosong',
                    'username.required' => 'Username Tidak Boleh Kosong',
                    'username.min' => 'Username Minimal 6 Karakter',
                    'username.unique' => 'Username Telah Digunakan',
                    'password_text.required' => 'Password Tidak Boleh Kosong',
                    'password_text.min' => 'Password Minimal 6 Karakter',
                    'status.required' => 'Status Tidak Boleh Kosong',
                    'foto.required' => 'Foto Profil Tidak Boleh Kosong',
                    'foto.max' => 'Foto Profil Tidak Boleh Melebihi 1MB',
                    'foto_ttd.required' => 'Foto TTD Tidak Boleh Kosong',
                    'foto_ttd.max' => 'Foto TTD Tidak Boleh Melebihi 1MB',
                    'foto_ttd.mimes' => 'Foto TTD Harus Format PNG (Background Transparan)',

                ]
            );

            $user = [
                'nama' => $request->nama,
                'nip' => $request->nip,
                'username' => $request->username,
                'password' =>  Hash::make($request->password_text),
                'status_kepegawaian' => '-',
                'jenis_guru' => '-',
                'role' => $request->role,
                'status' => $request->status,
            ];

            User::create($user);
            $id_user = User::all()->max('id');

            $request->file('foto')->storeAs(
                'upload/foto-profil',
                $id_user .
                    '.' . $request->file('foto')->extension()
            );

            $request->file('foto_ttd')->storeAs(
                'upload/foto-ttd',
                $id_user .
                    '.' . $request->file('foto_ttd')->extension()
            );

            $profile_pejabat = [
                'id_user' => $id_user,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => date("Y-m-d", strtotime($request->tanggal_lahir)),
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'nip' => $request->nip,
                'jabatan_pangkat_golongan' => $request->jabatan_pangkat_golongan,
                'foto' => $id_user . '.' . $request->file('foto')->extension(),
                'foto_ttd' => $id_user . '.' . $request->file('foto_ttd')->extension(),

            ];

            ProfilePejabat::create($profile_pejabat);

            Toastr::success('Berhasil Menambahkan Akun', 'Success');
            return redirect('/user');
        }
    }

    public function importExcel(Request $request)
    {
        Excel::import(new UsersImport, $request->file('file'));

        //     $this->validate($request, [
        //         'file' => 'required|mimes:csv,xls,xlsx'
        //     ]);

        //     // membuat nama file unik
        //     $nama_file = rand() . $request->file->getClientOriginalName();

        //     // upload ke folder file_siswa di dalam folder public
        //     $request->file->move('file-excel', $nama_file);

        //     // import data
        //     Excel::import(new User, public_path('/file_siswa/' . $nama_file));

        //     // notifikasi dengan session
        Toastr::success('Berhasil Menambahkan Akun Dengan Proses Impor File Excel', 'Success');
        return redirect('/user');
        //     ddd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data = [
            'user' => User::find($user->id),
        ];
        return view('pages.admin.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // dd($request->old_status_kepegawaian);
        if ($request->username != $user->username) {
            $username_req = ['required', 'min:6', 'unique:user'];
        } else {
            $username_req = '';
        }

        if ($user->role != 'Admin') {
            $role_req = ['required'];
            $status_req = ['required'];
            if (($user->role == 'Guru') || ($user->role == 'Pegawai')) {
                $jenis_guru_req = ['required'];
                $status_kepegawaian_req = ['required'];
            } else {
                $jenis_guru_req = '';
                $status_kepegawaian_req = '';
            }
        } else {
            $role_req = '';
            $status_req = '';
            $jenis_guru_req = '';
            $status_kepegawaian_req = '';
        }

        $request->validate(
            [
                'nama' => 'required',
                'username' => $username_req,
                'password_text' => 'required|min:6',
                'jenis_guru' => $jenis_guru_req,
                'status_kepegawaian' => $status_kepegawaian_req,
                'role' => $role_req,
                'status' => $status_req,
            ],
            [
                'nama.required' => 'Nama Tidak Boleh Kosong',
                'username.required' => 'Username Tidak Boleh Kosong',
                'username.min' => 'Username Minimal 6 Karakter',
                'username.unique' => 'Username Telah Digunakan',
                'password_text.required' => 'Password Tidak Boleh Kosong',
                'password_text.min' => 'Password Minimal 6 Karakter',
                'jenis_guru.required' => 'Jenis Guru Tidak Boleh Kosong',
                'status_kepegawaian.required' => 'Status Kepegawaian Tidak Boleh Kosong',
                'role.required' => 'Role Tidak Boleh Kosong',
                'status.required' => 'Status Tidak Boleh Kosong',
            ]
        );

        if ($request->password_text != $user->password) {
            $password = Hash::make($request->password_text);
        } else {
            $password = $user->password;
        }

        if ($user->role == 'Admin') {
            $data = [
                'nama' => $request->nama,
                'username' => $request->username,
                'password' => $password,
            ];
        } else if (($user->role == 'Guru') || ($user->role == 'Pegawai')) {
            $data = [
                'nama' => $request->nama,
                'username' => $request->username,
                'password' => $password,
                'jenis_guru' => $request->jenis_guru,
                'status_kepegawaian' => $request->status_kepegawaian,
                'password' => $password,
                'role' => $request->role,
                'status' => $request->status,
            ];
        } else {
            $data = [
                'nama' => $request->nama,
                'username' => $request->username,
                'password' => $password,
                'role' => $request->role,
                'status' => $request->status,
            ];
        }


        User::where('id', $user->id)
            ->update($data);

        if ($user->role == 'Admin') {
            Toastr::success('Berhasil Memperbarui User', 'Success');
            return redirect('/user');
        } //

        if (($request->role == 'Guru') || ($request->role == 'Pegawai')) {
            if (($request->old_status_kepegawaian == 'PNS') || ($request->old_status_kepegawaian == 'PNS Depag') || ($request->old_status_kepegawaian == 'PNS Diperbantukan')) {
                if (!in_array($request->status_kepegawaian, array('PNS', 'PNS Depag', 'PNS Diperbantukan'))) { //ke non pns
                    if ($request->role != $user->role) {
                        $user->berkasDasar()->delete();
                        ProfileGuruPegawai::where('id_user', $user->id)
                            ->update(['nama' => $request->nama, 'jenis_asn' => $request->role, 'jabatan_pangkat_golongan' => 0, 'jenis_guru' => $request->jenis_guru, 'status' => $request->status_kepegawaian, 'status_berkas_dasar' => -1]);
                    } else {
                        $user->berkasDasar()->delete();
                        ProfileGuruPegawai::where('id_user', $user->id)
                            ->update(['nama' => $request->nama, 'jenis_asn' => $request->role, 'jenis_guru' => $request->jenis_guru, 'status' => $request->status_kepegawaian, 'status_berkas_dasar' => -1]);
                    }
                } else {
                    if ($request->role != $user->role) {
                        ProfileGuruPegawai::where('id_user', $user->id)
                            ->update(['nama' => $request->nama, 'jenis_asn' => $request->role, 'jabatan_pangkat_golongan' => 0, 'jenis_guru' => $request->jenis_guru, 'status' => $request->status_kepegawaian]);
                    } else {
                        ProfileGuruPegawai::where('id_user', $user->id)
                            ->update(['nama' => $request->nama, 'jenis_asn' => $request->role, 'jenis_guru' => $request->jenis_guru, 'status' => $request->status_kepegawaian]);
                    }
                }
            } else {
                if (in_array($request->status_kepegawaian, array('PNS', 'PNS Depag', 'PNS Diperbantukan'))) { //ke pns
                    if ($request->role != $user->role) {
                        $user->berkasDasar()->delete();
                        ProfileGuruPegawai::where('id_user', $user->id)
                            ->update(['nama' => $request->nama, 'jenis_asn' => $request->role, 'jabatan_pangkat_golongan' => 0, 'jenis_guru' => $request->jenis_guru, 'status' => $request->status_kepegawaian, 'status_profile' => 2, 'alasan_profile' => 'Lengkapi Kembali Profile', 'status_berkas_dasar' => -1]);
                    } else {
                        ProfileGuruPegawai::where('id_user', $user->id)
                            ->update(['nama' => $request->nama, 'jenis_asn' => $request->role, 'jenis_guru' => $request->jenis_guru, 'status' => $request->status_kepegawaian, 'status_profile' => 2, 'alasan_profile' => 'Lengkapi Kembali Profile', 'status_berkas_dasar' => -1]);
                    }
                } else {
                    if ($request->role != $user->role) {
                        ProfileGuruPegawai::where('id_user', $user->id)
                            ->update(['nama' => $request->nama, 'jenis_asn' => $request->role, 'jabatan_pangkat_golongan' => 0, 'jenis_guru' => $request->jenis_guru, 'status' => $request->status_kepegawaian]);
                    } else {
                        ProfileGuruPegawai::where('id_user', $user->id)
                            ->update(['nama' => $request->nama, 'jenis_asn' => $request->role, 'jenis_guru' => $request->jenis_guru, 'status' => $request->status_kepegawaian]);
                    }
                }
            }
        } //

        else {
            ProfilePejabat::where('id_user', $user->id)
                ->update(['nama' => $request->nama]);
        }



        Toastr::success('Berhasil Memperbarui Akun', 'Success');
        return redirect('/user');
    }

    public function editAkun(User $user)
    {
        if (Auth::user()->id == $user->id) {
            $data = [
                'user' => User::find($user->id),
            ];
            return view('pages.guru_pegawai.editAkun', $data);
        } else {
            abort(404);
        }
    }

    public function editAkunPejabat(User $user)
    {
        if (Auth::user()->id == $user->id) {
            $data = [
                'user' => User::find($user->id),
                'jabatanGolonganPangkat' => JabatanStruktural::all()
            ];
            return view('pages.editAkunPejabat', $data);
        } else {
            abort(404);
        }
    }

    public function updateAkun(Request $request, User $user)
    {
        if ($request->username != $user->username) {
            $username_req = ['required', 'min:6', 'unique:user'];
        } else {
            $username_req = '';
        }


        $request->validate(
            [
                'nama' => 'required',
                'username' => $username_req,
                'password_text' => 'required|min:6'
            ],
            [
                'nama.required' => 'Nama Tidak Boleh Kosong',
                'username.required' => 'Username Tidak Boleh Kosong',
                'username.min' => 'Username Minimal 6 Karakter',
                'username.unique' => 'Username Telah Digunakan',
                'password_text.required' => 'Password Tidak Boleh Kosong',
                'password_text.min' => 'Password Minimal 6 Karakter',
            ]
        );

        if ($request->password_text != $user->password) {
            $password = Hash::make($request->password_text);
        } else {
            $password = $user->password;
        }

        $data = [
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $password,
        ];

        User::where('id', $user->id)
            ->update($data);


        ProfileGuruPegawai::where('id_user', $user->id)
            ->update(['nama' => $request->nama]);

        Toastr::success('Berhasil Memperbarui Akun', 'Success');
        return redirect('/dashboard');
    }

    public function updateAkunPejabat(Request $request, User $user)
    {
        if ($request->username != $user->username) {
            $username_req = ['required', 'min:6', 'unique:user'];
        } else {
            $username_req = '';
        }

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

        $request->validate(
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
                'foto_ttd' => $foto_ttd_req,

                'username' => $username_req,
                'password_text' => 'required|min:6'
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

                'username.required' => 'Username Tidak Boleh Kosong',
                'username.min' => 'Username Minimal 6 Karakter',
                'username.unique' => 'Username Telah Digunakan',
                'password_text.required' => 'Password Tidak Boleh Kosong',
                'password_text.min' => 'Password Minimal 6 Karakter',
            ]
        );

        if ($request->password_text != $user->password) {
            $password = Hash::make($request->password_text);
        } else {
            $password = $user->password;
        }

        $data = [
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $password,
        ];

        if ($request->file('foto')) {
            if (Storage::exists('upload/foto-profil/' . $user->profilePejabat->foto)) {
                Storage::delete('upload/foto-profil/' . $user->profilePejabat->foto);
            }
            $request->file('foto')->storeAs(
                'upload/foto-profil',
                $user->id .
                    '.' . $request->file('foto')->extension()
            );
            $profile['foto'] = $user->id . '.' . $request->file('foto')->extension();
        } else {
            $profile['foto'] = $user->profilePejabat->foto;
        }

        if ($request->file('foto_ttd')) {
            if (Storage::exists('upload/foto-ttd/' . $user->profilePejabat->foto_ttd)) {
                Storage::delete('upload/foto-ttd/' . $user->profilePejabat->foto_ttd);
            }
            $request->file('foto_ttd')->storeAs(
                'upload/foto-ttd',
                $user->id .
                    '.' . $request->file('foto_ttd')->extension()
            );
            $profile['foto_ttd'] = $user->id . '.' . $request->file('foto_ttd')->extension();
        } else {
            $profile['foto_ttd'] = $user->profilePejabat->foto_ttd;
        }

        $profile = [
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'nip' => $request->nip,
            'jabatan_pangkat_golongan' => $request->jabatan_pangkat_golongan,
        ];
        $profile['tanggal_lahir'] = date("Y-m-d", strtotime($request->tanggal_lahir));



        // dump($data);
        // dd($profile);


        User::where('id', $user->id)
            ->update($data);

        ProfilePejabat::where('id_user', $user->id)
            ->update($profile);

        Toastr::success('Berhasil Memperbarui Akun', 'Success');
        return redirect('/dashboard');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (($user->role == 'Guru') || ($user->role == 'Pegawai')) {
            $user->profile()->delete();
            $user->berkasDasar()->delete();
        } else {
            $user->profilePejabat()->delete();
        }
        $user->delete();
        return response()->json([
            'res' => 'success',
            'message' => 'Akun Berhasil Dihapus'
        ]);
    }
}
