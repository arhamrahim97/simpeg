<?php

namespace App\Http\Controllers\admin;

use App\Models\UnitKerja;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Imports\UnitKerjaImport;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class MasterUnitKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = UnitKerja::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('master-unit-kerja.edit', $row->id) . '" class="edit btn btn-success btn-sm my-2">Edit</a>';

                    $actionBtn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm hapusData">Hapus</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.masterUnitKerja.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.masterUnitKerja.create');
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
                'nama' => [
                    'required',
                    Rule::unique('unit_kerja')->withoutTrashed()
                ],
                'kategori' => 'required'
            ],
            [
                'nama.required' => 'Nama Tidak Boleh Kosong',
                'kategori.required' => 'Kategori Tidak Boleh Kosong',
                'nama.unique' => 'Nama Tidak Boleh Sama',
            ]
        );

        $unitKerja = new UnitKerja();
        $unitKerja->nama = $request->nama;
        $unitKerja->kategori = $request->kategori;
        $unitKerja->save();

        Toastr::success('Berhasil Menambahkan Unit Kerja', 'Success');
        return redirect()->route('master-unit-kerja.index');
    }

    public function importExcel(Request $request)
    {
        Excel::import(new UnitKerjaImport, $request->file('file'));
        Toastr::success('Berhasil Menambahkan Unit Kerja Dengan Proses Impor File Excel', 'Success');
        return redirect('/master-unit-kerja');
        //     ddd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnitKerja  $unitKerja
     * @return \Illuminate\Http\Response
     */
    public function show(UnitKerja $unitKerja)
    {
        dd($unitKerja);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnitKerja  $unitKerja
     * @return \Illuminate\Http\Response
     */
    public function edit(UnitKerja $unitKerja)
    {
        return view('pages.admin.masterUnitKerja.edit', compact('unitKerja'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnitKerja  $unitKerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnitKerja $unitKerja)
    {
        $validated = $request->validate(
            [
                'nama' => [
                    'required',
                    Rule::unique('jabatan')->ignore($unitKerja->id)->withoutTrashed()
                ],
                'kategori' => 'required'
            ],
            [
                'nama.required' => 'Nama Tidak Boleh Kosong',
                'kategori.required' => 'Kategori Tidak Boleh Kosong',
                'nama.unique' => 'Nama Tidak Boleh Sama',
            ]
        );

        $unitKerja->nama = $request->nama;
        $unitKerja->kategori = $request->kategori;
        $unitKerja->save();

        Toastr::success('Berhasil Mengubah Unit Kerja', 'Success');
        return redirect()->route('master-unit-kerja.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnitKerja  $unitKerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnitKerja $unitKerja)
    {
        $unitKerja->delete();
        return response()->json([
            'res' => 'success',
            'message' => 'Unit Kerja Berhasil Dihapus'
        ]);
    }
}
