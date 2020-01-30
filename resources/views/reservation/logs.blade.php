<style>
    table.dataTable thead .sorting,
    table.dataTable thead .sorting_asc,
    table.dataTable thead .sorting_desc {
        background: none;
    }

    #table_paginate .pagination li {
        padding: 1px;
    }

    .card-header {
        padding: .75rem;
    }

    .table_filterSelect {
        max-width: none !important;
        display: inline-block;
        height: 30px;
        width: 150px;
        padding: 2px 10px 2px 2px;
        outline: none;
        color: #74646e;
        border: 1px solid #C8BFC4;
        border-radius: 4px;
        box-shadow: inset 1px 1px 2px #ddd8dc !important;
        background: #fff;
        cursor: pointer;
        margin-left: 5px;
    }

    .table_filterWrapper {
        text-align: right;
        margin-bottom: 10px;
        display: block;
    }
</style>

<div class="card" style="font-size: 13px;">
    <div class="card-header">
        <div class="row">
            <div class="col-12">
                <h4>Reservation Logs</h4>
            </div>
        </div>
    </div>
    <div class="container" style="padding: 20px;">
        <table id="table" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Reserve Date & Time</th>
                    <th>Time In</th>
                    <th>Occupant Type</th>
                    <th>Fullname</th>
                    <th>Contact</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $rsv)
                <tr>
                    <td>{{$rsv->rsv_datetime == "" ? "" :date_format(new DateTime($rsv->rsv_datetime),"F j, Y g:i:s A")}}
                    </td>
                    <td>{{$rsv->rsv_timein_datetime == "" ? "" :date_format(new DateTime($rsv->rsv_datetime),"F j, Y g:i:s A")}}
                    </td>
                    <td>{{$rsv->oct_name}}</td>
                    <td>
                        {{$rsv->occ_lastname . ", " . $rsv->occ_firstname . ", " . strtoupper($rsv->occ_middlename[0]) . ". "}}
                    </td>
                    <td>{{$rsv->occ_phone_number . " | " . $rsv->occ_telephone}}</td>
                    <td>{{ucfirst($rsv->rsv_status)}}</td>
                    <td style="text-align: center;">
                        <a href="{{url('occupant/profile?id=') . $rsv->occ_id}}" type="button"
                            class="btn btn-primary btn-sm" title="Open Occupant Profile">
                            <i class="fa fa-external-link"></i>
                        </a>
                        <a href="{{url('scan?qr=') . $rsv->occ_qr_code}}" type="button" class="btn btn-info btn-sm"
                            title="Go to Scan">
                            <i class="fa fa-qrcode"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#table').DataTable({
            "order": [],
            "iDisplayLength": 10,
            "aLengthMenu": [
                [10, 50, 100, -1],
                [10, 50, 100, "All"]
            ],
            responsive: true,
            filterDropDown: {
                columns: [{ idx: 0 }, { idx: 1 }, { idx: 2 }, { idx: 5 }],
                label: '<strong>Filter by:</strong> ',
                bootstrap: true,
            },
            dom: 'Bfrtip',
            select: false,
            buttons: [
                'pageLength',
                {
                    extend: 'collection',
                    text: '<i class="fa fa-print"></i> File Export <i class="fa fa-caret-down"></i>',
                    buttons: [
                        {
                            extend: 'pdf',
                            text: '<i class="fa fa-file-pdf-o"></i> PDF',
                            title: 'Reservation List PDF',
                            footer: true,
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            },
                            filename: 'pdf_reservation_list_{{date("mdY_His")}}'
                        },
                        {
                            extend: 'excel',
                            text: '<i class="fa fa-file-excel-o"></i> EXCEL',
                            title: 'Reservation List EXCEL',
                            footer: true,
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            },
                            filename: 'excel_reservation_list_{{date("mdY_His")}}'
                        },
                        {
                            extend: 'print',
                            text: '<i class="fa fa-print"></i> Print File',
                            title: 'Reservation List',
                            footer: true,
                            exportOptions: {
                                columns: [-1, 0, 1, 2, 3, 4, 5]
                            },
                            filename: 'docx_reservation_list_{{date("mdY_His")}}'
                        }
                    ]
                }
            ],
            "drawCallback": function (settings, json) {
                // $("#table_filterSelect5").val("Pending");
            }
        });
    });
</script>