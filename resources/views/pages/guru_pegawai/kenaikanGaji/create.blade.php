@extends('templates.dashboard')

@section('title')
Upload Berkas Usulan Kenaikan Gaji
@endsection

@section('content')


<div class="row">

    <!-- Team item -->

    <div class="col-xl-5">
        <table class="table">
            <tbody>
                <tr>
                    <th scope="row" width="40%">Nama : </th>
                    <td>{{$user->nama}}</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">Jenis Kelamin : </th>
                    <td>{{$user->profile->jenis_kelamin}}</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">Pendidikan Terakhir : </th>
                    <td>{{$user->profile->pendidikan_terakhir}}</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">Jenis ASN : </th>
                    <td>{{$user->profile->jenis_asn}}</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">NIP : </th>
                    <td>{{$user->nip}}</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">NUPTK : </th>
                    <td>{{$user->profile->nuptk}}</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">Unit Kerja : </th>
                    <td>{{$user->profile->unitKerja->nama}}</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">Status : </th>
                    <td>{{$user->profile->status}}</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">Golongan : </th>
                    @if ($user->role == "Pegawai")
                    <td>{{$user->profile->jabatanStruktural->golongan}}</td>
                    @elseif ($user->role == "Guru")
                    <td>{{$user->profile->jabatanFungsional->golongan}}</td>
                    @endif
                </tr>

                <tr>
                    <th scope="row" width="40%">Jabatan : </th>
                    @if ($user->role == "Pegawai")
                    <td>{{$user->profile->jabatanStruktural->jabatan}}</td>
                    @elseif ($user->role == "Guru")
                    <td>{{$user->profile->jabatanFungsional->jabatan}}</td>
                    @endif
                </tr>

                <tr>
                    <th scope="row" width="40%">Pangkat : </th>
                    @if ($user->role == "Pegawai")
                    <td>{{$user->profile->jabatanStruktural->pangkat}}</td>
                    @elseif ($user->role == "Guru")
                    <td>{{$user->profile->jabatanFungsional->pangkat}}</td>
                    @endif
                </tr>
                <tr>
                    <th scope="row" width="40%">Gaji Terakhir : </th>
                    <td>{{"Rp " . number_format($user->profile->nilai_gaji,0,',','.');}}</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">TMT Gaji Berkala : </th>
                    <td>{{date("d-m-Y", strtotime($user->profile->tmt_gaji))}}</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">Lama Kerja : </th>
                    <td>
                        @php
                        $tanggal_kerja = new DateTime(Auth::user()->profile->tanggal_kerja);
                        $sekarang = new DateTime("today");
                        $thn = $sekarang->diff($tanggal_kerja)->y;
                        $bln = $sekarang->diff($tanggal_kerja)->m;
                        echo $thn . " Tahun " . $bln . " Bulan";
                        @endphp
                    </td>
                </tr>

            </tbody>
        </table>
        <div class="col-lg-12">
            <div class="row">
                @foreach ($berkasDasar as $berkas)
                <div class="col-lg-6 mt-3">
                    <a href="{{Storage::url('upload/berkas-dasar/' . $berkas->file)}}" class="text-decoration-none">
                        <div class="shadow-lg text-decoration-none text-center rounded shadow-sm py-5 px-4"
                            style="height: 200px">
                            <img src="/assets/dashboard/img/pdf.png" alt="" width="50" class="img-fluid">
                            <br>
                            <span class="small text-uppercase">
                                {{$berkas->nama}}
                            </span>
                        </div>
                    </a>
                </div>
                @endforeach

            </div>
        </div>

    </div>

    <div class="col-xl-7 col-sm-12 mb-5">
        <h6 class="my-2 font-weight-bold">Berikut beberapa berkas yang harus di upload:</h6>
        <ul class="list-group list-group-bordered list my-4">
            @php
            $i = 1
            @endphp
            @foreach ($persyaratan->deskripsiPersyaratan as $deskripsi)
            <li class="list-group-item">
                <span class="name">{{ $i++ }}. {{ $deskripsi->deskripsi }}</span>
            </li>
            @endforeach
        </ul>
        <form method="POST" id="formBerkas" action="{{route('usulan-kenaikan-gaji.store')}}"
            enctype="multipart/form-data">
            @csrf
            <div class="border border-grey shadow-lg text-center rounded shadow-sm py-5 px-4"><img
                    src="/assets/dashboard/img/pdf.png" alt="" width="100" class="img-fluid">
                <h5 class="mb-0 mt-2">Upload Berkas Usulan Kenaikan Gaji</h5>
                <span class="small text-uppercase">
                    File harus berekstensi .PDF dengan ukuran maksimal 1 MB
                </span>
            </div>

            <div class="row gx-4 d-flex justify-content-center">
                <div class="col-lg-12 mt-3" id="listBerkas">
                    @php
                    $listDeskripsi = ['SK Pangkat Terakhir','SK Gaji Berkala'];
                    @endphp
                    @foreach ($persyaratan->deskripsiPersyaratan as $deskripsi)
                    <div class="form-group border border-grey shadow-lg rounded p-3"
                        id="daftarBerkas{{$loop->iteration}}">
                        <label for="exampleInputEmail1">Nama Berkas</label>
                        <input type="text" class="form-control namaBerkas" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Nama Berkas" name="namaBerkas[]"
                            value="{{$deskripsi->deskripsi}}" @if(in_array($deskripsi->deskripsi, $listDeskripsi))
                        readonly @endif>
                        <div class="mb-3 mt-3"><label for="formFileSm" class="form-label">File
                                Berkas</label><input class="form-control form-control-sm fileBerkas" id="formFileSm"
                                type="file" name="fileBerkas[]"></div>
                        <div class="div d-flex justify-content-end">
                            @if(!in_array($deskripsi->deskripsi, $listDeskripsi))
                            <button href="" class="btn btn-danger btn-sm btnHapusFitur" id="{{$loop->iteration}}">
                                <i class="fas fa-trash-alt"></i>
                                Hapus</button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="div">
                    <button type="button" class="btn btn-warning" id="btnTambahBerkas"> + Tambah Berkas</button>
                </div>


            </div> <!-- / .row -->

            <hr>
            <div class="div d-flex justify-content-center mt-5">
                <button type="submit" class="btn btn-primary">Upload Berkas</button>
            </div>
        </form>
    </div><!-- End -->

