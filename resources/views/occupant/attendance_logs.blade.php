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

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-12">
                <h4>Attendance Logs</h4>
            </div>
        </div>
    </div>
    <div class="container" style="padding: 20px;">
        <div class="table-responsive">
            <table id="table" class="table table-striped table-bordered responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Occupant</th>
                        <th>Date In</th>
                        <th>Time In</th>
                        <th>Date Out</th>
                        <th>Time Out</th>
                        <th>Plate #</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                    <tr>
                        <td>{{$log->oct_name}}</td>
                        <td>
                            {{$log->occ_lastname . ", " . $log->occ_firstname . ", " . strtoupper($log->occ_middlename[0]) . ". "}}
                        </td>
                        <td>{{$log->atl_date_in == "" ? "" :date_format(new DateTime($log->atl_date_in),"F j, Y")}}
                        </td>
                        <td>{{$log->atl_time_in == "" ? "" :date_format(new DateTime($log->atl_time_in),"g:i:s A")}}
                        </td>
                        <td>{{$log->atl_date_out == "" ? "" : date_format(new DateTime($log->atl_date_out),"F j, Y")}}
                        </td>
                        <td>{{$log->atl_time_out == "" ? "" :date_format(new DateTime($log->atl_time_out),"g:i:s A")}}
                        </td>
                        <td>{{$log->omi_plate_number}}</td>
                        <td>{{ucfirst($log->atl_status)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
                columns: [{ idx: 0 }, { idx: 1 }, { idx: 7 }],
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
                            title: 'Attendance Logs PDF',
                            footer: true,
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7]
                            },
                            filename: 'pdf_attendance_logs_{{date("mdY_His")}}'
                        },
                        {
                            extend: 'excel',
                            text: '<i class="fa fa-file-excel-o"></i> EXCEL',
                            title: 'Attendance Logs EXCEL',
                            footer: true,
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7]
                            },
                            filename: 'excel_attendance_logs_{{date("mdY_His")}}'
                        },
                        {
                            extend: 'print',
                            text: '<i class="fa fa-print"></i> Print File',
                            title: 'Attendance Logs',
                            footer: true,
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7]
                            },
                            filename: 'docx_attendance_logs_{{date("mdY_His")}}'
                        }
                    ]
                }
            ]
        });
    });
</script>