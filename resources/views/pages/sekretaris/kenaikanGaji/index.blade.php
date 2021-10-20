@extends('templates.dashboard')

@section('title')
Usulan Kenaikan Gaji
@endsection

@section('content')

<div class="table-responsive">
    <table class="table table-bordered yajra-datatable " style="width: 100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-timeline" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Timeline Berkas</h5>
                <button type="button" class="close close-modal" data-dismiss="modal-timeline" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="body-timeline">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal-timeline">Close</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>
@endsection



{{-- Style Disini --}}
@push('style')
<style>
    <style>.timeline_area {
        position: relative;
        z-index: 1;
    }

    .single-timeline-area {
        position: relative;
        z-index: 1;
        padding-left: 180px;
    }

    @media only screen and (max-width: 575px) {
        .single-timeline-area {
            padding-left: 100px;
        }
    }

    .single-timeline-area .timeline-date {
        position: absolute;
        width: 180px;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 1;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -ms-grid-row-align: center;
        align-items: center;
        -webkit-box-pack: end;
        -ms-flex-pack: end;
        justify-content: flex-end;
        padding-right: 60px;
    }

    @media only screen and (max-width: 575px) {
        .single-timeline-area .timeline-date {
            width: 100px;
        }
    }

    .single-timeline-area .timeline-date::after {
        position: absolute;
        width: 3px;
        height: 100%;
        content: "";
        background-color: #ebebeb;
        top: 0;
        right: 30px;
        z-index: 1;
    }

    .single-timeline-area .timeline-date::before {
        position: absolute;
        width: 11px;
        height: 11px;
        border-radius: 50%;
        background-color: #f1c40f;
        content: "";
        top: 50%;
        right: 26px;
        z-index: 5;
        margin-top: -5.5px;
    }

    .single-timeline-area .timeline-date p {
        margin-bottom: 0;
        color: #020710;
        font-size: 13px;
        text-transform: uppercase;
        font-weight: 500;
    }

    .single-timeline-area .single-timeline-content {
        position: relative;
        z-index: 1;
        padding: 30px 30px 25px;
        border-radius: 6px;
        margin-bottom: 15px;
        margin-top: 15px;
        -webkit-box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
        box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
        border: 1px solid #ebebeb;
    }

    @media only screen and (max-width: 575px) {
        .single-timeline-area .single-timeline-content {
            padding: 20px;
        }
    }

    .single-timeline-area .single-timeline-content .timeline-icon {
        -webkit-transition-duration: 500ms;
        transition-duration: 500ms;
        width: 30px;
        height: 30px;
        background-color: #f1c40f;
        -webkit-box-flex: 0;
        -ms-flex: 0 0 30px;
        flex: 0 0 30px;
        text-align: center;
        max-width: 30px;
        border-radius: 50%;
        margin-right: 15px;
    }

    .timeline-icon-reject {
        background-color: #f10f0f !important;
    }

    .timeline-icon-accept {
        background-color: #35f10f !important;
    }

    .single-timeline-area .timeline-date-reject::before {
        background-color: #f10f0f !important;
    }

    .single-timeline-area .timeline-date-accept::before {
        background-color: #35f10f !important;
    }

    .single-timeline-area .single-timeline-content .timeline-icon i {
        color: #ffffff;
        line-height: 30px;
    }

    .single-timeline-area .single-timeline-content .timeline-text h6 {
        -webkit-transition-duration: 500ms;
        transition-duration: 500ms;
    }

    .single-timeline-area .single-timeline-content .timeline-text p {
        font-size: 13px;
        margin-bottom: 0;
    }

    .single-timeline-area .single-timeline-content:hover .timeline-icon,
    .single-timeline-area .single-timeline-content:focus .timeline-icon {
        background-color: #020710;
    }

    .single-timeline-area .single-timeline-content:hover .timeline-text h6,
    .single-timeline-area .single-timeline-content:focus .timeline-text h6 {
        color: #3f43fd;
    }

</style>
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
            ajax: "{{ route('proses-usulan-kenaikan-gaji-sekretaris.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                // {
                //     data: 'kategori',
                //     name: 'kategori'
                // },
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

    });

    $('.close-modal').click(function () {
        $('#modal-timeline').modal('hide');
    })

    $(document).on('click', '.lihatTimeline', function () {
        var id = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: "get-timeline-usulan-kenaikan-gaji-sekretaris",
            dataType: 'json',
            data: {
                id: id
            },
            success: function (data) {
                if (data.res == 'success') {
                    $('#body-timeline').empty();
                    $('#body-timeline').append(data.html);
                    $('#modal-timeline').modal('show');
                } else {

                }
            },
            error: function (data) {
                // swal({
                // title: 'Gagal',
                // text: 'Gagal Menghapus Data',
                // icon: 'warning',
                // buttons: {
                // confirm: {
                // className: 'btn btn-success'
                // }
                // }
                // });
            }
        });
    });

</script>

<script>
    $(document).ready(function () {
        $('.nav-unit-kerja').addClass('active');
    })

</script>
@endpush
