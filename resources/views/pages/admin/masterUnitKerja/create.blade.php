@extends('templates.dashboard')

@section('title')
Tambah Master Unit Kerja
@endsection

@section('content')
<a type="button" class="btn btn-primary mb-1 text-white" data-toggle="modal" data-target="#importExcel">Impor Excel</a>
<form action="{{ route('master-unit-kerja.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group @error('nama') has-error @enderror">
        <label for="errorInput">Nama Unit Kerja</label>
        <input type="text" value="{{ old('nama') }}" class="form-control" name="nama"
            placeholder="Masukkan Nama Unit Kerja" required>
        @error('nama')
        <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group @error('kategori') has-error @enderror">
        <label for="exampleFormControlSelect1">Kategori</label>
        <select class="form-control" id="exampleFormControlSelect1" name="kategori" required>
            <option selected hidden value="">Pilih Kategori</option>
            <option value="SMP" @if (old('kategori')=='SMP' ) selected="selected" @endif>SMP</option>
            <option value="SMA/SMK" @if (old('kategori')=='SMA/SMK' ) selected="selected" @endif>SMA/SMK</option>
        </select>
        @error('kategori')
        <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary float-right">Tambah</button>
    </div>
</form>


<!-- Import Excel -->
<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" action="/import-excel-unit-kerja" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div>
                        <p style="color: red; text-decoration: bold; font-size: 13pt;" class="mb-0 pb-0">Perhatian !!!</p>
                        <p style="color: red; font-size: 11pt">Import File Sangat Beresiko. Mohon perhatikan ketentuan berikut sebelum impor file excel.</p>
                        <ol class="px-4">
                            <li class="mb-2">
                                <p class="pb-0 mb-0">Format file harus berupa file excel (.xlsx / .xls / .csv).</p>
                            </li>                           
                            <li class="mb-2">
                                <p class="pb-0 mb-0">Penulisan text judul harus sesuai seperti gambar berikut. Tidak boleh kurang ataupun lebih.</p>
                                <img src="/assets/dashboard/img/headerExcelSekolah.png" alt="" width="380">
                            </li>
                            <li class="mb-2">
                                <p class="pb-0 mb-0">Contoh pengisian Unit Kerja seperti berikut. Nama Sekolah dan juga Kategori tidak boleh dikosongkan.</p>
                                <img src="/assets/dashboard/img/pengisianExcelSekolah.png" alt="" width="380">
                            </li>
                            <li class="mb-2">
                                <p class="pb-0 mb-0">Apabila sebelumnya telah melakukan impor file excel dan ingin melakukan impor kembali, maka data Unit Kerja yang di impor tidak boleh ada kesamaan dengan data yang sebelumnya telah di impor.</p>
                            </li>
                            <li class="mb-2">
                                <p class="pb-0 mb-0">Apabila ada yang kurang di mengerti, silahkan untuk menghubungi pihak developer aplikasi ini.</p>
                            </li>    
                            <li class="mb-2">
                                <p class="pb-0 mb-0">Apabila sudah di mengerti, silahkan pilih file excel dibawah ini sesuai ketentuan yang telah disebutkan di atas dan kemudian klik tombol "Impor".</p>
                            </li>                            
                        </ol>
                    </div>
                    <div class="form-group pt-0">
                        <label>Pilih file excel</label>
                        <input type="file" class="form-control namaBerkas" id="file" aria-describedby="emailHelp"placeholder="Contoh : Kartu Pegawai" name="file" accept=".xlsx, .xls, .csv" required>
                        {{-- <input type="file" name="file" required="required"> --}}
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-sm btn-success">Impor</button>
                </div>
            </div>
        </form>
    </div>
</div>

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
