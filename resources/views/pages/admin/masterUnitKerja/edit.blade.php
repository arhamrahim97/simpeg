@extends('templates.dashboard')

@section('title')
Ubah Master Unit Kerja
@endsection

@section('content')

<form action="{{ route('master-unit-kerja.update',$unitKerja->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group @error('nama') has-error @enderror">
        <label for="errorInput">Nama Unit Kerja</label>
        <input type="text" value="{{ $unitKerja->nama }}" class="form-control" name="nama"
            placeholder="Masukkan Nama Unit Kerja" required>
        @error('nama')
        <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group @error('kategori') has-error @enderror">
        <label for="exampleFormControlSelect1">Kategori</label>
        <select class="form-control" id="exampleFormControlSelect1" name="kategori" required>
            <option selected hidden value="">Pilih Kategori</option>
            <option value="SMP" @if ($unitKerja->kategori=='SMP' ) selected="selected" @endif>SMP</option>
            <option value="SMA/SMK" @if ($unitKerja->kategori=='SMA/SMK' ) selected="selected" @endif>SMA/SMK</option>
        </select>
        @error('kategori')
        <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary float-right">Simpan</button>
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
        $('.nav-unit-kerja').addClass('active');
    })

</script>
@endpush
