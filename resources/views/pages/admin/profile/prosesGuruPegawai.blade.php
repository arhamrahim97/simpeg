@extends('templates.dashboard')

@section('title')
Konfirmasi Profil
@endsection

@section('content')


<div class="row">
    <div class="col-lg-4 col-12">       
        <table class="table mt-3">
            <tbody>
                <tr>
                    <th width="210">Nama Lengkap :</th>                    
                    <td>{{$profile->nama}}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin :</th>
                    <td>{{$profile->jenis_kelamin}}</td>
                </tr>
                <tr>
                    <th>Tempat, Tanggal Lahir :</th>
                    <td>{{$profile->tempat_lahir}}, {{ date( 'd F Y', strtotime($profile->tanggal_lahir))}}</td>
                </tr>
                <tr> 
                    <th>No. Hp/WA : </th>
                    <td>{{$profile->no_hp}}</td>
                </tr>
                <tr> 
                    <th>Email : </th>
                    <td>{{$profile->email}}</td>
                </tr>
                <tr> 
                    <th>Alamat : </th>
                    <td>{{$profile->alamat}}</td>
                </tr>
                <tr> 
                    <th>Pendidikan Terakhir : </th>
                    <td>{{$profile->pendidikan_terakhir}}</td>
                </tr>            
            </tbody>
        </table>
    </div>
    <div class="col-lg-4 col-12">       
        <table class="table mt-3">
            <tbody>
                <tr>
                    <th>Jenis ASN : </th>
                    <td>{{$profile->jenis_asn}}</td>
                </tr>    
                <tr class="@if ($profile->jenis_asn == 'Pegawai')
                    d-none
                @endif">
                    <th>Jenis Guru : </th>
                    <td>{{$profile->jenis_guru}}</td>
                </tr>               
                <tr>
                    <th>NIP : </th>
                    <td>{{$profile->nip}}</td>
                </tr>
                <tr>
                    <th>NUPTK : </th>                    
                    <td>@if ($profile->nuptk)
                        {{$profile->nuptk}}
                    @else
                        -
                    @endif</td>
                </tr>
                <tr>
                    <th>Unit Kerja :</th>
                    <td>{{$profile->unitKerja->nama}}</td>
                </tr>
                <tr>
                    <th>Status :</th>
                    <td>{{$profile->status}}</td>
                </tr>
                <tr>
                    <th>Jabatan / Golongan :</th>
                    @if ($profile->jabatan_pangkat_golongan)
                        <td>{{ $jabatan->jabatan }} / {{ $jabatan->golongan }}</td>
                    @else
                        <td>-</td>
                    @endif
                </tr>
                <tr>
                    <th>Tanggal Awal Kerja :</th>
                    <td>{{ date( 'd F Y', strtotime($profile->tanggal_kerja))}}</td>
                </tr>
            <tbody>
        </table>
    </div>
    <div class="col-lg-4 col-12">       
        <table class="table mt-3">
            <tbody>
                <tr>
                    <th>Gaji Terakhir :</th>
                    <td>{{"Rp " . number_format($profile->nilai_gaji,0,',','.');}}</td>
                </tr>
                <tr>
                    <th>TMT Gaji Berkala : </th>
                    <td>{{date("d F Y", strtotime($profile->tmt_gaji))}}</td>
                </tr>    
                <tr>
                    <th>TMT Pangkat : </th>
                    <td>{{date("d F Y", strtotime($profile->tmt_pangkat))}}</td>
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
            <tbody>
        </table>
        <div class="input-file input-file-image text-center">
            <img class="img-upload-preview img-circle" src="{{ old('foto', '/storage/upload/foto-profil/'.$profile->foto) }}" alt="preview" width="150" height="150">
            <input type="file" class="form-control form-control-file" id="foto" name="foto" accept="image/*">                                       
        </div> 
    </div>   
</div>
<div class="row">
    <div class="col-lg-4 col-12">        
        <form action="{{ route('konfirmasi-profile-guru-pegawai', $profile->id) }}" method="POST" id="form-proses">
            @csrf
            @method('PUT')
            <h4 class="page-title mt-4">Proses Profil</h4>
            <div>
                <label for="exampleInputEmail1" class="form-label">Konfirmasi Profil</label>
                <select class="form-control form-select form-select-lg mb-3 col-lg-12" aria-label=".form-select-lg example" id="konfirmasi-profile" name="status_profile" required="">
                    <option value="" selected="">Pilih Status Konfirmasi</option>
                    <option value="1" @if ($profile->status_profile == '1') selected @endif >Setuju</option>
                    <option value="2" @if ($profile->status_profile == '2') selected @endif >Tolak</option>
                </select>
            </div>

            <div id="form-alasan-ditolak" @if($profile->status_profile != 2)
                style="display: none;  
            @endif ">
                <label for="exampleFormControlTextarea1" class="form-label">Alasan Ditolak</label>
                <textarea class="form-control" required="" name="alasan_profile" id="alasan-ditolak">@if ($profile->status_profile == '2') {{ $profile->alasan_profile }} @else  @endif</textarea>
            </div>

            <div class="div d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Proses Profil</button>
            </div>
        </form>                                    
    </div>
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
        @if($profile->status_profile != 2)
        $('#konfirmasi-profile').change();
        @endif
    })

</script>

<script>
    $('#konfirmasi-profile').change(function () {
        var konfirmasi_berkas = $('#konfirmasi-profile').val();
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
@endpush
