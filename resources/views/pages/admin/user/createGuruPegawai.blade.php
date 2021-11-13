@extends('templates.dashboard')

@section('title')
Tambah Akun Guru atau Pegawai
@endsection

@section('content')
<a type="button" class="btn btn-primary mb-1 text-white" data-toggle="modal" data-target="#importExcel">Impor Excel</a>
<form method="POST" id="formSubmit" enctype="multipart/form-data" action="/user">
    @csrf         
    <div class="row">										
        <div class="col-12 col-md-12 col-lg-6">
            <input type="hidden" name="createAkun" value="1">
            <div class="form-group @error('nama') has-error @enderror">
                <label>Nama Lengkap :</label>
                <input name="nama" type="text" class="form-control" placeholder="Masukkan Nama Lengkap" value="{{ old('nama') }}">
                @error('nama')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div> 
            <div class="form-group @error('status_kepegawaian') has-error @enderror" >
                <label>Status Kepegawaian:</label>                
                <select class="form-control" name="status_kepegawaian">
                    <option value="">- Pilih Salah Satu -</option>
                    <option value="GTY/PTY" @if (old('status_kepegawaian') == 'GTY/PTY') selected @endif>GTY/PTY</option>
                    <option value="Guru Honor Sekolah" @if (old('status_kepegawaian') == 'Guru Honor Sekolah') selected @endif>Guru Honor Sekolah</option>
                    <option value="Honor Daerah TK.I Provinsi" @if (old('status_kepegawaian') == 'Honor Daerah TK.I Provinsi') selected @endif>Honor Daerah TK.I Provinsi</option>
                    <option value="Honor Daerah TK.II Kab/Kota" @if (old('status_kepegawaian') == 'Honor Daerah TK.II Kab/Kota') selected @endif>Honor Daerah TK.II Kab/Kota</option>
                    <option value="PNS" @if (old('status_kepegawaian') == 'PNS') selected @endif>PNS</option>
                    <option value="PNS Depag" @if (old('status_kepegawaian') == 'PNS Depag') selected @endif>PNS Depag</option>
                    <option value="PNS Diperbantukan" @if (old('status_kepegawaian') == 'PNS Diperbantukan') selected @endif>PNS Diperbantukan</option>
                    <option value="Tenaga Honor Sekolah" @if (old('status_kepegawaian') == 'Tenaga Honor Sekolah') selected @endif>Tenaga Honor Sekolah</option>
                    <option value="Lainnya" @if (old('status_kepegawaian') == 'Lainnya') selected @endif>Lainnya</option>
                </select>
                @error('status_kepegawaian')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group @error('jenis_guru') has-error @enderror" id="form-jenis-guru">
                <label>Jenis PTK : </label>                
                <select class="form-control" name="jenis_guru" id="jenis_guru">
                    <option value="">- Pilih Salah Satu -</option>
                    <option value="Guru BK" @if (old('jenis_guru') == 'Guru BK') selected @endif>Guru BK</option>
                    <option value="Guru Kelas" @if (old('jenis_guru') == 'Guru Kelas') selected @endif>Guru Kelas</option>
                    <option value="Guru Mapel" @if (old('jenis_guru') == 'Guru Mapel') selected @endif>Guru Mapel</option>
                    <option value="Guru Pendamping" @if (old('jenis_guru') == 'Guru Pendamping') selected @endif>Guru Pendamping</option>
                    <option value="Guru Pendamping Khusus" @if (old('jenis_guru') == 'Guru Pendamping Khusus') selected @endif>Guru Pendamping Khusus</option>
                    <option value="Guru Pengganti" @if (old('jenis_guru') == 'Guru Pengganti') selected @endif>Guru Pengganti</option>
                    <option value="Guru TIK" @if (old('jenis_guru') == 'Guru TIK') selected @endif>Guru TIK</option>
                    <option value="Instruktur" @if (old('jenis_guru') == 'Instruktur') selected @endif>Instruktur</option>
                    <option value="Kepala Sekolah" @if (old('jenis_guru') == 'Kepala Sekolah') selected @endif>Kepala Sekolah</option>
                    <option value="Kepala Sekolah" @if (old('jenis_guru') == 'Laboran') selected @endif>Laboran</option>
                    <option value="Penjaga Sekolah" @if (old('jenis_guru') == 'Penjaga Sekolah') selected @endif>Penjaga Sekolah</option>
                    <option value="Pesuruh/Office Boy" @if (old('jenis_guru') == 'Pesuruh/Office Boy') selected @endif>Pesuruh/Office Boy</option>
                    <option value="Petugas Keamanan" @if (old('jenis_guru') == 'Petugas Keamanan') selected @endif>Petugas Keamanan</option>
                    <option value="Tenaga Administrasi Sekolah" @if (old('jenis_guru') == 'Tenaga Administrasi Sekolah') selected @endif>Tenaga Administrasi Sekolah</option>
                    <option value="Tenaga Perpustakaan" @if (old('jenis_guru') == 'Tenaga Perpustakaan') selected @endif>Tenaga Perpustakaan</option>
                    <option value="Tukang Kebun" @if (old('jenis_guru') == 'Tukang Kebun') selected @endif>Tukang Kebun</option>
                    <option value="Tutor" @if (old('jenis_guru') == 'Tutor') selected @endif>Tutor</option>	
                    <option value="Lainnya" @if (old('jenis_guru') == 'Lainnya') selected @endif>Lainnya</option>
                </select>               
                @error('jenis_guru')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>   
        </div>
        <div class="col-12 col-md-12 col-lg-6">
            <div class="form-group @error('username') has-error @enderror">
                <label>Username :</label>
                <input name="username" id="username" type="text" class="form-control" placeholder="Masukkan Username" value="{{ old('username') }}">
                @error('username')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mb-0 @error('password_text') has-error @enderror">
                <label>Password :</label>
                <input name="password_text" id="password_text" type="password" class="form-control" placeholder="Masukkan Password" value="{{ old('password_text') }}">
                @error('password_text')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>     
            <div class="form-check py-0 px-3 m-0" id="showPassDiv">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="showPass">
                    <span class="form-check-sign">Lihat Password</span>
                </label>
            </div>                                      
            <div class="form-group @error('role') has-error @enderror">
                <label>Role :</label>
                <select class="form-control" name="role" id="role">
                    <option value="">- Pilih Salah Satu -</option>
                    <option value="Guru" @if (old('role') == 'Guru') selected @endif>Guru</option>
                    <option value="Pegawai" @if (old('role') == 'Pegawai') selected @endif>Pegawai</option>                                        
                </select>
                @error('role')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>            
            <div class="form-group @error('status') has-error @enderror">
                <label>Status :</label>
                <select class="form-control" name="status">
                    <option value="">- Pilih Salah Satu -</option>
                    <option value="1" @if (old('status') == '1') selected @endif>Aktif</option>
                    <option value="2" @if (old('status') == '2') selected @endif>Tidak Aktif</option>                    
                </select>
                @error('status')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div> 
            <div class="form-group float-right mt-5">
                <button type="submit" class="btn btn-primary float-right">Tambah</button>
            </div>          
        </div>
    </div>
