@extends('templates.dashboard')

@section('title')
Tambah Master Jabatan Fungsional
@endsection

@section('content')

<form action="{{ route('master-jabatan-fungsional.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group @error('gologan') has-error @enderror">
        <label for="errorInput">Gologan</label>
        <input type="text" value="{{ old('golongan') }}" class="form-control" name="golongan"
            placeholder="Masukkan Gologan" required>
        @error('golongan')
        <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group @error('jabatan') has-error @enderror">
        <label for="errorInput">Nama Jabatan</label>
        <input type="text" value="{{ old('jabatan') }}" class="form-control" name="jabatan"
            placeholder="Masukkan Nama Jabatan" required>
        @error('jabatan')
        <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group @error('pangkat') has-error @enderror">
        <label for="errorInput">Pangkat</label>
        <input type="text" value="{{ old('pangkat') }}" class="form-control" name="pangkat"
            placeholder="Masukkan Nama pangkat" required>
        @error('pangkat')
        <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group @error('no_urut') has-error @enderror">
        <label for="errorInput">Urutan</label>
        <input type="number" value="{{ old('no_urut') }}" class="form-control" name="no_urut"
            placeholder="Masukkan Urutan" required onkeypress="return (event.charCode == 8 || event.charCode == 0 ||
            event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
        @error('no_urut')
        <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary float-right">Tambah</button>
    </div>
</form>

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
        $('.nav-jabatan-fungsional').addClass('active');
    })

</script>
@endpush
