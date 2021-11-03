@extends('templates.dashboard')

@section('title')
Proses Berkas
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
                    <td>{{$usulanPangkat->jumlah_tahun_kerja_lama}} Tahun {{$usulanPangkat->jumlah_bulan_kerja_lama}}
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

    </div>

    <div class="col-xl-7 col-sm-12 mb-5">
        <form action="{{route('proses-usulan-kenaikan-pangkat-kepala-dinas.update',$usulanPangkat->id)}}" method="POST"
            id="form-proses">
            @csrf
            @method('PUT')
            <div>
                <label for="exampleInputEmail1" class="form-label mt-4">Usulan Pangkat</label>
                <div class="row mx-1">
                    <select class="form-select form-select-lg col-lg-9" aria-label=".form-select-lg example"
                        id="usulan_pangkat" name="usulan_pangkat" required disabled>
                        @foreach ($listPangkat as $pangkat)
                        <option value="{{$pangkat->id}}" @if ($pangkat->id ==
                            $usulanPangkat->pangkat_selanjutnya)
                            selected
                            @endif>{{$pangkat->golongan}} | {{$pangkat->jabatan}} |
                            {{$pangkat->pangkat}}
                        </option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-warning col-lg-2 ml-2" id="ubahPangkat">Ubah</button>
                </div>

            </div>

            <div class="div" id="persyaratanBerkas">

            </div>

            <h4 class="page-title">Berkas Dasar</h4>
            <div class="row gx-4">
                @foreach ($berkasDasar as $berkas)
                <div class="col-lg-4 mt-3">
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
            <h4 class="page-title mt-4">Berkas Tambahan</h4>
            <div class="row gx-4">
                @if ($usulanPangkat)
                @foreach ($usulanPangkat->berkasUsulanPangkat as $usulan)
                <div class="col-lg-4 mt-3">
                    <a href="{{Storage::url('upload/berkas-usulan-pangkat/' . $usulan->file)}}"
                        class="text-decoration-none lihat-pdf" data-id="{{$usulan->id}}" target="_blank">
                        <div class="shadow-lg text-decoration-none text-center rounded shadow-sm py-5 px-4"
                            style="height: 200px">
                            <img src="/assets/dashboard/img/pdf.png" alt="" width="50" class="img-fluid">
                            <br>
                            <span class="small text-uppercase">
                                {{$usulan->nama}}
                            </span>
                        </div>
                    </a>
                </div>
                @endforeach
                @endif
            </div> <!-- / .row -->



            <h4 class="page-title mt-4">Proses Berkas</h4>
            <div>
                <label for="exampleInputEmail1" class="form-label mt-4">Konfirmasi Berkas</label>
                <select class="form-select form-select-lg mb-3 col-lg-12" aria-label=".form-select-lg example"
                    id="konfirmasi-berkas" name="konfirmasi_berkas" required>
                    <option value="" selected>Pilih Status Konfirmasi</option>
                    <option value="1">Setuju</option>
                    <option value="2">Tolak</option>
                </select>
            </div>

            <div id="form-alasan-ditolak">
                <label for="exampleFormControlTextarea1" class="form-label">Alasan Ditolak</label>
                <textarea class="form-control" required name="alasan_ditolak" id="alasan-ditolak"></textarea>
            </div>

            <div class="div d-flex justify-content-center mt-5">
                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Proses
                    Berkas</button>
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
    $(document).ready(function () {
        $('.nav-usulan-kenaikan-pangkat').addClass('active');
        $('#usulan_pangkat').change();
        $('#konfirmasi-berkas').change();
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#konfirmasi-berkas').change(function () {
        var konfirmasi_berkas = $('#konfirmasi-berkas').val();
        if (konfirmasi_berkas == 1) {
            $('#form-alasan-ditolak').hide();
            $("#alasan-ditolak").prop('required', false);
        } else if (konfirmasi_berkas == 2) {
            $('#form-alasan-ditolak').show();
            $("#alasan-ditolak").prop('required', true);
        } else {
            $('#form-alasan-ditolak').hide();
            $("#alasan-ditolak").prop('required', true);
        }
    })

</script>

<script>
    var i = 1;
    $('#btnTambahBerkas').on('click', function () {
        i++;
        var formBerkas =
            ' <div class="form-group border border-success rounded p-3" id="daftarBerkas' + i +
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
                var url = "{{url('hapus-berkas')}}";
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
                    console.log(data);
                    if (data.res == 'success') {
                        $('#persyaratanBerkas').empty();
                        $('#persyaratanBerkas').append(data.daftarPersyaratan);
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
<script>
    var usulanPangkat = "{{$usulanPangkat->pangkat_selanjutnya}}";
    $('#ubahPangkat').click(function () {
        if ($('#usulan_pangkat').prop('disabled')) {
            $('#usulan_pangkat').prop('disabled', false);
            $("#ubahPangkat").html('Batal');
            $("#ubahPangkat").removeClass("btn-warning").addClass("btn-danger");
        } else {
            $('#usulan_pangkat').val(usulanPangkat);
            $('#usulan_pangkat').change();
            $('#usulan_pangkat').prop('disabled', true);
            $("#ubahPangkat").html('Ubah');
            $("#ubahPangkat").removeClass("btn-danger").addClass("btn-warning");
        }
    })

</script>
@endpush
