@extends('templates.welcome')

@section('title')
    Sistem Informasi Manajemen Pegawai
@endsection

@section('content')    		
<nav class="bg-gray-200">
	<div class="container-fluid">
	  <div class="row">
		<div class="col-12">
		  <!-- Breadcrumb -->
		  <ol class="breadcrumb breadcrumb-scroll">
			<li class="breadcrumb-item">
			  <a href="/" class="text-gray-700">
				SIMPEG Dinas Pendidikan Kota Palu
			  </a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">
			  Daftar Usulan Kenaikan Pangkat
			</li>
		  </ol>

		</div>
	  </div> <!-- / .row -->
	</div> <!-- / .container -->
</nav>
<section class="py-6">
	<div class="container-fluid">
		<h1 class="display-5 text-gray-900 text-center mb-6" data-aos="fade-up" data-aos-delay="100">
			Daftar Usulan Kenaikan Pangkat
		</h1>
	  <div class="row align-items-center">	
		<div class="col-lg-2 col-md-4 col-sm-12 text-center align-items-center  pb-3" data-aos="fade-right" data-aos-delay="250">
			<a href="/daftar-usulan-kenaikan-pangkat-export" class="btn btn-sm btn-secondary"><i class="fas fa-download"></i>  Ekspor Excel</a>
		</div>
		<div class="col-lg-10 col-md-8 col-sm-12" data-aos="fade-left" data-aos-delay="250">
			<!-- Form -->
			  <form class="rounded shadow" action="/daftar-usulan-kenaikan-pangkat">
				  <div class="input-group input-group-lg">
					  <!-- Text -->
					  <span class="input-group-text border-0 pe-1">
						  <i class="fe fe-search"></i>
					  </span>
					  <!-- Input -->
					  <input type="text" class="form-control border-0 px-1" aria-label="Search our blog..." name="cari" placeholder="Cari Nama..." value="{{ request('cari') }}">
					  <!-- Text -->
					  <span class="input-group-text border-0 py-0 ps-1 pe-3">
						  <!-- Text -->
						  <span class="h6 text-uppercase text-muted d-none d-md-block mb-0 me-5">				  
						  </span>
						  <!-- Button -->
						  
						  <button type="submit" class="btn shadow-lg btn-sm btn-primary">
							  <i class="fas fa-search"></i> 
						  </button>
					  </span>					
				  </div>
			  </form>
		</div>
	</div> <!-- / .row -->
</div>
</section>
<section>
	<div class="container-fluid">
		<div class="row">
		@if(request('cari') != '')
		<h4 class="mb-4 text-gray-800">Menampilkan hasil pencarian Nama : "{{ request('cari') }}"</h4>                  
		@endif
		@forelse ($usulanPangkat->get() as $item)
			<div class="col-12 col-md-4 col-lg-3 d-flex" data-aos="fade-up" data-aos-delay="250">

			<!-- Card -->
			<div class="card mb-6 shadow-light-lg lift lift-lg">

				<!-- Image -->
				<div class="card-img-top">

					<!-- Image -->
					<img src="@if ($item->foto != NULL)
					{{ '/storage/upload/foto-profil/'.$item->foto }}
					@else
					{{ '/assets/welcome/img/avatar.png' }}					
					@endif" alt="..." class="card-img-top" style="height:280px; object-fit: cover; object-position: 100% 0;">

					<!-- Shape -->
					<div class="position-relative">
						<div class="shape shape-bottom shape-fluid-x text-white">
						<svg viewBox="0 0 2880 480" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M2160 0C1440 240 720 240 720 240H0v240h2880V0h-720z" fill="currentColor"></path></svg>                  </div>
					</div>

				</div>

				<!-- Body -->
				<div class="card-body px-4 pt-5 pb-3">
					<!-- Heading -->
					<h4 class="text-center mb-0">
						{{ $item->nama }}
					</h4>
					<h6 class="text-center text-muted">
						({{ $item->nip }})
					</h6>
					

					<ul class="pt-2">
						<li class="text-muted">
							<p class="mb-0 text-muted">
								{{ $item->status }}								
							</p>
						</li>
						<li class="text-muted">
							<p class="mb-0 text-muted">
								{{ $item->jenis_asn }}								
							</p>
						</li>
						<li class="text-muted">
							<p class="mb-0 text-muted">
								Golongan @if ($item->jenis_asn == 'Guru')
									{{ $item->golongan_jabatan_fungsional }}																	
								@else
									{{ $item->golongan_jabatan_struktural }}								
								@endif 
							</p>
						</li>					
						<li class="text-muted">
							<p class="mb-0 text-muted">
								{{ $item->jenis_guru }}								
							</p>
						</li>
						<li class="text-muted">
							<p class="mb-0 text-muted">
								{{ $item->sekolah }}								
							</p>
						</li>	
						<li class="text-muted">
							<p class="mb-0 text-muted">
								{{ $item->kecamatan }}								
							</p>
						</li>						
					</ul>
					<!-- Text -->

				</div>

				<!-- Meta -->
				<div class="card-meta mt-auto">

					<!-- Divider -->
					<hr class="card-meta-divider">

					{{-- <!-- Avatar -->
					<div class="avatar avatar-sm me-2">
						<img src="assets/img/avatars/avatar-1.jpg" alt="..." class="avatar-img rounded-circle">
					</div> --}}

					<!-- Author -->
					<h6 class="text-uppercase text-muted me-2 mb-0">
						Masa Kerja :
					</h6>

					<!-- Date -->
					<p class="h6 text-uppercase text-muted mb-0 ms-auto">
						@php
								$tanggal_kerja = new DateTime($item->tanggal_kerja);
								$sekarang = new DateTime("today") ;
								$thn = $sekarang->diff ($tanggal_kerja)->y;
								$bln = $sekarang->diff($tanggal_kerja)->m;
								echo $thn . " Tahun " . $bln . " Bulan ";                        
							@endphp
					</p>

				</div>

			</div>

			</div>		
		@empty
			<h4 class="text-center text-muted mt-8">Data tidak ditemukan</h4>
		@endforelse				
	  </div> <!-- / .row -->
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
