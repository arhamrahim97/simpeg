<?php

namespace App\Http\Controllers\guru_pegawai;

use App\Models\UnitKerja;
use Illuminate\Http\Request;
use App\Models\JabatanFungsional;
use App\Models\JabatanStruktural;
use App\Models\ProfileGuruPegawai;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class ProfileGuruPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
                'alamat' => 'required',
                'pendidikan_terakhir' => 'required',
                'jenis_asn' => 'required',
                'jenis_guru' => $jenis_guru_req,
                // 'nip' => 'required',
                'nuptk' => $nuptk_req,
                'unit_kerja' => 'required',
                'status' => 'required',
                'jabatan_pangkat_golongan' => 'required',
                'jumlah_tahun_kerja' => 'required',
                'jumlah_bulan_kerja' => 'required',
                'nilai_gaji' => 'required',
                'tmt_gaji' => 'required',
                'tmt_pangkat' => 'required',
                'foto' => 'required|image|file|max:1024'
            ],
            [
                'nama.required' => 'Jenis Asn Tidak Boleh Kosong',
                'jenis_kelamin.required' => 'Jenis Kelamin Tidak Boleh Kosong',
                'tempat_lahir.required' => 'Tempat Lahir Tidak Boleh Kosong',
                'tanggal_lahir.required' => 'Tanggal Lahir Tidak Boleh Kosong',
                'no_hp.required' => 'Nomor HP Tidak Boleh Kosong',
                'alamat.required' => 'Alamat Tidak Boleh Kosong',
                'pendidikan_terakhir.required' => 'Pendidikan Terakhir Tidak Boleh Kosong',
                'jenis_asn.required' => 'Jenis Asn Tidak Boleh Kosong',
                'jenis_guru.required' => 'Jenis Guru Tidak Boleh Kosong',
                // 'nip.required' => 'Kategori Tidak Boleh Kosong',
                'nuptk.required' => 'NUPTK Tidak Boleh Kosong',
                'unit_kerja.required' => 'Unit Kerja Tidak Boleh Kosong',
                'status.required' => 'Status Tidak Boleh Kosong',
                'jabatan_pangkat_golongan.required' => 'Jabatan - Pangkat - Golongan Tidak Boleh Kosong',
                'jumlah_tahun_kerja.required' => 'Lama Masa Kerja (Tahun) Tidak Boleh Kosong',
                'jumlah_bulan_kerja.required' => 'Lama Masa Kerja (Bulan) Kategori Tidak Boleh Kosong',
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
        $data['tmt_gaji'] = date("Y-m-d", strtotime($request->tmt_gaji));
        $data['tmt_pangkat'] = date("Y-m-d", strtotime($request->tmt_pangkat));
        $data['foto'] = Auth::user()->nama . '.' . $request->file('foto')->extension();

        ProfileGuruPegawai::create($data);

        Toastr::success('Berhasil Melengkapi Profil', 'Success');
        return redirect('/dashboard');


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
        //
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
        //
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
