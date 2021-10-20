@extends('templates.dashboard')

@section('title')
    Dashboard
@endsection

@section('content')
@if ($status_berkas_dasar == 0)
    <div class="alert alert-warning" role="alert">
        <span><i class="fas fa-clock"></i> Berkas Dasar anda sedang menunggu persetujuan dari Admin Kepegawaian</span>
    </div>
    @elseif ($status_berkas_dasar == 2)
    <div class="alert alert-danger" role="alert">
        <div class="row">
            <div class="col">
                <span><i class="fas fa-exclamation-triangle"></i> Berkas Dasar anda tidak disetujui. </span>
                <a href="/berkas-dasar/{{ Auth::user()->id }}/edit" class="btn btn-sm shadow-sm btn-primary" style="float: right">Upload Kembali</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h6 class="m-0 mt-2 bold">Alasan :</h6> <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Animi asperiores laborum omnis iure illum recusandae dolore iste vitae consequatur, dolorem, adipisci assumenda ullam architecto aut consectetur non rem optio repudiandae.</p>
            </div>
        </div>
        
        
    </div>
    @endif

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
            $('.nav-dashboard').addClass('active');
        })
    
    </script>
    <script>
        $(".table").DataTable();
    </script>
@endpush

