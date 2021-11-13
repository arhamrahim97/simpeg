@extends('templates.dashboard')

@section('title')
Profil Guru/Pegawai
@endsection

@section('content')
<div class="btn-group mb-4" role="group">    
  </div>
<div class="table-responsive">
    <div class="row">
        <div class="col-lg-4 col-12">
            <div class="form-group px-0">
                <label for="my-select" class="font-weight-bold">Jenis PTK</label>
                <select id="jenis-guru" class="form-control">
                    <option value="">Semua</option>
                    <option value="Guru BK">Guru BK</option>
                    <option value="Guru Kelas">Guru Kelas</option>
                    <option value="Guru Mapel">Guru Mapel</option>
                    <option value="Guru Pendamping">Guru Pendamping</option>
                    <option value="Guru Pendamping Khusus">Guru Pendamping Khusus</option>
                    <option value="Guru Pengganti">Guru Pengganti</option>
                    <option value="Guru TIK">Guru TIK</option>
                    <option value="Instruktur">Instruktur</option>
                    <option value="Kepala Sekolah">Kepala Sekolah</option>
                    <option value="Kepala Sekolah">Laboran</option>
                    <option value="Penjaga Sekolah">Penjaga Sekolah</option>
                    <option value="Pesuruh/Office Boy">Pesuruh/Office Boy</option>
                    <option value="Petugas Keamanan">Petugas Keamanan</option>
                    <option value="Tenaga Administrasi Sekolah">Tenaga Administrasi Sekolah</option>
                    <option value="Tenaga Perpustakaan">Tenaga Perpustakaan</option>
                    <option value="Tukang Kebun">Tukang Kebun</option>
                    <option value="Tutor">Tutor</option>	
                    <option value="Lainnya">Lainnya</option>    
                </select>
            </div>
        </div>     
        <div class="col-lg-4 col-12">
            <div class="form-group px-0">
                <label for="my-select" class="font-weight-bold">Status Kepegawaian</label>
                <select id="status-kepegawaian" class="form-control">
                    <option value="">Semua</option>
                    <option value="GTY/PTY">GTY/PTY</option>
                    <option value="Guru Honor Sekolah">Guru Honor Sekolah</option>
                    <option value="Honor Daerah TK.I Provinsi">Honor Daerah TK.I Provinsi</option>
                    <option value="Honor Daerah TK.II Kab/Kota">Honor Daerah TK.II Kab/Kota</option>
                    <option value="PNS">PNS</option>
                    <option value="PNS Depag">PNS Depag</option>
                    <option value="PNS Diperbantukan">PNS Diperbantukan</option>
                    <option value="Tenaga Honor Sekolah">Tenaga Honor Sekolah</option>
                    <option value="Lainnya">Lainnya</option>       
                </select>
            </div>
        </div>    
        <div class="col-lg-4 col-12">
            <div class="form-group px-0">
                <label for="my-select" class="font-weight-bold">Status Profil</label>
                <select id="status-profile" class="form-control">
                    <option value="">Semua</option>                    
                    <option value="3">Menunggu Konfirmasi</option>
                    <option value="1">Sudah Lengkap dan Disetujui</option>
                    <option value="2">Ditolak</option>                                                
                </select>
            </div>
        </div>
    </div>    
    <table class="table table-bordered yajra-datatable " style="width: 100%">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Golongan</th>   
                <th>Jenis PTK</th>   
                <th>Status Kepegawaian</th>   
                {{-- <th>Unit Kerja</th>                 --}}
                <th>Status Profil</th>
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
                url: "{{ url('/profile-guru-pegawai-') }}",
                data: function (d) {
                    // d.unitKerja = $('#unit-kerja').val();                    
                    d.statusKepegawaian = $('#status-kepegawaian').val();
                    d.jenisGuru = $('#jenis-guru').val();                  
                    d.statusProfile = $('#status-profile').val();
                    d.search = $('input[type="search"]').val();
                }
            },
            dom: 'lBfrtip',
            buttons : [
                        {
                        extend: 'excel',
                        className: 'btn btn-sm btn-primary mt-1 mb-2 btn-export-table d-inline ml-3',                        
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
                {
                    data: 'nip',
                    name: 'nip'
                },
                {
                    data: 'golongan_jabatan_pangkat',
                    name: 'golongan_jabatan_pangkat',
                    className: 'text-center'
                },  
                {
                    data: 'jenis_guru',
                    name: 'jenis_guru',
                    className: 'text-center'
                },
                {
                    data: 'status',
                    name: 'status',
                    className: 'text-center'
                },              
                // {
                //     data: 'unit_kerja',
                //     name: 'unit_kerja',
                //     // className: 'text-center'
                // },    
                {
                    data: 'status_profile_',
                    name: 'status_profile_',
                    className: 'text-center'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true,
                    class: 'text-center'
                },
            ]
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#status-kepegawaian').change(function () {
            table.draw();
        })

        $('#jenis-guru').change(function () {
            table.draw();
        })

        $('#status-profile').change(function () {
            table.draw();
        })

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
                        url: "master-unit-kerja" + '/' + id,
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
        $('.nav-profile').addClass('active');
    })

</script>
@endpush
