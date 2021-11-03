@extends('templates.dashboard')

@section('title')
Edit Akun
@endsection

@section('content')

<form method="POST" id="formSubmit" enctype="multipart/form-data" action="{{ route('user.update_akun_pejabat', $user->id) }}">
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
            <div class="form-group @error('jenis_kelamin') has-error @enderror">
                <label>Jenis Kelamin :</label>
                <div class="select2-input">
                    <select class="form-control select2" name="jenis_kelamin">
                        <option value="">- Pilih Salah Satu -</option>	
                        <option value="Laki-laki" @if (old('jenis_kelamin',  $user->profilePejabat->jenis_kelamin) == 'Laki-laki') selected @endif >Laki-laki</option>		
                        <option value="Perempuan" @if (old('jenis_kelamin',  $user->profilePejabat->jenis_kelamin) == 'Perempuan') selected @endif>Perempuan</option>		
                    </select>
                    @error('jenis_kelamin')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="form-group py-0 @error('tempat_lahir') has-error @enderror">
                        <label>Tempat Lahir : </label>
                        <input name="tempat_lahir" type="text" class="form-control" id="tempat_lahir" placeholder="Masukkan Tempat Lahir" value="{{ old('tempat_lahir', $user->profilePejabat->tempat_lahir) }}" >
                        @error('tempat_lahir')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group py-0 @error('tanggal_lahir') has-error @enderror">
                        <label>Tanggal Lahir (contoh: <span style="color: seagreen">01-01-1991</span>) : </label>
                        <input name="tanggal_lahir" type="text" class="form-control tanggal" id="tanggal_lahir" placeholder="Masukkan Tanggal Lahir" value="{{ old('tanggal_lahir', date('d-m-Y', strtotime($user->profilePejabat->tanggal_lahir))) }}">
                        @error('tanggal_lahir')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group @error('no_hp') has-error @enderror">
                <label>Nomor HP (Wa Aktif) :</label>
                <input name="no_hp" id="no_hp" type="text" class="form-control" placeholder="Masukkan Nomor HP" value="{{ old('no_hp', $user->profilePejabat->no_hp) }}">
                @error('no_hp')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group @error('email') has-error @enderror">
                <label>Email :</label>
                <input name="email" id="email" type="text" class="form-control" placeholder="Masukkan Email" value="{{ old('email', $user->profilePejabat->email) }}">
                @error('email')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group @error('alamat') has-error @enderror">
                <label>Alamat :</label>
                <textarea name="alamat" class="form-control" rows="4" placeholder="Masukkan Alamat">{{ old('alamat', $user->profilePejabat->alamat) }}</textarea>
                @error('alamat')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>                       
        </div>
        <div class="col-12 col-md-12 col-lg-6">
            <div class="form-group @error('nip') has-error @enderror">
                <label>NIP :</label>
                <input name="nip" id="nip" type="text" class="form-control" placeholder="Masukkan NIP" value="{{ old('nip', $user->profilePejabat->nip) }}">
                @error('nip')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group @error('jabatan_pangkat_golongan') has-error @enderror">
                <label>Jabatan - Golongan - Pangkat :</label>
                <select class="form-control select2" name="jabatan_pangkat_golongan" id="jabatan_pangkat_golongan">
                    <option value=""> - Pilih Salah Satu -</option>
                    @forelse ($jabatanGolonganPangkat as $row)
                        @if (old('jabatan_pangkat_golongan', $user->profilePejabat->jabatan_pangkat_golongan) == $row->id)
                            <option value="{{ $row->id }}" selected>{{ $row->jabatan }} - {{ $row->golongan }} - {{ $row->pangkat }}</option>  
                        @else
                            <option value="{{ $row->id }}">{{ $row->jabatan }} - {{ $row->golongan }} - {{ $row->pangkat }}</option>  
                        @endif
                    @empty
                        <option value="">Tidak ada data</option>                
                    @endforelse
                </select>
                @error('jabatan_pangkat_golongan')
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
            <div class="form-group @error('password_text') has-error @enderror">
                <label>Password :</label>
                <input name="password_text" id="password_text" type="password" class="form-control" placeholder="Masukkan Password" value="{{ old('password_text', $user->password) }}">
                @error('password_text')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
                <div class="form-check pt-1 px-0 m-0 d-none" id="showPassDiv">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="showPass">
                        <span class="form-check-sign">Lihat Password</span>
                    </label>
                </div>
            </div>           
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="form-group @error('foto_ttd') has-error @enderror">
                        <label>Foto TTD <span style="color: red">(Max: 1MB | Format: PNG)</span> : </label>
                        <div class="input-file input-file-image">
                            <div class="row">							
                                <div class="col-lg-6 col-md-9 col-sm-8">
                                    <div class="input-file input-file-image">
                                        <img class="img-upload-preview img-circle" src="{{ old('foto_ttd', '/storage/upload/foto-ttd/'.$user->profilePejabat->foto_ttd) }}" alt="preview" width="150" height="150">
                                        <input type="file" class="form-control form-control-file" id="foto_ttd" name="foto_ttd" accept="image/*" value="{{ old('foto') }}">
                                        <label for="foto_ttd" class="btn btn-primary btn-sm btn-round btn-lg"><i class="fa fa-file-image"></i> Pilih Gambar</label>
                                        @error('foto_ttd')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="form-group @error('foto') has-error @enderror">
                        <label>Foto Profile <span style="color: red">(Max: 1MB)</span> : </label>
                        <div class="input-file input-file-image">
                            <div class="row">							
                                <div class="col-lg-6 col-md-9 col-sm-8">
                                    <div class="input-file input-file-image">
                                        <img class="img-upload-preview img-circle" src="{{ old('foto', '/storage/upload/foto-profil/'.$user->profilePejabat->foto) }}" alt="preview" width="150" height="150">
                                        <input type="file" class="form-control form-control-file" id="foto" name="foto" accept="image/*" value="{{ old('foto') }}">
                                        <label for="foto" class="btn btn-primary btn-sm btn-round btn-lg"><i class="fa fa-file-image"></i> Pilih Gambar</label>
                                        @error('foto')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group float-right">
                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    </div>
                </div>

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

	$('.tanggal').mask('00-00-0000');
	$('#no_hp').mask('000000000000');
	$('#nip').mask('000000000000000000');
	// $('#nuptk').mask('0000000000000000');
	// $('.lama_kerja').mask('00');
	// $('.rupiah').mask('000.000.000.000', {reverse: true});
</script>
@endpush
