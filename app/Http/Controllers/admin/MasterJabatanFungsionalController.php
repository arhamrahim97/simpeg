<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JabatanFungsional;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Validation\Rule;

class MasterJabatanFungsionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = JabatanFungsional::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('master-jabatan-fungsional.edit', $row->id) . '" class="edit btn btn-success btn-sm my-2">Edit</a>';

                    $actionBtn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm hapusData">Hapus</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.masterJabatanFungsional.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.masterJabatanFungsional.create');
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
                    Rule::unique('jabatan_fungsional')->withoutTrashed()
                ],
                'jabatan' => 'required',
                'pangkat' => 'required',
                'no_urut' => [
                    'required',
                    Rule::unique('jabatan_fungsional')->withoutTrashed()
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

        $jabatanFungsional = new JabatanFungsional();
        $jabatanFungsional->golongan = $request->golongan;
        $jabatanFungsional->pangkat = $request->pangkat;
        $jabatanFungsional->jabatan = $request->jabatan;
        $jabatanFungsional->no_urut = $request->no_urut;
        $jabatanFungsional->save();

        Toastr::success('Berhasil Menambahkan Jabatan Fungsional', 'Success');
        return redirect()->route('master-jabatan-fungsional.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JabatanFungsional  $jabatanFungsional
     * @return \Illuminate\Http\Response
     */
    public function show(JabatanFungsional $jabatanFungsional)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JabatanFungsional  $jabatanFungsional
     * @return \Illuminate\Http\Response
     */
    public function edit(JabatanFungsional $jabatanFungsional)
    {
        return view('pages.admin.masterJabatanFungsional.edit', compact('jabatanFungsional'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JabatanFungsional  $jabatanFungsional
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JabatanFungsional $jabatanFungsional)
    {
        $validated = $request->validate(
            [
                'golongan' => [
                    'required',
                    Rule::unique('jabatan_fungsional')->ignore($jabatanFungsional->id)->withoutTrashed()
                ],
                'jabatan' => 'required',
                'pangkat' => 'required',
                'no_urut' => [
                    'required',
                    Rule::unique('jabatan_fungsional')->ignore($jabatanFungsional->id)->withoutTrashed()
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

        $jabatanFungsional->golongan = $request->golongan;
        $jabatanFungsional->pangkat = $request->pangkat;
        $jabatanFungsional->jabatan = $request->jabatan;
        $jabatanFungsional->no_urut = $request->no_urut;
        $jabatanFungsional->save();

        Toastr::success('Berhasil Mengubah Jabatan Fungsional', 'Success');
        return redirect()->route('master-jabatan-fungsional.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JabatanFungsional  $jabatanFungsional
     * @return \Illuminate\Http\Response
     */
    public function destroy(JabatanFungsional $jabatanFungsional)
    {
        $jabatanFungsional->delete();
        return response()->json([
            'res' => 'success',
            'message' => 'Jabatan Fungsional Berhasil Dihapus'
        ]);
    }
}
