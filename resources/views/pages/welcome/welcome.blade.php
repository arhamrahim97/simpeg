@extends('templates.welcome')

@section('title')
Sistem Informasi Manajemen Pegawai
@endsection

@section('content')    	
			<section class="pt-4 pt-md-11 mb-7">
				<div class="container-fluid">
					<div class="row align-items-center">
							<div class="col-12 col-md-5 col-lg-4 order-md-2 text-center justify-content-center">
							<!-- Image -->
								<img src="{{asset('assets/welcome/img/illustrations/illustration-10.png')}}" width="300px"
								class="img-fluid mw-sm-50 mw-md-150 mw-lg-130  mb-6 mb-md-0" alt="..." data-aos="fade-left"
								data-aos-delay="100">
							</div>
							<div class="col-12 col-md-7 col-lg-8 order-md-1" data-aos="fade-right"
							data-aos-delay="100">
								<!-- Heading -->
								<div class="mx-auto mx-lg-6">
									<h1 class="display-3 text-center text-md-start">
										<span class="text-primary">SIMPEG</span>. <br>
									</h1>
	
									<!-- Text -->
									<p class="lead text-center text-md-start text-muted mb-6 mb-lg-8">
										Sistem Informasi Manajemen Pegawai Dinas Pendidikan Kota Palu
									</p>

									<div class="text-center text-md-start">
									<a href="/login" class="btn btn-primary shadow lift me-1">
										Masuk <i class="fe fe-arrow-right d-none d-md-inline ms-3"></i>
									</a>
								</div>

								<!-- Buttons -->
							</div>
						</div>
					</div> <!-- / .row -->
				</div> <!-- / .container -->	
				<div class="container-fluid">
					<div class="row mb-8 mt-5">
						<div class="col-12 col-md-4" data-aos="fade-up"
						data-aos-delay="100">
						  <div class="row">
							<div class="col-auto col-md-12">
		  
							  <!-- Step -->
							  <div class="row gx-0 align-items-center mb-md-5">
								<div class="col-auto">
		  
								  <a href="#!" class="btn btn-sm btn-rounded-circle btn-gray-400 disabled opacity-1">
									<span>1</span>
								  </a>
		  
								</div>
								<div class="col">
		  
								  <hr class="d-none d-md-block w-130">
		  
								</div>
							  </div> <!-- / .row -->
		  
							</div>
							<div class="col col-md-12 ms-n5 ms-md-0">
		  
							  <!-- Heading -->
							  <h4>
								Lengkapi Data Diri
							  </h4>
		  
							  <!-- Text -->
							  <p class="text-muted mb-6 mb-md-0">
								Lengkapi data diri anda ketika pertama kali Login.
							  </p>
		  
							</div>
						  </div> <!-- / .row -->
						</div>
						<div class="col-12 col-md-4" data-aos="fade-up"
						data-aos-delay="200">
						  <div class="row">
							<div class="col-auto col-md-12">
		  
							  <!-- Step -->
							  <div class="row gx-0 align-items-center mb-md-5">
								<div class="col-auto">
		  
								  <a href="#!" class="btn btn-sm btn-rounded-circle btn-gray-400 disabled opacity-1">
									<span>2</span>
								  </a>
		  
								</div>
								<div class="col">
		  
								  <hr class="d-none d-md-block w-130">
		  
								</div>
							  </div> <!-- / .row -->
		  
							</div>
							<div class="col col-md-12 ms-n5 ms-md-0">
		  
							  <!-- Heading -->
							  <h4>
								Lengkapi Berkas Dasar (PNS)
							  </h4>
		  
							  <!-- Text -->
							  <p class="text-muted mb-6 mb-md-0">
								Setelah melengkapi Data Diri kemudian lengkapi Berkas Dasar anda, ini dikhususkan untuk yang PNS.
							  </p>
		  
							</div>
						  </div> <!-- / .row -->
						</div>
						<div class="col-12 col-md-4" data-aos="fade-up"
						data-aos-delay="300">
						  <div class="row">
							<div class="col-auto col-md-12">
		  
							  <!-- Step -->
							  <div class="row gx-0 align-items-center mb-md-5">
								<div class="col-auto">
		  
								  <a href="#!" class="btn btn-sm btn-rounded-circle btn-gray-400 disabled opacity-1">
									<span>3</span>
								  </a>
		  
								</div>
							  </div> <!-- / .row -->
		  
							</div>
							<div class="col col-md-12 ms-n5 ms-md-0">
		  
							  <!-- Heading -->
							  <h4>
								Usulkan Kenaikan Gaji & Pangkat (PNS)
							  </h4>
		  
							  <!-- Text -->
							  <p class="text-muted mb-0">
								Usulkan kenaikan gaji / pangkat apabila nama anda telah terdaftar pada usulan Kenaikan Gaji atau Kenaikan Pangkat di bawah ini.
							  </p>
		  
							</div>
						  </div> <!-- / .row -->
						</div>
					</div>
				</div>		
			</section>	

			<section class="py-8 py-md-6 bg-gradient-light-white mb-7">
				{{-- <div class="container container-xl"> --}}
				<div class="container-fluid">
				<div class="row align-items-center">
					<div class="col-12 col-md-7" data-aos="fade-right">
					<!-- Preheading -->
					<h6 class="text-uppercase text-primary fw-bold">
						Daftar Terbaru
					</h6>
					<!-- Heading -->
					<h2>
						Daftar Nama Usulan Kenaikan Gaji dan Kenaikan Pangkat
					</h2>
		
					<!-- Text -->
					<p class="text-muted mb-4 mb-md-0">
						Cek nama anda di bawah ini, apakah termasuk ke dalam salah satu usulan kenaikan gaji atau usulan kenaikan pangkat.
					</p>
					</div>
					<div class="col-12 col-md-5 text-center" data-aos="fade-left">
					<!-- Image -->
					<img src="assets/welcome/img/illustrations/illustration-11.png" class="img-fluid py-4" alt="...">
					</div>
				</div> <!-- / .row -->
				<div class="row">		
					<div class="col-lg-6 col-md-6 col-sm-12" data-aos="fade-up">
					<!-- Card -->
					<div class="card card-border border-primary shadow-light-lg mb-4 mb-md-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
						<div class="card-body">
						<!-- Heading -->
						<h6 class="text-uppercase text-primary d-inline mb-5 me-1">
							Usulan Kenaikan Gaji 
						</h6>
						<!-- Badge -->
						<span class="badge badge-rounded bg-primary-soft mt-1 d-inline" style="float: right">
							<span>{{ $usulanGaji->count() }}</span>
						</span>
						<!-- List group -->
						<div class="mt-4">
							<div class="list-group list-group-flush">
								<?php $count = 0; ?>
								@forelse ($usulanGaji->get() as $item)
									<?php if($count == 5) break; ?>
									<div class="list-group-item text-reset text-decoration-none" href="#!">
										<p class="fw-bold mb-1">
											{{ $count+1 }}. {{ $item->nama }}
										</p>
										<p class="fs-sm text-muted mb-0">
											{{ $item->jenis_guru }} · {{ $item->sekolah }}
										</p>	
									</div>															
									<?php $count++; ?>														
								@empty
									<h4 class="text-center text-muted">Belum Ada Daftar Usulan Gaji</h4>
								@endforelse	
								@if ($usulanGaji->count() != 0)
									<a href="/daftar-usulan-kenaikan-gaji" class="btn w-100 btn-primary-soft d-flex align-items-center mt-5 lift shadow-sm">
									Lihat Selengkapnya <i class="fe fe-arrow-right ms-auto"></i>
									</a>								
								@endif				
							</div>
						</div>
		
						</div>
					</div>	  								
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12" data-aos="fade-up">		
						<!-- Card -->
						<div class="card card-border border-success shadow-light-lg mb-4 mb-md-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
						<div class="card-body">
							<!-- Heading -->
							<h6 class="text-uppercase text-success d-inline mb-5 me-1">
							Usulan Kenaikan Pangkat
							</h6>
							<!-- Badge -->
							<span class="badge badge-rounded bg-success-soft d-inline" style="float: right">
								<span>{{ $usulanPangkat->count() }}</span>
							</span>
							<!-- List group -->
							<div class="mt-4">
								<div class="list-group list-group-flush">
									<?php $count = 0; ?>
									@forelse ($usulanPangkat->get() as $item)
										<?php if($count == 5) break; ?>
										<div class="list-group-item text-reset text-decoration-none" href="#!">
											<p class="fw-bold mb-1">
												{{ $count+1 }}. {{ $item->nama }}
											</p>
											<p class="fs-sm text-muted mb-0">
												{{ $item->jenis_guru }} · {{ $item->sekolah }}
											</p>	
										</div>															
										<?php $count++; ?>														
									@empty
										<h4 class="text-center text-muted">Belum Ada Daftar Usulan Pangkat</h4>
									@endforelse	
									@if ($usulanPangkat->count() != 0)
										<a href="/daftar-usulan-kenaikan-pangkat" class="btn w-100 btn-success-soft d-flex align-items-center mt-5 lift shadow-sm">
											Lihat Selengkapnya <i class="fe fe-arrow-right ms-auto"></i>
										</a>																
									@endif									 
								</div>
							</div>		
						</div>
						</div>	  								
					</div>
				</div> <!-- / .row -->
				</div> <!-- / .container -->
			</section>				
		  
		  	<!-- Radar Chart -->
			<section class="pt-8 mt-8 pt-md-8 bg-light pb-10">
				<div class="container-fluid">
					<div class="row justify-content-center">
						<div class="col-12 col-md-10 col-lg-8 text-center">
							<!-- Heading -->
							<h1 class="fw-bold" data-aos="fade-in"
							data-aos-delay="100">
								Status Kepegawaian (Guru & Pegawai)
							</h1>
						</div>
					</div> <!-- / .row -->
					<div class="row" data-aos="fade-up"
					data-aos-delay="100">
						<div class="col-12 order-md-2 mt-1">
							<div class="mx-md-1 mx-lg-10">
								<canvas id="myChart"></canvas>
							</div>
						</div>
					</div>					
				</div>

				</div> <!-- / .container -->

			</section>

			{{-- <div class="position-relative">
				<div class="shape shape-bottom shape-fluid-x text-white">
				<svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 48h2880V0h-720C1442.5 52 720 0 720 0H0v48z" fill="currentColor"></path></svg>      </div>
			</div> --}}
			<section class="py-8 pt-md-11 pb-md-10 bg-white">
				<div class="container-fluid">
					<div class="row" data-aos="fade-in"
					data-aos-delay="300">
						<div class="col-12 col-md-4 text-center">
			
						<!-- Heading -->
						<h1 class="display-2 fw-bold text-primary-desat">
							<span data-countup="{&quot;startVal&quot;: 0}" data-to="{{ $profileAll->count() }}" data-aos="" data-aos-id="countup:in" class="aos-init aos-animate">{{ $profileAll->count() }}</span>
						</h1>
			
						<!-- Text -->
						<p class="text-muted mb-6 mb-md-0">
							Total Guru & Pegawai
						</p>
			
						</div>
						<div class="col-12 col-md-4 text-center">
			
						<!-- Heading -->
						<h1 class="display-2 fw-bold text-primary-desat">
							<span data-countup="{&quot;startVal&quot;: 0}" data-to="{{ $profilePNS->count() }}" data-aos="" data-aos-id="countup:in" class="aos-init aos-animate">{{ $profilePNS->count() }}</span>
						</h1>
			
						<!-- Text -->
						<p class="text-muted mb-6 mb-md-0">
							Total Guru & Pegawai PNS
						</p>
			
						</div>
						<div class="col-12 col-md-4 text-center">
			
						<!-- Heading -->
						<h1 class="display-2 fw-bold text-primary-desat">
							<span data-countup="{&quot;startVal&quot;: 0}" data-to="{{ $profileNonPNS->count() }}" data-aos="" data-aos-id="countup:in" class="aos-init aos-animate">{{ $profileNonPNS->count() }}</span>
						</h1>
			
						<!-- Text -->
						<p class="text-muted mb-0">
							Total Guru & Pegawai Non PNS
						</p>
			
						</div>
					</div> <!-- / .row -->
				</div> <!-- / .container -->
			</section>

			<!-- Filter Data Per-Fakultas -->
			<section class="pt-8 pb-0 pb-md-0 bg-gradient-light-white" data-aos="fade-in" data-aos-delay="200">
				<div class="container-fluid">
					<div class="row justify-content-center">
						<div class="col-12 col-md-10 col-lg-8 text-center">
						<!-- Text -->
						<h2 class="text-dark mb-4">
							Informasi Berdasarkan Jenis PTK
						</h2>

						<!-- Badges -->
						<nav class="nav justify-content-center">
							<a class="badge rounded-pill bg-secondary-soft active me-1 mb-1" href="#" data-bs-toggle="pill" data-filter="*" data-bs-target="#fakultas">
							<span class="h6 text-uppercase">Semua</span>
							</a>
							<a class="badge rounded-pill bg-secondary-soft me-1 mb-1" href="#" data-bs-toggle="pill" data-filter=".GuruBK" data-bs-target="#fakultas">
							<span class="h6 text-uppercase">Guru BK</span>
							</a>
							<a class="badge rounded-pill bg-secondary-soft me-1 mb-1" href="#" data-bs-toggle="pill" data-filter=".GuruKelas" data-bs-target="#fakultas">
							<span class="h6 text-uppercase">Guru Kelas</span>
							</a>
							<a class="badge rounded-pill bg-secondary-soft me-1 mb-1" href="#" data-bs-toggle="pill" data-filter=".GuruMapel" data-bs-target="#fakultas">
							<span class="h6 text-uppercase">Guru Mapel</span>
							</a>
							<a class="badge rounded-pill bg-secondary-soft me-1 mb-1" href="#" data-bs-toggle="pill" data-filter=".GuruPendamping" data-bs-target="#fakultas">
							<span class="h6 text-uppercase">Guru Pendamping</span>
							</a>
							<a class="badge rounded-pill bg-secondary-soft me-1 mb-1" href="#" data-bs-toggle="pill" data-filter=".GuruPendampingKhusus" data-bs-target="#fakultas">
							<span class="h6 text-uppercase">Guru Pendamping Khusus</span>
							</a>
							<a class="badge rounded-pill bg-secondary-soft me-1 mb-1" href="#" data-bs-toggle="pill" data-filter=".GuruPengganti" data-bs-target="#fakultas">
							<span class="h6 text-uppercase">Guru Pengganti</span>
							</a>
							<a class="badge rounded-pill bg-secondary-soft me-1 mb-1" href="#" data-bs-toggle="pill" data-filter=".GuruTIK" data-bs-target="#fakultas">
							<span class="h6 text-uppercase">Guru TIK</span>
							</a>
							<a class="badge rounded-pill bg-secondary-soft me-1 mb-1" href="#" data-bs-toggle="pill" data-filter=".Instruktur" data-bs-target="#fakultas">
							<span class="h6 text-uppercase">Instruktur</span>
							</a>
							<a class="badge rounded-pill bg-secondary-soft me-1 mb-1" href="#" data-bs-toggle="pill" data-filter=".KepalaSekolah" data-bs-target="#fakultas">
							<span class="h6 text-uppercase">Kepala Sekolah</span>
							</a>
							<a class="badge rounded-pill bg-secondary-soft me-1 mb-1" href="#" data-bs-toggle="pill" data-filter=".Laboran" data-bs-target="#fakultas">
							<span class="h6 text-uppercase">Laboran</span>
							</a>
							<a class="badge rounded-pill bg-secondary-soft me-1 mb-1" href="#" data-bs-toggle="pill" data-filter=".PenjagaSekolah" data-bs-target="#fakultas">
							<span class="h6 text-uppercase">Penjaga Sekolah</span>
							</a>
							<a class="badge rounded-pill bg-secondary-soft me-1 mb-1" href="#" data-bs-toggle="pill" data-filter=".PesuruhOfficeBoy" data-bs-target="#fakultas">
							<span class="h6 text-uppercase">Pesuruh/Office Boy</span>
							</a>
							<a class="badge rounded-pill bg-secondary-soft me-1 mb-1" href="#" data-bs-toggle="pill" data-filter=".PetugasKeamanan" data-bs-target="#fakultas">
							<span class="h6 text-uppercase">Petugas Keamanan</span>
							</a>
							<a class="badge rounded-pill bg-secondary-soft me-1 mb-1" href="#" data-bs-toggle="pill" data-filter=".TenagaAdministrasiSekolah" data-bs-target="#fakultas">
							<span class="h6 text-uppercase">Tenaga Administrasi Sekolah</span>
							</a>
							<a class="badge rounded-pill bg-secondary-soft me-1 mb-1" href="#" data-bs-toggle="pill" data-filter=".TenagaPerpustakaan" data-bs-target="#fakultas">
							<span class="h6 text-uppercase">Tenaga Perpustakaan</span>
							</a>
							<a class="badge rounded-pill bg-secondary-soft me-1 mb-1" href="#" data-bs-toggle="pill" data-filter=".TukangKebun" data-bs-target="#fakultas">
							<span class="h6 text-uppercase">Tukang Kebun</span>
							</a>
							<a class="badge rounded-pill bg-secondary-soft me-1 mb-1" href="#" data-bs-toggle="pill" data-filter=".Tutor" data-bs-target="#fakultas">
								<span class="h6 text-uppercase">Tutor</span>
							</a>
							<a class="badge rounded-pill bg-secondary-soft me-1 mb-1" href="#" data-bs-toggle="pill" data-filter=".Lainnya" data-bs-target="#fakultas">
								<span class="h6 text-uppercase">Lainnya</span>
							</a>
						</nav>
						</div>
					</div> <!-- / .row -->
				</div>
			</section>

			<!-- Data filter -->
			<section class="py-8 pt-md-6 pb-md-0" data-aos="fade-in" data-aos-delay="200">
				<div class="container-fluid">
					<div class="row" id="fakultas" data-isotope="{&quot;layoutMode&quot;: &quot;fitRows&quot;}" style="position: relative; height: 5834.25px;">
						<div class="col-12 col-md-6 col-lg-4 justify-content-center GuruBK" style="position: absolute; left: 0px; top: 648.25px;">
							<div class="card card-border border-primary shadow-lg mb-6 mb-md-8 lift lift-lg ">
								<div class="card-body p-5">
								<!-- Icon -->
									<div class="text-center mb-5">
										<h4 class="fw-bold">
										Guru BK
										</h4>
										<!-- Badge -->
										<span class="badge rounded-pill bg-dark-soft ">
										<span class="h6 text-uppercase">
											Total: {{ $guruBKTotal->count() }}
										</span>
										</span>
									</div>
									<div class="list-group primary">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Laki-laki
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-primary-soft">
												<span class="h6 text-uppercase">{{ $guruBKLakilaki->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Perempuan
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-primary-soft">
												<span class="h6 text-uppercase">{{ $guruBKPerempuan->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
									<br>
									<div class="list-group primary ">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-primary-soft">
												<span class="h6 text-uppercase">{{ $guruBKPNS->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												NON PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-primary-soft">
												<span class="h6 text-uppercase">{{ $guruBKNonPNS->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-4 justify-content-center GuruKelas" style="position: absolute; left: 0px; top: 648.25px;">
							<div class="card card-border border-success shadow-lg mb-6 mb-md-8 lift lift-lg ">
								<div class="card-body p-5">
								<!-- Icon -->
									<div class="text-center mb-5">
										<h4 class="fw-bold">
										Guru Kelas
										</h4>
										<!-- Badge -->
										<span class="badge rounded-pill bg-dark-soft ">
										<span class="h6 text-uppercase">
											Total: {{ $guruKelasTotal->count() }}
										</span>
										</span>
									</div>
									<div class="list-group success">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Laki-laki
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-success-soft">
												<span class="h6 text-uppercase">{{ $guruKelasLakilaki->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Perempuan
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-success-soft">
												<span class="h6 text-uppercase">{{ $guruKelasPerempuan->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
									<br>
									<div class="list-group success">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-success-soft">
												<span class="h6 text-uppercase">{{ $guruKelasPNS->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												NON PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-success-soft">
												<span class="h6 text-uppercase">{{ $guruKelasNonPNS->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-4 justify-content-center GuruMapel" style="position: absolute; left: 0px; top: 648.25px;">
							<div class="card card-border border-warning shadow-lg mb-6 mb-md-8 lift lift-lg ">
								<div class="card-body p-5">
								<!-- Icon -->
									<div class="text-center mb-5">
										<h4 class="fw-bold">
										Guru Mapel
										</h4>
										<!-- Badge -->
										<span class="badge rounded-pill bg-dark-soft ">
										<span class="h6 text-uppercase">
											Total: {{ $guruMapelTotal->count() }}
										</span>
										</span>
									</div>
									<div class="list-group warning">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Laki-laki
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-warning-soft">
												<span class="h6 text-uppercase">{{ $guruMapelLakilaki->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Perempuan
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-warning-soft">
												<span class="h6 text-uppercase">{{ $guruMapelPerempuan->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
									<br>
									<div class="list-group warning">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-warning-soft">
												<span class="h6 text-uppercase">{{ $guruMapelPNS->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												NON PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-warning-soft">
												<span class="h6 text-uppercase">{{ $guruMapelNonPNS->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-12 col-md-6 col-lg-4 justify-content-center GuruPendamping" style="position: absolute; left: 0px; top: 648.25px;">
							<div class="card card-border border-danger shadow-lg mb-6 mb-md-8 lift lift-lg ">
								<div class="card-body p-5">
								<!-- Icon -->
									<div class="text-center mb-5">
										<h4 class="fw-bold">
										Guru Pendamping
										</h4>
										<!-- Badge -->
										<span class="badge rounded-pill bg-dark-soft ">
										<span class="h6 text-uppercase">
											Total: {{ $guruPendampingTotal->count() }}
										</span>
										</span>
									</div>
									<div class="list-group danger">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Laki-laki
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-danger-soft">
												<span class="h6 text-uppercase">{{ $guruPendampingLakilaki->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Perempuan
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-danger-soft">
												<span class="h6 text-uppercase">{{ $guruPendampingPerempuan->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
									<br>
									<div class="list-group danger">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-danger-soft">
												<span class="h6 text-uppercase">{{ $guruPendampingPNS->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												NON PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-danger-soft">
												<span class="h6 text-uppercase">{{ $guruPendampingNonPNS->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-4 justify-content-center GuruPendampingKhusus" style="position: absolute; left: 0px; top: 648.25px;">
							<div class="card card-border border-info shadow-lg mb-6 mb-md-8 lift lift-lg ">
								<div class="card-body p-5">
								<!-- Icon -->
									<div class="text-center mb-5">
										<h4 class="fw-bold">
										Guru Pendamping Khusus
										</h4>
										<!-- Badge -->
										<span class="badge rounded-pill bg-dark-soft ">
										<span class="h6 text-uppercase">
											Total: {{ $guruPendampingKhususTotal->count() }}
										</span>
										</span>
									</div>
									<div class="list-group info">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Laki-laki
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-info-soft">
												<span class="h6 text-uppercase">{{ $guruPendampingKhususLakilaki->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Perempuan
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-info-soft">
												<span class="h6 text-uppercase">{{ $guruPendampingKhususPerempuan->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
									<br>
									<div class="list-group info">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-info-soft">
												<span class="h6 text-uppercase">{{ $guruPendampingKhususPNS->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												NON PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-info-soft">
												<span class="h6 text-uppercase">{{ $guruPendampingKhususNonPNS->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-4 justify-content-center GuruPengganti" style="position: absolute; left: 0px; top: 648.25px;">
							<div class="card card-border border-secondary shadow-lg mb-6 mb-md-8 lift lift-lg ">
								<div class="card-body p-5">
								<!-- Icon -->
									<div class="text-center mb-5">
										<h4 class="fw-bold">
										Guru Pengganti
										</h4>
										<!-- Badge -->
										<span class="badge rounded-pill bg-dark-soft ">
										<span class="h6 text-uppercase">
											Total: {{ $guruPenggantiTotal->count() }}
										</span>
										</span>
									</div>
									<div class="list-group secondary">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Laki-laki
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-secondary-soft">
												<span class="h6 text-uppercase">{{ $guruPenggantiLakilaki->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Perempuan
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-secondary-soft">
												<span class="h6 text-uppercase">{{ $guruPenggantiPerempuan->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
									<br>
									<div class="list-group secondary">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-secondary-soft">
												<span class="h6 text-uppercase">{{ $guruPenggantiPNS->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												NON PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-secondary-soft">
												<span class="h6 text-uppercase">{{ $guruPenggantiNonPNS->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
								</div>
							</div>
						</div>

						<div class="col-12 col-md-6 col-lg-4 justify-content-center GuruTIK" style="position: absolute; left: 0px; top: 648.25px;">
							<div class="card card-border border-primary shadow-lg mb-6 mb-md-8 lift lift-lg ">
								<div class="card-body p-5">
								<!-- Icon -->
									<div class="text-center mb-5">
										<h4 class="fw-bold">
										Guru TIK
										</h4>
										<!-- Badge -->
										<span class="badge rounded-pill bg-dark-soft ">
										<span class="h6 text-uppercase">
											Total: {{ $guruTIKTotal->count() }}
										</span>
										</span>
									</div>
									<div class="list-group primary">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Laki-laki
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-primary-soft">
												<span class="h6 text-uppercase">{{ $guruTIKLakilaki->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Perempuan
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-primary-soft">
												<span class="h6 text-uppercase">{{ $guruTIKPerempuan->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
									<br>
									<div class="list-group primary ">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-primary-soft">
												<span class="h6 text-uppercase">{{ $guruTIKPNS->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												NON PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-primary-soft">
												<span class="h6 text-uppercase">{{ $guruTIKNonPNS->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-4 justify-content-center Instruktur" style="position: absolute; left: 0px; top: 648.25px;">
							<div class="card card-border border-success shadow-lg mb-6 mb-md-8 lift lift-lg ">
								<div class="card-body p-5">
								<!-- Icon -->
									<div class="text-center mb-5">
										<h4 class="fw-bold">
										Instruktur
										</h4>
										<!-- Badge -->
										<span class="badge rounded-pill bg-dark-soft ">
										<span class="h6 text-uppercase">
											Total: {{ $instrukturTotal->count() }}
										</span>
										</span>
									</div>
									<div class="list-group success">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Laki-laki
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-success-soft">
												<span class="h6 text-uppercase">{{ $instrukturLakilaki->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Perempuan
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-success-soft">
												<span class="h6 text-uppercase">{{ $instrukturPerempuan->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
									<br>
									<div class="list-group success">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-success-soft">
												<span class="h6 text-uppercase">{{ $instrukturPNS->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												NON PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-success-soft">
												<span class="h6 text-uppercase">{{ $instrukturNonPNS->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-4 justify-content-center KepalaSekolah" style="position: absolute; left: 0px; top: 648.25px;">
							<div class="card card-border border-warning shadow-lg mb-6 mb-md-8 lift lift-lg ">
								<div class="card-body p-5">
								<!-- Icon -->
									<div class="text-center mb-5">
										<h4 class="fw-bold">
										Kepala Sekolah
										</h4>
										<!-- Badge -->
										<span class="badge rounded-pill bg-dark-soft ">
										<span class="h6 text-uppercase">
											Total: {{ $kepalaSekolahTotal->count() }}
										</span>
										</span>
									</div>
									<div class="list-group warning">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Laki-laki
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-warning-soft">
												<span class="h6 text-uppercase">{{ $kepalaSekolahLakilaki->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Perempuan
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-warning-soft">
												<span class="h6 text-uppercase">{{ $kepalaSekolahPerempuan->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
									<br>
									<div class="list-group warning">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-warning-soft">
												<span class="h6 text-uppercase">{{ $kepalaSekolahPNS->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												NON PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-warning-soft">
												<span class="h6 text-uppercase">{{ $kepalaSekolahNonPNS->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
								</div>
							</div>
						</div>

						<div class="col-12 col-md-6 col-lg-4 justify-content-center Laboran" style="position: absolute; left: 0px; top: 648.25px;">
							<div class="card card-border border-danger shadow-lg mb-6 mb-md-8 lift lift-lg ">
								<div class="card-body p-5">
								<!-- Icon -->
									<div class="text-center mb-5">
										<h4 class="fw-bold">
										Laboran
										</h4>
										<!-- Badge -->
										<span class="badge rounded-pill bg-dark-soft ">
										<span class="h6 text-uppercase">
											Total: {{ $laboranTotal->count() }}
										</span>
										</span>
									</div>
									<div class="list-group danger">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Laki-laki
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-danger-soft">
												<span class="h6 text-uppercase">{{ $laboranLakilaki->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Perempuan
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-danger-soft">
												<span class="h6 text-uppercase">{{ $laboranPerempuan->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
									<br>
									<div class="list-group danger">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-danger-soft">
												<span class="h6 text-uppercase">{{ $laboranPNS->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												NON PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-danger-soft">
												<span class="h6 text-uppercase">{{ $laboranNonPNS->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-4 justify-content-center PenjagaSekolah" style="position: absolute; left: 0px; top: 648.25px;">
							<div class="card card-border border-info shadow-lg mb-6 mb-md-8 lift lift-lg ">
								<div class="card-body p-5">
								<!-- Icon -->
									<div class="text-center mb-5">
										<h4 class="fw-bold">
										Penjaga Sekolah
										</h4>
										<!-- Badge -->
										<span class="badge rounded-pill bg-dark-soft ">
										<span class="h6 text-uppercase">
											Total: {{ $penjagaSekolahTotal->count() }}
										</span>
										</span>
									</div>
									<div class="list-group info">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Laki-laki
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-info-soft">
												<span class="h6 text-uppercase">{{ $penjagaSekolahLakilaki->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Perempuan
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-info-soft">
												<span class="h6 text-uppercase">{{ $penjagaSekolahPerempuan->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
									<br>
									<div class="list-group info">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-info-soft">
												<span class="h6 text-uppercase">{{ $penjagaSekolahPNS->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												NON PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-info-soft">
												<span class="h6 text-uppercase">{{ $penjagaSekolahNonPNS->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-4 justify-content-center PesuruhOfficeBoy" style="position: absolute; left: 0px; top: 648.25px;">
							<div class="card card-border border-secondary shadow-lg mb-6 mb-md-8 lift lift-lg ">
								<div class="card-body p-5">
								<!-- Icon -->
									<div class="text-center mb-5">
										<h4 class="fw-bold">
										Pesuruh/Office Boy
										</h4>
										<!-- Badge -->
										<span class="badge rounded-pill bg-dark-soft ">
										<span class="h6 text-uppercase">
											Total: {{ $pesuruhTotal->count() }}
										</span>
										</span>
									</div>
									<div class="list-group secondary">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Laki-laki
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-secondary-soft">
												<span class="h6 text-uppercase">{{ $pesuruhLakilaki->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Perempuan
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-secondary-soft">
												<span class="h6 text-uppercase">{{ $pesuruhPerempuan->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
									<br>
									<div class="list-group secondary">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-secondary-soft">
												<span class="h6 text-uppercase">{{ $pesuruhPNS->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												NON PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-secondary-soft">
												<span class="h6 text-uppercase">{{ $pesuruhNonPNS->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
								</div>
							</div>
						</div>

						<div class="col-12 col-md-6 col-lg-4 justify-content-center PetugasKeamanan" style="position: absolute; left: 0px; top: 648.25px;">
							<div class="card card-border border-primary shadow-lg mb-6 mb-md-8 lift lift-lg ">
								<div class="card-body p-5">
								<!-- Icon -->
									<div class="text-center mb-5">
										<h4 class="fw-bold">
										Petugas Keamanan
										</h4>
										<!-- Badge -->
										<span class="badge rounded-pill bg-dark-soft ">
										<span class="h6 text-uppercase">
											Total: {{ $petugasKeamananTotal->count() }}
										</span>
										</span>
									</div>
									<div class="list-group primary">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Laki-laki
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-primary-soft">
												<span class="h6 text-uppercase">{{ $petugasKeamananLakilaki->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Perempuan
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-primary-soft">
												<span class="h6 text-uppercase">{{ $petugasKeamananPerempuan->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
									<br>
									<div class="list-group primary ">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-primary-soft">
												<span class="h6 text-uppercase">{{ $petugasKeamananPNS->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												NON PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-primary-soft">
												<span class="h6 text-uppercase">{{ $petugasKeamananNonPNS->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-4 justify-content-center TenagaAdministrasiSekolah" style="position: absolute; left: 0px; top: 648.25px;">
							<div class="card card-border border-success shadow-lg mb-6 mb-md-8 lift lift-lg ">
								<div class="card-body p-5">
								<!-- Icon -->
									<div class="text-center mb-5">
										<h4 class="fw-bold">
										Tenaga Administrasi Sekolah
										</h4>
										<!-- Badge -->
										<span class="badge rounded-pill bg-dark-soft ">
										<span class="h6 text-uppercase">
											Total: {{ $tenagaAdministrasiTotal->count() }}
										</span>
										</span>
									</div>
									<div class="list-group success">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Laki-laki
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-success-soft">
												<span class="h6 text-uppercase">{{ $tenagaAdministrasiLakilaki->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Perempuan
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-success-soft">
												<span class="h6 text-uppercase">{{ $tenagaAdministrasiPerempuan->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
									<br>
									<div class="list-group success">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-success-soft">
												<span class="h6 text-uppercase">{{ $tenagaAdministrasiPNS->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												NON PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-success-soft">
												<span class="h6 text-uppercase">{{ $tenagaAdministrasiNonPNS->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-4 justify-content-center TenagaPerpustakaan" style="position: absolute; left: 0px; top: 648.25px;">
							<div class="card card-border border-warning shadow-lg mb-6 mb-md-8 lift lift-lg ">
								<div class="card-body p-5">
								<!-- Icon -->
									<div class="text-center mb-5">
										<h4 class="fw-bold">
										Tenaga Perpustakaan
										</h4>
										<!-- Badge -->
										<span class="badge rounded-pill bg-dark-soft ">
										<span class="h6 text-uppercase">
											Total: {{ $tenagaPerpustakaanTotal->count() }}
										</span>
										</span>
									</div>
									<div class="list-group warning">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Laki-laki
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-warning-soft">
												<span class="h6 text-uppercase">{{ $tenagaPerpustakaanLakilaki->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Perempuan
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-warning-soft">
												<span class="h6 text-uppercase">{{ $tenagaPerpustakaanPerempuan->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
									<br>
									<div class="list-group warning">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-warning-soft">
												<span class="h6 text-uppercase">{{ $tenagaPerpustakaanPNS->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												NON PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-warning-soft">
												<span class="h6 text-uppercase">{{ $tenagaPerpustakaanNonPNS->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
								</div>
							</div>
						</div>

						<div class="col-12 col-md-6 col-lg-4 justify-content-center TukangKebun" style="position: absolute; left: 0px; top: 648.25px;">
							<div class="card card-border border-danger shadow-lg mb-6 mb-md-8 lift lift-lg ">
								<div class="card-body p-5">
								<!-- Icon -->
									<div class="text-center mb-5">
										<h4 class="fw-bold">
										Tukang Kebun
										</h4>
										<!-- Badge -->
										<span class="badge rounded-pill bg-dark-soft ">
										<span class="h6 text-uppercase">
											Total: {{ $tukangKebunTotal->count() }}
										</span>
										</span>
									</div>
									<div class="list-group danger">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Laki-laki
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-danger-soft">
												<span class="h6 text-uppercase">{{ $tukangKebunLakilaki->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Perempuan
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-danger-soft">
												<span class="h6 text-uppercase">{{ $tukangKebunPerempuan->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
									<br>
									<div class="list-group danger">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-danger-soft">
												<span class="h6 text-uppercase">{{ $tukangKebunPNS->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												NON PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-danger-soft">
												<span class="h6 text-uppercase">{{ $tukangKebunNonPNS->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-4 justify-content-center Tutor" style="position: absolute; left: 0px; top: 648.25px;">
							<div class="card card-border border-info shadow-lg mb-6 mb-md-8 lift lift-lg ">
								<div class="card-body p-5">
								<!-- Icon -->
									<div class="text-center mb-5">
										<h4 class="fw-bold">
										Tutor
										</h4>
										<!-- Badge -->
										<span class="badge rounded-pill bg-dark-soft ">
										<span class="h6 text-uppercase">
											Total: {{ $tutorTotal->count() }}
										</span>
										</span>
									</div>
									<div class="list-group info">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Laki-laki
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-info-soft">
												<span class="h6 text-uppercase">{{ $tutorLakilaki->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Perempuan
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-info-soft">
												<span class="h6 text-uppercase">{{ $tutorPerempuan->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
									<br>
									<div class="list-group info">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-info-soft">
												<span class="h6 text-uppercase">{{ $tutorPNS->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												NON PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-info-soft">
												<span class="h6 text-uppercase">{{ $tutorNonPNS->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-4 justify-content-center Lainnya" style="position: absolute; left: 0px; top: 648.25px;">
							<div class="card card-border border-secondary shadow-lg mb-6 mb-md-8 lift lift-lg ">
								<div class="card-body p-5">
								<!-- Icon -->
									<div class="text-center mb-5">
										<h4 class="fw-bold">
										Lainnya
										</h4>
										<!-- Badge -->
										<span class="badge rounded-pill bg-dark-soft ">
										<span class="h6 text-uppercase">
											Total: {{ $lainnyaTotal->count() }}
										</span>
										</span>
									</div>
									<div class="list-group secondary">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Laki-laki
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-secondary-soft">
												<span class="h6 text-uppercase">{{ $lainnyaLakilaki->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												Perempuan
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-secondary-soft">
												<span class="h6 text-uppercase">{{ $lainnyaPerempuan->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
									<br>
									<div class="list-group secondary">
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span>
												<span class="badge rounded-pill bg-secondary-soft">
												<span class="h6 text-uppercase">{{ $lainnyaPNS->count() }}</span>
												</span>
											</span>
											</div>
										</div>
										</li>
										
										<li class="list-group-item px-4 py-3">
										<!-- Text -->
										<div class="row align-items-center">
											<div class="col-8 pl-1">
											<!-- Heading -->
											<h5 class="mb-0">
												NON PNS
											</h5>
											</div>
											<div class="col-4 text-end">
											<!-- Badge -->
											<span class="badge rounded-pill bg-secondary-soft">
												<span class="h6 text-uppercase">{{ $lainnyaNonPNS->count() }}</span>
											</span>
											</div>
										</div>
										</li>
									</div>
								</div>
							</div>
						</div>
			</section>

			

{{-- 
			<div class="position-relative">
				<div class="shape shape-bottom shape-fluid-x text-white">
				<svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 48h2880V0h-720C1442.5 52 720 0 720 0H0v48z" fill="currentColor"></path></svg>      </div>
			</div> --}}

			{{-- <div class="position-relative">
				<div class="shape shape-bottom shape-fluid-x text-white">
				<svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 48h2880V0h-720C1442.5 52 720 0 720 0H0v48z" fill="currentColor"></path></svg>      </div>
			</div> --}}
		  

{{-- <section class="py-8 py-md-11 bg-gray-200">
	<div class="container">
		<div class="row justify-content-center">
		<div class="col-12 col-md-10 col-lg-12 text-center">
			<!-- Heading -->
			<h2 class="fw-bold">
			Daftar Usulan Kenaikan Gaji dan Pangkat
			</h2>
		</div>
		</div> <!-- / .row -->
		<div class="row gx-4">
		<div class="col-12 col-lg-6 d-lg-flex mb-4">
			<!-- Card -->
			<div class="card shadow-light-lg overflow-hidden" data-aos="fade-up">
			<div class="row">
				<div class="col-md-4 position-relative">
				<!-- Image -->
				<img src="assets/welcome/img/illustrations/illustration-11.png" class="h-75 position-absolute right-0 mt-7 me-n4" alt="...">
				</div>
				<div class="col-md-8">
					<!-- Body -->
					<div class="card-body py-7 py-md-9 text-center">

						<!-- Heading -->
						<h4 class="fw-bold">
							Kenaikan Gaji
						</h4>

						<!-- Text -->
						<p class="text-muted mb-0">
							Lihat Daftar Usulan Kenaikan Gaji
						</p>

						<a href="kenaikan_gaji.html" class="btn btn-primary mt-4">Lihat</a>

					</div>

				</div>
			</div> <!-- / .row -->
		</div>
		</div>
		<div class="col-12 col-lg-6 d-lg-flex mb-4">
			<!-- Card -->
			<div class="card shadow-light-lg overflow-hidden text-center" data-aos="fade-up">
			<div class="row">
				<div class="col-md-8">

					<!-- Body -->
					<div class="card-body py-7 py-md-9">

						<!-- Heading -->
						<h4 class="fw-bold">
							Daftar Kenaikan Pangkat
						</h4>

						<!-- Text -->
						<p class="text-muted mb-0">
							Lihat Daftar Usulan Kenaikan Pangkat
						</p>

						<a href="kenaikan_pangkat.html" class="btn btn-primary mt-4">Lihat</a>

					</div>

				</div>
				<div class="col-md-4">

					<!-- Image -->
					<img src="assets/welcome/img/illustrations/illustration-12.png"
						class="h-75 position-absolute left-0 mt-7" alt="...">

				</div>
			</div> <!-- / .row -->
		</div>

	</div>
	</div> <!-- / .row -->
		<div class="row">
			<div class="col-12">

				<!-- Card -->
				<div class="card shadow-light-lg overflow-hidden text-center text-lg-start" data-aos="fade-up">
					<div class="row">
						<div class="col-md-4 position-relative">

							<!-- Image -->
							<img src="assets/welcome/img/illustrations/illustration-12.png"
								class="h-75 position-absolute right-0 mt-6" alt="...">

						</div>
					</div> <!-- / .row -->
				</div>

			</div>
		</div> <!-- / .row -->
	</div> <!-- / .container -->
</section> --}}


@endsection

@push('style')
      <style>
		  /* @media (max-width: 800) {
			  .container-fluid {
				  padding-left: 0 !important;
				  padding-right: 0 !important;
			  }
		  } */
		  @media (min-width: 200px) {
			  .container-fluid {
				  padding-left: 2rem !important;
				  padding-right: 2rem !important;
			  }
		  }

		@media (min-width: 460px) { 
			.container-fluid {
				  padding-left: 2.5rem !important;
				  padding-right: 2.5rem !important;
			  }
		 }

		/* Medium devices (tablets, 768px and up) */
		@media (min-width: 768px) {
			.container-fluid {
				  padding-left: 3.5rem !important;
				  padding-right: 3.5rem !important;
			  }
		 }

		/* Large devices (desktops, 992px and up) */
		@media (min-width: 990px) {
			.container-fluid {
				  padding-left: 10rem !important;
				  padding-right: 10rem !important;
			  }
		 }

		/* Extra large devices (large desktops, 1200px and up) */
		@media (min-width: 1600px) {
			.container-fluid {
				  padding-left: 16rem !important;
				  padding-right: 16rem !important;
			  }
		}
		/* @media (min-width: 1600px) {
			.container-fluid {
				padding-left: 120px !important;
				padding-right: 120px !important;
			} */
		
     </style>
@endpush

@push('script')
<script src="/assets/welcome/js/chart.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('myChart').getContext('2d');
const data = {
  labels: <?php echo $namaStatus; ?>,
  datasets: [{
    label: 'Jumlah',
    data: <?php echo $jumlahTiapStatus; ?>,
    backgroundColor: [
		'#ff595e',
		'#ff6b6b',
		'#f8961e',
		'#f9c74f',
		'#90be6d',
		'#43aa8b',
		'#17c3b2',
		'#227c9d',
		'#3a6ea5',
    ]
  }]
};
const myChart = new Chart(ctx, {
  type: 'bar',
  data: data,
  options: {}
});


</script>
@endpush
