@extends('templates.dashboard')

@section('title')
Dashboard
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-lg">
            <div class="card-header">
                <div class="card-title fw-bold mb-0">Usulan Kenaikan Gaji</div>
            </div>
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        @if ($usulanGaji)
                        <div class="notification mb-3">
                            <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i> </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="text-center mt-2"> <img
                                            src="/assets/dashboard/img/illustration/illustration-11.png"
                                            class="img-fluid" width="300px"> </div>
                                </div>
                                <div class="col-md-8 align-self-center">
                                    <div class="text-white mt-4"> <span class="intro-1 fw-bold">Selamat, Anda
                                            Mendapatkan Usulan Kenaikan
                                            Gaji</span>
                                        <div class="mt-2"> <span class="intro-2">Silahkan Upload Berkas Sesuai
                                                Persyaratan yang Telah
                                                Ditentukan</span> </div>
                                        <div class="mt-4 mb-5"> <a class="btn btn-notification"
                                                href="{{route('usulan-kenaikan-gaji.create')}}">Upload Berkas<i
                                                    class="fa fa-cloud-download"></i></a> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif($berkasUsulanGaji)
                        <div class="shadow shadow-lg mb-3">
                            <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i> </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="text-center my-3"> <img src="/assets/dashboard/img/pdf.png"
                                            class="img-fluid" width="150px"> </div>
                                </div>
                                <div class="col-md-9 align-self-center">
                                    <div class="text-dark"> <span class="intro-1 fw-bold">Berkas Usulan Kenaikan
                                            Gaji</span>
                                        <div class="mt-2"> <span class="intro-2">{!!$statusGaji!!}</span> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <p class="text-center">Anda Belum Memiliki Usulan Kenaikan Gaji</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-lg">
            <div class="card-header">
                <div class="card-title fw-bold mb-0">Usulan Kenaikan Pangkat</div>
            </div>
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        @if ($usulanPangkat)
                        <div class="notification">
                            <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i> </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="text-center mt-2"> <img
                                            src="/assets/dashboard/img/illustration/illustration-12.png"
                                            class="img-fluid" width="300px"> </div>
                                </div>
                                <div class="col-md-8 align-self-center">
                                    <div class="text-white mt-4"> <span class="intro-1 fw-bold">Selamat, Anda
                                            Mendapatkan Usulan Kenaikan
                                            Pangkat</span>
                                        <div class="mt-2"> <span class="intro-2">Silahkan Upload Berkas Sesuai
                                                Persyaratan yang Telah
                                                Ditentukan</span> </div>
                                        <div class="mt-4 mb-5"> <a class="btn btn-notification"
                                                href="{{route('usulan-kenaikan-pangkat.create')}}">Upload Berkas<i
                                                    class="fa fa-cloud-download"></i></a> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif($berkasUsulanPangkat)
                        <div class="shadow shadow-lg mb-3">
                            <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i> </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="text-center my-3"> <img src="/assets/dashboard/img/pdf.png"
                                            class="img-fluid" width="150px"> </div>
                                </div>
                                <div class="col-md-9 align-self-center">
                                    <div class="text-dark"> <span class="intro-1 fw-bold">Berkas Usulan Kenaikan
                                            Pangkat</span>
                                        <div class="mt-2"> <span class="intro-2">{!!$statusPangkat!!}</span> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <p class="text-center">Anda Belum Memiliki Usulan Kenaikan Pangkat</p>
                        @endif
                    </div>
                </div>
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
    $(document).ready(function () {
        $('.nav-dashboard').addClass('active');
    })

</script>
<script>
    $(".table").DataTable();

</script>
@endpush
