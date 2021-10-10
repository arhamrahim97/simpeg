@extends('templates.welcome')

@section('title')
    Sistem Informasi Manajemen Pegawai
@endsection

@section('content')
    	    <!-- WELCOME -->
		<section class="pt-4 pt-md-11">
			<div class="container">
			  <div class="row align-items-center">
				<div class="col-12 col-md-5 col-lg-6 order-md-2">

				  <!-- Image -->
				  <img src="assets/welcome/img/illustrations/illustration-10.png" class="img-fluid mw-md-150 mw-lg-130 mb-6 mb-md-0" alt="..." data-aos="fade-up" data-aos-delay="100">

				</div>
				<div class="col-12 col-md-7 col-lg-6 order-md-1" data-aos="fade-up">

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
					<a href="masuk.html" class="btn btn-primary shadow lift me-1">
					  Masuk <i class="fe fe-arrow-right d-none d-md-inline ms-3"></i>
					</a>
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

      </style>
@endpush

@push('script')
<script src="assets/welcome/js/chart.js"></script>
<script>
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