</div>

@endsection

{{-- Style Disini --}}
@push('style')
<style>
    .social-link {
        width: 30px;
        height: 30px;
        border: 1px solid #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
        border-radius: 50%;
        transition: all 0.3s;
        font-size: 0.9rem;
    }

    .social-link:hover,
    .social-link:focus {
        background: #ddd;
        text-decoration: none;
        color: #555;
    }
</style>
@endpush

{{-- Script Disini --}}
@push('script')
<script>
    var lengthNamaBerkas = 0;
    var lengthTipeFileBerkas = 0;
    var lengthSizeFileBerkas = 0;
    var lengthFileBerkas = 0;
    var lengthNamaSama = 0;
    var ukuranFile = 1048576;
    $('#formBerkas').submit(function (e) {
        lengthNamaBerkas = 0;
        lengthTipeFileBerkas = 0;
        lengthSizeFileBerkas = 0;
        lengthFileBerkas = 0;
        lengthNamaSama = 0;
        $(".namaBerkas").each(function () {
            if ($(this).val()) {
                lengthNamaBerkas++;
            }
        })

        for (var i = 0; i < $(".namaBerkas").length; i++) {
            for (var j = 0; j < $(".namaBerkas").length; j++) {
                if (i != j) {
                    if ($(".namaBerkas")[i]['value'] == $(".namaBerkas")[j]['value']) {
                        lengthNamaSama++;
                    }
                }
            }
        }

        if (!$(".fileBerkas")[0]) {
            swal("Terjadi Kesalahan", "Berkas Harus Ditambahkan", {
                icon: "error",
                buttons: {
                    confirm: {
                        className: 'btn btn-danger'
                    }
                },
            });
            e.preventDefault();
        } else {
            $(".fileBerkas").each(function () {
                if (this.files[0]) {
                    var fileBerkas = this.files[0];
                    var fileSize = fileBerkas.size;
                    var fileType = fileBerkas["type"];
                    var validImageTypes = ["application/pdf"];

                    if (fileType == validImageTypes) {
                        lengthTipeFileBerkas++;
                    }

                    if (fileSize < ukuranFile) {
                        lengthSizeFileBerkas++;
                    }

                    lengthFileBerkas++;
                }
            })
        }

        if (lengthNamaBerkas !== $('.namaBerkas').length) {
            swal("Periksa Kembali Berkas Anda", "Nama Berkas Tidak Boleh Kosong", {
                icon: "error",
                buttons: {
                    confirm: {
                        className: 'btn btn-danger'
                    }
                },
            });
            e.preventDefault();
        }

        if (lengthFileBerkas !== $('.fileBerkas').length) {
            swal("Periksa Kembali Berkas Anda", "Berkas Tidak Boleh Kosong", {
                icon: "error",
                buttons: {
                    confirm: {
                        className: 'btn btn-danger'
                    }
                },
            });
            e.preventDefault();
        }

        if (lengthSizeFileBerkas !== $('.fileBerkas').length) {
            swal("Periksa Kembali Berkas Anda", "Berkas Harus Berukuran Kurang dari 1 MB", {
                icon: "error",
                buttons: {
                    confirm: {
                        className: 'btn btn-danger'
                    }
                },
            });
            e.preventDefault();
        }

        if (lengthTipeFileBerkas !== $('.fileBerkas').length) {
            swal("Periksa Kembali Berkas Anda", "Berkas Yang Diupload Harus PDF", {
                icon: "error",
                buttons: {
                    confirm: {
                        className: 'btn btn-danger'
                    }
                },
            });
            e.preventDefault();
        }

        if (lengthNamaSama > 0) {
            swal("Periksa Kembali Berkas Anda", "Nama Berkas Tidak Boleh Sama", {
                icon: "error",
                buttons: {
                    confirm: {
                        className: 'btn btn-danger'
                    }
                },
            });
            e.preventDefault();
        }
    })

