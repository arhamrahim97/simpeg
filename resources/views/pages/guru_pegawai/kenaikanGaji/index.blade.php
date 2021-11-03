@extends('templates.dashboard')

@section('title')
Usulan Kenaikan Gaji
@endsection

@section('content')
@if ($usulan)
<div class="notification">
    <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i> </div>
    <div class="row">
        <div class="col-md-4">
            <div class="text-center mt-2"> <img src="/assets/dashboard/img/illustration/illustration-11.png"
                    class="img-fluid" width="300px"> </div>
        </div>
        <div class="col-md-8 align-self-center">
            <div class="text-white mt-4"> <span class="intro-1 fw-bold">Selamat, Anda Mendapatkan Usulan Kenaikan
                    Gaji</span>
                <div class="mt-2"> <span class="intro-2">Silahkan Upload Berkas Sesuai Persyaratan yang Telah
                        Ditentukan</span> </div>
                <div class="mt-4 mb-5"> <a class="btn btn-notification"
                        href="{{route('usulan-kenaikan-gaji.create')}}">Upload Berkas<i
                            class="fa fa-cloud-download"></i></a> </div>
            </div>
        </div>
    </div>
</div>
@endif

@if ($usulanGaji)
<div class="row mt-3">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered yajra-datatable " style="width: 100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tahun</th>
                        <th>Daftar Berkas</th>
                        <th>Status Berkas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif


