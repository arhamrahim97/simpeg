@extends('templates.dashboard')

@section('title')
Data Berkas Dasar
@endsection

@section('content')
<div class="table-responsive">
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="form-group px-0">
                <label for="my-select" class="font-weight-bold">Jenis ASN</label>
                <select id="jenis-asn" class="form-control">
                    <option value="">Semua</option>
                    <option value="Guru">Guru</option>
                    <option value="Pegawai">Pegawai</option>                    
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="form-group px-0">
                <label for="my-select" class="font-weight-bold">Status</label>
                <select id="status-berkas" class="form-control">
                    <option value="">Semua</option>
                    <option value="1">Disetujui</option>
                    <option value="2">Ditolak</option>
                    <option value="3">Menunggu Konfirmasi</option>
                    <option value="-1">Belum Ada Berkas Dasar</option>
                    {{-- <option value="Profile Belum Lengkap Dan Belum Ada Berkas Dasar">Profile Belum Lengkap Dan Belum Ada Berkas Dasar</option> --}}
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
                        <th>Jenis ASN</th>
                        <th>Nama File Upload</th>                                                   
                        <th>Status</th>                
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
                    d.jenisAsn = $('#jenis-asn').val();
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
                    data: 'jenis_asn',
                    name: 'jenis_asn'
                },
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

        $('#jenis-asn').change(function () {
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
