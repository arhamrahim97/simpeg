<?php

namespace App\Http\Controllers\guru_pegawai;

use id;
use Carbon\Carbon;
use App\Models\User;
use App\Models\BerkasDasar;
use App\Models\Persyaratan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BerkasUsulanGaji;
use App\Models\ProfileGuruPegawai;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BerkasDasarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        if (($user->profile)) {
            if (($user->profile->status_berkas_dasar == -1)) {
                $data = [
                    'persyaratan' => Persyaratan::with('deskripsiPersyaratan')->where('jenis_asn', Auth::user()->role)
                        ->where('kategori', 'Berkas Dasar')->get(),
                ];
                return view('pages.guru_pegawai.lengkapiData.berkasDasar', $data);
            } else {
                return redirect('/dashboard');
            }
        } else {
            return redirect('/dashboard');
        }
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


            ProfileGuruPegawai::where('id_user', Auth::user()->id)
                ->update(['status_berkas_dasar' => 0, 'konfirmasi_berkas_dasar' => Carbon::now()]);
            // $user->updated_at = DB::raw('NOW()');
            // $user->save();
        }
        Toastr::success('Berhasil Mengupload Berkas Dasar, Admin akan mengecek berkas dasar anda terlebih dahulu.', 'Success');
        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BerkasDasar  $berkasDasar
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BerkasDasar  $berkasDasar
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        if ($user->profile->id_user == Auth::user()->id) {
            $data = [
                'persyaratan' => Persyaratan::with('deskripsiPersyaratan')->where('jenis_asn', Auth::user()->role)
                    ->where('kategori', 'Berkas Dasar')->get(),
                'user' => $user
            ];
            return view('pages.guru_pegawai.lengkapiData.berkasDasarEdit', $data);
        } else {
            return redirect('/dashboard');
        }
    }

    // public function revisiBerkas(User $user)
    // {
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BerkasDasar  $berkasDasar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $lengthBerkasUpdate = count($request->namaBerkasUpdate);
        // Update
        if ($request->namaBerkasUpdate) {
            for ($i = 0; $i < $lengthBerkasUpdate; $i++) {
                $berkasDasar = BerkasDasar::find($request->idBerkasUpdate[$i]);
                $namaFileBerkasUpdate = Str::slug($request->namaBerkasUpdate[$i], '-') . "-" . $i . Carbon::now()->format('YmdHs') . rand(1, 9999) . ".pdf";


                if (isset($request->file('fileBerkasUpdate')[$i])) {
                    if (Storage::exists('upload/berkas-dasar/' . $berkasDasar->file)) {
                        Storage::delete('upload/berkas-dasar/' . $berkasDasar->file);
                    }
                    $request->file('fileBerkasUpdate')[$i]->storeAs(
                        'upload/berkas-dasar',
                        $namaFileBerkasUpdate
                    );
                    $berkasDasar->file = $namaFileBerkasUpdate;
                }

                $berkasDasar->nama = $request->namaBerkasUpdate[$i];
                $berkasDasar->save();
            }
        }
        // Tambahkan Berkas Baru
        if ($request->namaBerkas) {
            $lengthBerkas = count($request->namaBerkas);
            if ($request->namaBerkas) {
                for ($i = 0; $i < $lengthBerkas; $i++) {
                    $namaFileBerkas = Str::slug($request->namaBerkas[$i], '-') . "-" . $i . Carbon::now()->format('YmdHs') . ".pdf";
                    $request->file('fileBerkas')[$i]->storeAs(
                        'upload/berkas-dasar',
                        $namaFileBerkas
                    );

                    $berkasDasar = new BerkasDasar();
                    $berkasDasar->id_user = $user->id;
                    $berkasDasar->nama = $request->namaBerkas[$i];
                    $berkasDasar->file = $namaFileBerkas;
                    $berkasDasar->save();
                }
            }
        }

        ProfileGuruPegawai::where('id_user', $user->id)
            ->update(['status_berkas_dasar' => 0, 'konfirmasi_berkas_dasar' => Carbon::now()]);

        Toastr::success('Berhasil Mengubah Berkas', 'Success');
        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BerkasDasar  $berkasDasar
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // if (Storage::exists('upload/berkas-dasar/' . $berkasDasar->file)) {
        //     Storage::delete('upload/berkas-dasar/' . $berkasDasar->file);
        // }

        // $berkasDasar->delete();

        // return response()->json([
        //     'res' => 'success',
        //     'data' => $berkasDasar
        // ]);
    }

    public function hapusBerkas(BerkasDasar $berkasDasar)
    {
        // return $berkasDasar;
        if (Storage::exists('upload/berkas-dasar/' . $berkasDasar->file)) {
            Storage::delete('upload/berkas-dasar/' . $berkasDasar->file);
        }

        $berkasDasar->delete();

        return response()->json([
            'res' => 'success',
            'data' => $berkasDasar
        ]);
    }
}
