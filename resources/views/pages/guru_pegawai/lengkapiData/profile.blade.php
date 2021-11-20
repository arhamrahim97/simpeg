@extends('components.dashboard.guru_pegawai.mainLengkapiData')

@section('content')
<div class="card">
	<div class="card-header py-4 text-center">
		<h3 class="wizard-title">Lengkapi <b>Profil</b> Anda</h3>
		<small>Silahkan lengkapi data diri anda</small>
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
					<div class="form-group @error('nik') has-error @enderror">
						<label>NIK :</label>
						<input name="nik" id="nik" type="text" class="form-control" placeholder="Masukkan NIK" value="{{ old('nik') }}">
						@error('nik')
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
						<div class="col-md-6 col-md-12 col-lg-6">
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
						<label>Pendidikan :</label>
						<select class="form-control" name="pendidikan_terakhir">
							<option value="">- Pilih Salah Satu -</option>
							<option value="PAUD" @if (old('pendidikan_terakhir') == 'PAUD') selected @endif>PAUD</option>
							<option value="Paket B" @if (old('pendidikan_terakhir') == 'Paket B') selected @endif>Paket B</option>
							<option value="Paket C" @if (old('pendidikan_terakhir') == 'Paket C') selected @endif>Paket C</option>
							<option value="SD / Sederajat" @if (old('pendidikan_terakhir') == 'SD / Sederajat') selected @endif>SD / Sederajat</option>
							<option value="SMP / Sederajat" @if (old('pendidikan_terakhir') == 'SMP / Sederajat') selected @endif>SMP / Sederajat</option>
							<option value="SMA / Sederajat" @if (old('pendidikan_terakhir') == 'SMA / Sederajat') selected @endif>SMA / Sederajat</option>
							<option value="D1" @if (old('pendidikan_terakhir') == 'D1') selected @endif>D1</option>
							<option value="D2" @if (old('pendidikan_terakhir') == 'D2') selected @endif>D2</option>
							<option value="D3" @if (old('pendidikan_terakhir') == 'D3') selected @endif>D3</option>
							<option value="D4" @if (old('pendidikan_terakhir') == 'D4') selected @endif>D4</option>
							<option value="S1" @if (old('pendidikan_terakhir') == 'S1') selected @endif>S1</option>
							<option value="S2" @if (old('pendidikan_terakhir') == 'S2') selected @endif>S2</option>
							<option value="S3" @if (old('pendidikan_terakhir') == 'S3') selected @endif>S3</option>
							<option value="Lainnya" @if (old('pendidikan_terakhir') == 'Lainnya') selected @endif>Lainnya</option>
						</select>
						@error('pendidikan_terakhir')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @error('jenis_asn') has-error @enderror" disabled>
						<label>Jenis ASN :</label>
						<select class="form-control" name="jenis_asn" id="jenis_asn" disabled>
							<option value="">- Pilih Salah Satu -</option>					
							<option value="Guru" @if(Auth::user()->role == 'Guru')
								selected
							@endif>Guru</option>
							<option value="Pegawai" @if(Auth::user()->role == 'Pegawai')
								selected
							@endif>Pegawai (Non Guru)</option>
						</select>
						<small style="color: green"><i>* Hubungi admin untuk mengubah jenis asn (apabila tidak sesuai)</i></small>
						@error('jenis_asn')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @error('status') has-error @enderror">
						<input type="text" value="{{ Auth::user()->status_kepegawaian }}" id="cek_status" class="d-none">
						<label>Status Kepegawaian:</label>
						<select class="form-control" name="status" disabled>
							<option value="">- Pilih Salah Satu -</option>
							<option value="GTY/PTY" @if (old('status', Auth::user()->status_kepegawaian) == 'GTY/PTY') selected @endif>GTY/PTY</option>
							<option value="Guru Honor Sekolah" @if (old('status', Auth::user()->status_kepegawaian) == 'Guru Honor Sekolah') selected @endif>Guru Honor Sekolah</option>
							<option value="Honor Daerah TK.I Provinsi" @if (old('status', Auth::user()->status_kepegawaian) == 'Honor Daerah TK.I Provinsi') selected @endif>Honor Daerah TK.I Provinsi</option>
							<option value="Honor Daerah TK.II Kab/Kota" @if (old('status', Auth::user()->status_kepegawaian) == 'Honor Daerah TK.II Kab/Kota') selected @endif>Honor Daerah TK.II Kab/Kota</option>
							<option value="PNS" @if (old('status', Auth::user()->status_kepegawaian) == 'PNS') selected @endif>PNS</option>
							<option value="PNS Depag" @if (old('status', Auth::user()->status_kepegawaian) == 'PNS Depag') selected @endif>PNS Depag</option>
							<option value="PNS Diperbantukan" @if (old('status', Auth::user()->status_kepegawaian) == 'PNS Diperbantukan') selected @endif>PNS Diperbantukan</option>
							<option value="Tenaga Honor Sekolah" @if (old('status', Auth::user()->status_kepegawaian) == 'Tenaga Honor Sekolah') selected @endif>Tenaga Honor Sekolah</option>
							<option value="Lainnya" @if (old('status', Auth::user()->status_kepegawaian) == 'Lainnya') selected @endif>Lainnya</option>
						</select>
						<small style="color: green"><i>* Hubungi admin untuk mengubah status kepegawaian (apabila tidak sesuai)</i></small>
						@error('status')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @error('jenis_guru') has-error @enderror" id="form-jenis-guru">
						<label>Jenis PTK : </label>
						<select class="form-control" name="jenis_guru" id="jenis_guru" disabled>
							<option value="">- Pilih Salah Satu -</option>
							<option value="Guru BK" @if (old('jenis_guru', Auth::user()->jenis_guru) == 'Guru BK') selected @endif>Guru BK</option>
							<option value="Guru Kelas" @if (old('jenis_guru', Auth::user()->jenis_guru) == 'Guru Kelas') selected @endif>Guru Kelas</option>
							<option value="Guru Mapel" @if (old('jenis_guru', Auth::user()->jenis_guru) == 'Guru Mapel') selected @endif>Guru Mapel</option>
							<option value="Guru Pendamping" @if (old('jenis_guru', Auth::user()->jenis_guru) == 'Guru Pendamping') selected @endif>Guru Pendamping</option>
							<option value="Guru Pendamping Khusus" @if (old('jenis_guru', Auth::user()->jenis_guru) == 'Guru Pendamping Khusus') selected @endif>Guru Pendamping Khusus</option>
							<option value="Guru Pengganti" @if (old('jenis_guru', Auth::user()->jenis_guru) == 'Guru Pengganti') selected @endif>Guru Pengganti</option>
							<option value="Guru TIK" @if (old('jenis_guru', Auth::user()->jenis_guru) == 'Guru TIK') selected @endif>Guru TIK</option>
							<option value="Instruktur" @if (old('jenis_guru', Auth::user()->jenis_guru) == 'Instruktur') selected @endif>Instruktur</option>
							<option value="Kepala Sekolah" @if (old('jenis_guru', Auth::user()->jenis_guru) == 'Kepala Sekolah') selected @endif>Kepala Sekolah</option>
							<option value="Laboran" @if (old('jenis_guru', Auth::user()->jenis_guru) == 'Laboran') selected @endif>Laboran</option>
							<option value="Penjaga Sekolah" @if (old('jenis_guru', Auth::user()->jenis_guru) == 'Penjaga Sekolah') selected @endif>Penjaga Sekolah</option>
							<option value="Pesuruh/Office Boy" @if (old('jenis_guru', Auth::user()->jenis_guru) == 'Pesuruh/Office Boy') selected @endif>Pesuruh/Office Boy</option>
							<option value="Petugas Keamanan" @if (old('jenis_guru', Auth::user()->jenis_guru) == 'Petugas Keamanan') selected @endif>Petugas Keamanan</option>
							<option value="Tenaga Administrasi Sekolah" @if (old('jenis_guru', Auth::user()->jenis_guru) == 'Tenaga Administrasi Sekolah') selected @endif>Tenaga Administrasi Sekolah</option>
							<option value="Tenaga Perpustakaan" @if (old('jenis_guru', Auth::user()->jenis_guru) == 'Tenaga Perpustakaan') selected @endif>Tenaga Perpustakaan</option>
							<option value="Tukang Kebun" @if (old('jenis_guru', Auth::user()->jenis_guru) == 'Tukang Kebun') selected @endif>Tukang Kebun</option>
							<option value="Tutor" @if (old('jenis_guru', Auth::user()->jenis_guru) == 'Tutor') selected @endif>Tutor</option>	
							<option value="Lainnya" @if (old('jenis_guru', Auth::user()->jenis_guru) == 'Lainnya') selected @endif>Lainnya</option>
						</select>
						<small style="color: green"><i>* Hubungi admin untuk mengubah jenis ptk (apabila tidak sesuai)</i></small>
						@error('jenis_guru')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @error('bidang_studi') has-error @enderror">
						<label>Bidang Studi Pendidikan :</label>
						<select class="form-control" name="bidang_studi">
							<option value="">- Pilih Salah Satu -</option>
							<option value="Administrasi" @if (old('bidang_studi') == 'Administrasi') selected @endif>Administrasi</option>
							<option value="Administrasi dan Supervisi pendidikan" @if (old('bidang_studi') == 'Administrasi dan Supervisi pendidikan') selected @endif>Administrasi dan Supervisi pendidikan</option>
							<option value="Administrasi Negara" @if (old('bidang_studi') == 'Administrasi Negara') selected @endif>Administrasi Negara</option>
							<option value="Administrasi Pembangunan" @if (old('bidang_studi') == 'Administrasi Pembangunan') selected @endif>Administrasi Pembangunan</option>
							<option value="Administrasi Pendidikan" @if (old('bidang_studi') == 'Administrasi Pendidikan') selected @endif>Administrasi Pendidikan</option>
							<option value="Agribisnis Perikanan" @if (old('bidang_studi') == 'Agribisnis Perikanan') selected @endif>Agribisnis Perikanan</option>
							<option value="Agronomi" @if (old('bidang_studi') == 'Agronomi') selected @endif>Agronomi</option>
							<option value="Agrostoligi" @if (old('bidang_studi') == 'Agrostoligi') selected @endif>Agrostoligi</option>
							<option value="Akuntansi" @if (old('bidang_studi') == 'Akuntansi') selected @endif>Akuntansi</option>
							<option value="Akuntansi Manajemen" @if (old('bidang_studi') == 'Akuntansi Manajemen') selected @endif>Akuntansi Manajemen</option>
							<option value="Antropologi" @if (old('bidang_studi') == 'Antropologi') selected @endif>Antropologi</option>
							<option value="Arsitektur" @if (old('bidang_studi') == 'Arsitektur') selected @endif>Arsitektur</option>
							<option value="B.S Lainnya di SMA/MA Yang Belum Tercantum" @if (old('bidang_studi') == 'B.S Lainnya di SMA/MA Yang Belum Tercantum') selected @endif>B.S Lainnya di SMA/MA Yang Belum Tercantum</option>
							<option value="B.S Lainnya di SMK Yang Belum Tercantum" @if (old('bidang_studi') == 'B.S Lainnya di SMK Yang Belum Tercantum') selected @endif>B.S Lainnya di SMK Yang Belum Tercantum</option>
							<option value="Bahasa Arab" @if (old('bidang_studi') == 'Bahasa Arab') selected @endif>Bahasa Arab</option>
							<option value="Bahasa Dan Sastra Belanda" @if (old('bidang_studi') == 'Bahasa Dan Sastra Belanda') selected @endif>Bahasa Dan Sastra Belanda</option>
							<option value="Bahasa Dan Sastra Indonesia" @if (old('bidang_studi') == 'Bahasa Dan Sastra Indonesia') selected @endif>Bahasa Dan Sastra Indonesia</option>
							<option value="Bahasa Dan Sastra Inggris" @if (old('bidang_studi') == 'Bahasa Dan Sastra Inggris') selected @endif>Bahasa Dan Sastra Inggris</option>
							<option value="Bahasa Dan Sastra Melayu" @if (old('bidang_studi') == 'Bahasa Dan Sastra Melayu') selected @endif>Bahasa Dan Sastra Melayu</option>
							<option value="Bahasa Indonesia" @if (old('bidang_studi') == 'Bahasa Indonesia') selected @endif>Bahasa Indonesia</option>
							<option value="Bahasa Indonesia (dan sastra)" @if (old('bidang_studi') == 'Bahasa Indonesia (dan sastra)') selected @endif>Bahasa Indonesia (dan sastra)</option>
							<option value="Bahasa Inggris" @if (old('bidang_studi') == 'Bahasa Inggris') selected @endif>Bahasa Inggris</option>
							<option value="Bahasa Mandarin" @if (old('bidang_studi') == 'Bahasa Mandarin') selected @endif>Bahasa Mandarin</option>
							<option value="Bahasa Prancis" @if (old('bidang_studi') == 'Bahasa Prancis') selected @endif>Bahasa Prancis</option>
							<option value="Bidang Kejuruan Lainnya" @if (old('bidang_studi') == 'Bidang Kejuruan Lainnya') selected @endif>Bidang Kejuruan Lainnya</option>
							<option value="Bimbingan Dan Konseling" @if (old('bidang_studi') == 'Bimbingan Dan Konseling') selected @endif>Bimbingan Dan Konseling</option>
							<option value="Bimbingan Dan Konseling (Konselor)" @if (old('bidang_studi') == 'Bimbingan Dan Konseling (Konselor)') selected @endif>Bimbingan Dan Konseling (Konselor)</option>
							<option value="Biologi" @if (old('bidang_studi') == 'Biologi') selected @endif>Biologi</option>
							<option value="Ekonomi" @if (old('bidang_studi') == 'Ekonomi') selected @endif>Ekonomi</option>
							<option value="Ekonomi Dan Pembangunan" @if (old('bidang_studi') == 'Ekonomi Dan Pembangunan') selected @endif>Ekonomi Dan Pembangunan</option>
							<option value="Ekonomi Koperasi" @if (old('bidang_studi') == 'Ekonomi Koperasi') selected @endif>Ekonomi Koperasi</option>
							<option value="Elektronika dan Komunikasi" @if (old('bidang_studi') == 'Elektronika dan Komunikasi') selected @endif>Elektronika dan Komunikasi</option>
							<option value="Filsafat Sosial" @if (old('bidang_studi') == 'Filsafat Sosial') selected @endif>Filsafat Sosial</option>
							<option value="Filsafat Sosial Budaya" @if (old('bidang_studi') == 'Filsafat Sosial Budaya') selected @endif>Filsafat Sosial Budaya</option>
							<option value="Filsafat Theologia" @if (old('bidang_studi') == 'Filsafat Theologia') selected @endif>Filsafat Theologia</option>
							<option value="Fisika" @if (old('bidang_studi') == 'Fisika') selected @endif>Fisika</option>
							<option value="Geografi" @if (old('bidang_studi') == 'Geografi') selected @endif>Geografi</option>
							<option value="Guru Kelas PAUD" @if (old('bidang_studi') == 'Guru Kelas PAUD') selected @endif>Guru Kelas PAUD</option>
							<option value="Guru Kelas SD/MI" @if (old('bidang_studi') == 'Guru Kelas SD/MI') selected @endif>Guru Kelas SD/MI</option>
							<option value="Guru Kelas SDLB" @if (old('bidang_studi') == 'Guru Kelas SDLB') selected @endif>Guru Kelas SDLB</option>
							<option value="Hama Dan Penyakit Tumbuhan" @if (old('bidang_studi') == 'Hama Dan Penyakit Tumbuhan') selected @endif>Hama Dan Penyakit Tumbuhan</option>
							<option value="Hukum" @if (old('bidang_studi') == 'Hukum') selected @endif>Hukum</option>
							<option value="Hukum Ekonomi" @if (old('bidang_studi') == 'Hukum Ekonomi') selected @endif>Hukum Ekonomi</option>
							<option value="Ilmu Administrasi Negara" @if (old('bidang_studi') == 'Ilmu Administrasi Negara') selected @endif>Ilmu Administrasi Negara</option>
							<option value="Ilmu Administrasi Niaga" @if (old('bidang_studi') == 'Ilmu Administrasi Niaga') selected @endif>Ilmu Administrasi Niaga</option>
							<option value="Ilmu Hukum" @if (old('bidang_studi') == 'Ilmu Hukum') selected @endif>Ilmu Hukum</option>
							<option value="Ilmu Kehutanan" @if (old('bidang_studi') == 'Ilmu Kehutanan') selected @endif>Ilmu Kehutanan</option>
							<option value="Ilmu Kependidikan" @if (old('bidang_studi') == 'Ilmu Kependidikan') selected @endif>Ilmu Kependidikan</option>
							<option value="Ilmu Kesejahteraan Sosial" @if (old('bidang_studi') == 'Ilmu Kesejahteraan Sosial') selected @endif>Ilmu Kesejahteraan Sosial</option>
							<option value="Ilmu Komunikasi" @if (old('bidang_studi') == 'Ilmu Komunikasi') selected @endif>Ilmu Komunikasi</option>
							<option value="Ilmu Pemerintahan" @if (old('bidang_studi') == 'Ilmu Pemerintahan') selected @endif>Ilmu Pemerintahan</option>
							<option value="Ilmu Pendidikan" @if (old('bidang_studi') == 'Ilmu Pendidikan') selected @endif>Ilmu Pendidikan</option>
							<option value="Ilmu Pengetahuan Alam (IPA)" @if (old('bidang_studi') == 'Ilmu Pengetahuan Alam (IPA)') selected @endif>Ilmu Pengetahuan Alam (IPA)</option>
							<option value="Ilmu Pengetahuan kehutanan" @if (old('bidang_studi') == 'Ilmu Pengetahuan kehutanan') selected @endif>Ilmu Pengetahuan kehutanan</option>
							<option value="Ilmu Pengetahuan Sosial (IPS)" @if (old('bidang_studi') == 'Ilmu Pengetahuan Sosial (IPS)') selected @endif>Ilmu Pengetahuan Sosial (IPS)</option>
							<option value="Ilmu Perpustakaan" @if (old('bidang_studi') == 'Ilmu Perpustakaan') selected @endif>Ilmu Perpustakaan</option>
							<option value="Ilmu Pertanian" @if (old('bidang_studi') == 'Ilmu Pertanian') selected @endif>Ilmu Pertanian</option>
							<option value="Ilmu Sosial dan Politik" @if (old('bidang_studi') == 'Ilmu Sosial dan Politik') selected @endif>Ilmu Sosial dan Politik</option>
							<option value="Kehutanan" @if (old('bidang_studi') == 'Kehutanan') selected @endif>Kehutanan</option>
							<option value="Kependidikan" @if (old('bidang_studi') == 'Kependidikan') selected @endif>Kependidikan</option>
							<option value="Keterampilan" @if (old('bidang_studi') == 'Keterampilan') selected @endif>Keterampilan</option>
							<option value="Kewirausahaan" @if (old('bidang_studi') == 'Kewirausahaan') selected @endif>Kewirausahaan</option>
							<option value="Kimia" @if (old('bidang_studi') == 'Kimia') selected @endif>Kimia</option>
							<option value="KKPI" @if (old('bidang_studi') == 'KKPI') selected @endif>KKPI</option>
							<option value="Manajemen Informatika dan Komputer" @if (old('bidang_studi') == 'Manajemen Informatika dan Komputer') selected @endif>Manajemen Informatika dan Komputer</option>
							<option value="Manajemen Kebendaharaan" @if (old('bidang_studi') == 'Manajemen Kebendaharaan') selected @endif>Manajemen Kebendaharaan</option>
							<option value="Manajemen Pemasaran " @if (old('bidang_studi') == 'Manajemen Pemasaran ') selected @endif>Manajemen Pemasaran </option>
							<option value="Manajemen Perbankan" @if (old('bidang_studi') == 'Manajemen Perbankan') selected @endif>Manajemen Perbankan</option>
							<option value="Manajemen Sistem Informasi" @if (old('bidang_studi') == 'Manajemen Sistem Informasi') selected @endif>Manajemen Sistem Informasi</option>
							<option value="Matematika" @if (old('bidang_studi') == 'Matematika') selected @endif>Matematika</option>
							<option value="Matematika dan Ilmu Pengetahuan" @if (old('bidang_studi') == 'Matematika dan Ilmu Pengetahuan') selected @endif>Matematika dan Ilmu Pengetahuan</option>
							<option value="Muatan Lokal" @if (old('bidang_studi') == 'Muatan Lokal') selected @endif>Muatan Lokal</option>
							<option value="Muatan Lokal Bahasa Daerah" @if (old('bidang_studi') == 'Muatan Lokal Bahasa Daerah') selected @endif>Muatan Lokal Bahasa Daerah</option>
							<option value="Muatan Lokal Potensi Daerah" @if (old('bidang_studi') == 'Muatan Lokal Potensi Daerah') selected @endif>Muatan Lokal Potensi Daerah</option>
							<option value="Nutrisi dan Makanan Ternak" @if (old('bidang_studi') == 'Nutrisi dan Makanan Ternak') selected @endif>Nutrisi dan Makanan Ternak</option>
							<option value="Pendidikan Administrasi Perkantoran" @if (old('bidang_studi') == 'Pendidikan Administrasi Perkantoran') selected @endif>Pendidikan Administrasi Perkantoran</option>
							<option value="Pendidikan Agama Buddha" @if (old('bidang_studi') == 'Pendidikan Agama Buddha') selected @endif>Pendidikan Agama Buddha</option>
							<option value="Pendidikan Agama Hindu" @if (old('bidang_studi') == 'Pendidikan Agama Hindu') selected @endif>Pendidikan Agama Hindu</option>
							<option value="Pendidikan Agama Islam" @if (old('bidang_studi') == 'Pendidikan Agama Islam') selected @endif>Pendidikan Agama Islam</option>
							<option value="Pendidikan Agama Katholik" @if (old('bidang_studi') == 'Pendidikan Agama Katholik') selected @endif>Pendidikan Agama Katholik</option>
							<option value="Pendidikan Agama Kong Hu Chu" @if (old('bidang_studi') == 'Pendidikan Agama Kong Hu Chu') selected @endif>Pendidikan Agama Kong Hu Chu</option>
							<option value="Pendidikan Agama Kristen" @if (old('bidang_studi') == 'Pendidikan Agama Kristen') selected @endif>Pendidikan Agama Kristen</option>
							<option value="Pendidikan Agama Kristen Protestan" @if (old('bidang_studi') == 'Pendidikan Agama Kristen Protestan') selected @endif>Pendidikan Agama Kristen Protestan</option>
							<option value="Pendidikan Akuntansi" @if (old('bidang_studi') == 'Pendidikan Akuntansi') selected @endif>Pendidikan Akuntansi</option>
							<option value="Pendidikan Anak Prasekolah dan Pendidikan" @if (old('bidang_studi') == 'Pendidikan Anak Prasekolah dan Pendidikan') selected @endif>Pendidikan Anak Prasekolah dan Pendidikan</option>
							<option value="Pendidikan Bahasa Arab" @if (old('bidang_studi') == 'Pendidikan Bahasa Arab') selected @endif>Pendidikan Bahasa Arab</option>
							<option value="Pendidikan dan Sastra Indonesia" @if (old('bidang_studi') == 'Pendidikan dan Sastra Indonesia') selected @endif>Pendidikan dan Sastra Indonesia</option>
							<option value="Pendidikan Bahasa Inggris" @if (old('bidang_studi') == 'Pendidikan Bahasa Inggris') selected @endif>Pendidikan Bahasa Inggris</option>
							<option value="Pendidikan Biologi" @if (old('bidang_studi') == 'Pendidikan Biologi') selected @endif>Pendidikan Biologi</option>
							<option value="Pendidikan Dasar" @if (old('bidang_studi') == 'Pendidikan Dasar') selected @endif>Pendidikan Dasar</option>
							<option value="Pendidikan Ekonomi" @if (old('bidang_studi') == 'Pendidikan Ekonomi') selected @endif>Pendidikan Ekonomi</option>
							<option value="Pendidikan Fisika" @if (old('bidang_studi') == 'Pendidikan Fisika') selected @endif>Pendidikan Fisika</option>
							<option value="Pendidikan Ilmu Pengetahuan Alam (IPA)" @if (old('bidang_studi') == 'Pendidikan Ilmu Pengetahuan Alam (IPA)') selected @endif>Pendidikan Ilmu Pengetahuan Alam (IPA)</option>
							<option value="Pendidikan Ilmu Pengetahuan Sosial (IPS)" @if (old('bidang_studi') == 'Pendidikan Ilmu Pengetahuan Sosial (IPS)') selected @endif>Pendidikan Ilmu Pengetahuan Sosial (IPS)</option>
							<option value="Pendidikan Jasmani (OR dan Kesehatan)" @if (old('bidang_studi') == 'Pendidikan Jasmani (OR dan Kesehatan)') selected @endif>Pendidikan Jasmani (OR dan Kesehatan)</option>
							<option value="Pendidikan Jasmani dan Kesehatan" @if (old('bidang_studi') == 'Pendidikan Jasmani dan Kesehatan') selected @endif>Pendidikan Jasmani dan Kesehatan</option>
							<option value="Pendidikan Keolahragaan" @if (old('bidang_studi') == 'Pendidikan Keolahragaan') selected @endif>Pendidikan Keolahragaan</option>
							<option value="Pendidikan Kesehatan dan Rekreasi" @if (old('bidang_studi') == 'Pendidikan Kesehatan dan Rekreasi') selected @endif>Pendidikan Kesehatan dan Rekreasi</option>
							<option value="Pendidikan Kewarganegaraan (PKn)" @if (old('bidang_studi') == 'Pendidikan Kewarganegaraan (PKn)') selected @endif>Pendidikan Kewarganegaraan (PKn)</option>
							<option value="Pendidikan Kimia" @if (old('bidang_studi') == 'Pendidikan Kimia') selected @endif>Pendidikan Kimia</option>
							<option value="Pendidikan Luar Sekolah" @if (old('bidang_studi') == 'Pendidikan Luar Sekolah') selected @endif>Pendidikan Luar Sekolah</option>
							<option value="Pendidikan Matematika" @if (old('bidang_studi') == 'Pendidikan Matematika') selected @endif>Pendidikan Matematika</option>
							<option value="Pendidikan Olahraga dan Kesehatan" @if (old('bidang_studi') == 'Pendidikan Olahraga dan Kesehatan') selected @endif>Pendidikan Olahraga dan Kesehatan</option>
							<option value="Pendidikan Pancasila dan Kewarganegaraan" @if (old('bidang_studi') == 'Pendidikan Pancasila dan Kewarganegaraan') selected @endif>Pendidikan Pancasila dan Kewarganegaraan</option>
							<option value="Pendidikan Sejarah" @if (old('bidang_studi') == 'Pendidikan Sejarah') selected @endif>Pendidikan Sejarah</option>
							<option value="Pendidikan Teknik Sipil" @if (old('bidang_studi') == 'Pendidikan Teknik Sipil') selected @endif>Pendidikan Teknik Sipil</option>
							<option value="Pendidikan Umum" @if (old('bidang_studi') == 'Pendidikan Umum') selected @endif>Pendidikan Umum</option>
							<option value="Penyiaran" @if (old('bidang_studi') == 'Penyiaran') selected @endif>Penyiaran</option>
							<option value="Peradilan Pidana" @if (old('bidang_studi') == 'Peradilan Pidana') selected @endif>Peradilan Pidana</option>
							<option value="Perencanaan Hutan" @if (old('bidang_studi') == 'Perencanaan Hutan') selected @endif>Perencanaan Hutan</option>
							<option value="Perikanan" @if (old('bidang_studi') == 'Perikanan') selected @endif>Perikanan</option>
							<option value="Pertanian" @if (old('bidang_studi') == 'Pertanian') selected @endif>Pertanian</option>
							<option value="Peternakan" @if (old('bidang_studi') == 'Peternakan') selected @endif>Peternakan</option>
							<option value="Psikologi" @if (old('bidang_studi') == 'Psikologi') selected @endif>Psikologi</option>
							<option value="Rekayasa Perangkat Lunak" @if (old('bidang_studi') == 'Rekayasa Perangkat Lunak') selected @endif>Rekayasa Perangkat Lunak</option>
							<option value="Sejarah" @if (old('bidang_studi') == 'Sejarah') selected @endif>Sejarah</option>
							<option value="Seni Budaya" @if (old('bidang_studi') == 'Seni Budaya') selected @endif>Seni Budaya</option>
							<option value="Sistem Informasi" @if (old('bidang_studi') == 'Sistem Informasi') selected @endif>Sistem Informasi</option>
							<option value="Sosial Ekonomi" @if (old('bidang_studi') == 'Sosial Ekonomi') selected @endif>Sosial Ekonomi</option>
							<option value="Sosial Politik" @if (old('bidang_studi') == 'Sosial Politik') selected @endif>Sosial Politik</option>
							<option value="Sosiologi" @if (old('bidang_studi') == 'Sosiologi') selected @endif>Sosiologi</option>
							<option value="Tabliq dan Nasy'Ru" @if (old('bidang_studi') == "Tabliq dan Nasy'Ru") selected @endif>Tabliq dan Nasy'Ru</option>
							<option value="Tafsir Hadist" @if (old('bidang_studi') == 'Tafsir Hadist') selected @endif>Tafsir Hadist</option>
							<option value="Teknik Gambar dan Bangunan" @if (old('bidang_studi') == 'Teknik Gambar dan Bangunan') selected @endif>Teknik Gambar dan Bangunan</option>
							<option value="Teknik Informatika Komputer" @if (old('bidang_studi') == 'Teknik Informatika Komputer') selected @endif>Teknik Informatika Komputer</option>
							<option value="Teknik Komputer" @if (old('bidang_studi') == 'Teknik Komputer') selected @endif>Teknik Komputer</option>
							<option value="Teknik Komputer dan Jaringan" @if (old('bidang_studi') == 'Teknik Komputer dan Jaringan') selected @endif>Teknik Komputer dan Jaringan</option>
							<option value="Teknik Mesin Umum" @if (old('bidang_studi') == 'Teknik Mesin Umum') selected @endif>Teknik Mesin Umum</option>
							<option value="Teknik Sipil" @if (old('bidang_studi') == 'Teknik Sipil') selected @endif>Teknik Sipil</option>
							<option value="Teknologi Informasi dan Komunikasi" @if (old('bidang_studi') == 'Teknologi Informasi dan Komunikasi') selected @endif>Teknologi Informasi dan Komunikasi</option>
							<option value="Teknologi Kependidikan" @if (old('bidang_studi') == 'Teknologi Kependidikan') selected @endif>Teknologi Kependidikan</option>
							<option value="Umum" @if (old('bidang_studi') == 'Umum') selected @endif>Umum</option>
							<option value="Lainnya" @if (old('bidang_studi') == 'Lainnya') selected @endif>Lainnya</option>
							
						</select>
						@error('bidang_studi')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @error('mata_pelajaran') has-error @enderror">
						<label>Mata Pelajaran Diajarkan :</label>
						<select class="form-control" name="mata_pelajaran">
							<option value="">- Pilih Salah Satu -</option>
							<option value="Al-Qur'an" @if (old('mata_pelajaran') == "Al-Qur'an") selected @endif>Al-Qur'an</option>
							<option value="Bahasa Arab" @if (old('mata_pelajaran') == 'Bahasa Arab') selected @endif>Bahasa Arab</option>
							<option value="Bahasa Indonesia" @if (old('mata_pelajaran') == 'Bahasa Indonesia') selected @endif>Bahasa Indonesia</option>
							<option value="Bahasa Inggris" @if (old('mata_pelajaran') == 'Bahasa Inggris') selected @endif>Bahasa Inggris</option>
							<option value="Bimbingan dan Konseling/Konselor (BP/BK)" @if (old('mata_pelajaran') == 'Bimbingan dan Konseling/Konselor (BP/BK)') selected @endif>Bimbingan dan Konseling/Konselor (BP/BK)</option>
							<option value="Ekonomi" @if (old('mata_pelajaran') == 'Ekonomi') selected @endif>Ekonomi</option>
							<option value="Geografi" @if (old('mata_pelajaran') == 'Geografi') selected @endif>Geografi</option>
							<option value="Guru kelas SD/MI/SLB" @if (old('mata_pelajaran') == 'Guru kelas SD/MI/SLB') selected @endif>Guru kelas SD/MI/SLB</option>
							<option value="Ilmu Pengetahuan Alam (IPA)" @if (old('mata_pelajaran') == 'Ilmu Pengetahuan Alam (IPA)') selected @endif>Ilmu Pengetahuan Alam (IPA)</option>
							<option value="Ilmu Pengetahuan Sosial (IPS)" @if (old('mata_pelajaran') == 'Ilmu Pengetahuan Sosial (IPS)') selected @endif>Ilmu Pengetahuan Sosial (IPS)</option>
							<option value="Matematika (Umum)" @if (old('mata_pelajaran') == 'Matematika (Umum)') selected @endif>Matematika (Umum)</option>
							<option value="Muatan Lokal Bahasa Daerah" @if (old('mata_pelajaran') == 'Muatan Lokal Bahasa Daerah') selected @endif>Muatan Lokal Bahasa Daerah</option>
							<option value="Muatan Lokal Potensi Daerah" @if (old('mata_pelajaran') == 'Muatan Lokal Potensi Daerah') selected @endif>Muatan Lokal Potensi Daerah</option>
							<option value="Pendidikan Agama Buddha" @if (old('mata_pelajaran') == 'Pendidikan Agama Buddha') selected @endif>Pendidikan Agama Buddha</option>
							<option value="Pendidikan Agama Hindu" @if (old('mata_pelajaran') == 'Pendidikan Agama Hindu') selected @endif>Pendidikan Agama Hindu</option>
							<option value="Pendidikan Agama Hindu dan Budi Pekerti" @if (old('mata_pelajaran') == 'Pendidikan Agama Hindu dan Budi Pekerti') selected @endif>Pendidikan Agama Hindu dan Budi Pekerti</option>
							<option value="Pendidikan Agama Islam" @if (old('mata_pelajaran') == 'Pendidikan Agama Islam') selected @endif>Pendidikan Agama Islam</option>
							<option value="Pendidikan Agama Islam dan Budi Pekerti" @if (old('status') == 'Pendidikan Agama Islam dan Budi Pekerti') selected @endif>Pendidikan Agama Islam dan Budi Pekerti</option>
							<option value="Pendidikan Agama Katholik" @if (old('mata_pelajaran') == 'Pendidikan Agama Katholik') selected @endif>Pendidikan Agama Katholik</option>
							<option value="Pendidikan Agama Katholik dan Budi Pekerti" @if (old('mata_pelajaran') == 'Pendidikan Agama Katholik dan Budi Pekerti') selected @endif>Pendidikan Agama Katholik dan Budi Pekerti</option>
							<option value="Pendidikan Agama Kristen" @if (old('mata_pelajaran') == 'Pendidikan Agama Kristen') selected @endif>Pendidikan Agama Kristen</option>
							<option value="Pendidikan Agama kristen dan Budi Pekerti" @if (old('mata_pelajaran') == 'Pendidikan Agama kristen dan Budi Pekerti') selected @endif>Pendidikan Agama kristen dan Budi Pekerti</option>
							<option value="Pendidikan Jasmani, Olahraga dan Kesehatan" @if (old('mata_pelajaran') == 'Pendidikan Jasmani, Olahraga dan Kesehatan') selected @endif>Pendidikan Jasmani, Olahraga dan Kesehatan</option>
							<option value="Pendidikan Keterampilan" @if (old('mata_pelajaran') == 'Pendidikan Keterampilan') selected @endif>Pendidikan Keterampilan</option>
							<option value="Pendidikan Kewarganegaraan" @if (old('mata_pelajaran') == 'Pendidikan Kewarganegaraan') selected @endif>Pendidikan Kewarganegaraan</option>
							<option value="Pendidikan Pancasila dan Kewarganegaraan" @if (old('status') == 'Pendidikan Pancasila dan Kewarganegaraan') selected @endif>Pendidikan Pancasila dan Kewarganegaraan</option>
							<option value="Prakarya" @if (old('mata_pelajaran') == 'Prakarya') selected @endif>Prakarya</option>
							<option value="Seni dan Budaya" @if (old('mata_pelajaran') == 'Seni dan Budaya') selected @endif>Seni dan Budaya</option>
							<option value="Teknologi Informasi dan Komunikasi" @if (old('mata_pelajaran') == 'Teknologi Informasi dan Komunikasi') selected @endif>Teknologi Informasi dan Komunikasi</option>
							<option value="Lainnya" @if (old('mata_pelajaran') == 'Lainnya') selected @endif>Lainnya</option>
							
						</select>
						@error('mata_pelajaran')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>					
				</div>
				<div class="col-12 col-md-12 col-lg-6">
					<div class="form-group @error('npsn') has-error @enderror">
						<label>NPSN :</label>
						<input name="npsn" type="text" id="npsn" class="form-control" placeholder="Masukkan NPSN" value="{{ old('npsn') }}">
						@error('npsn')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @error('nip') has-error @enderror">
						<label>NIP @if ((Auth::user()->status_kepegawaian == 'PNS') || (Auth::user()->status_kepegawaian == 'PNS Depag') || (Auth::user()->status_kepegawaian == 'PNS Diperbantukan')) @else <span style="color: red">(Tidak Wajib untuk yang Non PNS)</span>
						@endif :</label>
						<input name="nip" id="nip" type="text" class="form-control" placeholder="Masukkan NIP" value="{{ old('nip', Auth::user()->nip) }}">
						@error('nip')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @error('nuptk') has-error @enderror">
						<label>NUPTK <span style="color: red">(Tidak Wajib) : </span></label>
						<input name="nuptk" type="text" class="form-control" id="nuptk" placeholder="Masukkan NUPTK" value="{{ old('nuptk') }}">
						@error('nuptk')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @error('jabatan_pangkat_golongan') has-error @enderror">
						<label>Jabatan - Golongan - Pangkat @if ((Auth::user()->status_kepegawaian == 'PNS') || (Auth::user()->status_kepegawaian == 'PNS Depag') || (Auth::user()->status_kepegawaian == 'PNS Diperbantukan')) @else <span style="color: red">(Tidak Wajib untuk yang Non PNS)</span>
							@endif :</label>
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
					<div class="form-group @error('unit_kerja') has-error @enderror">
						<label>Unit Kerja/Tempat Tugas :</label>
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
					<div class="form-group @error('kecamatan') has-error @enderror">
						<label>Kecamatan (Unit Kerja) :</label>
						<select class="form-control" name="kecamatan">
							<option value="">- Pilih Salah Satu -</option>
							<option value="Mantikulore" @if (old('kecamatan') == 'Mantikulore') selected @endif>Mantikulore</option>			
							<option value="Palu Barat" @if (old('kecamatan') == 'Palu Barat') selected @endif>Palu Barat</option>								
							<option value="Palu Selatan" @if (old('kecamatan') == 'Palu Selatan') selected @endif>Palu Selatan</option>					
							<option value="Palu Timur" @if (old('kecamatan') == 'Palu Timur') selected @endif>Palu Timur</option>								
							<option value="Palu Utara" @if (old('kecamatan') == 'Palu Utara') selected @endif>Palu Utara</option>								
							<option value="Tatanga" @if (old('kecamatan') == 'Tatanga') selected @endif>Tatanga</option>								
							<option value="Tawaeli" @if (old('kecamatan') == 'Tawaeli') selected @endif>Tawaeli</option>								
							<option value="Ulujadi" @if (old('kecamatan') == 'Ulujadi') selected @endif>Ulujadi</option>								
						</select>
						@error('kecamatan')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>								
					<div class="form-group @if ((Auth::user()->status_kepegawaian == 'PNS') || (Auth::user()->status_kepegawaian == 'PNS Depag') || (Auth::user()->status_kepegawaian == 'PNS Diperbantukan')) @else d-none
						@endif @error('tanggal_kerja') has-error @enderror">
						<label>Tanggal Awal Kerja (contoh: <span style="color: seagreen">01-12-2012</span>) : </label>
						<input name="tanggal_kerja" type="text" class="form-control tanggal" id="tanggal_kerja" placeholder="Masukkan Tanggal Awal Kerja" value="{{ old('tanggal_kerja') }}">
						<small style="color: green"><i>* akan dijadikan acuan untuk menghitung jumlah tahun dan bulan kerja</i></small>
						@error('tanggal_kerja')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>																
					<div class="form-group @error('tmt_pengangkatan') has-error @enderror">
						<label>TMT Pengangkatan (contoh: <span style="color: seagreen">01-01-2015</span>) :</label>
						<input name="tmt_pengangkatan" type="text" class="form-control tanggal" placeholder="Masukkan TMT Pengangkatan" value="{{ old('tmt_pengangkatan') }}">
						@error('tmt_pengangkatan')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @if ((Auth::user()->status_kepegawaian == 'PNS') || (Auth::user()->status_kepegawaian == 'PNS Depag') || (Auth::user()->status_kepegawaian == 'PNS Diperbantukan')) @else d-none
						@endif @error('tmt_pangkat') has-error @enderror">
						<label>TMT Pangkat (contoh: <span style="color: seagreen">01-01-2021</span>) :</label>
						<input name="tmt_pangkat" type="text" class="form-control tanggal" placeholder="Masukkan TMT Pangkat" value="{{ old('tmt_pangkat') }}">
						@error('tmt_pangkat')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @if ((Auth::user()->status_kepegawaian == 'PNS') || (Auth::user()->status_kepegawaian == 'PNS Depag') || (Auth::user()->status_kepegawaian == 'PNS Diperbantukan')) @else d-none
						@endif @error('tmt_gaji') has-error @enderror">
						<label>TMT Gaji Berkala (contoh: <span style="color: seagreen">01-01-2021</span>) :</label>
						<input name="tmt_gaji" type="text" class="form-control tanggal" placeholder="Masukkan TMT Gaji Berkala" value="{{ old('tmt_gaji') }}">
						@error('tmt_gaji')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @if ((Auth::user()->status_kepegawaian == 'PNS') || (Auth::user()->status_kepegawaian == 'PNS Depag') || (Auth::user()->status_kepegawaian == 'PNS Diperbantukan')) @else d-none
						@endif @error('nilai_gaji') has-error @enderror">
						<label>Nilai Gaji Terakhir (Rp) :</label>
						<input name="nilai_gaji" type="text" class="form-control rupiah" placeholder="Masukkan Nilai Gaji Terakhir" value="{{ old('nilai_gaji') }}">
						@error('nilai_gaji')
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
					<input type="button" id="submit" class="btn btn-next btn-danger" value="Simpan">										
					<input type="submit" id="submit2" class="btn btn-next btn-danger d-none" value="Simpan">										
				</div>
				<div class="clearfix"></div>
			</div>
		</form>										
	</div>