<!-- Modal -->
<div class="modal fade" id="modal-timeline" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Timeline Berkas</h5>
                <button type="button" class="close close-modal" data-dismiss="modal-timeline" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="body-timeline">
                {{-- <section class="timeline_area section_padding_130">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <!-- Timeline Area-->
                                <div class="apland-timeline-area">
                                    <!-- Single Timeline Content-->
                                    <div class="single-timeline-area">
                                        <div class="timeline-date timeline-date-accept wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p>01-10-2021</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="single-timeline-content d-flex wow fadeInLeft"
                                                    data-wow-delay="0.3s"
                                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                    <div class="timeline-icon timeline-icon-accept"><i
                                                            class="fas fa-check"></i></div>
                                                    <div class="timeline-text">
                                                        <h6>Guru</h6>
                                                        <p>Berkas Selesai Diupload</p>
                                                        <div class="row">
                                                            <button class="btn btn-sm btn-primary mt-2 mr-2 ml-3">Lihat
                                                                Berkas</button>
                                                            <button class="btn btn-sm btn-warning mt-2">Ubah
                                                                Berkas</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-timeline-area">
                                        <div class="timeline-date timeline-date-accept wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p>10-10-2021</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="single-timeline-content d-flex wow fadeInLeft"
                                                    data-wow-delay="0.3s"
                                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                    <div class="timeline-icon timeline-icon-accept"><i
                                                            class="fas fa-check"></i></div>
                                                    <div class="timeline-text">
                                                        <h6>Admin Kepegawaian</h6>
                                                        <p>Menyetujui Berkas</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-timeline-area">
                                        <div class="timeline-date timeline-date-accept wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p>15-10-2021</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="single-timeline-content d-flex wow fadeInLeft"
                                                    data-wow-delay="0.3s"
                                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                    <div class="timeline-icon timeline-icon-accept"><i
                                                            class="fas fa-check"></i></div>
                                                    <div class="timeline-text">
                                                        <h6>KASUBAG Kepegawaian</h6>
                                                        <p>Menyetujui Berkas</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-timeline-area">
                                        <div class="timeline-date timeline-date-reject wow fadeInLeft"
                                            data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p>16-10-2021</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="single-timeline-content d-flex wow fadeInLeft"
                                                    data-wow-delay="0.3s"
                                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                    <div class="timeline-icon timeline-icon-reject"><i
                                                            class="fas fa-times"></i></div>
                                                    <div class="timeline-text">
                                                        <h6>Sekretaris</h6>
                                                        <p>Berkas Ditolak</p>
                                                        <p>Alasan : Lorem ipsum dolor sit amet consectetur, adipisicing
                                                            elit. Cupiditate error quas sapiente corporis cumque magnam
                                                            earum? Eveniet minima quisquam doloremque.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Timeline Content-->
                                    <div class="single-timeline-area">
                                        <div class="timeline-date wow fadeInLeft" data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p>---</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="single-timeline-content d-flex wow fadeInLeft"
                                                    data-wow-delay="0.3s"
                                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                    <div class="timeline-icon timeline-icon"><i
                                                            class="far fa-clock"></i></div>
                                                    <div class="timeline-text">
                                                        <h6>Kepala Dinas</h6>
                                                        <p>Berkas Masih Diproses</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-timeline-area">
                                        <div class="timeline-date wow fadeInLeft" data-wow-delay="0.1s"
                                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                            <p>---</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="single-timeline-content d-flex wow fadeInLeft"
                                                    data-wow-delay="0.3s"
                                                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                    <div class="timeline-icon timeline-icon"><i
                                                            class="far fa-clock"></i></div>
                                                    <div class="timeline-text">
                                                        <h6>Unduh Berkas</h6>
                                                        <p>Berkas Masih Diproses</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal-timeline">Close</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>

@endsection

{{-- Style Disini --}}
@push('style')
<style>
    .timeline_area {
        position: relative;
        z-index: 1;
    }

    .single-timeline-area {
        position: relative;
        z-index: 1;
        padding-left: 180px;
    }

    @media only screen and (max-width: 575px) {
        .single-timeline-area {
            padding-left: 100px;
        }
    }

    .single-timeline-area .timeline-date {
        position: absolute;
        width: 180px;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 1;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -ms-grid-row-align: center;
        align-items: center;
        -webkit-box-pack: end;
        -ms-flex-pack: end;
        justify-content: flex-end;
        padding-right: 60px;
    }

    @media only screen and (max-width: 575px) {
        .single-timeline-area .timeline-date {
            width: 100px;
        }
    }

    .single-timeline-area .timeline-date::after {
        position: absolute;
        width: 3px;
        height: 100%;
        content: "";
        background-color: #ebebeb;
        top: 0;
        right: 30px;
        z-index: 1;
    }

    .single-timeline-area .timeline-date::before {
        position: absolute;
        width: 11px;
        height: 11px;
        border-radius: 50%;
        background-color: #f1c40f;
        content: "";
        top: 50%;
        right: 26px;
        z-index: 5;
        margin-top: -5.5px;
    }

    .single-timeline-area .timeline-date p {
        margin-bottom: 0;
        color: #020710;
        font-size: 13px;
        text-transform: uppercase;
        font-weight: 500;
    }

    .single-timeline-area .single-timeline-content {
        position: relative;
        z-index: 1;
        padding: 30px 30px 25px;
        border-radius: 6px;
        margin-bottom: 15px;
        margin-top: 15px;
        -webkit-box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
        box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
        border: 1px solid #ebebeb;
    }

    @media only screen and (max-width: 575px) {
        .single-timeline-area .single-timeline-content {
            padding: 20px;
        }
    }

    .single-timeline-area .single-timeline-content .timeline-icon {
        -webkit-transition-duration: 500ms;
        transition-duration: 500ms;
        width: 30px;
        height: 30px;
        background-color: #f1c40f;
        -webkit-box-flex: 0;
        -ms-flex: 0 0 30px;
        flex: 0 0 30px;
        text-align: center;
        max-width: 30px;
        border-radius: 50%;
        margin-right: 15px;
    }

    .timeline-icon-reject {
        background-color: #f10f0f !important;
    }

    .timeline-icon-accept {
        background-color: #35f10f !important;
    }

    .single-timeline-area .timeline-date-reject::before {
        background-color: #f10f0f !important;
    }

    .single-timeline-area .timeline-date-accept::before {
        background-color: #35f10f !important;
    }

    .single-timeline-area .single-timeline-content .timeline-icon i {
        color: #ffffff;
        line-height: 30px;
    }

    .single-timeline-area .single-timeline-content .timeline-text h6 {
        -webkit-transition-duration: 500ms;
        transition-duration: 500ms;
    }

    .single-timeline-area .single-timeline-content .timeline-text p {
        font-size: 13px;
        margin-bottom: 0;
    }

    .single-timeline-area .single-timeline-content:hover .timeline-icon,
    .single-timeline-area .single-timeline-content:focus .timeline-icon {
        background-color: #020710;
    }

    .single-timeline-area .single-timeline-content:hover .timeline-text h6,
    .single-timeline-area .single-timeline-content:focus .timeline-text h6 {
        color: #3f43fd;
    }

    .notification {
        background-color: #5165ff;
        border-color: #5165ff;
        border-radius: 10px;
    }

    .intro-1 {
        font-size: 20px
    }

    .close {
        color: #fff
    }

    .close:hover {
        color: #fff
    }

    .intro-2 {
        font-size: 13px
    }

    .btn-notification {
        color: #5165ff;
        background-color: #fffaff;
        border-color: #fffaff;
        padding: 12px;
        font-weight: 700;
        border-radius: 10px;
        padding-right: 20px;
        padding-left: 20px
    }

</style>
@endpush

{{-- Script Disini --}}
@push('script')
<script>
    $(function () {
        var table = $('.yajra-datatable').DataTable({
            fixedColumns: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('usulan-kenaikan-gaji.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'tahun',
                    name: 'tahun'
                },
                {
                    data: 'daftarBerkas',
                    name: 'daftarBerkas'
                },
                {
                    data: 'status',
                    name: 'status',
                    class: 'text-center'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true,
                    class: 'text-center'
                },
            ]
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '.hapusData', function () {
            var id = $(this).data('id');
            swal({
                title: 'Anda Yakin?',
                text: "Data yang sudah dihapus tidak dapat dikembalikan lagi",
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
                    $.ajax({
                        type: "DELETE",
                        url: "master-jabatan-fungsional" + '/' + id,
                        dataType: 'json',
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
                                table.draw();
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

        });
    });

</script>

<script>
    $('.close-modal').click(function () {
        $('#modal-timeline').modal('hide');
    })

    $(document).on('click', '.lihatTimeline', function () {
        var id = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: "get-timeline-usulan-kenaikan-gaji",
            dataType: 'json',
            data: {
                id: id
            },
            success: function (data) {
                if (data.res == 'success') {
                    $('#body-timeline').empty();
                    $('#body-timeline').append(data.html);
                    $('#modal-timeline').modal('show');
                } else {

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
    })

</script>

<script>
    $(document).ready(function () {
        $('.nav-usulan-kenaikan-gaji').addClass('active');
    })

</script>
@endpush
