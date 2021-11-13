@extends('templates.welcome')

@section('title')
    Sistem Informasi Manajemen Pegawai
@endsection

@section('content')    	
		<section class="pt-4 pt-md-11 mb-7">
			<div class="container-fluid">
			  <div class="row align-items-center">
				<div class="col-12 col-md-6 col-lg-6 order-md-2">

				  <!-- Image -->
				  <img src="assets/welcome/img/illustrations/illustration-10.png" class="img-fluid mw-md-150 mw-lg-130 mb-6 mb-md-0" alt="..." data-aos="fade-up" data-aos-delay="100">

				</div>
				<div class="col-12 col-md-4 col-lg-4 order-md-1" data-aos="fade-up">

				  <!-- Heading -->
				  <h1 class="display-3 text-center text-md-start">
					<span class="text-primary">SIMPEG</span>. <br>
				  </h1>

				  <!-- Text -->
				  <p class="lead text-center text-md-start text-muted mb-6 mb-lg-8">
					Sistem Informasi Manajemen Pegawai
				  </p>

				  <!-- Buttons -->
				  <div class="text-center text-md-start">
					<a href="/login" class="btn btn-primary shadow lift me-1">
					  Masuk <i class="fe fe-arrow-right d-none d-md-inline ms-3"></i>
					</a>
				  </div>

				</div>
			  </div> <!-- / .row -->
			</div> <!-- / .container -->			
		  </section>

		  

		  <section class="py-8 py-md-4 bg-gradient-light-white">
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
								@if ($usulanGaji->count() != 0)
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

		  <section class="py-8 py-md-11 bg-gray-200">
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
						<img src="assets/welcome/img/illustrations/illustration-12.png" class="h-75 position-absolute left-0 mt-7" alt="...">

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
						<img src="assets/welcome/img/illustrations/illustration-12.png" class="h-75 position-absolute right-0 mt-6" alt="...">

					  </div>
					</div> <!-- / .row -->
				  </div>

				</div>
			  </div> <!-- / .row -->
			</div> <!-- / .container -->
		  </section>

       <!-- CONTROL -->
       <section class="pt-5 pt-md-5">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 text-center">

              <!-- Heading -->
              <h1 class="fw-bold">
                Statistik Guru
              </h1>


            </div>
        </div> <!-- / .row -->
        <div class="row">
            <div class="col-12 order-md-2 mt-5">
              <canvas id="myChart" width="400" height="150"></canvas>
            </div>

        </div>
		<div class="d-flex justify-content-center mt-5">
			<a class="btn btn-primary" href="statistik.html" target="_blank">
				Lihat Selengkapnya <i class="fe fe-arrow-right d-none d-md-inline ms-3"></i>
			  </a>
		</div>


          </div>

        </div> <!-- / .container -->

      </section>
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

<script>

if($('#alertNonPNS').val() == 'Terima Kasih'){	
	swal({
		title: "Terima Kasih",
		text: "Data diri anda telah tersimpan",
		icon: "success",
		buttons: {
			confirm: {
				text: "Oke",
				value: true,
				visible: true,
				className: "btn btn-success",
				closeModal: true
			}
		}
	});
}

if($('#alertNonPNS').val() == 'Sudah Ada'){	
	swal({
		title: "Data profil anda sudah lengkap",
		text: "Apabila ingin mengubah data silahkan hubungi Admin.",
		icon: "success",
		buttons: {
			confirm: {
				text: "Oke",
				value: true,
				visible: true,
				className: "btn btn-success",
				closeModal: true
			}
		}
	});
}
	
  var ctx = document.getElementById('myChart');
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: ['Statistik Guru Berdasarkan Jenis Kelamin'],
          datasets: [
            {
              label: 'Pria',
              data: [250],
              backgroundColor: [
                  'rgba(54, 162, 235, 0.2)',
              ],
              borderColor: [
                  'rgba(54, 162, 235, 1)',
              ],
              borderWidth: 1
          },
          {
              label: 'Wanita',
              data: [100],
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
              ],
              borderWidth: 1
          }
        ]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          },
          plugins: {
            legend: {
                display: true,
                labels: {
                    color: 'rgb(255, 99, 132)'
                }
            }
          }
      }
  });
  </script>
@endpush
