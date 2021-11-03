<?php

namespace App\Http\Controllers\admin;

use App\Models\Persyaratan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\JabatanFungsional;
use App\Models\JabatanStruktural;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DeskripsiPersyaratan;
use Brian2694\Toastr\Facades\Toastr;
use Yajra\DataTables\Facades\DataTables;


class MasterPersyaratanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Persyaratan::with(['jabatanFungsional', 'deskripsiPersyaratan']);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('golongan', function (Persyaratan $persyaratan) {
                    if ($persyaratan->jabatanFungsional) {
                        $golongan =  $persyaratan->jabatanFungsional->golongan;
                    } else {
                        $golongan = '-';
                    }
                    return $golongan;
                })
                ->addColumn('syarat', function (Persyaratan $persyaratan) {
                    $deskripsiPersyaratan = '';
                    $deskripsiPersyaratan .= '<ol style="margin-top: 15px">';
                    foreach ($persyaratan->deskripsiPersyaratan as $deskripsi) {
                        $deskripsiPersyaratan .= '<li>'
                            . $deskripsi->deskripsi .
                            '</li>';
                    }
                    $deskripsiPersyaratan .= '</ol>';
                    return $deskripsiPersyaratan;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('master-persyaratan.edit', $row->id) . '" class="edit btn btn-success btn-sm my-2">Edit</a>';

                    $actionBtn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm hapusData">Hapus</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'golongan', 'syarat'])
                ->make(true);
        }
        return view('pages.admin.masterPersyaratan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'golongan' => JabatanFungsional::all()
        ];
        return view('pages.admin.masterPersyaratan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $jenis_asn = 'Guru';
        if (($request->kategori == '')) {
            $ke_golongan = '';
            $kategori = ['required'];
        } else if (($request->kategori == 'Usulan Kenaikan Gaji Berkala') || ($request->kategori == 'Berkas Dasar') || ($request->kategori == '')) {
            $ke_golongan = '';
            $kategori = [Rule::unique('persyaratan')->where(function ($query) use ($request) {
                return $query->where('jenis_asn', '=', $request->jenis_asn)->where('kategori', '=', $request->kategori);
            })->withoutTrashed()];
        } else if (($request->kategori == 'Usulan Kenaikan Pangkat')) { // Usulan Kenaikan Pangkat
            $kategori = ['required'];
            $ke_golongan = ['required', Rule::unique('persyaratan')->where(function ($query) use ($request) {
                return $query->where('jenis_asn', '=', $request->jenis_asn)->where('kategori', '=', $request->kategori)->where('ke_golongan', '=', $request->ke_golongan);
            })->withoutTrashed()];
        }

        $request->validate(
            [
                'jenis_asn' => 'required',
                'kategori' => $kategori,
                'syarat' => 'required',
                'ke_golongan' => $ke_golongan,
            ],
            [
                'jenis_asn.required' => 'Jenis Asn Tidak Boleh Kosong',
                'kategori.required' => 'Kategori Tidak Boleh Kosong',
                'kategori.unique' => 'Jenis ASN ' . $request->jenis_asn . ' pada kategori ' . $request->kategori . ' sudah ada. Silakan di ubah pada tabel persyaratan apabila ingin menambahkan syarat baru.',
                'syarat.required' => 'Persyaratan Tidak Boleh Kosong',
                'ke_golongan.required' => 'Golongan Tidak Boleh Kosong',
                'ke_golongan.unique' => 'Jenis ASN ' . $request->jenis_asn . ' pada kategori ' . $request->kategori . ' , dan Golongan yang dipilih sudah ada. Silakan di ubah pada tabel persyaratan apabila ingin menambahkan syarat baru.'
            ]
        );

        $persyaratan = [
            'jenis_asn' => $request->jenis_asn,
            'kategori' => $request->kategori,
            'ke_golongan' => $request->ke_golongan,
        ];
        Persyaratan::create($persyaratan);



        foreach ($request->syarat as $syarat) {
            $deksripsiSyarat[] = [
                'id_persyaratan' => Persyaratan::max('id'),
                'deskripsi' => $syarat,
            ];
        }
        DB::table('deskripsi_persyaratan')->insert($deksripsiSyarat);

        Toastr::success('Berhasil Menambahkan Persyaratan', 'Success');
        return redirect()->route('master-persyaratan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persyaratan  $persyaratan
     * @return \Illuminate\Http\Response
     */
    public function show(Persyaratan $persyaratan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Persyaratan  $persyaratan
     * @return \Illuminate\Http\Response
     */
    public function edit(Persyaratan $persyaratan)
    {
        Persyaratan::with(['deskripsiPersyaratan']);
        $data = [
            'countDeskripsi' => $persyaratan->deskripsiPersyaratan->count(),
            'persyaratan' => $persyaratan,
            'golongan' => JabatanFungsional::all()
        ];
        return view('pages.admin.masterPersyaratan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Persyaratan  $persyaratan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persyaratan $persyaratan)
    {
        // $jenis_asn = 'Guru';
        if (($request->kategori == '')) {
            $ke_golongan = '';
            $kategori = ['required'];
        } else if (($request->kategori == 'Usulan Kenaikan Gaji Berkala') || ($request->kategori == 'Berkas Dasar') || ($request->kategori == '')) {
            $ke_golongan = '';
            $kategori = [Rule::unique('persyaratan')->where(function ($query) use ($request) {
                return $query->where('jenis_asn', '=', $request->jenis_asn)->where('kategori', '=', $request->kategori);
            })->ignore($persyaratan->id)->withoutTrashed()];
        } else if (($request->kategori == 'Usulan Kenaikan Pangkat')) { // Usulan Kenaikan Pangkat
            $kategori = ['required'];
            $ke_golongan = ['required', Rule::unique('persyaratan')->where(function ($query) use ($request) {
                return $query->where('jenis_asn', '=', $request->jenis_asn)->where('kategori', '=', $request->kategori)->where('ke_golongan', '=', $request->ke_golongan);
            })->ignore($persyaratan->id)->withoutTrashed()];
        }

        $request->validate(
            [
                'jenis_asn' => 'required',
                'kategori' => $kategori,
                'syarat' => 'required',
                'ke_golongan' => $ke_golongan,
            ],
            [
                'jenis_asn.required' => 'Jenis Asn Tidak Boleh Kosong',
                'kategori.required' => 'Kategori Tidak Boleh Kosong',
                'kategori.unique' => 'Jenis ASN ' . $request->jenis_asn . ' pada kategori ' . $request->kategori . ' sudah ada/digunakan.',
                'syarat.required' => 'Persyaratan Tidak Boleh Kosong',
                'ke_golongan.required' => 'Golongan Tidak Boleh Kosong',
                'ke_golongan.unique' => 'Jenis ASN ' . $request->jenis_asn . ' pada kategori ' . $request->kategori . ' , dan Golongan yang dipilih sudah ada/digunakan.'
            ]
        );

        $persyaratanInsert = [
            'jenis_asn' => $request->jenis_asn,
            'kategori' => $request->kategori,
            'ke_golongan' => $request->ke_golongan,
        ];


        Persyaratan::where('id', $persyaratan->id)
            ->update($persyaratanInsert);

        foreach ($request->syarat as $syarat) {
            $deksripsiSyarat[] = [
                'id_persyaratan' => $persyaratan->id,
                'deskripsi' => $syarat,
            ];
        }

        // DeskripsiPersyaratan::find($persyaratan->id)->delete();
        DB::table('deskripsi_persyaratan')->where('id_persyaratan', $persyaratan->id)->delete();

        DB::table('deskripsi_persyaratan')->insert($deksripsiSyarat);

        Toastr::success('Berhasil Mengubah Persyaratan', 'Success');
        return redirect()->route('master-persyaratan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persyaratan  $persyaratan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persyaratan $persyaratan)
    {
        $persyaratan->deskripsiPersyaratan()->delete();
        $persyaratan->delete();
        return response()->json([
            'res' => 'success',
            'message' => 'Syarat Berhasil Dihapus'
        ]);
    }
}
