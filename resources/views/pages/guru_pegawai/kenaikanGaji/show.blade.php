@extends('templates.dashboard')

@section('title')
Lihat Berkas
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
                    <td>{{"Rp " . number_format($usulanGaji->nilai_gaji_sebelumnya,0,',','.');}}</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">TMT Gaji Berkala : </th>
                    <td>{{date("d-m-Y", strtotime($usulanGaji->tmt_gaji_sebelumnya))}}</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">Lama Kerja : </th>
                    <td>{{$usulanGaji->jumlah_tahun_kerja_lama}} Tahun {{$usulanGaji->jumlah_bulan_kerja_lama}}
                        Bulan
                    </td>
                </tr>
                @if ($usulanGaji->nilai_gaji_selanjutnya)
                <tr>
                    <th scope="row" width="40%">Nilai Usulan Gaji : </th>
                    <td>{{"Rp " . number_format($usulanGaji->nilai_gaji_selanjutnya,0,',','.');}}
                    </td>
                </tr>
                <tr>
                    <th scope="row" width="40%">TMT Gaji Selanjutnya : </th>
                    <td>{{date("d-m-Y", strtotime($usulanGaji->tmt_gaji_selanjutnya))}}</td>
                </tr>
                @endif

            </tbody>
        </table>

    </div>

    <div class="col-xl-7 col-sm-12 mb-5">
        <h4 class="page-title">Persyaratan Berkas</h4>
        <ul class="list-group list-group-bordered list my-4">
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
            @if ($usulanGaji)
            @foreach ($usulanGaji->berkasUsulanGaji as $usulan)
            <div class="col-lg-4 mt-3">
                <a href="{{Storage::url('upload/berkas-usulan-gaji/' . $usulan->file)}}"
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
        $('.nav-usulan-kenaikan-gaji').addClass('active');
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

</script>
@endpush
