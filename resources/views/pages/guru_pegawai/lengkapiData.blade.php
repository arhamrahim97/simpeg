<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Lengkapi Data </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="/assets/dashboard/img/icon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="/assets/dashboard/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['/assets/dashboard/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="/assets/dashboard/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/dashboard/css/atlantis.css">	
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="/assets/dashboard/css/demo.css">

	<style>
		.select2-container {
    width: 100% !important;
}
	</style>
</head>

<body>
    <div class="wrapper mt-5">
		{{-- <div class="main-panel"> --}}
			<div class="container-fluid p-0">
				<div class="page-inner">
					<div class="row">
						<div class="wizard-container wizard-round col-md-9">
							<div class="wizard-header text-center">
								<h3 class="wizard-title"><b>Lengkapi</b> Profile dan Berkas Dasar Anda</h3>
								<small>Silahkan lengkapi terlebih dahulu data anda untuk dapat masuk ke halaman Dashboard</small>
							</div>
							<form novalidate="novalidate">
								<div class="wizard-body">
									<div class="row">
										<ul class="wizard-menu nav nav-pills nav-primary">
											<li class="step" style="width: 33.3333%;">
												<a class="nav-link active" href="#about" id="tab-profile" data-toggle="tab" aria-expanded="true"><i class="fa fa-user mr-0"></i> Profile</a>
											</li>
											<li class="step" style="width: 33.3333%;">
												<a class="nav-link " href="#account" id="tab-berkas" data-toggle="tab"><i class="fa fa-file mr-2"></i> Berkas Dasar</a>
											</li>
										</ul>
									</div>
									<div class="tab-content">
										<div class="tab-pane active" id="about">
											<div class="row">
												<div class="col-md-12">
													<h4 class="info-text">Beri tahu kami siapa anda.</h4>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Nama Lengkap :</label>
														<input name="nama_lengkap" type="text" class="form-control" placeholder="Masukkan Nama Lengkap" value="{{ auth()->user()->nama }}" required>
													</div>
													<div class="form-group">
														<label>Jenis Kelamin :</label>
														<div class="select2-input">
															<select class="form-control select2" name="jenis_kelamin" required>
																<option value="">- Pilih Salah Satu -</option>
																<option value="Laki-laki">Laki-laki</option>
																<option value="Perempuan">Perempuan</option>
															</select>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label>Tempat Lahir : </label>
																<input name="tempat_lahir" type="text" class="form-control" id="tempat_lahir" placeholder="Masukkan Tempat Lahir" required>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Tanggal Lahir (contoh: <span style="color: seagreen">01-01-1991</span>) : </label>
																<input name="tanggal_lahir" type="text" class="form-control tanggal" id="tanggal_lahir" placeholder="Masukkan Tanggal Lahir" required>
															</div>
														</div>
													</div>
													<div class="form-group">
														<label>Nomor Telepon/Handphone :</label>
														<input name="no_hp" id="no_hp" type="text" class="form-control" placeholder="Masukkan Nomor Telepon/Handphone" required>
													</div>
													<div class="form-group">
														<label>Alamat :</label>
														<textarea name="alamat" class="form-control" rows="4" required></textarea>
													</div>
													<div class="form-group">
														<label>Pendidikan Terakhir :</label>
														<select class="form-control" name="pendidikan_terakhir" required>
															<option value="">- Pilih Salah Satu -</option>
															<option value="Tidak/Belum Sekolah">Tidak/Belum Sekolah</option>
															<option value="Tidak Tamat SD/Sederajat">Tidak Tamat SD/Sederajat</option>
															<option value="Tamat SD/Sederajat">Tamat SD/Sederajat</option>
															<option value="SLTP/Sederajat">SLTP/Sederajat</option>
															<option value="SLTA/Sederajat">SLTA/Sederajat</option>
															<option value="Diploma I/II">Diploma I/II</option>
															<option value="Akademi/Diploma III/Sarjana Muda">Akademi/Diploma III/Sarjana Muda</option>
															<option value="Diploma IV/Strata I">Diploma IV/Strata I</option>
															<option value="Strata II">Strata II</option>
															<option value="Strata III">Strata III
															</option>
														</select>
													</div>
													<div class="form-group">
														<label>Jenis ASN :</label>
														<select class="form-control" name="jenis_asn" required onchange="jenis_asn1(this);">
															<option value="">- Pilih Salah Satu -</option>
															<option value="Guru">Guru</option>
															<option value="Pegawai">Pegawai</option>
														</select>
													</div>
													<div class="form-group d-none" id="form-jenis-guru">
														<label>Jenis Guru : </label>
														<select class="form-control" name="jenis_guru" id="jenis_guru" required>
															<option value="">- Pilih Salah Satu -</option>
															<option value="Guru Kelas">Guru Kelas</option>
															<option value="Guru Mata Pelajaran">Guru Mata Pelajaran</option>
															<option value="Guru Bimbingan dan Konseling">Guru Bimbingan dan Konseling</option>
														</select>
													</div>
													<div class="form-group">
														<label>NIP <span style="color: red">(Tidak Wajib)</span> :</label>
														<input name="nip" id="nip" type="text" class="form-control" placeholder="Masukkan NIP" value="{{ auth()->user()->nip }}">
													</div>
													<div class="form-group">
														<label>NUPTK <span style="color: red">(Tidak Wajib Bagi Pegawai)</span> :</label>
														<input name="nuptk" type="text" class="form-control" id="nuptk" placeholder="Masukkan NUPTK">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Unit Kerja (Sekolah) :</label>
														<select class="form-control" name="unit_kerja" required>
															<option value="">- Pilih Salah Satu -</option>
															<option value="1">SMA Negeri 1 Testing</option>
														</select>
													</div>
													<div class="form-group">
														<label>Status :</label>
														<select class="form-control" name="status_kerja" required>
															<option value="">- Pilih Salah Satu -</option>
															<option value="PNS">PNS</option>
															<option value="PKKK">PKKK</option>
															<option value="Honorer">Honorer</option>
														</select>
													</div>
													{{-- <div class="form-group">
																					<label>Jenis Jabatan :</label>
																					<select class="form-control" name="jenis_jabatan" required>
																						<option value="">- Pilih Salah Satu -</option>														
																						<option value="Struktural">Struktural</option>									
																						<option value="Fungsional">Fungsional</option>														
																					</select>
																				</div>		 --}}
													<div class="form-group">
														<label>Jabatan :</label>
														<select class="form-control" name="jabatan" required>
															<option value="">- Pilih Salah Satu -</option>
															{{-- Kondisi jika guru = tabel jabatan fungsional, else tabel jabatan struktural --}}
															<option value="Guru Pertama">Guru Pertama</option>
														</select>
													</div>
													<div class="form-group">
														<label>Pangkat :</label>
														<select class="form-control" name="pangkat" required>
															<option value="">- Pilih Salah Satu -</option>
															<option value="Penata Muda">Penata Muda</option>
														</select>
													</div>
													<div class="form-group">
														<label>Golongan :</label>
														<select class="form-control" name="golongan" required>
															<option value="">- Pilih Salah Satu -</option>
															<option value="Penata Muda">III/a</option>
														</select>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label>Lama Masa Kerja (Tahun) : </label>
																<input name="tahun" type="text" class="form-control lama_kerja" id="tahun" placeholder="Masukkan Jumlah Tahun" required>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Lama Masa Kerja (Bulan) : </label>
																<input name="bulan" type="text" class="form-control lama_kerja" id="bulan" placeholder="Masukkan Jumlah Bulan" required>
															</div>
														</div>
													</div>
													<div class="form-group">
														<label>Nilai Gaji Terakhir (Rp) :</label>
														<input name="gaji_terakhir" type="text" class="form-control rupiah" placeholder="Masukkan Nilai Gaji Terakhir" required>
													</div>
													<div class="form-group">
														<label>TMT Gaji Berkala (contoh: <span style="color: seagreen">01-01-2021</span>) :</label>
														<input name="tmt_gaji" type="text" class="form-control tanggal" placeholder="Masukkan TMT Gaji Berkala" required>
													</div>
													<div class="form-group">
														<label>TMT Kenaikan Pangkat (contoh: <span style="color: seagreen">01-01-2021</span>) :</label>
														<input name="tmt_pangkat" type="text" class="form-control tanggal" placeholder="Masukkan TMT Pangkat" required>
													</div>
													<div class="form-group">
														<label>Foto :</label>
														<div class="input-file input-file-image">
															<div class="row">
																<div class="col-md-3">
																	<img class="img-upload-preview img-circle" src="http://placehold.it/100x100" alt="preview" width="120" height="120">
																	<input type="file" class="form-control form-control-file" id="uploadImg" name="uploadImg" accept="image/*" required="">
																</div>
																<div class="col">
																	<label for="uploadImg" class="label-input-file btn btn-sm btn-primary">Pilih Foto</label>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane " id="account">
											<h4 class="info-text">Upload berkas dasar anda.</h4>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>Kartu Pegawai :</label>
														<input type="file" name="karpeg_file" class="form-control" required>
													</div>
													<div class="form-group">
														<label>Kartu Tanda Penduduk :</label>
														<input type="file" name="ktp_file" class="form-control" required>
													</div>
													<div class="form-group">
														<label>Kartu Keluarga :</label>
														<input type="file" name="kk_file" class="form-control" required>
													</div>
													<div class="form-group">
														<label>Ijasah Terakhir :</label>
														<input type="file" name="ijasah_file" class="form-control" required>
													</div>
													<div class="form-group">
														<label>Kartu NUPTK (Tidak wajib bagi pegawai) :</label>
														<input type="file" name="nuptk_file" id="nuptk_file" class="form-control" required>
													</div>
													<div class="form-group d-none" id="form-sertifikasi">
														<label>Sertifikasi Guru <span style="color: red">(Tidak Wajib)</span> :</label>
														<input type="file" name="sertifikasi_file" class="form-control">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>SK CPNS</label>
														<input type="file" name="sk_cpns_file" class="form-control" required>
													</div>
													<div class="form-group">
														<label>SK PNS :</label>
														<input type="file" name="sk_pns_file" class="form-control" required>
													</div>
													<div class="form-group">
														<label>SK Kenaikan Gaji Berkala :</label>
														<input type="file" name="sk_gaji_file" class="form-control" required>
													</div>
													<div class="form-group">
														<label>SK Kenaikan Pangkat :</label>
														<input type="file" name="sk_pangkat_file" class="form-control" required>
													</div>
													<div class="form-group">
														<label>SPMT :</label>
														<input type="file" name="spmt" class="form-control" required>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							
								<div class="wizard-action pt-0">
									<div class="pull-left">
										{{-- <input type="button" class="btn btn-primary" name="beranda" value="Beranda"> --}}
										<input type="button" class="btn btn-previous btn-fill btn-black disabled" name="previous" id="previous" value="Sebelumnya">
									</div>
									<div class="pull-right">
										<input type="button" class="btn btn-next btn-danger" name="next" value="Selanjutnya">
										<input type="button" class="btn btn-finish btn-danger" name="finish" value="Kirim" style="display: none;">
									</div>
									<div class="clearfix"></div>
								</div>
							</form>				
						</div>
					</div>
				</div>
			</div>			
		{{-- </div>		 --}}	
	</div>
    <!--   Core JS Files   -->
    <script src="/assets/dashboard/js/core/jquery.3.2.1.min.js"></script>
    <script src="/assets/dashboard/js/core/popper.min.js"></script>
    <script src="/assets/dashboard/js/core/bootstrap.min.js"></script>
    <!-- jQuery UI -->
    <script src="/assets/dashboard/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="/assets/dashboard/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
    <!-- Moment JS -->
    <script src="/assets/dashboard/js/plugin/moment/moment.min.js"></script>
    <!-- Bootstrap Toggle -->
    <script src="/assets/dashboard/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
    <!-- jQuery Scrollbar -->
    <script src="/assets/dashboard/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- DateTimePicker -->
    <script src="/assets/dashboard/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>
    <!-- Select2 -->
    <script src="/assets/dashboard/js/plugin/select2/select2.full.min.js"></script>
	 <!-- Jquery Mask -->
	 <script src="/assets/dashboard/js/plugin/jquery.mask/jquery.mask.min.js"></script>
    <!-- Bootstrap Wizard -->
    <script src="/assets/dashboard/js/plugin/bootstrap-wizard/bootstrapwizard.js"></script>
    <!-- jQuery Validation -->
    <script src="/assets/dashboard/js/plugin/jquery.validate/jquery.validate.min.js"></script>
    <!-- Atlantis JS -->
    <script src="/assets/dashboard/js/atlantis.min.js"></script>
    <!-- Atlantis DEMO methods, don't include it in your project! -->
    <script src="/assets/dashboard/js/setting-demo2.js"></script>
    <script>
        // Code for the Validator
        var $validator = $('.wizard-container form').validate({
            validClass: "success",
            highlight: function(element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element) {
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            }
        });

		function jenis_asn1(sel)
		{
			if(sel.value == 'Guru'){
				$('#jenis_guru').prop('required',true);									
				$('#jenis_guru').val('');		
				$('#form-sertifikasi').removeClass('d-none')
				$('#form-jenis-guru').removeClass('d-none')				

				$('#nuptk_file').val('');		
				$('#nuptk_file').prop('required',true);
			}	
			else {
				$('#jenis_guru').closest('.form-group').removeClass('has-error')
				$('#jenis_guru').closest('.form-group').removeClass('has-success')
				$('#jenis_guru-error').addClass('d-none')
				$('#jenis_guru').val('');				
				$('#form-jenis-guru').addClass('d-none')							
				$('#jenis_guru').prop('required',false);


				$('#nuptk_file').closest('.form-group').removeClass('has-error')
				$('#nuptk_file').closest('.form-group').removeClass('has-success')			
				$('#nuptk_file-error').addClass('d-none')
				$('#nuptk_file').val('');				
				$('#nuptk_file').prop('required',false);		
				
				$('#form-sertifikasi').addClass('d-none')

			}		
		}

		$(document).ready(function() {
			jenis_asn1(sel)		
		});
		
		$('.tanggal').mask('00-00-0000');
		$('#no_hp').mask('000000000000');
		$('#nip').mask('000000000000000000');
		$('#nuptk').mask('0000000000000000');
		$('.lama_kerja').mask('00');
		$('.rupiah').mask('000.000.000.000', {reverse: true});
		
		

		$('select').select2({
			theme: "bootstrap"
		})				
		
		if ($("#tab-profile").hasClass("active")){
			$('#previous').addClass('d-none')
		}

		if ($("#tab-berkas").hasClass("active")){			
			$('#previous').removeClass('d-none')
		}		
    </script>
</body>

</html>