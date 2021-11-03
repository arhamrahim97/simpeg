@extends('templates.dashboard')

@section('title')
Lihat Berkas
@endsection

@section('content')


<div class="row">
    <div class="col-xl-5">
        <table class="table">
            <tbody>
                <tr>
                    <th scope="row" width="40%">Nama : </th>
                    <td>{{$profile->nama}}</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">Jenis Kelamin : </th>
                    <td>{{$profile->jenis_kelamin}}</td>
                </tr>
                <tr> 
                    <th scope="row" width="40%">Pendidikan Terakhir : </th>
                    <td>{{$profile->pendidikan_terakhir}}</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">Jenis ASN : </th>
                    <td>{{$profile->jenis_asn}}</td>
                </tr>               
                <tr>
                    <th scope="row" width="40%">NIP : </th>
                    <td>{{$profile->nip}}</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">NUPTK : </th>                    
                    <td>@if ($profile->nuptk)
                        {{$profile->nuptk}}
                    @else
                        -
                    @endif</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">Unit Kerja : </th>
                    <td>{{$profile->unitKerja->nama}}</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">Jabatan/Golongan : </th>
                    <td>@if ($profile->jabatan_pangkat_golongan != 0)
                        {{ $jabatan->jabatan }} / {{ $jabatan->golongan }}
                    @else
                        -
                    @endif</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">Status : </th>
                    <td>{{$profile->status}}</td>
                </tr>
                <tr>
                    <th scope="row" width="40%">Gaji Terakhir : </th>
                    <td>{{"Rp " . number_format($profile->nilai_gaji,0,',','.');}}</td>
                </tr>
                {{-- <tr>
                    <th scope="row" width="40%">Lama Kerja : </th>
                    <td>{{$profile->jumlah_tahun_kerja}} Tahun {{$profile->jumlah_bulan_kerja}}
                        Bulan</td>
                </tr> --}}
                <tr>
                    <th scope="row" width="40%">TMT Gaji Berkala : </th>
                    <td>{{date("d-m-Y", strtotime($profile->tmt_gaji))}}</td>
                </tr>    
                <tr>
                    <th scope="row" width="40%">TMT Pangkat : </th>
                    <td>{{date("d-m-Y", strtotime($profile->tmt_pangkat))}}</td>
                </tr>     
                <tr>
                    <th scope="row" width="40%">Lama Kerja : </th>
                    <td>
                        @php
                            $tanggal_kerja = new DateTime($profile->tanggal_kerja);
                            $sekarang = new DateTime("today") ;
                            $thn = $sekarang->diff ($tanggal_kerja)->y;
                            $bln = $sekarang->diff($tanggal_kerja)->m;
                            echo $thn . " Tahun " . $bln . " Bulan ";                        
                        @endphp
                    </td>
                </tr>   
                
                
            </tbody>
        </table>

    </div>

    <div class="col-xl-7 col-sm-12 mb-5">        
        <div class="row gx-4">
            @foreach ($berkasDasar as $berkas)
            <div class="col-lg-4 mb-4">
                <a href="{{Storage::url('upload/berkas-dasar/' . $berkas->file)}}" class="text-decoration-none">
                    <div class="shadow text-decoration-none text-center rounded py-5 px-4"
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
        <div class="row">
            <div class="col-lg-12 col-12">        
                @if ($profile->status_berkas_dasar == 0)
                    <form action="{{route('data-berkas-dasar.update',$profile->id)}}" method="POST" id="form-proses">
                        @csrf
                        @method('PUT') 
                        <h4 class="page-title mt-4">Proses Berkas</h4>
                        <div>
                            <label for="exampleInputEmail1" class="form-label">Konfirmasi Berkas</label>
                            <select class="form-control form-select form-select-lg mb-3 col-lg-12" aria-label=".form-select-lg example" id="konfirmasi-berkas" name="status_berkas_dasar" required="">
                                <option value="" selected="">Pilih Status Konfirmasi</option>
                                <option value="1">Setuju</option>
                                <option value="2">Tolak</option>
                            </select>
                        </div>
            
                        <div id="form-alasan-ditolak" style="">
                            <label for="exampleFormControlTextarea1" class="form-label">Alasan Ditolak</label>
                            <textarea class="form-control" required="" name="alasan_berkas_dasar" id="alasan-ditolak"></textarea>
                        </div>
            
                        <div class="div d-flex justify-content-center mt-5">
                            <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Proses Berkas</button>
                        </div>
                    </form>                                    
                @else 
                    <h4 class="page-title">Info Konfirmasi</h4>
                    @if ($profile->status_berkas_dasar == 1)
                        <table class="table table-light">
                            <tbody>
                                <tr>
                                    <td>Tanggal Konfirmasi</td>
                                    <td>:</td>
                                    <td>{{ date('d-m-Y',strtotime($profile->konfirmasi_berkas_dasar)) }}</td>
                                </tr>
                                <tr>
                                    <td>Waktu Konfirmasi</td>
                                    <td>:</td>
                                    <td>{{ date('H:i',strtotime($profile->konfirmasi_berkas_dasar)) }}</td>
                                </tr>  
                                <tr>
                                    <td style="width: 190px">Status Konfirmasi</td>
                                    <td style="width: 2%"">:</td>
                                    <td><span class="badge badge-success p-2">Disetujui</span><a name="" id="btn-edit" class="btn btn-sm ml-2 shadow btn-success" href="#form-proses" role="button">Edit</a></td>
                                </tr>          
                            </tbody>
                        </table>
                    @else
                        <table class="table table-light">
                            <tbody>
                                <tr>
                                    <td>Tanggal Konfirmasi</td>
                                    <td>:</td>
                                    <td>{{ date('d-m-Y',strtotime($profile->konfirmasi_berkas_dasar)) }}</td>
                                </tr>
                                <tr>
                                    <td>Waktu Konfirmasi</td>
                                    <td>:</td>
                                    <td>{{ date('H:i',strtotime($profile->konfirmasi_berkas_dasar)) }}</td>
                                </tr>  
                                <tr>
                                    <td style="width: 190px">Status Konfirmasi</td>
                                    <td style="width: 2%"">:</td>
                                    <td><span class="badge badge-danger p-2">Ditolak</span> <a name="" id="btn-edit" class="btn btn-sm ml-2 shadow btn-success" href="#form-proses" role="button">Edit</a></td>
                                </tr>     
                                <tr>
                                    <td style="width: 190px">Alasan Ditolak</td>
                                    <td style="width: 2%"">:</td>
                                    <td>{{ $profile->alasan_berkas_dasar }}</td>
                                </tr>        
                            </tbody>
                        </table>
                    @endif
                    <form action="{{route('data-berkas-dasar.update',$profile->id)}}" method="POST" id="form-proses" class="d-none">
                        @csrf
                        @method('PUT') 
                        <h4 class="page-title mt-4">Proses Berkas</h4>
                        <div>
                            <label for="exampleInputEmail1" class="form-label">Konfirmasi Berkas</label>
                            <select class="form-control form-select form-select-lg mb-3 col-lg-12" aria-label=".form-select-lg example" id="konfirmasi-berkas" name="status_berkas_dasar" required="">
                                <option value="" selected="">Pilih Status Konfirmasi</option>
                                <option value="1">Setuju</option>
                                <option value="2">Tolak</option>
                            </select>
                        </div>
            
                        <div id="form-alasan-ditolak" style="">
                            <label for="exampleFormControlTextarea1" class="form-label">Alasan Ditolak</label>
                            <textarea class="form-control" required="" name="alasan_berkas_dasar" id="alasan-ditolak"></textarea>
                        </div>
            
                        <div class="div d-flex justify-content-center mt-5">
                            <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Proses Berkas</button>
                        </div>
                    </form>           
                @endif
            </div>
        </div>
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
        $('.nav-berkas-dasar').addClass('active');
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

    $('#btn-edit').click(function(){
        $('#form-proses').removeClass('d-none')
    })

</script>
@endpush
