@extends('templates.dashboard')

@section('title')
Data Berkas Dasar
@endsection

@section('content')
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
                <label for="my-select" class="font-weight-bold">Status Berkas</label>
                <select id="status-berkas" class="form-control">
                    <option value="">Semua</option>
                    <option value="1">Disetujui</option>
                    <option value="2">Ditolak</option>
                    <option value="3">Menunggu Konfirmasi</option>
                    <option value="-1">Belum Ada Berkas Dasar</option>                    
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-bordered yajra-datatable " style="width: 100%">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Jenis PTK</th>
                        <th>Status Kepegawaian</th>
                        {{-- <th>Jenis ASN</th> --}}
                        <th>Nama File Upload</th>                                                   
                        <th>Status Berkas</th>                
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>   
</div>

@endsection

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
                url: "{{ route('data-berkas-dasar.index') }}",
                data: function (d) {
                    d.statusBerkas = $('#status-berkas').val();
                    d.statusKepegawaian = $('#status-kepegawaian').val();
                    d.jenisGuru = $('#jenis-guru').val();
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
            language: {
                buttons: {
                    colvis : 'show / hide', // label button show / hide
                    colvisRestore: "Reset Kolom" //lael untuk reset kolom ke default
                }
            },
            
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    // searchable: false  
                },
                {
                    data: 'nama',
                    name: 'nama',
                    searchable: true
                },
                {
                    data: 'nip',
                    name: 'nip'
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
                //     data: 'jenis_asn',
                //     name: 'jenis_asn',
                //     className: 'text-center'
                // },

                // {
                //     data: 'jenis_asn',
                //     name: 'jenis_asn'
                // },
                {
                    data: 'file_upload',
                    name: 'file_upload'
                },
              
                {
                    data: 'status_berkas',
                    name: 'status_berkas',
                    className: 'text-center'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,                    
                    class: 'text-center'
                },
            ],      
            // order: [[ 0, 'desc' ],      
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

        $('#status-berkas').change(function () {
            table.draw();
        })

        

    });

</script>

<script>
    $(document).ready(function () {
        $('.nav-berkas-dasar').addClass('active');
    })

</script>
@endpush
