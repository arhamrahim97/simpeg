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
            <div class="form-group  @if (!in_array($user->role, array('Guru', 'Pegawai'))) d-none
                @endif @error('status_kepegawaian') has-error @enderror" >
                <label>Status Kepegawaian:</label>
                <input type="hidden" id="old-status-kepegawaian" name="old_status_kepegawaian" value="{{ $user->status_kepegawaian }}">
                <select class="form-control" name="status_kepegawaian" id="status_kepegawaian">
                    {{-- <option value="">- Pilih Salah Satu -</option> --}}
                    <option value="GTY/PTY" @if (old('status', $user->status_kepegawaian) == 'GTY/PTY') selected @endif>GTY/PTY</option>
                    <option value="Guru Honor Sekolah" @if (old('status', $user->status_kepegawaian) == 'Guru Honor Sekolah') selected @endif>Guru Honor Sekolah</option>
                    <option value="Honor Daerah TK.I Provinsi" @if (old('status', $user->status_kepegawaian) == 'Honor Daerah TK.I Provinsi') selected @endif>Honor Daerah TK.I Provinsi</option>
                    <option value="Honor Daerah TK.II Kab/Kota" @if (old('status', $user->status_kepegawaian) == 'Honor Daerah TK.II Kab/Kota') selected @endif>Honor Daerah TK.II Kab/Kota</option>
                    <option value="PNS" @if (old('status', $user->status_kepegawaian) == 'PNS') selected @endif>PNS</option>
                    <option value="PNS Depag" @if (old('status', $user->status_kepegawaian) == 'PNS Depag') selected @endif>PNS Depag</option>
                    <option value="PNS Diperbantukan" @if (old('status', $user->status_kepegawaian) == 'PNS Diperbantukan') selected @endif>PNS Diperbantukan</option>
                    <option value="Tenaga honor lainnya" @if (old('status', $user->status_kepegawaian) == 'Tenaga honor lainnya') selected @endif>Tenaga honor lainnya</option>
                    <option value="Lainnya" @if (old('status', $user->status_kepegawaian) == 'Lainnya') selected @endif>Lainnya</option>
                </select>
                @error('status_kepegawaian')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group  @if (!in_array($user->role, array('Guru', 'Pegawai'))) d-none
                @endif @error('jenis_guru') has-error @enderror" id="form-jenis-guru">
                <label>Jenis PTK : </label>
                <input type="hidden" id="old-jenis-guru" value="{{ $user->jenis_guru }}">
                <select class="form-control" name="jenis_guru" id="jenis_guru">
                    {{-- <option value="">- Pilih Salah Satu -</option> --}}
                    <option value="Guru BK" @if (old('jenis_guru', $user->jenis_guru) == 'Guru BK') selected @endif>Guru BK</option>
                    <option value="Guru Kelas" @if (old('jenis_guru', $user->jenis_guru) == 'Guru Kelas') selected @endif>Guru Kelas</option>
                    <option value="Guru Mapel" @if (old('jenis_guru', $user->jenis_guru) == 'Guru Mapel') selected @endif>Guru Mapel</option>
                    <option value="Guru Pendamping" @if (old('jenis_guru', $user->jenis_guru) == 'Guru Pendamping') selected @endif>Guru Pendamping</option>
                    <option value="Guru Pendamping Khusus" @if (old('jenis_guru', $user->jenis_guru) == 'Guru Pendamping Khusus') selected @endif>Guru Pendamping Khusus</option>
                    <option value="Guru Pengganti" @if (old('jenis_guru', $user->jenis_guru) == 'Guru Pengganti') selected @endif>Guru Pengganti</option>
                    <option value="Guru TIK" @if (old('jenis_guru', $user->jenis_guru) == 'Guru TIK') selected @endif>Guru TIK</option>
                    <option value="Instruktur" @if (old('jenis_guru', $user->jenis_guru) == 'Instruktur') selected @endif>Instruktur</option>
                    <option value="Kepala Sekolah" @if (old('jenis_guru', $user->jenis_guru) == 'Kepala Sekolah') selected @endif>Kepala Sekolah</option>
                    <option value="Penjaga Sekolah" @if (old('jenis_guru', $user->jenis_guru) == 'Penjaga Sekolah') selected @endif>Penjaga Sekolah</option>
                    <option value="Pesuruh/Office Boy" @if (old('jenis_guru', $user->jenis_guru) == 'Pesuruh/Office Boy') selected @endif>Pesuruh/Office Boy</option>
                    <option value="Petugas Keamanan" @if (old('jenis_guru', $user->jenis_guru) == 'Petugas Keamanan') selected @endif>Petugas Keamanan</option>
                    <option value="Tenaga Administrasi Sekolah" @if (old('jenis_guru', $user->jenis_guru) == 'Tenaga Administrasi Sekolah') selected @endif>Tenaga Administrasi Sekolah</option>
                    <option value="Tenaga Perpustakaan" @if (old('jenis_guru', $user->jenis_guru) == 'Tenaga Perpustakaan') selected @endif>Tenaga Perpustakaan</option>
                    <option value="Tukang Kebun" @if (old('jenis_guru', $user->jenis_guru) == 'Tukang Kebun') selected @endif>Tukang Kebun</option>
                    <option value="Tutor" @if (old('jenis_guru', $user->jenis_guru) == 'Tutor') selected @endif>Tutor</option>	
                    <option value="Lainnya" @if (old('jenis_guru', $user->jenis_guru) == 'Lainnya') selected @endif>Lainnya</option>
                </select>                
                @error('jenis_guru')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>   
            <div class="form-group @if ($user->role == 'Admin') d-none @endif @error('role') has-error @enderror">
                <label>Role :</label>
                <input type="hidden" id="old-role" value="{{ $user->role }}">
                @if ($user->role == 'Guru' || $user->role == 'Pegawai')
                <select class="form-control" name="role" id="role">
                    {{-- <option value="">- Pilih Salah Satu -</option> --}}
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
        </div>
        <div class="col-12 col-md-12 col-lg-6">        
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
            <div class="form-group float-right @if ($user->role != "Admin")
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

    $('#role').change(function(e){        
        if($('#role').val() !== $('#old-role').val()){
            swal({
                title: 'Perhatian',
                text: 'Mengubah Role akan membuat Jabatan/Golongan/Pangkat di akun terkait dihapus. Silahkan memilih kembali Jabatan/Golongan/Pangkat pada akun terkait di menu Profil -> Guru/Pegawai.',
                icon: 'warning',
                buttons: {
                    confirm: {
                        className: 'btn btn-success',
                        text: 'Oke, Lanjutkan'
                    },
                    cancel: {
                        visible: true,
                        text: 'Batal',
                        className: 'btn btn-danger'
                    }
                }
            }).then((confirm) => {
                if (confirm) {
                    swal.close();
                } else {
                    $('#role').val($('#old-role').val())
                    swal.close();
                }
            });
                           
        }
    })   

    $('#status_kepegawaian').change(function(e){        
        // if($('#status_kepegawaian').val() !== $('#old-status-kepegawaian').val()){
            var arr = ['PNS', 'PNS Depag', 'PNS Diperbantukan'];
            if(($('#old-status-kepegawaian').val() == 'PNS') || ($('#old-status-kepegawaian').val() == 'PNS Depag') || ($('#old-status-kepegawaian').val() == 'PNS Diperbantukan')){
                if(jQuery.inArray($('#status_kepegawaian').val(), arr)  == -1){ // !=	
                    swal({
                        title: 'Perhatian',
                        text: 'Mengubah Status Kepegawaian ke Non PNS akan membuat berkas dasar pada akun terkait terhapus (jika ada)',
                        icon: 'warning',
                        buttons: {
                            confirm: {
                                className: 'btn btn-success',
                                text: 'Oke, Lanjutkan'
                            },
                            cancel: {
                                visible: true,
                                text: 'Batal',
                                className: 'btn btn-danger'
                            }
                        }
                    }).then((confirm) => {
                        if (confirm) {
                            swal.close();
                        } else {
                            $('#status_kepegawaian').val($('#old-status-kepegawaian').val())
                            swal.close();
                        }
                    });
                // }	
                }  
            }
            else{
                if(jQuery.inArray($('#status_kepegawaian').val(), arr)  !== -1){ // ==	
                    swal({
                        title: 'Perhatian',
                            text: 'Mengubah Status Kepegawaian ke PNS akan membuat akun terkait melengkapi profilnya kembali ketika login',                   
                        icon: 'warning',
                        buttons: {
                            confirm: {
                                className: 'btn btn-success',
                                text: 'Oke, Lanjutkan'
                            },
                            cancel: {
                                visible: true,
                                text: 'Batal',
                                className: 'btn btn-danger'
                            }
                        }
                    }).then((confirm) => {
                        if (confirm) {
                            swal.close();
                        } else {
                            $('#status_kepegawaian').val($('#old-status-kepegawaian').val())
                            swal.close();
                        }
                    });
                }	
                              
            }
            // if(($('#status_kepegawaian').val() == 'PNS') || ($('#status_kepegawaian').val() == 'PNS Dipag') || ($('#status_kepegawaian').val() == 'PNS Diperbantukan')){
            // }

            // else{
            //     if(jQuery.inArray($('#status_kepegawaian').val(), arr)  == 1){ // !=	
            //         swal({
            //             title: 'Perhatian',
            //             text: 'Mengubah Status Kepegawaian ke PNS akan membuat akun terkait melengkapi profilnya kembali ketika login',
            //             icon: 'warning',
            //             buttons: {
            //                 confirm: {
            //                     className: 'btn btn-success',
            //                     text: 'Oke, Lanjutkan'
            //                 },
            //                 cancel: {
            //                     visible: true,
            //                     text: 'Batal',
            //                     className: 'btn btn-danger'
            //                 }
            //             }
            //         }).then((confirm) => {
            //             if (confirm) {
            //                 swal.close();
            //             } else {
            //                 $('#status_kepegawaian').val($('#old-status-kepegawaian').val())
            //                 swal.close();
            //             }
            //         });
            //     }
            
            // }
                           
        
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
