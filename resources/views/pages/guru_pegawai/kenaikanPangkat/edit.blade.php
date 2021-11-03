@extends('templates.dashboard')

@section('title')
Ubah Berkas
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
                @if ($user->role == "Guru")
                <tr>
                    <th scope="row" width="40%">Golongan : </th>
                    <td>{{$usulanPangkat->pangkatFungsionalSebelumnya->golongan}}</td>
                </tr>

                <tr>
                    <th scope="row" width="40%">Jabatan : </th>
                    <td>{{$usulanPangkat->pangkatFungsionalSebelumnya->jabatan}}</td>
                </tr>

                <tr>
                    <th scope="row" width="40%">Pangkat : </th>
                    <td>{{$usulanPangkat->pangkatFungsionalSebelumnya->pangkat}}</td>
                </tr>
                @endif
                @if ($user->role == "Pegawai")
                <tr>
                    <th scope="row" width="40%">Golongan : </th>
                    <td>{{$usulanPangkat->pangkatStrukturalSebelumnya->golongan}}</td>
                </tr>

                <tr>
                    <th scope="row" width="40%">Jabatan : </th>
                    <td>{{$usulanPangkat->pangkatStrukturalSebelumnya->jabatan}}</td>
                </tr>

                <tr>
                    <th scope="row" width="40%">Pangkat : </th>
                    <td>{{$usulanPangkat->pangkatStrukturalSebelumnya->pangkat}}</td>
                </tr>
                @endif

                <tr>
                    <th scope="row" width="40%">TMT Pangkat : </th>
                    <td>{{date("d-m-Y", strtotime($usulanPangkat->tmt_pangkat_sebelumnya))}}</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">Lama Kerja : </th>
                    <td>{{$usulanPangkat->jumlah_tahun_kerja_lama}} Tahun
                        {{$usulanPangkat->jumlah_bulan_kerja_lama}}
                        Bulan
                    </td>
                </tr>

                @if ($user->role == "Guru")
                @if ($usulanPangkat->pangkatFungsionalSelanjutnya)
                <tr>
                    <th scope="row" width="40%">Golongan Selanjutnya : </th>
                    <td>{{$usulanPangkat->pangkatFungsionalSelanjutnya->golongan}}</td>
                </tr>

                <tr>
                    <th scope="row" width="40%">Jabatan Selanjutnya : </th>
                    <td>{{$usulanPangkat->pangkatFungsionalSelanjutnya->jabatan}}</td>
                </tr>

                <tr>
                    <th scope="row" width="40%">Pangkat Selanjutnya : </th>
                    <td>{{$usulanPangkat->pangkatFungsionalSelanjutnya->pangkat}}</td>
                </tr>
                @endif
                @endif

                @if ($user->role == "Pegawai")
                @if ($usulanPangkat->pangkatStrukturalSelanjutnya)
                <tr>
                    <th scope="row" width="40%">Golongan Selanjutnya : </th>
                    <td>{{$usulanPangkat->pangkatStrukturalSelanjutnya->golongan}}</td>
                </tr>

                <tr>
                    <th scope="row" width="40%">Jabatan Selanjutnya : </th>
                    <td>{{$usulanPangkat->pangkatStrukturalSelanjutnya->jabatan}}</td>
                </tr>

                <tr>
                    <th scope="row" width="40%">Pangkat Selanjutnya : </th>
                    <td>{{$usulanPangkat->pangkatStrukturalSelanjutnya->pangkat}}</td>
                </tr>
                @endif
                @endif

                @if ($usulanPangkat->tmt_pangkat_selanjutnya)
                <tr>
                    <th scope="row" width="40%">TMT Pangkat Selanjutnya : </th>
                    <td>{{date("d-m-Y", strtotime($usulanPangkat->tmt_pangkat_selanjutnya))}}</td>
                </tr>
                @endif

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
        <form method="POST" id="formBerkas" action="{{route('usulan-kenaikan-pangkat.update',$usulanPangkat->id)}}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <label for="exampleInputEmail1" class="form-label mt-4">Usulan Pangkat</label>
                <select class="form-select form-select-lg mb-3 col-lg-12" aria-label=".form-select-lg example"
                    id="usulan_pangkat" name="usulan_pangkat" required>
                    <option value="" selected>Pilih Usulan Pangkat</option>
                    @foreach ($listPangkat as $pangkat)
                    <option value="{{$pangkat->id}}" @if ($pangkat->id ==
                        $usulanPangkat->pangkat_selanjutnya)
                        selected
                        @endif>{{$pangkat->golongan}} | {{$pangkat->jabatan}} |
                        {{$pangkat->pangkat}}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="div" id="persyaratanBerkas">

            </div>



            <div class="border border-grey shadow-lg text-center rounded shadow-sm py-5 px-4"><img
                    src="/assets/dashboard/img/pdf.png" alt="" width="100" class="img-fluid">
                <h5 class="mb-0 mt-2">Upload Berkas Usulan Kenaikan Pangkat</h5>
                <span class="small text-uppercase">
                    File harus berekstensi .PDF dengan ukuran maksimal 1 MB
                </span>
            </div>

            <div class="row gx-4 d-flex justify-content-center">
                <div class="col-lg-12 mt-3" id="listBerkas">
                    @foreach ($berkasPangkat as $berkas)
                    <div class="form-group shadow-lg border border-grey rounded p-3"
                        id="daftarBerkasUpdate{{$berkas->id}}">
                        <input type="hidden" value="{{$berkas->id}}" name="idBerkasUpdate[]">
                        <label for="exampleInputEmail1">Nama Berkas</label>
                        <input type="text" class="form-control namaBerkasUpdate" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Nama Berkas" name="namaBerkasUpdate[]"
                            value="{{$berkas->nama}}">
                        <div class="mb-3 mt-3">
                            <label for="formFileSm" class="form-label">File Berkas</label>
                            <input class="form-control form-control-sm fileBerkasUpdate" id="formFileSm" type="file"
                                name="fileBerkasUpdate[]">
                            <small id="emailHelp" class="form-text text-danger">Kosongkan
                                File
                                Berkas Jika
                                Tidak Ingin Mengubah
                                Berkas</small></div>

                        <div class="div d-flex justify-content-end"><button type="button"
                                class="btn btn-danger btn-sm btnHapusBerkasUpdate" id="{{$berkas->id}}"><i
                                    class="fas fa-trash-alt"></i>
                                Hapus</button></div>
                    </div>
                    @endforeach

                </div>

                <div class="div">
                    <button type="button" class="btn btn-warning" id="btnTambahBerkas"> + Tambah
                        Berkas</button>
                </div>


            </div> <!-- / .row -->

            <hr>
            <div class="div d-flex justify-content-center mt-5">
                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Upload Berkas</button>
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
    var ukuranFile = 1048576; //1 MB

    // Update File
    var lengthNamaBerkasUpdate = 0;
    var lengthFileBerkasUpdate = 0;
    var lengthSizeFileBerkasUpdate = 0;
    var lengthTipeFileBerkasUpdate = 0;
    $('#formBerkas').submit(function (e) {
        // e.preventDefault();
        lengthNamaBerkas = 0;
        lengthTipeFileBerkas = 0;
        lengthSizeFileBerkas = 0;
        lengthFileBerkas = 0;

        // Update
        lengthSizeFileBerkasUpdate = 0;
        lengthFileBerkasUpdate = 0;
        lengthNamaBerkasUpdate = 0;
        lengthTipeFileBerkasUpdate = 0;

        $(".namaBerkasUpdate").each(function () {
            if ($(this).val()) {
                lengthNamaBerkasUpdate++;
            }
        })

        $('.fileBerkasUpdate').each(function () {
            if (this.files[0]) {
                var fileBerkas = this.files[0];
                var fileSize = fileBerkas.size;
                var fileType = fileBerkas["type"];
                var validImageTypes = ["application/pdf"];

                if (fileType == validImageTypes) {
                    lengthTipeFileBerkasUpdate++;
                }

                if (fileSize < ukuranFile) {
                    lengthSizeFileBerkasUpdate++;
                }
                lengthFileBerkasUpdate++;
            }
        })

        if (lengthSizeFileBerkasUpdate != lengthFileBerkasUpdate) {
            swal("Periksa Kembali Berkas Anda", "Berkas Yang Diubah Harus Berukuran Kurang dari 1 MB", {
                icon: "error",
                buttons: {
                    confirm: {
                        className: 'btn btn-danger'
                    }
                },
            });
        }

        if (lengthNamaBerkasUpdate != $('.namaBerkasUpdate').length) {
            swal("Periksa Kembali Berkas Anda", "Nama Berkas Yang Diubah Tidak Boleh Kosong", {
                icon: "error",
                buttons: {
                    confirm: {
                        className: 'btn btn-danger'
                    }
                },
            });
        }

        $(".namaBerkas").each(function () {
            if ($(this).val()) {
                lengthNamaBerkas++;
            }
        })

        if (($('.fileBerkasUpdate').length == 0) && ($('.fileBerkas').length == 0)) {
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
            }
        }

        if (lengthTipeFileBerkasUpdate != lengthFileBerkasUpdate) {
            swal("Periksa Kembali Berkas Anda", "Berkas Yang Diupdate Harus PDF", {
                icon: "error",
                buttons: {
                    confirm: {
                        className: 'btn btn-danger'
                    }
                },
            });
            e.preventDefault();
        }

        if ($(".fileBerkas")[0]) {
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
            swal("Periksa Kembali Berkas Anda", "Nama Berkas Yang Ditambahkan Tidak Boleh Kosong", {
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
            swal("Periksa Kembali Berkas Anda", "Berkas Yang Ditambahkan Harus Berukuran Kurang dari 1 MB", {
                icon: "error",
                buttons: {
                    confirm: {
                        className: 'btn btn-danger'
                    }
                },
            });
            e.preventDefault();
        }

        if ($('.fileBerkas').length != 0) {
            if (lengthTipeFileBerkas !== $('.fileBerkas').length) {
                swal("Periksa Kembali Berkas Anda", "Berkas Yang Ditambahkan Harus PDF", {
                    icon: "error",
                    buttons: {
                        confirm: {
                            className: 'btn btn-danger'
                        }
                    },
                });
                e.preventDefault();
            }
        }

    })

</script>

<script>
    $(document).ready(function () {
        $('.nav-usulan-kenaikan-pangkat').addClass('active');
        $('#usulan_pangkat').change();
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>

<script>
    var i = 1;
    $('#btnTambahBerkas').on('click', function () {
        i++;
        var formBerkas =
            ' <div class="form-group border border-grey shadow-lg rounded p-3" id="daftarBerkas' + i +
            '"><label for="exampleInputEmail1">Nama Berkas</label><input type="text" class="form-control namaBerkas" id="exampleInputEmail1" aria-describedby="emailHelp"placeholder="Nama Berkas" name="namaBerkas[]"><div class="mb-3 mt-3"><label for="formFileSm" class="form-label">File Berkas</label><input class="form-control form-control-sm fileBerkas" id="formFileSm" type="file" name="fileBerkas[]"></div><div class="div d-flex justify-content-end"><button href="" class="btn btn-danger btn-sm btnHapusBerkas" id="' +
            i +
            '"><i class="fas fa-trash-alt"></i> Hapus</button></div></div>';
        $('#listBerkas').append(formBerkas);
    })

    $(document).on('click', '.btnHapusBerkas', function () {
        var id = $(this).attr("id");
        $('#daftarBerkas' + id).remove();
        i--;
    })

    $(document).on('click', '.btnHapusBerkasUpdate', function () {
        var id = $(this).attr("id");
        swal({
            title: 'Anda Yakin Ingin Menghapus Berkas Ini?',
            text: "Berkas yang sudah dihapus tidak dapat dikembalikan lagi",
            icon: 'warning',
            buttons: {
                confirm: {
                    text: 'Hapus',
                    className: 'btn btn-success'
                },
                cancel: {
                    visible: true,
                    text: 'Batal',
                    className: 'btn btn-danger'
                }
            }
        }).then((Delete) => {
            if (Delete) {
                var url = "{{url('hapus-berkas-pangkat')}}";
                $.ajax({
                    type: "DELETE",
                    url: url + "/" + id,
                    dataType: 'json',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (data) {
                        if (data.res == 'success') {
                            swal({
                                title: 'Terhapus',
                                text: data.message,
                                icon: 'success',
                                buttons: {
                                    confirm: {
                                        className: 'btn btn-success'
                                    }
                                }
                            });
                            $('#daftarBerkasUpdate' + id).remove();
                        } else {
                            swal({
                                title: 'Gagal',
                                text: 'Gagal Menghapus Data',
                                icon: 'warning',
                                buttons: {
                                    confirm: {
                                        className: 'btn btn-success'
                                    }
                                }
                            });
                        }
                    },
                    error: function (data) {
                        swal({
                            title: 'Gagal',
                            text: 'Gagal Menghapus Data',
                            icon: 'warning',
                            buttons: {
                                confirm: {
                                    className: 'btn btn-success'
                                }
                            }
                        });
                    }
                });
            } else {
                swal.close();
            }
        });
    })

    $('#usulan_pangkat').change(function () {
        var pangkat = $('#usulan_pangkat').val();
        if (pangkat != '') {
            $.ajax({
                type: "POST",
                url: "/get-persyaratan-berkas",
                dataType: 'json',
                data: {
                    pangkat: pangkat
                },
                success: function (data) {
                    if (data.res == 'success') {
                        $('#persyaratanBerkas').empty();
                        $('#persyaratanBerkas').append(data.html);
                    } else {
                        $('#persyaratanBerkas').empty();
                    }
                },
                error: function (data) {
                    // swal({
                    // title: 'Gagal',
                    // text: 'Gagal Menghapus Data',
                    // icon: 'warning',
                    // buttons: {
                    // confirm: {
                    // className: 'btn btn-success'
                    // }
                    // }
                    // });
                }
            });
        } else {
            $('#persyaratanBerkas').empty();
        }

    })

</script>
@endpush