</div>														
@endsection
			
@section('script')
<script>	
	$("#submit" ).on('click', function() {
		var arr = ['PNS', 'PNS Depag', 'PNS Diperbantukan'];
		if(jQuery.inArray($('#cek_status').val(), arr)  == -1){ // !=							
			swal({
				title: 'Apakah data yang anda inputkan sudah benar?',				
				type: 'warning',
				buttons:{
					confirm: {
						text : 'Ya, Sudah Benar',
						className : 'btn btn-success'
					},
					cancel: {
						text: 'Tidak, Ingin memeriksa kembali',
						visible: true,
						className: 'btn btn-danger'
					}
				}
			}).then((confirm) => {
				if (confirm) {
					$("#submit2").click()	
				// 	$('.rupiah').unmask();
					// swal({
					// 	title: "Terima Kasih!",
					// 	text: "Data diri anda telah tersimpan di database kami",
					// 	icon: "success",
					// 	buttons: {
					// 		confirm: {
					// 			text: "Oke",
					// 			value: true,
					// 			visible: true,
					// 			className: "btn btn-success",
					// 			closeModal: true
					// 		}
					// 	}
					// });
				} else {			
					return false					
					swal.close();
				}
			});
		}	
		else{
			$('.rupiah').unmask();
			$("#submit2").click()	
		}	
	});

	function test(){
		// $('#formSubmit').submit();										
		document.getElementById("abc").submit

	}

	$('.tanggal').mask('00-00-0000');
	$('#no_hp').mask('0000000000000');
	$('#nip').mask('000000000000000000');
	$('#nik').mask('0000000000000000');
	$('#npsn').mask('000000000000000000');	
	$('#nuptk').mask('0000000000000000');
	$('.lama_kerja').mask('00');
	$('.rupiah').mask('000.000.000.000', {reverse: true});
</script>
@endsection