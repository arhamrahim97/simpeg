@extends('components.dashboard.guru_pegawai.mainLengkapiData')

@section('content')
<div class="card">
	<div class="card-header py-4 text-center">
		<h3 class="wizard-title">Lengkapi <b>Profile</b> Anda</h3>
		<small>Silahkan lengkapi terlebih dahulu data diri anda</small>
	</div>
	<div class="card-body">
		<form action="{{ route('profile-guru-pegawai.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="formSubmit">
			@csrf
			<div class="row">										
				<div class="col-12 col-md-12 col-lg-6">
					<div class="form-group @error('nama') has-error @enderror">
						<label>Nama Lengkap :</label>
						<input name="nama" type="text" class="form-control" placeholder="Masukkan Nama Lengkap" value="{{ old('nama', Auth::user()->nama) }}">
						@error('nama')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @error('jenis_kelamin') has-error @enderror">
						<label>Jenis Kelamin :</label>
						<div class="select2-input">
							<select class="form-control select2" name="jenis_kelamin">
								<option value="">- Pilih Salah Satu -</option>									
								<option value="Laki-laki" @if (old('jenis_kelamin') == 'Laki-laki') selected @endif >Laki-laki</option>		
								<option value="Perempuan" @if (old('jenis_kelamin') == 'Perempuan') selected @endif>Perempuan</option>
								
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
								<input name="tempat_lahir" type="text" class="form-control" id="tempat_lahir" placeholder="Masukkan Tempat Lahir" value="{{ old('tempat_lahir') }}" >
								@error('tempat_lahir')
									<small class="form-text text-danger">{{ $message }}</small>
								@enderror
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group py-0 @error('tanggal_lahir') has-error @enderror">
								<label>Tanggal Lahir (contoh: <span style="color: seagreen">01-01-1991</span>) : </label>
								<input name="tanggal_lahir" type="text" class="form-control tanggal" id="tanggal_lahir" placeholder="Masukkan Tanggal Lahir" value="{{ old('tanggal_lahir') }}">
								@error('tanggal_lahir')
									<small class="form-text text-danger">{{ $message }}</small>
								@enderror
							</div>
						</div>
					</div>
					<div class="form-group @error('no_hp') has-error @enderror">
						<label>Nomor HP (Wa Aktif) :</label>
						<input name="no_hp" id="no_hp" type="text" class="form-control" placeholder="Masukkan Nomor HP" value="{{ old('no_hp') }}">
						@error('no_hp')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @error('email') has-error @enderror">
						<label>Email :</label>
						<input name="email" id="email" type="text" class="form-control" placeholder="Masukkan Email" value="{{ old('email') }}">
						@error('email')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @error('alamat') has-error @enderror">
						<label>Alamat :</label>
						<textarea name="alamat" class="form-control" rows="4" placeholder="Masukkan Alamat">{{ old('alamat') }}</textarea>
						@error('alamat')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @error('pendidikan_terakhir') has-error @enderror">
						<label>Pendidikan Terakhir :</label>
						<select class="form-control" name="pendidikan_terakhir">
							<option value="">- Pilih Salah Satu -</option>
							<option value="Tidak/Belum Sekolah" @if (old('pendidikan_terakhir') == 'Tidak/Belum Sekolah') selected @endif>Tidak/Belum Sekolah</option>
							<option value="Tidak Tamat SD/Sederajat" @if (old('pendidikan_terakhir') == 'Tidak Tamat SD/Sederajat') selected @endif>Tidak Tamat SD/Sederajat</option>
							<option value="Tamat SD/Sederajat" @if (old('pendidikan_terakhir') == 'Tamat SD/Sederajat') selected @endif>Tamat SD/Sederajat</option>
							<option value="SLTP/Sederajat" @if (old('pendidikan_terakhir') == 'SLTP/Sederajat') selected @endif>SLTP/Sederajat</option>
							<option value="SLTA/Sederajat" @if (old('pendidikan_terakhir') == 'SLTA/Sederajat') selected @endif>SLTA/Sederajat</option>
							<option value="Diploma I/II" @if (old('pendidikan_terakhir') == 'Diploma I/II') selected @endif>Diploma I/II</option>
							<option value="Akademi/Diploma III/Sarjana Muda" @if (old('pendidikan_terakhir') == 'Akademi/Diploma III/Sarjana Muda') selected @endif>Akademi/Diploma III/Sarjana Muda</option>
							<option value="Diploma IV/Strata I" @if (old('pendidikan_terakhir') == 'Diploma IV/Strata I') selected @endif>Diploma IV/Strata I</option>
							<option value="Strata II" @if (old('pendidikan_terakhir') == 'Strata II') selected @endif>Strata II</option>
							<option value="Strata III" @if (old('pendidikan_terakhir') == 'Strata III') selected @endif>Strata III
							</option>
						</select>
						@error('pendidikan_terakhir')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @error('jenis_asn') has-error @enderror">
						<label>Jenis ASN :</label>
						<select class="form-control" name="jenis_asn" id="jenis_asn" disabled>
							{{-- <select class="form-control" name="jenis_asn" onchange="jenis_asn1(this);" readonly> --}}
							<option value="">- Pilih Salah Satu -</option>										
							<option value="Guru" @if($role == 'Guru')
								selected
							@endif>Guru</option>
							<option value="Pegawai" @if($role == 'Pegawai')
								selected
							@endif>Pegawai</option>
						</select>
						@error('jenis_asn')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @if($role == 'Pegawai') d-none @else @error('jenis_guru') has-error @enderror  @endif" id="form-jenis-guru">
						<label>Jenis Guru : </label>
						<select class="form-control" name="jenis_guru" id="jenis_guru">
							<option value="">- Pilih Salah Satu -</option>
							<option value="Guru Kelas" @if (old('jenis_guru') == 'Guru Kelas') selected @endif>Guru Kelas</option>
							<option value="Guru Mata Pelajaran" @if (old('jenis_guru') == 'Guru Mata Pelajaran') selected @endif>Guru Mata Pelajaran</option>
							<option value="Guru Bimbingan dan Konseling" @if (old('jenis_guru') == 'Guru Bimbingan dan Konseling') selected @endif>Guru Bimbingan dan Konseling</option>
						</select>
						@error('jenis_guru')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @error('nip') has-error @enderror">
						<label>NIP <span style="color: red">(Tidak Wajib)</span> :</label>
						<input name="nip" id="nip" type="text" class="form-control" placeholder="Masukkan NIP" value="{{ old('nip', Auth::user()->nip) }}">
						@error('nip')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
				</div>
				<div class="col-12 col-md-12 col-lg-6">
					<div class="form-group @error('nuptk') has-error @enderror">
						<label>NUPTK @if($role == 'Pegawai')
							<span style="color: red">(Tidak Wajib)</span>
						@endif :</label>
						<input name="nuptk" type="text" class="form-control" id="nuptk" placeholder="Masukkan NUPTK" value="{{ old('nuptk') }}">
						@error('nuptk')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @error('unit_kerja') has-error @enderror">
						<label>Unit Kerja (Sekolah) :</label>
						<select class="form-control" name="unit_kerja">
							<option value="">- Pilih Salah Satu -</option>
							@forelse ($unit_kerja as $row)
								@if(old('unit_kerja') == $row->id)
									<option value="{{ $row->id }}" selected>{{ $row->nama }}</option>	
								@else
									<option value="{{ $row->id }}">{{ $row->nama }}</option>	
								@endif
							@empty
								<option value="">Tidak Ada Data</option>								
							@endforelse
						</select>
						@error('unit_kerja')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @error('status') has-error @enderror">
						<label>Status :</label>
						<select class="form-control" name="status">
							<option value="">- Pilih Salah Satu -</option>
							<option value="PNS" @if (old('status') == 'PNS') selected @endif>PNS</option>
							<option value="PKKK" @if (old('status') == 'PKKK') selected @endif>PKKK</option>
							<option value="Honorer" @if (old('status') == 'Honorer') selected @endif>Honorer</option>
						</select>
						@error('status')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @error('jabatan_pangkat_golongan') has-error @enderror">
						<label>Jabatan - Golongan - Pangkat :</label>
						<select class="form-control" name="jabatan_pangkat_golongan" id="jabatan_pangkat_golongan">
							<option value=""> - Pilih Salah Satu -</option>
							@forelse ($jabatanGolonganPangkat as $row)
								@if (old('jabatan_pangkat_golongan') == $row->id)
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
					<div class="form-group @error('tanggal_kerja') has-error @enderror">
						<label>Tanggal Awal Kerja (contoh: <span style="color: seagreen">01-12-2012</span>) : </label>
						<input name="tanggal_kerja" type="text" class="form-control tanggal" id="tanggal_kerja" placeholder="Masukkan Tanggal Awal Kerja" value="{{ old('tanggal_kerja') }}">
						@error('tanggal_kerja')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>											
					{{-- <div class="row">
						<div class="col-md-6">
							<div class="form-group @error('jumlah_tahun_kerja') has-error @enderror">
								<label>Lama Masa Kerja (Tahun) : </label>
								<input name="jumlah_tahun_kerja" type="text" class="form-control lama_kerja" id="jumlah_tahun_kerja" placeholder="Masukkan Jumlah Tahun" value="{{ old('jumlah_tahun_kerja') }}">
								@error('jumlah_tahun_kerja')
									<small class="form-text text-danger">{{ $message }}</small>
								@enderror
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group @error('jumlah_bulan_kerja') has-error @enderror">
								<label>Lama Masa Kerja (Bulan) : </label>
								<input name="jumlah_bulan_kerja" type="text" class="form-control lama_kerja" id="jumlah_bulan_kerja" placeholder="Masukkan Jumlah Bulan" value="{{ old('jumlah_bulan_kerja') }}">
								@error('jumlah_bulan_kerja')
									<small class="form-text text-danger">{{ $message }}</small>
								@enderror
							</div>
						</div>
					</div> --}}
					<div class="form-group @error('nilai_gaji') has-error @enderror">
						<label>Nilai Gaji Terakhir (Rp) :</label>
						<input name="nilai_gaji" type="text" class="form-control rupiah" placeholder="Masukkan Nilai Gaji Terakhir" value="{{ old('nilai_gaji') }}">
						@error('nilai_gaji')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @error('tmt_gaji') has-error @enderror">
						<label>TMT Gaji Berkala (contoh: <span style="color: seagreen">01-01-2021</span>) :</label>
						<input name="tmt_gaji" type="text" class="form-control tanggal" placeholder="Masukkan TMT Gaji Berkala" value="{{ old('tmt_gaji') }}">
						@error('tmt_gaji')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @error('tmt_pangkat') has-error @enderror">
						<label>TMT Kenaikan Pangkat (contoh: <span style="color: seagreen">01-01-2021</span>) :</label>
						<input name="tmt_pangkat" type="text" class="form-control tanggal" placeholder="Masukkan TMT Pangkat" value="{{ old('tmt_pangkat') }}">
						@error('tmt_pangkat')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @error('foto') has-error @enderror">
						<label>Foto Profile <span style="color: red">(Max: 1MB)</span> : </label>
						<div class="input-file input-file-image">
							<div class="row">							
								<div class="col-lg-6 col-md-9 col-sm-8">
									<div class="input-file input-file-image">
										<img class="img-upload-preview img-circle" src="{{ old('foto', '/assets/dashboard/img/blank_photo.png') }}" alt="preview" width="150" height="150">
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
				</div>
			</div>																	
			<div class="wizard-action pt-0">
				<div class="pull-right">
					<input type="submit" class="btn btn-next btn-danger" value="Simpan">										
				</div>
				<div class="clearfix"></div>
			</div>
		</form>										
	</div>
</div>														
@endsection
			
@section('script')
<script>
	$( "#formSubmit" ).submit(function() {
		$('#jenis_asn').removeAttr('disabled')
		$('.rupiah').unmask();
	});

	$('.tanggal').mask('00-00-0000');
	$('#no_hp').mask('000000000000');
	$('#nip').mask('000000000000000000');
	$('#nuptk').mask('0000000000000000');
	$('.lama_kerja').mask('00');
	$('.rupiah').mask('000.000.000.000', {reverse: true});
</script>
@endsection