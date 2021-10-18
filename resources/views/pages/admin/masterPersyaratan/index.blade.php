@extends('templates.dashboard')

@section('title')
Master Persyaratan
@endsection

@section('content')

<a type="button" class="btn btn-primary mb-5" href="/master-persyaratan/create">Tambah</a>
<div class="table-responsive">
    <table class="table table-bordered yajra-datatable " style="width: 100%">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Jenis Asn</th>
                <th>Kategori</th>
                <th>Ke Golongan</th>
                <th>Syarat</th>                           
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
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
    $(function () {
        var table = $('.yajra-datatable').DataTable({
            fixedColumns: true,
            processing: true,
            serverSide: true,
            pageLength : 15,
            lengthMenu: [[10, 15, 20, -1], [10, 15, 20, 'Todos']],
            ajax: "{{ route('master-persyaratan.index') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',  
                    orderable: false,
                    searchable: false                  
                },
                {
                    data: 'jenis_asn',
                    name: 'jenis_asn'
                },
                {
                    data: 'kategori',
                    name: 'kategori'
                },
                {
                    data: 'golongan',
                    name: 'golongan',
                    className: 'text-center'
                },
                {
                    data: 'syarat',
                    name: 'syarat'
                },             
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true,
                    class: 'text-center'
                },
            ],           
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '.hapusData', function () {
            var id = $(this).data('id');
            swal({
                title: 'Anda Yakin?',
                text: "Data yang sudah dihapus tidak dapat dikembalikan lagi",
                icon: 'warning',
                buttons: {
                    confirm: {
                        text: 'Hapus',
                        className: 'btn btn-success'
                    },
                    cancel: {
                        visible: true,
                        text: 'Batal',
                        className: 'btn btn-danger'
                    }
                }
            }).then((Delete) => {
                if (Delete) {
                    $.ajax({
                        type: "DELETE",
                        url: "master-persyaratan" + '/' + id,
                        dataType: 'json',
                        success: function (data) {
                            if (data.res == 'success') {
                                swal({
                                    title: 'Terhapus',
                                    text: data.message,
                                    icon: 'success',
                                    buttons: {
                                        confirm: {
                                            className: 'btn btn-success'
                                        }
                                    }
                                });
                                table.draw();
                            } else {
                                swal({
                                    title: 'Gagal',
                                    text: 'Gagal Menghapus Data',
                                    icon: 'warning',
                                    buttons: {
                                        confirm: {
                                            className: 'btn btn-success'
                                        }
                                    }
                                });
                            }
                        },
                        error: function (data) {
                            swal({
                                title: 'Gagal',
                                text: 'Gagal Menghapus Data',
                                icon: 'warning',
                                buttons: {
                                    confirm: {
                                        className: 'btn btn-success'
                                    }
                                }
                            });
                        }
                    });
                } else {
                    swal.close();
                }
            });

        });
    });

</script>

<script>
    $(document).ready(function () {
        $('.nav-master-persyaratan').addClass('active');
    })

</script>
@endpush
