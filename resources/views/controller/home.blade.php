<style>
    table.dataTable thead .sorting,
    table.dataTable thead .sorting_asc,
    table.dataTable thead .sorting_desc {
        background: none;
    }

    #table_occ_paginate .pagination li {
        padding: 1px;
    }

    #table_rsv_paginate .pagination li {
        padding: 1px;
    }

    #table_incident_reports_paginate .pagination li {
        padding: 1px;
    }
</style>

<div class="row">
    @if(session('USER_TYPE_ID') != 2)
    <div class="col-lg-8" style="margin-bottom: 20px;font-size: small;">
        <div class="card">
            <div class="card-header" style="text-align: center;">
                <div class="row">
                    <div class="col-12">
                        <h5>Ongoing Occupants</h5>
                    </div>
                </div>
            </div>
            <div class="container table-responsive" style="padding: 25px;vertical-align: middle;">
                <table id="table_occ" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Plate #</th>
                            <th>Date In</th>
                            <th>Time In</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
    @if(session('USER_TYPE_ID') == 2)
    <div class="col-lg-4" style="text-align: center;margin-bottom: 20px;">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12">
                        <h5>Reserve Parking Slot</h5>
                    </div>
                </div>
            </div>
            <div class="container" style="padding: 25px;vertical-align: middle;">
                <h6>Reservation Queue Number</h6>
                <span style="font-size: 50px;" id="reservation_queue_number">0</span>
                <br>
                <button type="button" class="btn btn-primary" id="reserve_slot_btn" value="reserve" disabled>RESERVE
                    SLOT</button>
            </div>
        </div>
    </div>
    @endif
    <div class="col-lg-4" style="text-align: center;margin-bottom: 20px;">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12">
                        <h5>Parking Status</h5>
                    </div>
                </div>
            </div>
            <div class="container" style="padding: 25px;vertical-align: middle;">
                <span style="font-size: 100px;" id="parking_ctr">0/0</span>
            </div>
        </div>
    </div>
    @if(session('USER_TYPE_ID') != 2)
    <div class="col-lg-8" style="margin-bottom: 20px;font-size: small;">
        <div class="card">
            <div class="card-header" style="text-align: center;">
                <div class="row">
                    <div class="col-12">
                        <h5>Pending Reservations</h5>
                    </div>
                </div>
            </div>
            <div class="container table-responsive" style="padding: 25px;vertical-align: middle;">
                <table id="table_rsv" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Queue</th>
                            <th>Reserve</th>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Alert</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
    <div class="col-lg-4" style="text-align: center;margin-bottom: 20px;">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12">
                        <h5>Queued Reservation</h5>
                    </div>
                </div>
            </div>
            <div class="container" style="padding: 25px;vertical-align: middle;">
                <span style="font-size: 100px;" id="queued_reservation_ctr">0</span>
            </div>
        </div>
    </div>
    @if(session('USER_TYPE_ID') != 2)
    <div class="col-lg-8" style="margin-bottom: 20px;font-size: small;">
        <div class="card">
            <div class="card-header" style="text-align: center;">
                <div class="row">
                    <div class="col-12">
                        <h5>Ongoing Incident Reports</h5>
                    </div>
                </div>
            </div>
            <div class="container table-responsive" style="padding: 25px;vertical-align: middle;">
                <table id="table_incident_reports" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Description</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    @if(session('USER_TYPE_ID') == 2)
    <div class="col-lg-8" style="margin-bottom: 20px;font-size: small;">
        <div class="card">
            <div class="card-header" style="text-align: center;">
                <div class="row">
                    <div class="col-12">
                        <h5>IETI Parking Card</h5>
                    </div>
                </div>
            </div>
            <div class="container table-responsive" style="padding: 25px;vertical-align: middle;">
                <div class="row table-responsive" id="qr_card_div" style="padding: 20px;margin: 0;">
                    <style>
                        .table td {
                            padding: 0 1px;
                            vertical-align: middle;
                            text-align: left;
                        }
                    </style>
                    <table class="table table-bordered"
                        style="width: 600px;border: 2px solid #000 !important;margin: 0 auto;width: 470px;">
                        <tr>
                            <td width="80%" colspan="2">
                                <h6 style="margin-bottom: 0;">IETI Parking Card</h6>
                                <span id="card_name" style="font-weight: bold;"></span>
                                <br>
                                <span id="card_occupant_type" style="font-size: small;"></span>
                            </td>
                            <td width="20%" rowspan="2" style="text-align: center;">
                                <img src="" alt="" srcset="" id="card_image" width="100px" style="float: right;">
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="5" width="20%" style="vertical-align: middle;">
                                <div id="qrcode" style="text-align: center;"></div>
                                <!-- <span style="font-size: xx-small;margin-top: -15px;position: absolute">Date
                                    Issued:</span>
                                <span id="card_date_issued"
                                    style="font-weight: bold;font-size: xx-small;margin-top: -15px;position: absolute;margin-left: 50px;"></span> -->
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Plate Number: <span id="card_plate_number"
                                    style="font-weight: bold;"></span></td>
                        </tr>
                        <tr>
                            <td colspan="2">Brand: <span id="card_brand" style="font-weight: bold;"></span></td>
                        </tr>
                        <tr>
                            <td colspan="2">Model: <span id="card_model" style="font-weight: bold;"></span></td>
                        </tr>
                        <tr>
                            <td colspan="2">Date Issued: <span id="card_date_issued" style="font-weight: bold;"></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="row" style="text-align:center">
                    <div class="col">
                        <button id="btnQRCardPrint" class="btn btn-light btn-outline-dark"
                            style="margin-bottom:20px;"><i class="fa fa-print"></i> Print
                            Card</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4" style="margin-bottom: 20px;font-size: small;">
        <div class="card">
            <div class="card-header" style="text-align: center;">
                <div class="row">
                    <div class="col-12">
                        <h5>IETI Parking Sticker</h5>
                    </div>
                </div>
            </div>
            <div class="container table-responsive" style="padding: 25px;vertical-align: middle;">
                <div class="row table-responsive" id="qr_sticker_div" style="padding: 20px;margin: 0;">
                    <table style="border: 2px solid #000 !important;margin: 0 auto;width: 200px;height:200px">
                        <tr>
                            <td style="vertical-align: middle;">
                                <div id="qr_sticker_code" style="text-align: center;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;font-size: xx-small;"><span id="sticker_qr_serial"
                                    style="font-weight: bold;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;font-weight: bold;font-size: small;">IETI Parking
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="row" style="text-align:center">
                    <div class="col">
                        <button id="btnQRStickerPrint" class="btn btn-light btn-outline-dark"
                            style="margin-bottom:20px;"><i class="fa fa-print"></i> Print
                            QR Sticker</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(session('USER_TYPE_ID') == 3)
    <div class="col-lg-4" style="text-align: center;margin-bottom: 20px;">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12">
                        <h5>Closing SMS Blast</h5>
                    </div>
                </div>
            </div>
            <div class="container" style="padding: 25px;vertical-align: middle;">
                <a href="{{url('send-closing-sms-blast')}}" type="button" class="btn btn-primary btn-lg"
                    id="closing_sms_blast_btn" value="reserve" disabled>Trigger
                    Closing SMS Blast</a>
                <p style="text-align: left;margin-top: 20px;">
                    This is a manual trigger of SMS Blast for the occupant that are still on the parking lot minute
                    before closing time.
                </p>
            </div>
        </div>
    </div>
    @endif
