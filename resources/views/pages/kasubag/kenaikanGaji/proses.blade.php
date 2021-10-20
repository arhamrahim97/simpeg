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
                    <td>SMP Negeri 1 Parigi</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">Status : </th>
                    <td>{{$user->profile->status}}</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">Gaji Terakhir : </th>
                    <td>{{"Rp " . number_format($user->profile->nilai_gaji,0,',','.');}}</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">Lama Kerja : </th>
                    <td>{{$user->profile->jumlah_tahun_kerja}} Tahun {{$user->profile->jumlah_bulan_kerja}} Bulan</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">TMT Gaji Berkala : </th>
                    <td>{{date("d-m-Y", strtotime($user->profile->tmt_gaji))}}</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">Nilai Usulan Gaji : </th>
                    <td>{{"Rp " . number_format($usulanGaji->nilai_gaji_selanjutnya,0,',','.');}}</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">TMT Gaji Selanjutnya : </th>
                    <td>{{date("d-m-Y", strtotime($usulanGaji->tmt_gaji_selanjutnya))}}</td>
                </tr>
            </tbody>
        </table>

    </div>

    <div class="col-xl-7 col-sm-12 mb-5">

        <h4 class="page-title">Berkas Dasar</h4>
        <div class="row gx-4">
            <div class="col-lg-4 mt-3">
                <a href="" class="text-decoration-none">
                    <div class="shadow-lg text-decoration-none text-center rounded shadow-sm py-5 px-4"
                        style="height: 200px">
                        <img src="/assets/dashboard/img/pdf.png" alt="" width="50" class="img-fluid">
                        <br>
                        <span class="small text-uppercase">
                            Kartu Pegawai
                        </span>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 mt-3">
                <a href="" class="text-decoration-none">
                    <div class="shadow-lg text-decoration-none text-center rounded shadow-sm py-5 px-4"
                        style="height: 200px">
                        <img src="/assets/dashboard/img/pdf.png" alt="" width="50" class="img-fluid">
                        <br>
                        <span class="small text-uppercase">
                            Kartu Tanda Penduduk
                        </span>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 mt-3">
                <a href="" class="text-decoration-none">
                    <div class="shadow-lg text-decoration-none text-center rounded shadow-sm py-5 px-4"
                        style="height: 200px">
                        <img src="/assets/dashboard/img/pdf.png" alt="" width="50" class="img-fluid">
                        <br>
                        <span class="small text-uppercase">
                            Kartu Keluarga
                        </span>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 mt-3">
                <a href="" class="text-decoration-none">
                    <div class="shadow-lg text-decoration-none text-center rounded shadow-sm py-5 px-4"
                        style="height: 200px">
                        <img src="/assets/dashboard/img/pdf.png" alt="" width="50" class="img-fluid">
                        <br>
                        <span class="small text-uppercase">
                            Ijazah Terakhir
                        </span>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 mt-3">
                <a href="" class="text-decoration-none">
                    <div class="shadow-lg text-decoration-none text-center rounded shadow-sm py-5 px-4"
                        style="height: 200px">
                        <img src="/assets/dashboard/img/pdf.png" alt="" width="50" class="img-fluid">
                        <br>
                        <span class="small text-uppercase">
                            SK CPNS
                        </span>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 mt-3">
                <a href="" class="text-decoration-none">
                    <div class="shadow-lg text-decoration-none text-center rounded shadow-sm py-5 px-4"
                        style="height: 200px">
                        <img src="/assets/dashboard/img/pdf.png" alt="" width="50" class="img-fluid">
                        <br>
                        <span class="small text-uppercase">
                            SK PNS
                        </span>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 mt-3">
                <a href="" class="text-decoration-none">
                    <div class="shadow-lg text-decoration-none text-center rounded shadow-sm py-5 px-4"
                        style="height: 200px">
                        <img src="/assets/dashboard/img/pdf.png" alt="" width="50" class="img-fluid">
                        <br>
                        <span class="small text-uppercase">
                            SK Kenaikan Gaji Berkala
                        </span>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 mt-3">
                <a href="" class="text-decoration-none">
                    <div class="shadow-lg text-decoration-none text-center rounded shadow-sm py-5 px-4"
                        style="height: 200px">
                        <img src="/assets/dashboard/img/pdf.png" alt="" width="50" class="img-fluid">
                        <br>
                        <span class="small text-uppercase">
                            SPMT
                        </span>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 mt-3">
                <a href="" class="text-decoration-none">
                    <div class="shadow-lg text-decoration-none text-center rounded shadow-sm py-5 px-4"
                        style="height: 200px">
                        <img src="/assets/dashboard/img/pdf.png" alt="" width="50" class="img-fluid">
                        <br>
                        <span class="small text-uppercase">
                            Kartu NUPTK
                        </span>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 mt-3">
                <a href="" class="text-decoration-none">
                    <div class="shadow-lg text-decoration-none text-center rounded shadow-sm py-5 px-4"
                        style="height: 200px">
                        <img src="/assets/dashboard/img/pdf.png" alt="" width="50" class="img-fluid">
                        <br>
                        <span class="small text-uppercase">
                            Sertifikasi Guru
                        </span>
                    </div>
                </a>
            </div>
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

        <form action="{{route('proses-usulan-kenaikan-gaji-kasubag.update',$usulanGaji->id)}}" method="POST"
            id="form-proses">
            @csrf
            @method('PUT')
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
                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Proses Berkas</button>
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
<!-- Jquery Mask -->
<script src="/assets/dashboard/js/plugin/jquery.mask/jquery.mask.min.js"></script>
<script>
    $(document).ready(function () {
        $('.nav-usulan-kenaikan-gaji').addClass('active');
        $('#konfirmasi-berkas').change();
    })

</script>

<script>
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

    $('.rupiah').mask('000.000.000.000', {
        reverse: true
    });
    $('.tanggal').mask('00-00-0000');

</script>
{{-- <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });

    CKEDITOR.replace('ckeditor', {
        removeButtons: 'Source,Image,Table,HorizontalRule,Anchor,Link,RemoveFormat,Indent,Blockquote,Styles,Format,About,SpecialChar'
    });

    $('#form-proses').submit(function () {
        CKEDITOR.instances.alasan_ditolak.updateElement();
    })

</script> --}}


@endpush
