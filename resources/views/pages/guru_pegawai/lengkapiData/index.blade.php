@extends('components.dashboard.guru_pegawai.mainLengkapiData')

@section('content')
<div class="card">
	<div class="card-header py-4 text-center">
		<h3 class="wizard-title">Terima kasih telah melengkapi <b>Profil & Berkas Dasar</b> Anda</h3>
		<small>Refresh secara berkala. Halaman ini akan berganti apabila profil dan berkas dasar anda telah di setujui oleh Admin</small>
	</div>
	<div class="card-body py-5">
        <div class="row">
			<div class="col-12">
				@if ($user->profile->status_profile == '0')
					<div class="alert alert-warning" role="alert">
						<span><i class="fas fa-clock"></i> Profile anda sedang menunggu persetujuan dari Admin</span>
					</div>					
				@elseif ($user->profile->status_profile == 1)
					<div class="alert alert-success" role="alert">
						<span><i class="fas fa-check"></i> Profile anda telah disetujui</span>
					</div>	
				@else
					<div class="alert alert-danger" role="alert">						
						<div class="row">
							<div class="col">
								<span><i class="fas fa-exclamation-triangle"></i> Profile anda tidak disetujui. </span>
								<a href="/profile-guru-pegawai/{{ $user->profile->id }}/edit" class="btn btn-sm shadow-sm btn-primary" style="float: right"><i class="fas fa-edit"></i> Lengkapi Kembali</a>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<h6 class="m-0 bold">Alasan :</h6> <p>{{ $user->profile->alasan_profile }}</p>
							</div>
						</div>
					</div>
				@endif
			</div>
			<div class="col-12">
				@if ($user->profile->status_berkas_dasar == 0)
					<div class="alert alert-warning" role="alert">
						<span><i class="fas fa-clock"></i> Berkas Dasar anda sedang menunggu persetujuan dari Admin</span>
					</div>					
				@elseif ($user->profile->status_berkas_dasar == 1)
					<div class="alert alert-success" role="alert">
						<span><i class="fas fa-check"></i> Berkas Dasar anda telah disetujui</span>
					</div>	
				@else
					<div class="alert alert-danger" role="alert">						
						<div class="row">
							<div class="col">
								<span><i class="fas fa-exclamation-triangle"></i> Berkas Dasar anda tidak disetujui. </span>
								<a href="/berkas-dasar/{{ Auth::user()->id }}/edit" class="btn btn-sm shadow-sm btn-primary" style="float: right"><i class="fas fa-upload"></i> Upload Kembali</a>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<h6 class="m-0 bold">Alasan :</h6> <p>{{ $user->profile->alasan_berkas_dasar }}</p>
							</div>
						</div>
					</div>
				@endif
				{{-- <div class="alert alert-warning" role="alert">
					<span><i class="fas fa-clock"></i> Berkas Dasar anda sedang menunggu persetujuan dari Admin</span>
				</div>				 --}}
			</div>
			{{-- <div class="col-lg-6 col-12">         
				<h4 class="page-title text-center">Status Profil</h4>
				<div class="alert alert-warning" role="alert">
					<span><i class="fas fa-clock"></i> Profile anda sedang menunggu persetujuan dari Admin</span>
				</div>
				
				<table class="table table-light">
					<tbody>
						<tr>
							<td>Tanggal Pelengkapan Profil</td>
							<td>:</td>
							<td>25-10-2021</td>
						</tr>
						<tr>
							<td>Waktu Pelengkapan Profil</td>
							<td>:</td>
							<td>20:46</td>
						</tr>  
						<tr>
							<td style="width: 250px">Status Konfirmasi</td>
							<td style="width: 2%" "="">:</td>
							<td><span class="badge badge-warning p-2">Menunggu Persetujuan Admin</span></td>
						</tr>          
					</tbody>
				</table>
			</div>
			<div class="col-lg-6 col-12">         
				<h4 class="page-title text-center">Status Berkas Dasar</h4>
				<div class="alert alert-warning" role="alert">
					<span><i class="fas fa-clock"></i> Berkas Dasar anda sedang menunggu persetujuan dari Admin</span>
				</div>
				<table class="table table-light">
					<tbody>
						<tr>
							<td>Tanggal Konfirmasi</td>
							<td>:</td>
							<td>25-10-2021</td>
						</tr>
						<tr>
							<td>Waktu Konfirmasi</td>
							<td>:</td>
							<td>20:46</td>
						</tr>  
						<tr>
							<td style="width: 190px">Status Konfirmasi</td>
							<td style="width: 2%" "="">:</td>
							<td><span class="badge badge-success p-2">Disetujui</span></td>
						</tr>          
					</tbody>
				</table>
			</div> --}}
        </div>
	</div>
</div>														
@endsection
			
@section('script')



@endsection