</div>

<script>
    var _table_occ = "";
    var _table_rsv = "";
    var _user_type = "{{session('USER_TYPE_ID')}}";
    $(document).ready(function () {
        _table_occ = $('#table_occ').DataTable({
            "ordering": false,
            "autoWidth": false,
            responsive: true
        });

        _table_rsv = $('#table_rsv').DataTable({
            "ordering": false,
            "autoWidth": false,
            responsive: true
        });

        _table_incident_reports = $('#table_incident_reports').DataTable({
            "ordering": false,
            "autoWidth": false,
            responsive: true
        });

        getParkingStatus();
        if (_user_type != 2) {
            getOngoingOccupants();
            getPendingReservations();
            getIncidentReports();
            getQueuedReservationCount();
        } else {
            getOccupantQueueNumber();
            getOccupantProfile();
        }

        setInterval(function () {
            getParkingStatus();
            if (_user_type != 2) {
                getOngoingOccupants();
                getPendingReservations();
                getIncidentReports();
                getQueuedReservationCount();
            } else {
                getOccupantQueueNumber();
            }
        }, 5000);

        $("#reserve_slot_btn").on('click', function (e) {
            $rsv_id = this.value.split("_")
            if (this.value == "reserve")
                reserveSlot();
            else
                cancelReservation($rsv_id[1]);
        });

        $("#btnQRCardPrint").on('click', function (e) {
            $("#qr_card_div").printThis();
        });

        $("#btnQRStickerPrint").on('click', function (e) {
            $("#qr_sticker_div").printThis();
        });

        var status = "{{session('status')}}";

        if (status == "success_sms_blast") {
            iziToast.success({
                title: 'Success:',
                message: ' Closing SMS Blast has been successfully sent to all occupant that are still on the parking lot.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status == "error_sms_blast") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to send Closing SMS Blast.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        }

        $('#closing_sms_blast_btn').click(function (event) {
            event.preventDefault(); //this will prevent the default submit
            $.confirm({
                title: 'Confirmation',
                content: 'Are you sure to continue?',
                buttons: {
                    confirm: function () {
                        window.location.href = $("#closing_sms_blast_btn").attr("href"); // continue the submit unbind preventDefault
                    },
                    cancel: function () {
                        //
                    },
                }
            });
        });
    });

    function getParkingStatus() {
        $.ajax({
            method: 'GET',
            url: '{{ url("get-parking-status") }}',
            success: function (response) {
                $("#parking_ctr").text(response);
                //for ending loading
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                //for ending loading
            }
        });
    }

    function getQueuedReservationCount() {
        $.ajax({
            method: 'GET',
            url: '{{ url("get-queued-reservation-count") }}',
            dataType: 'json',
            success: function (response) {
                $("#queued_reservation_ctr").text(response);
                //for ending loading
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                //for ending loading
            }
        });
    }

    function getOccupantQueueNumber() {
        $.ajax({
            method: 'GET',
            url: '{{ url("get-occupant-queue-number") }}',
            success: function (response) {
                $("#reservation_queue_number").text(response.ctr);

                $("#reserve_slot_btn").removeAttr("disabled");
                if (response.ctr != 0) {
                    $("#reserve_slot_btn").removeClass("btn-primary");
                    $("#reserve_slot_btn").addClass("btn-danger");
                    $("#reserve_slot_btn").text("CANCEL RESERVATION");
                    $("#reserve_slot_btn").val("cancel_" + response.rsv_id);
                } else {
                    $("#reserve_slot_btn").removeClass("btn-danger");
                    $("#reserve_slot_btn").addClass("btn-primary");
                    $("#reserve_slot_btn").text("RESERVE SLOT");
                    $("#reserve_slot_btn").val("reserve");
                }
                //for ending loading
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                //for ending loading
            }
        });
    }

    function getOngoingOccupants() {
        $.ajax({
            method: 'GET',
            url: '{{ url("get-ongoing-occupants") }}',
            dataType: 'json',
            success: function (response) {
                var logs = response;
                // console.log(logs);

                _table_occ.clear().draw();
                for (var i = 0; i < logs.length; i++) {
                    var date_in = moment(logs[i]['atl_date_in'] + " " + logs[i]['atl_time_in']).format('MMMM DD, YYYY');
                    var time_in = moment(logs[i]['atl_date_in'] + " " + logs[i]['atl_time_in']).format('h:mm:ss A');
                    var action = '<a href="' + "{{url('scan?qr=')}}" + logs[i]['occ_qr_code'] + '" type="button" class="btn btn-primary btn-sm" title="Go to Scan" style="float:right;margin-right: 10px;color:#fff;"><i class="fa fa-qrcode"></i></a >'

                    _table_occ.row.add([
                        logs[i]['oct_name'],
                        logs[i]['occ_lastname'] + ", " + logs[i]['occ_firstname'] + " " + (logs[i]['occ_middlename'].charAt(0).toUpperCase()) + ".",
                        logs[i]['omi_plate_number'],
                        date_in == "Invalid date" ? "" : date_in,
                        time_in == "Invalid date" ? "" : time_in,
                        ("{{session('USER_TYPE_ID')}}" == 3 || "{{session('USER_TYPE_ID')}}" == 4) ? action : ""
                    ]).draw(false);
                }

                //for ending loading
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                //for ending loading
            }
        });
    }

    function getPendingReservations() {
        $.ajax({
            method: 'GET',
            url: '{{ url("get-pending-reservations") }}',
            dataType: 'json',
            success: function (response) {
                var rsv = response;
                // console.log(rsv);

                _table_rsv.clear().draw();
                for (var i = 0; i < rsv.length; i++) {
                    var reserve_datetime = moment(rsv[i]['rsv_datetime']).format('MMMM DD, YYYY h:mm:ss A');
                    var action = '<a href="' + "{{url('scan?qr=')}}" + rsv[i]['occ_qr_code'] + '" type="button" class="btn btn-primary btn-sm" title="Go to Scan" style="float:right;margin-right: 10px;color:#fff;"><i class="fa fa-qrcode"></i></a >';

                    _table_rsv.row.add([
                        i + 1,
                        reserve_datetime == "Invalid date" ? "" : reserve_datetime,
                        rsv[i]['oct_name'],
                        rsv[i]['occ_lastname'] + ", " + rsv[i]['occ_firstname'] + " " + (rsv[i]['occ_middlename'].charAt(0).toUpperCase()) + ".",
                        rsv[i]['rsv_notify_ctr'],
                        ("{{session('USER_TYPE_ID')}}" == 3 || "{{session('USER_TYPE_ID')}}" == 4) ? action : ""
                    ]).draw(false);
                }

                //for ending loading
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                //for ending loading
            }
        });
    }

    function getIncidentReports() {
        $.ajax({
            method: 'GET',
            url: '{{ url("get-incident-reports") }}',
            dataType: 'json',
            success: function (response) {
                var icr = response;
                // console.log(icr);

                _table_incident_reports.clear().draw();
                for (var i = 0; i < icr.length; i++) {
                    var date = moment(icr[i]['icr_datetime']).format('MMMM DD, YYYY');
                    var time = moment(icr[i]['icr_datetime']).format('h:mm:ss A');

                    _table_incident_reports.row.add([
                        date == "Invalid date" ? "" : date,
                        time == "Invalid date" ? "" : time,
                        icr[i]['oct_name'],
                        icr[i]['occ_lastname'] + ", " + icr[i]['occ_firstname'] + " " + (icr[i]['occ_middlename'].charAt(0).toUpperCase()) + ".",
                        icr[i]['icr_description'],
                        // '<a href="' + "{{url('scan?qr=')}}" + icr[i]['occ_qr_code'] + '" type="button" class="btn btn-primary btn-sm" title="Go to Scan" style="float:right;margin-right: 10px;color:#fff;"><i class="fa fa-qrcode"></i></a >'
                    ]).draw(false);
                }

                //for ending loading
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                //for ending loading
            }
        });
    }

    function reserveSlot() {
        run_waitMe('ios', '#body-container');
        $("#reserve_slot_btn").attr("disabled", true);
        $.ajax({
            method: 'GET',
            url: '{{ url("occupant-reserve-slot") }}',
            success: function (response) {
                // console.log(response);

                if (response == "success_reservation") {
                    iziToast.success({
                        title: 'Success:',
                        message: ' Occupant is successfully reserved.',
                        position: 'bottomCenter',
                        titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
                    });
                } else if (response == "error_reservation") {
                    iziToast.error({
                        title: 'Error:',
                        message: ' Failure for occupant to reserve.',
                        position: 'bottomCenter',
                        titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
                    });
                    $('#reserve_slot_btn').attr("disabled", false);
                } else if (response == "occupant_deactivated") {
                    iziToast.warning({
                        title: 'Warning:',
                        message: ' Failure for occupant to reserve. Occupant\'s account is deactived.',
                        position: 'bottomCenter',
                        titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
                    });
                } else if (response == "occupant_reservation_exist") {
                    iziToast.error({
                        title: 'Error:',
                        message: ' Failure for occupant to reserve. Occupant have existing reservation.',
                        position: 'bottomCenter',
                        titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
                    });
                } else if (response == "reservation_invalid_not_full") {
                    iziToast.warning({
                        title: 'Warning:',
                        message: ' Invalid to reserve a slot. Parking slot is not full.',
                        position: 'bottomCenter',
                        titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
                    });
                } else if (response == "occupant_ongoing_attendance_exist") {
                    iziToast.error({
                        title: 'Error:',
                        message: ' Invalid to reserve a slot. Occupant has ongoing attendance.',
                        position: 'bottomCenter',
                        titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
                    });
                }

                getQueuedReservationCount();
                getOccupantQueueNumber();
                $('#body-container').waitMe('hide');
                $("#reserve_slot_btn").attr("disabled", false);

                //for ending loading
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                //for ending loading
                $('#body-container').waitMe('hide');
                $("#reserve_slot_btn").attr("disabled", false);
            }
        });
    }

    function cancelReservation(id) {
        run_waitMe('ios', '#body-container');
        $("#reserve_slot_btn").attr("disabled", true);
        $.ajax({
            method: 'GET',
            url: '{{ url("occupant-cancel-reservation") }}',
            data: {
                'id': id,
            },
            success: function (response) {
                // console.log(response);

                if (response == "success_cancellation") {
                    iziToast.success({
                        title: 'Success:',
                        message: ' Occupant reservation successfully cancelled.',
                        position: 'bottomCenter',
                        titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
                    });
                } else if (response == "error_cancellation") {
                    iziToast.error({
                        title: 'Error:',
                        message: ' Failure to cancel occupant reservation.',
                        position: 'bottomCenter',
                        titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
                    });
                }

                getQueuedReservationCount();
                getOccupantQueueNumber();
                $('#body-container').waitMe('hide');
                $("#reserve_slot_btn").attr("disabled", false);

                //for ending loading
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                //for ending loading
                $('#body-container').waitMe('hide');
                $("#reserve_slot_btn").attr("disabled", false);
            }
        });
    }

    function getOccupantProfile() {
        $.ajax({
            method: 'GET',
            url: '{{ url("get-occupant-profile") }}',
            dataType: 'json',
            success: function (response) {
                var d = response.details;
                $('#qrcode').html(response.qr_code);

                $("#card_occupant_type").text(d.oct_name);
                $("#card_name").text(d.occ_lastname + ", " + d.occ_firstname + " " + (d.occ_middlename.charAt(0).toUpperCase()) + ".");
                var date_issued = moment().format('MMMM DD, YYYY');
                $("#card_date_issued").text(date_issued == "Invalid date" ? "" : date_issued);
                $("#card_or_number").text(d.omi_or_number);
                $("#card_cr_number").text(d.omi_cr_number);
                $("#card_plate_number").text(d.omi_plate_number);
                $("#card_brand").text(d.omi_brand);
                $("#card_model").text(d.omi_model);
                var data_uri = "{{asset('public/img/occupant')}}" + "/" + d.occ_id + ".png?" + new Date().getTime();
                $("#card_image").attr("src", data_uri);

                $('#qr_sticker_code').html(response.qr_sticker_code);
                $('#sticker_qr_serial').html(d.occ_qr_code);

                //for ending loading
                $('#body-container').waitMe('hide');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                //for ending loading
                $('#body-container').waitMe('hide');
            }
        });
    }
</script>