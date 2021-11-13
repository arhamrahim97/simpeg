@extends('components.dashboard.guru_pegawai.mainLengkapiData')

@section('content')
<div class="card">
	<div class="card-header py-4 text-center">
		<h3 class="wizard-title">Lengkapi <b>Berkas Dasar</b> Anda</h3>
		<small>Silahkan lengkapi terlebih dahulu berkas dasar anda</small>
	</div>
	<div class="card-body">
        <div class="row">
            <div class="col-lg-6 col-12 px-4 mb-3">
                <h6 class="mb-3 font-weight-bold">Berikut beberapa berkas yang harus di upload:</h6>
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
                <form method="POST" id="formBerkas"
                    enctype="multipart/form-data" action="/berkas-dasar">
                    @csrf         
                    <div class="border border-grey shadow text-center rounded shadow-sm py-5 px-4"><img src="/assets/dashboard/img/pdf.png" alt="" class="img-fluid" width="100">
                        <h5 class="mb-0">Upload Berkas Dasar</h5>
                        <span class="small text-uppercase">
                            File harus berekstensi .PDF dengan ukuran maksimal 1 MB
                        </span>
                    </div>
        
                    <div class="row gx-4 d-flex justify-content-center">
                        <div class="col-lg-12 mt-3" id="listBerkas">
                            @forelse ($persyaratan as $row)
                                @foreach ($row->deskripsiPersyaratan as $deskripsi)
                                    <div class="form-group border border-grey shadow-lg rounded p-3"
                                        id="daftarBerkas{{$loop->iteration}}">
                                        <label for="exampleInputEmail1">Nama Berkas</label>
                                        <input type="text" class="form-control namaBerkas" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="Nama Berkas" name="namaBerkas[]"
                                            value="{{$deskripsi->deskripsi}}">
                                        <div class="mb-3 mt-3"><label for="formFileSm" class="form-label">File
                                                Berkas</label><input class="form-control form-control-sm fileBerkas" id="formFileSm"
                                                type="file" name="fileBerkas[]"></div>
                                        <div class="div d-flex justify-content-end">
                                            <button href="" class="btn btn-danger btn-sm btnHapusFitur" id="{{$loop->iteration}}">
                                                <i class="fas fa-trash-alt"></i>
                                                Hapus</button>
                                        </div>
                                    </div>
                                @endforeach                                                        
                            @empty
                                <h1>Belum Ada Persyaratan</h1>
                            @endforelse ($persyaratan as $row)
                        </div>
        
                        <div class="div">
                            <button type="button" class="btn btn-warning mt-1" id="btnTambahBerkas"> + Tambah Berkas</button>
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
    $('#formBerkas').submit(function (e) {
        lengthNamaBerkas = 0;
        lengthTipeFileBerkas = 0;
        lengthSizeFileBerkas = 0;
        lengthFileBerkas = 0;
        $(".namaBerkas").each(function () {
            if ($(this).val()) {
                lengthNamaBerkas++;
            }
        })

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
    })

</script>

<script>
    var i = 1;
    $('#btnTambahBerkas').on('click', function () {
        i++;
        var formBerkas =
            ' <div class="form-group border border-grey shadow rounded p-3" id="daftarBerkas' + i +
            '"><label for="exampleInputEmail1">Nama Berkas</label><input type="text" class="form-control namaBerkas" id="exampleInputEmail1" aria-describedby="emailHelp"placeholder="Contoh : Kartu Pegawai" name="namaBerkas[]"><div class="mb-3 mt-3"><label for="formFileSm" class="form-label">File Berkas</label><input class="form-control form-control-sm fileBerkas" id="formFileSm" type="file" name="fileBerkas[]"></div><div class="div d-flex justify-content-end"><button href="" class="btn btn-danger btn-sm btnHapusFitur" id="' +
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


@endsection