@extends('templates.dashboard')

@section('title')
    Dashboard
@endsection

@section('content')


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