</script>


<script>
    $(document).ready(function () {
        $('.nav-usulan-kenaikan-gaji').addClass('active');
    })

</script>

<script>
    var i = "{{count($persyaratan->deskripsiPersyaratan)}}";
    $('#btnTambahBerkas').on('click', function () {
        i++;
        var formBerkas =
            ' <div class="form-group border border-grey shadow-lg rounded p-3" id="daftarBerkas' + i +
            '"><label for="exampleInputEmail1">Nama Berkas</label><input type="text" class="form-control namaBerkas" id="exampleInputEmail1" aria-describedby="emailHelp"placeholder="Nama Berkas" name="namaBerkas[]"><div class="mb-3 mt-3"><label for="formFileSm" class="form-label">File Berkas</label><input class="form-control form-control-sm fileBerkas" id="formFileSm" type="file" name="fileBerkas[]"></div><div class="div d-flex justify-content-end"><button href="" class="btn btn-danger btn-sm btnHapusFitur" id="' +
            i +
            '"><i class="fas fa-trash-alt"></i> Hapus</button></div></div>';
        $('#listBerkas').append(formBerkas);
    })

    $(document).on('click', '.btnHapusFitur', function () {
        var id = $(this).attr("id");
        $('#daftarBerkas' + id).remove();
        i--;
    })

</script>
@endpush
