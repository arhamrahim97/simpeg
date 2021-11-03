@extends('templates.dashboard')

@section('title')
Edit Akun
@endsection

@section('content')

<form method="POST" id="formSubmit" enctype="multipart/form-data" action="/user/{{ $user->id }}">
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
            <div class="form-group mb-2 @error('password_text') has-error @enderror">
                <label>Password :</label>
                <input name="password_text" id="password_text" type="password" class="form-control" placeholder="Masukkan Password" value="{{ old('password_text', $user->password) }}">
                @error('password_text')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
                <div class="form-check pt-1 px-0 m-0 pb-0 d-none" id="showPassDiv">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="showPass">
                        <span class="form-check-sign">Lihat Password</span>
                    </label>
                </div>
            </div>

            <div class="form-group float-right @if ($user->role != "Admin")
                d-none
            @endif">
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-6">           
            <div class="form-group @if ($user->role == 'Admin') d-none @endif @error('role') has-error @enderror">
                <label>Role :</label>
                @if ($user->role == 'Guru' || $user->role == 'Pegawai')
                <select class="form-control" name="role" id="role">
                    <option value="">- Pilih Salah Satu -</option>
                    <option value="Guru" @if (old('role', $user->role) == 'Guru') selected @endif>Guru</option>
                    <option value="Pegawai" @if (old('role', $user->role) == 'Pegawai') selected @endif>Pegawai</option>                    
                </select>
                @else
                <select class="form-control" name="role">
                    <option value="Tim Penilai" @if (old('role', $user->role) == 'Tim Penilai') selected @endif>Tim Penilai</option>
                    <option value="Admin Kepegawaian" @if (old('role', $user->role) == 'Admin Kepegawaian') selected @endif>Admin Kepegawaian</option>                    
                    <option value="KASUBAG Kepegawaian dan Umum" @if (old('role', $user->role) == 'KASUBAG Kepegawaian dan Umum') selected @endif>KASUBAG Kepegawaian dan Umum</option>                    
                    <option value="Sekretaris" @if (old('role', $user->role) == 'Sekretaris') selected @endif>Sekretaris</option>                    
                    <option value="Kepala Dinas" @if (old('role', $user->role) == 'Kepala Dinas') selected @endif>Kepala Dinas</option>                                            
                </select>                
                @endif
                @error('role')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group @if ($user->role == 'Admin') d-none @endif @error('status') has-error @enderror w-100">
                <label>Status :</label>
                <select class="form-control" name="status">
                    <option value="">- Pilih Salah Satu -</option>
                    <option value="1" @if (old('status', $user->status) == '1') selected @endif>Aktif</option>
                    <option value="2" @if (old('status', $user->status) == '2') selected @endif>Tidak Aktif</option>                    
                </select>
                @error('status')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>        					             
            <div class="form-group float-right @if ($user->role == "Admin")
                d-none
            @endif">
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

    $('#role').change(function(){
        swal({
            title: 'Perhatian',
            text: 'Mengubah Role akan membuat Jabatan/Golongan/Pangkat di akun terkait dihapus. Silahkan memilih kembali Jabatan/Golongan/Pangkat pada akun terkait di menu Profil -> Guru/Pegawai.',
            icon: 'warning',
            buttons: {
                confirm: {
                    className: 'btn btn-success'
                }
            }
        });
    })   

    // $('select').select2({
    //     theme: "bootstrap"
    // })	

    $('#password_text').click(function(){
        $('#password_text').val('')
        $('#showPassDiv').removeClass('d-none')
    })
</script>
@endpush
