<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JabatanStruktural;
use Yajra\DataTables\Facades\DataTables;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class MasterJabatanStrukturalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = JabatanStruktural::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('master-jabatan-struktural.edit', $row->id) . '" class="edit btn btn-success btn-sm my-2">Edit</a>';

                    $actionBtn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm hapusData">Hapus</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.masterJabatanStruktural.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.masterJabatanStruktural.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'golongan' => [
                    'required',
                    Rule::unique('jabatan_struktural')->withoutTrashed()
                ],
                'jabatan' => 'required',
                'pangkat' => 'required',
                'no_urut' => [
                    'required',
                    Rule::unique('jabatan_struktural')->withoutTrashed()
                ]
            ],
            [
                'golongan.required' => 'Golongan Tidak Boleh Kosong',
                'golongan.unique' => 'Golongan Tidak Boleh Sama',
                'jabatan.required' => 'Jabatan Tidak Boleh Sama',
                'pangkat.required' => 'Pangkat Tidak Boleh Sama',
                'no_urut.required' => 'Nomor Urut Tidak Boleh Kosong',
                'no_urut.unique' => 'Nomor Urut Tidak Boleh Sama'
            ]
        );

        $jabatanStruktural = new JabatanStruktural();
        $jabatanStruktural->golongan = $request->golongan;
        $jabatanStruktural->pangkat = $request->pangkat;
        $jabatanStruktural->jabatan = $request->jabatan;
        $jabatanStruktural->no_urut = $request->no_urut;
        $jabatanStruktural->save();

        Toastr::success('Berhasil Menambahkan Jabatan Struktural', 'Success');
        return redirect()->route('master-jabatan-struktural.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(JabatanStruktural $jabatanStruktural)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(JabatanStruktural $jabatanStruktural)
    {
        return view('pages.admin.masterJabatanStruktural.edit', compact('jabatanStruktural'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JabatanStruktural $jabatanStruktural)
    {
        $validated = $request->validate(
            [
                'golongan' => [
                    'required',
                    Rule::unique('jabatan_struktural')->ignore($jabatanStruktural->id)->withoutTrashed()
                ],
                'jabatan' => 'required',
                'pangkat' => 'required',
                'no_urut' => [
                    'required',
                    Rule::unique('jabatan_struktural')->ignore($jabatanStruktural->id)->withoutTrashed()
                ]
            ],
            [
                'golongan.required' => 'Golongan Tidak Boleh Kosong',
                'golongan.unique' => 'Golongan Tidak Boleh Sama',
                'jabatan.required' => 'Jabatan Tidak Boleh Sama',
                'pangkat.required' => 'Pangkat Tidak Boleh Sama',
                'no_urut.required' => 'Nomor Urut Tidak Boleh Kosong',
                'no_urut.unique' => 'Nomor Urut Tidak Boleh Sama'
            ]
        );

        $jabatanStruktural->golongan = $request->golongan;
        $jabatanStruktural->pangkat = $request->pangkat;
        $jabatanStruktural->jabatan = $request->jabatan;
        $jabatanStruktural->no_urut = $request->no_urut;
        $jabatanStruktural->save();

        Toastr::success('Berhasil Mengubah Jabatan Struktural', 'Success');
        return redirect()->route('master-jabatan-struktural.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(JabatanStruktural $jabatanStruktural)
    {
        $jabatanStruktural->delete();
        return response()->json([
            'res' => 'success',
            'message' => 'Jabatan Struktural Berhasil Dihapus'
        ]);
    }
}
