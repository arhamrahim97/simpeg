@extends('templates.dashboard')

@section('title')
Edit Akun
@endsection

@section('content')

<form method="POST" id="formSubmit" enctype="multipart/form-data" action="{{ route('user.update_akun', $user->id) }}">
    @method('PUT')
    @csrf         
    <div class="row">										
        <div class="col-12 col-md-12 col-lg-6">
            <div class="form-group @error('nama') has-error @enderror">
                <label>Nama Lengkap :</label>
                <input name="nama" type="text" class="form-control" placeholder="Masukkan Nama Lengkap" value="{{ old('nama', $user->nama) }}">
                @error('nama')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div> 
            <div class="form-group @error('username') has-error @enderror">
                <label>Username :</label>
                <input name="username" id="username" type="text" class="form-control" placeholder="Masukkan Username" value="{{ old('username', $user->username) }}">
                @error('username')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mb-0 @error('password_text') has-error @enderror">
                <label>Password :</label>
                <input name="password_text" id="password_text" type="password" class="form-control" placeholder="Masukkan Password" value="{{ old('password_text', $user->password) }}">
                @error('password_text')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>     
            <div class="form-check py-0 px-3 m-0 d-none" id="showPassDiv">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="showPass">
                    <span class="form-check-sign">Lihat Password</span>
                </label>
            </div>                                      
            <div class="form-group float-right">
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </div>          
        </div>        
    </div>
</form>   

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
        // $('.nav-user').addClass('active');
        $('#showPass').click(function(){
            if($(this).prop("checked") == true){
                $('#password_text').attr('type', 'text');
            }
            else if($(this).prop("checked") == false){
                $('#password_text').attr('type', 'password');                            
            }
        });
    }) 

    $('#password_text').click(function(){
        $('#password_text').val('')
        $('#showPassDiv').removeClass('d-none')
    })

    // $('select').select2({
    //     theme: "bootstrap"
    // })	

	// $('.tanggal').mask('00-00-0000');
	// $('#no_hp').mask('000000000000');
	// $('#nip').mask('000000000000000000');
	// $('#nuptk').mask('0000000000000000');
	// $('.lama_kerja').mask('00');
	// $('.rupiah').mask('000.000.000.000', {reverse: true});
</script>
@endpush
