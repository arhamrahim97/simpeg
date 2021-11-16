@extends('components.dashboard.guru_pegawai.mainLengkapiData')

@section('content')
<div class="card">
    <div class="card-header py-4 text-center">
        <h3 class="wizard-title">Lengkapi <b>Berkas Dasar</b> Anda</h3>
        <small>Silahkan lengkapi berkas dasar anda</small>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6 col-12 px-4 mb-3">
                <h6>Berikut beberapa berkas yang harus di upload:</h6>
                <ul class="list-group list-group-bordered list">
                    @php
                    $i = 1
                    @endphp
                    @forelse ($persyaratan as $row)
                    @foreach ($row->deskripsiPersyaratan as $deskripsi)
                    <li class="list-group-item">
                        <span class="name">{{ $i++ }}. {{ $deskripsi->deskripsi }}</span>
                    </li>
                    @endforeach
                    @empty
                    <h5>Tidak ada persyaratan</h5>
                    @endforelse
                </ul>
            </div>
            <div class="col-lg-6 col-12 px-4">
                <form method="POST" id="formBerkas" action="{{route('berkas-dasar.update',$user->id)}}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="shadow text-center rounded py-5 px-4"><img src="/assets/dashboard/img/pdf.png" alt=""
                            width="100" class="img-fluid">
                        <h5 class="mb-0 mt-3">Upload Berkas Usulan Kenaikan Gaji</h5>
                        <span class="small text-uppercase">
                            File harus berekstensi .PDF dengan ukuran maksimal 1 MB
                        </span>
                    </div>

                    <div class="row gx-4 d-flex justify-content-center">
                        <div class="col-lg-12 mt-3" id="listBerkas">
                            @php
                            $listDeskripsi = ['SK Kenaikan Pangkat','SK Kenaikan Gaji Berkala'];
                            @endphp
                            @foreach ($user->berkasDasar as $berkas)
                            <div class="form-group shadow border border-grey rounded p-3"
                                id="daftarBerkasUpdate{{$berkas->id}}">
                                <input type="hidden" value="{{$berkas->id}}" name="idBerkasUpdate[]">
                                <label for="exampleInputEmail1">Nama Berkas</label>
                                <input type="text" class="form-control namaBerkasUpdate" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Nama Berkas" name="namaBerkasUpdate[]"
                                    value="{{$berkas->nama}}" @if(in_array($berkas->nama,
                                $listDeskripsi))
                                readonly @endif>
                                <div class="mb-3 mt-3">
                                    <label for="formFileSm" class="form-label">File Berkas</label>
                                    <input class="form-control form-control-sm fileBerkasUpdate" id="formFileSm"
                                        type="file" name="fileBerkasUpdate[]">
                                    <small id="emailHelp" class="form-text text-danger">Kosongkan
                                        File
                                        Berkas Jika
                                        Tidak Ingin Mengubah
                                        Berkas</small>
                                </div>

                                <div class="div d-flex justify-content-end">
                                    @if(!in_array($berkas->nama, $listDeskripsi))
                                    <button type="button" class="btn btn-danger btn-sm btnHapusBerkasUpdate"
                                        id="{{$berkas->id}}"><i class="fas fa-trash-alt"></i>
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
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    var lengthNamaBerkas = 0;
    var lengthTipeFileBerkas = 0;
    var lengthSizeFileBerkas = 0;
    var lengthFileBerkas = 0;
    var ukuranFile = 1048576;

    // Update File
    var lengthNamaBerkasUpdate = 0;
    var lengthFileBerkasUpdate = 0;
    var lengthSizeFileBerkasUpdate = 0;
    var lengthTipeFileBerkasUpdate = 0;
    $('#formBerkas').submit(function (e) {
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
                var url = "{{url('hapus-berkas-dasar')}}";
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
                            text: 'Gagal Menghapus Data' + console.log(data.id),
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
</script>


@endsection
