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
</style>

<div class="card" style="font-size: 13px;">
    <div class="card-header">
        <div class="row">
            <div class="col-12">
                <h4>Pending Reservation List</h4>
            </div>
        </div>
    </div>
    <div class="container" style="padding: 20px;">
        <div class="table-responsive">
            <table id="table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Queue</th>
                        <th>Reserve Date & Time</th>
                        <th>Occupant Type</th>
                        <th>Fullname</th>
                        <th>Alert</th>
                        <th>Expected Time-in</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $key => $rsv)
                    <tr>
                        <td style="text-align: center;">{{$key + 1}}</td>
                        <td>{{$rsv->rsv_datetime == "" ? "" :date_format(new DateTime($rsv->rsv_datetime),"F j, Y g:i:s A")}}
                        </td>
                        <td>{{$rsv->oct_name}}</td>
                        <td>
                            {{$rsv->occ_lastname . ", " . $rsv->occ_firstname . " " . (($rsv->occ_middlename == "") ? "" :  strtoupper($rsv->occ_middlename[0]) . ". ")}}
                        </td>
                        <td style="text-align: center;">{{ucfirst($rsv->rsv_notify_ctr)}}</td>
                        <td>{{$rsv->rsv_expected_timein == "" ? "" :date_format(new DateTime($rsv->rsv_expected_timein),"F j, Y g:i:s A")}}
                        </td>
                        <td>{{ucfirst($rsv->rsv_status)}}</td>
                        <td style="text-align: center;">
                            @if($rsv->rsv_notify_ctr > 0)
                            <a href="{{url('reservation/send-alert?id=') . $rsv->rsv_id}}" type="button"
                                class="btn btn-secondary btn-sm" title="Send Alert SMS" id="send_alert_btn">
                                <i class="fa fa-mobile fa-lg"></i>
                            </a>
                            @endif
                            <a href="{{url('occupant/profile?id=') . $rsv->occ_id}}" type="button"
                                class="btn btn-primary btn-sm" title="Open Occupant Profile">
                                <i class="fa fa-external-link"></i>
                            </a>
                            @if(session('USER_TYPE_ID') == 3 || session('USER_TYPE_ID') == 4)
                            <a href="{{url('scan?qr=') . $rsv->occ_qr_code}}" type="button" class="btn btn-info btn-sm"
                                title="Go to Scan">
                                <i class="fa fa-qrcode"></i>
                            </a>
                            @endif
                            <a href="{{url('reservation/cancel?id=') . $rsv->rsv_id}}" type="button"
                                class="btn btn-danger btn-sm" title="Cancel Reservation" id="cancel_reservation_btn">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
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
            "ordering": false
        });

        $('#send_alert_btn').click(function (event) {
            event.preventDefault(); //this will prevent the default submit
            $.confirm({
                title: 'Confirmation',
                content: 'Are you sure to continue?',
                buttons: {
                    confirm: function () {
                        window.location.href = $("#send_alert_btn").attr("href"); // continue the submit unbind preventDefault
                    },
                    cancel: function () {
                        //
                    },
                }
            });
        });

        $('#cancel_reservation_btn').click(function (event) {
            event.preventDefault(); //this will prevent the default submit
            $.confirm({
                title: 'Confirmation',
                content: 'Are you sure to continue?',
                buttons: {
                    confirm: function () {
                        window.location.href = $("#cancel_reservation_btn").attr("href"); // continue the submit unbind preventDefault
                    },
                    cancel: function () {
                        //
                    },
                }
            });
        });

        var status = "{{session('status')}}";

        if (status == "success_cancellation") {
            iziToast.success({
                title: 'Success:',
                message: ' Occupant reservation successfully cancelled.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status == "error_cancellation") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to cancel occupant reservation.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status == "success_alert_sms") {
            iziToast.success({
                title: 'Success:',
                message: ' Occupant has been successfully alerted via SMS.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status == "error_alert_sms") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to alert occupant via SMS.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        }
    });
</script>