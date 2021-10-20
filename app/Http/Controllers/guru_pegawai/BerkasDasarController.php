<?php

namespace App\Http\Controllers\guru_pegawai;

use App\Models\BerkasDasar;
use App\Models\Persyaratan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\BerkasUsulanGaji;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class BerkasDasarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'persyaratan' => Persyaratan::with('deskripsiPersyaratan')->where('jenis_asn', Auth::user()->role)
                ->where('kategori', 'Berkas Dasar')->get(),
        ];
        return view('pages.guru_pegawai.lengkapiData.berkasDasar', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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

        for ($i = 0; $i < $lengthBerkas; $i++) {
            $namaFileBerkas = Str::slug($request->namaBerkas[$i], '-') . "-" . $i . Carbon::now()->format('YmdHs') . ".pdf";
            $request->file('fileBerkas')[$i]->storeAs(
                'upload/berkas-dasar',
                $namaFileBerkas
            );

            $berkasDasar = new BerkasDasar();
            $berkasDasar->id_user = Auth::user()->id;
            $berkasDasar->nama = $request->namaBerkas[$i];
            $berkasDasar->file = $namaFileBerkas;
            $berkasDasar->save();
        }
        Toastr::success('Berhasil Mengupload Berkas Dasar, Admin akan mengecek berkas dasar anda terlebih dahulu agar dapat mengusulkan kenaikan gaji berkala ataupun kenaikan pangkat.', 'Success');
        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BerkasDasar  $berkasDasar
     * @return \Illuminate\Http\Response
     */
    public function show(BerkasDasar $berkasDasar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BerkasDasar  $berkasDasar
     * @return \Illuminate\Http\Response
     */
    public function edit(BerkasDasar $berkasDasar)
    {
        dd('sementara develop');
        // $data = [
        //     'persyaratan' => Persyaratan::with('deskripsiPersyaratan')->where('jenis_asn', Auth::user()->role)
        //         ->where('kategori', 'Berkas Dasar')->get(),
        // ];
        // return view('pages.guru_pegawai.lengkapiData.berkasDasar', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BerkasDasar  $berkasDasar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BerkasDasar $berkasDasar)
    {
        //
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
