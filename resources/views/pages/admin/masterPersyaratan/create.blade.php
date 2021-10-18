@extends('templates.dashboard')

@section('title')
Tambah Master Persyaratan
@endsection

@section('content')

<form action="{{ route('master-persyaratan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group @error('jenis_asn') has-error @enderror">
        <label for="errorInput">Jenis ASN</label>
        <select class="form-control" name="jenis_asn" id="jenis_asn">
            <option value="">- Pilih Salah Satu -</option>                    
            <option value="Guru" @if (old('jenis_asn') == "Guru") {{ 'selected' }} @endif>Guru</option>
            <option value="Pegawai" @if (old('jenis_asn') == "Pegawai") {{ 'selected' }} @endif>Pegawai</option>            
        </select>
        @error('jenis_asn')
        <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group @error('kategori') has-error @enderror">
        <label for="errorInput">Kategori</label>
        <select class="form-control" name="kategori" id="kategori">
            <option value="">- Pilih Salah Satu -</option>
            <option value="Usulan Kenaikan Gaji Berkala" @if (old('kategori') == "Usulan Kenaikan Gaji Berkala") {{ 'selected' }} @endif>Usulan Kenaikan Gaji Berkala</option>
            <option value="Usulan Kenaikan Pangkat" @if (old('kategori') == "Usulan Kenaikan Pangkat") {{ 'selected' }} @endif>Usulan Kenaikan Pangkat</option>
            <option value="Berkas Dasar" @if (old('kategori') == "Berkas Dasar") {{ 'selected' }} @endif>Berkas Dasar</option>
        </select>
        @error('kategori')
        <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group @error('ke_golongan') has-error @enderror" id="groupGolongan">
        <label for="errorInput">Ke Golongan (<span style="color: red">Hanya untuk kategori kenaikan pangkat</span> )</label>
        <select class="form-control" name="ke_golongan" id="golongan">
            <option value="">- Pilih Salah Satu -</option>
            @forelse ($golongan as $row)
                @if (old('ke_golongan') == $row->id)
                    <option value="{{ $row->id }}" selected>{{ $row->golongan }}</option>  
                @else
                    <option value="{{ $row->id }}">{{ $row->golongan }}</option>  
                @endif
            @empty
                <option value="">Tidak ada data</option>                
            @endforelse
        </select>
        @error('ke_golongan')
        <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>   
    <div class="form-group @error('syarat') has-error @enderror">
        <label for="errorInput">Syarat</label>
        <div class="row">
            <div class="col-lg-10">
                <input type="text" value="" class="form-control"
                placeholder="Masukkan Syarat" id="formsyarat">
            </div>
            <button type="button" class="btn btn-warning float-right col-lg-2" id="btnTambahSyarat">Tambah</button>
        </div>
        @error('syarat')
        <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group" id="syarat">
        @if (old('syarat'))
            @for ($i = 0;$i < count(old('syarat'));$i++) <div class="row my-2" id="daftarSyarat{{ ($i+1) }}"><input
                    type="text" value="{{old('syarat.' . $i)}}" class="form-control" name="syarat[]"
                    placeholder="Masukkan Syarat" hidden>
                <div class="col-lg-11">
                    <p>{{old('syarat.' . $i)}}</p>
                </div><button type="button" class="btn btn-danger float-right col-lg-1 btnHapusFitur"
                    id="{{ ($i+1) }}">X</button>
            </div>
            @endfor
        @endif
    </div>    
    <div class="row">
        <div class="col">
            <div class="form-group">
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </div>
        </div>
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
        $('.nav-master-persyaratan').addClass('active');
        if($('#kategori').val() == 'Usulan Kenaikan Pangkat'){            
            $('#golongan').removeAttr('disabled')                        
        }
        else{                 
            $('#golongan').attr('disabled', true)        
        }
    })

    $('#kategori').change(function() {
        if($('#kategori').val() == 'Usulan Kenaikan Pangkat'){                        
            $('#golongan').removeAttr('disabled')
        }
        else{
            $('#golongan').attr('disabled', true)
               
            // $("#golongan").append('<option value='-'>-</option>');
            
        }
	})


    var i = @php
    if (old('syarat')) {
        echo(count(old('syarat')));
    } else {
        echo(0);
    }
    @endphp;

    $('#btnTambahSyarat').on('click', function () {
        var formsyarat = $("#formsyarat").val();
        if (!formsyarat) {
            swal({
                title: 'Terjadi Kesalahan',
                text: 'Syarat Tidak Boleh Kosong',
                icon: 'warning',
                buttons: {
                    confirm: {
                        className: 'btn btn-success'
                    }
                }
            });
        } else {
            i++;
            var syarat = '<div class="row my-2" id="daftarSyarat' + i + '"><input type="text" value="' +
                formsyarat +
                '" class="form-control" name="syarat[]" placeholder="Masukkan Syarat"hidden><div class="col-lg-11"><p>' +
                formsyarat +
                '</p></div><button type="button" class="btn btn-danger float-right col-lg-1 btnHapusSyarat" id="' +
                i +
                '">X</button></div>';
            $('#syarat').append(syarat);
            $("#formsyarat").val('');
        }
    })

    $(document).on('click', '.btnHapusSyarat', function () {
        var id = $(this).attr("id");
        $('#daftarSyarat' + id).remove();
        i--;
    })

    // function kategori(){
    //     var a = $('#kategori').val()
    //     alert(a)
    // }

</script>
@endpush