</form>   

<!-- Import Excel -->
<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" action="/import-excel" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div>
                        <p style="color: red; text-decoration: bold; font-size: 13pt;" class="mb-0 pb-0">Perhatian !!!</p>
                        <p style="color: red; font-size: 11pt">Import File Sangat Beresiko. Mohon perhatikan ketentuan berikut sebelum impor file excel.</p>
                        <ol class="px-4">
                            <li class="mb-2">
                                <p class="pb-0 mb-0">Format file harus berupa file excel (.xlsx / .xls / .csv).</p>
                            </li>
                            <li class="mb-2">
                                <p class="pb-0 mb-0">Impor excel ini hanya diperuntukkan untuk data Guru dan Pegawai.</p>                                
                            </li>
                            <li class="mb-2">
                                <p class="pb-0 mb-0">Penulisan text judul harus sesuai seperti gambar berikut. Tidak boleh kurang ataupun lebih.</p>
                                <img src="/assets/dashboard/img/headerExcel2.png" alt="" width="500">
                            </li>
                            <li class="mb-2">
                                <p class="pb-0 mb-0">Contoh pengisian data Guru dan Pegawai seperti berikut. Nip boleh dikosongkan, username tidak boleh sama dengan username yang lain, dan Role hanya berupa kata "Guru" atau "Pegawai".</p>
                                <img src="/assets/dashboard/img/pengisianExcel2.png" alt="" width="500">
                            </li>
                            <li class="mb-2">
                                <p class="pb-0 mb-0">Apabila sebelumnya telah melakukan impor file excel dan ingin melakukan impor kembali, maka data guru atau pegawai yang di impor tidak boleh ada kesamaan dengan data yang sebelumnya telah di impor. Baik berupa nama, nip, maupun username.</p>
                            </li>
                            <li class="mb-2">
                                <p class="pb-0 mb-0">Apabila ada yang kurang di mengerti, silahkan untuk menghubungi pihak developer aplikasi ini.</p>
                            </li>    
                            <li class="mb-2">
                                <p class="pb-0 mb-0">Apabila sudah di mengerti, silahkan pilih file excel dibawah ini sesuai ketentuan yang telah disebutkan di atas dan kemudian klik tombol "Impor".</p>
                            </li>                            
                        </ol>
                    </div>
                    <div class="form-group pt-0">
                        <label>Pilih file excel</label>
                        <input type="file" class="form-control namaBerkas" id="file" aria-describedby="emailHelp"placeholder="Contoh : Kartu Pegawai" name="file" accept=".xlsx, .xls, .csv" required>
                        {{-- <input type="file" name="file" required="required"> --}}
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-sm btn-success">Impor</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

{{-- Style Disini --}}
@push('style')
<style>

</style>
@endpush

{{-- Script Disini --}}
@push('script')
<script>
    $(document).ready(function () {
        $('.nav-user').addClass('active');
        $('#showPass').click(function(){
            if($(this).prop("checked") == true){
                $('#password_text').attr('type', 'text');
            }
            else if($(this).prop("checked") == false){
                $('#password_text').attr('type', 'password');                            
            }
        });
    }) 

    $('select').select2({
        theme: "bootstrap"
    })	

	$('.tanggal').mask('00-00-0000');
	$('#no_hp').mask('000000000000');
	$('#nip').mask('000000000000000000');
	$('#nuptk').mask('0000000000000000');
	$('.lama_kerja').mask('00');
	$('.rupiah').mask('000.000.000.000', {reverse: true});
</script>
@endpush
