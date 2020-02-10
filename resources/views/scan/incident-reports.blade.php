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
                <h4>Incident Reports List</h4>
            </div>
        </div>
    </div>
    <div class="container" style="padding: 20px;">
        <div class="table-responsive">
            <table id="table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Date & Time</th>
                        <th>Occupant Type</th>
                        <th>Fullname</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Investigator Note</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($incidents as $key => $inc)
                    <tr>
                        <td>{{$inc->icr_datetime == "" ? "" :date_format(new DateTime($inc->icr_datetime),"F j, Y g:i:s A")}}
                        </td>
                        <td>{{$inc->oct_name}}</td>
                        <td>
                            {{$inc->occ_lastname . ", " . $inc->occ_firstname . ", " . strtoupper($inc->occ_middlename[0]) . ". "}}
                        </td>
                        <td>{{$inc->icr_description}}</td>
                        <td>{{ucfirst($inc->icr_status)}}</td>
                        <td>{{$inc->icr_notes}}</td>
                        <td style="text-align: center;">
                            @if($inc->icr_status == "ongoing")
                            <a href="#"  type="button"
                                class="btn btn-success btn-sm process_btn" title="Mark as Done" id="done_{{$inc->icr_id}}">
                                <i class="fa fa-check"></i>
                            </a>
                            <a href="#" type="button"
                                class="btn btn-danger btn-sm process_btn" title="Cancel Incident Report" id="cancel_{{$inc->icr_id}}">
                                <i class="fa fa-times"></i>
                            </a>
                            @endif
                            <a href="{{url('occupant/profile?id=') . $inc->occ_id}}" type="button"
                                class="btn btn-primary btn-sm" title="Open Occupant Profile">
                                <i class="fa fa-external-link"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- MODAL QR START -->
    <div id="report-incident-modal" class="lead_modal" data-izimodal-group="" data-izimodal-loop=""
        data-izimodal-title="Process Incident" data-izimodal-subtitle=" " style="display: none;">
        {!! Form::open(['url' => 'incident-reports/process','id'=>'form_submit_modal','data-smk-icon'=>'glyphicon-remove-sign']) !!}
        <div class="row justify-content-center" style="margin-top: 20px;">
            <div class="col-md-10">
                <div class="form-group">
                    <label for="notes">Incident Notes:</label>
                    <textarea class="form-control" rows="5" id="notes"
                        name="notes"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="margin-bottom:20px;float: right;"
                    id="incident_report_submit_btn"><i class="fa fa-floppy-o"></i> Submit</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <!-- MODAL QR END -->
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
                columns: [{ idx: 1 }, { idx: 2 }, { idx: 4 }],
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

        var status = "{{session('status')}}";

        if (status == "success_process") {
            iziToast.success({
                title: 'Success:',
                message: ' Incident is successfully processed.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status == "error_process") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to proccess incident.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        }
        
        $(".process_btn").click(function () {
            $("#form_submit_modal").attr('action', '{{url("incident-reports/process")}}');
            $('#report-incident-modal').iziModal('open');
            var value =  this.id.split("_");
            $("#form_submit_modal").attr('action', $("#form_submit_modal").attr('action') + '?s=' + value[0] + '&id=' + value[1]);
        });

        $('#report-incident-modal').iziModal({
            headerColor: '#23282E',
            width: '40%',
            overlay: true,
            overlayClose: false,
            overlayColor: 'rgba(0, 0, 0, 0.4)',
            transitionIn: 'bounceInDown',
            transitionOut: 'bounceOutDown',
        });

        $("#incident_report_submit_btn").click(function () {
            event.preventDefault(); //this will prevent the default submit
            $.confirm({
                title: 'Confirmation',
                content: 'Are you sure to continue?',
                buttons: {
                    confirm: function () {
                        $('#form_submit_modal').unbind('submit').submit(); // continue the submit unbind preventDefault
                    },
                    cancel: function () {
                        //
                    },
                }
            });
        });
    });
</script>