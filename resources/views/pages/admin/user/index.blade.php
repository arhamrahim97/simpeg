@extends('templates.dashboard')

@section('title')
Akun
@endsection

@section('content')
<div class="btn-group mb-4" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Tambah
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
      <a class="dropdown-item" href="/user-tambah-guru-pegawai">Guru atau Pegawai</a>
      <a class="dropdown-item" href="/user-tambah-non-guru-pegawai">Non Guru / Pegawai</a>
    </div>
  </div>
<div class="table-responsive">
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="form-group px-0">
                <label for="my-select" class="font-weight-bold">Role</label>
                <select id="role" class="form-control">
                    <option value="">Semua</option>
                    <option value="Guru">Guru</option>
                    <option value="Pegawai">Pegawai</option>    
                    <option value="Tim Penilai">Tim Penilai</option>
                    <option value="Admin Kepegawaian">Admin Kepegawaian</option>                    
                    <option value="KASUBAG Kepegawaian dan Umum">KASUBAG Kepegawaian dan Umum</option>                    
                    <option value="Sekretaris">Sekretaris</option>                    
                    <option value="Kepala Dinas">Kepala Dinas</option>                      
                    <option value="Admin">Admin</option>                      
                </select>
            </div>
        </div>       
        <div class="col-lg-6 col-12">
            <div class="form-group px-0">
                <label for="my-select" class="font-weight-bold">Status Akun</label>
                <select id="status-akun" class="form-control">
                    <option value="">Semua</option>
                    <option value="1">Aktif</option>
                    <option value="2">Tidak Aktif</option>                   
                </select>
            </div>
        </div>
    </div>
    <table class="table table-bordered yajra-datatable " style="width: 100%">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Nama</th>
                {{-- <th>NIP</th> --}}
                <th>Username</th>                            
                <th>Role</th>
                <th>Status Akun</th>
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
    .dataTables_filter {
        display: inline !important;
        float: right;
    }
    
    .dt-buttons {
        display: inline !important;
    }
    
    .dataTables_length {
        display: inline !important;
    
    }
</style>
@endpush

{{-- Script Disini --}}
@push('script')
<script src="/assets/dashboard/datatables/Responsive-2.2.1/js/dataTables.responsive.min.js"></script>
<script src="/assets/dashboard/datatables/Responsive-2.2.1/js/responsive.bootstrap4.min.js"></script>
<script src="/assets/dashboard/datatables/dataTables.buttons.min.js"></script>
<script src="/assets/dashboard/datatables/jszip.min.js"></script>
<script src="/assets/dashboard/datatables/vfs_fonts.js"></script>
<script src="/assets/dashboard/datatables/buttons.html5.min.js"></script>
<script src="/assets/dashboard/datatables/buttons.print.min.js"></script>


<script>
    $(function () {
        var table = $('.yajra-datatable').DataTable({
            fixedColumns: true,
            processing: true,
            serverSide: true,
            lengthMenu: [
				[10, 25, 50, -1],
				[10, 25, 50, "All"]
			],
           
            ajax: {
                url: "{{ route('user.index') }}",
                data: function (d) {
                    d.role = $('#role').val();                    
                    d.statusAkun = $('#status-akun').val();
                    d.search = $('input[type="search"]').val();
                }   
            },
            dom: 'lBfrtip',
            buttons : [
                        {
                        extend: 'excel',
                        className: 'btn btn-sm btn-primary mt-1 mb-2 btn-export-table d-inline ml-3',
                        // text: '<br>',
                        text: '<i class="fas fa-file-excel"></i> Export Excel',

                        exportOptions: {
                            modifier: {
                                // DataTables core
                                order: 'index', // 'current', 'applied', 'index',  'original'
                                page: 'current', // 'all',     'current'
                                search: 'none' // 'none',    'applied', 'removed'
                            }
                        }

                    }
            ],          
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false   
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                // {
                //     data: 'nip',
                //     name: 'nip'
                // },
                {
                    data: 'username',
                    name: 'username'
                },                             
                {
                    data: 'role',
                    name: 'role',
                    className: 'text-center'
                },
                {
                    data: 'status_akun',
                    name: 'status_akun',
                    className: 'text-center'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true,
                    class: 'text-center'
                },
            ],
            order: [[ 0, "desc" ]]
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#role').change(function () {
            table.draw();
        })

        $('#status-akun').change(function () {
            table.draw();
        })

        $('body').on('click', '.hapusData', function () {
            var id = $(this).data('id');
            swal({
                title: 'Anda Yakin?',
                text: "Data akun beserta profil dan berkas dasarnya akan ikut terhapus dan tidak dapat dikembalikan lagi",
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
                        url: "user" + '/' + id,
                        dataType: 'json',
                        success: function (data) {
                            console.log(data);
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
                            console.log(data);
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
        $('.nav-user').addClass('active');
    })

</script>
@endpush
