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
            <div class="form-group @error('nama') has-error @enderror">
                <label>Nama Lengkap :</label>
                <input name="nama" type="text" class="form-control" placeholder="Masukkan Nama Lengkap" value="{{ old('nama') }}">
                @error('nama')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div> 
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
        </div>
        <div class="col-12 col-md-12 col-lg-6">
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
    <div class="modal-dialog" role="document">
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
                                <img src="/assets/dashboard/img/headerExcel.png" alt="" width="380">
                            </li>
                            <li class="mb-2">
                                <p class="pb-0 mb-0">Contoh pengisian data Guru dan Pegawai seperti berikut. Nip boleh dikosongkan, username tidak boleh sama dengan username yang lain, dan Role hanya berupa kata "Guru" atau "Pegawai".</p>
                                <img src="/assets/dashboard/img/pengisianExcel.png" alt="" width="380">
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
