@extends('templates.dashboard')

@section('title')
Edit Proses Berkas
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

        <form action="{{route('proses-usulan-kenaikan-gaji-admin-kepegawaian.update',$usulanGaji->id)}}" method="POST">
            @csrf
            @method('PUT')
            <h4 class="page-title mt-4">Proses Berkas</h4>

            <div>
                <label>Nilai Gaji Usulan (Rp) :</label>
                <input name="gaji_selanjutnya" type="text" class="form-control rupiah"
                    placeholder="Masukkan Nilai Gaji Usulan" required value="{{$usulanGaji->nilai_gaji_selanjutnya}}">
            </div>

            <div class="mt-4">
                <label>TMT Gaji Selanjutnya (contoh: <span style="color: seagreen">01-01-2021</span>) :</label>
                <input name="tmt_gaji_selanjutnya" type="text" class="form-control tanggal"
                    placeholder="Masukkan TMT Gaji Selanjutnya" required
                    value="{{date("d-m-Y", strtotime($usulanGaji->tmt_gaji_selanjutnya))}}">
            </div>

            <div>
                <label for="exampleInputEmail1" class="form-label mt-4">Konfirmasi Berkas</label>
                <select class="form-select form-select-lg mb-3 col-lg-12" aria-label=".form-select-lg example"
                    id="konfirmasi-berkas" name="konfirmasi_berkas" required>
                    <option value="" selected>Pilih Status Konfirmasi</option>
                    <option value="1" @if ($usulanGaji->status_kepegawaian == 1) {{ 'selected' }} @endif>Setuju
                    </option>
                    <option value="2" @if ($usulanGaji->status_kepegawaian == 2) {{ 'selected' }} @endif>Tolak
                    </option>
                </select>
            </div>

            <div id="form-alasan-ditolak">
                <label for="exampleFormControlTextarea1" class="form-label">Alasan Ditolak</label>
                <textarea class="form-control" id="alasan-ditolak" name="alasan_ditolak"
                    required>{{$usulanGaji->alasan_tolak_kepegawaian}}</textarea>
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

</script> --}}


@endpush
