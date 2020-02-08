<style>
    #time_in_btn {
        border-top-left-radius: unset;
    }

    #time_out_btn {
        border-top-right-radius: unset;
    }

    #qr_code {
        border-bottom-left-radius: unset;
    }

    #clear_btn {
        border-bottom-right-radius: unset;
    }

    .card-header {
        padding: .75rem;
    }

    .o_info {
        font-weight: bold;
    }

    button:disabled {
        cursor: not-allowed;
    }

    table.dataTable thead .sorting,
    table.dataTable thead .sorting_asc,
    table.dataTable thead .sorting_desc {
        background: none;
    }

    #table_logs_paginate .pagination li {
        padding: 1px;
    }

    #account_deactivated_btn {
        margin-top: 0;
    }

    #account_deactivated_btn button {
        border-top-right-radius: unset;
        border-top-left-radius: unset;
    }

    #reserve_slot_btn {
        margin-top: 0;
    }

    #reserve_slot_btn button {
        border-top-right-radius: unset;
        border-top-left-radius: unset;
    }
</style>

<div class="card">
    <div class="container" style="padding: 20px;">
        <div class="row justify-content-md-center">
            <div class="col-lg-10">
                <div class="input-group" style="margin-bottom: 0;">
                    <input type="text" class="form-control form-control-lg" id="qr_code" placeholder="Scan QR Code..">
                    <div class="input-group-append">
                        <button class="btn btn-danger" type="button" id="clear_btn"><i class="fa fa-times"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-lg-10">
                <div class="btn-group btn-block" role="group" id="time_group_btn">
                    <button type="button" class="btn btn-secondary btn-lg btn_time" id="time_in_btn">IN</button>
                    <button type="button" class="btn btn-dark btn-lg btn_time" id="time_out_btn">OUT</button>
                </div>
                <div class="btn-group btn-block" role="group" id="account_deactivated_btn" style="display: none;">
                    <button type="button" class="btn btn-danger btn-lg btn-block" disabled>OCCUPANT IS
                        DEACTIVATED</button>
                </div>
                <div class="btn-group btn-block" role="group" id="reserve_slot_btn" style="display: none;">
                    <button type="button" class="btn btn-success btn-lg btn-block">RESERVE SLOT</button>
                </div>
                <div class="btn-group btn-block" role="group" id="report_incident_btn" style="display: none;">
                    <button type="button" class="btn btn-dark btn-lg btn-block">REPORT INCIDENT</button>
                </div>
            </div>
        </div>
        <div class="row justify-content-md-center" style="margin-top: 20px;">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-12" style="text-align: center;">
                                <h5 id="page_title">Occupant Details</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2" style="text-align:center;">
                                <img src="" alt="" srcset="" id="image" width="100px">
                                <div id="qrcode" style="text-align: center;"></div>
                            </div>
                            <div class="col-md-5">
                                <table>
                                    <tr>
                                        <td>Occupant Type: <span class="o_info" id="occupant_type"></span></td>
                                    </tr>
                                    <tr>
                                        <td> Name: <span class="o_info" id="name"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Student Number: <span class="o_info" id="student_number"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Course: <span class="o_info" id="course"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Contact: <span class="o_info" id="contact"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Address: <span class="o_info" id="address"></span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-5">
                                <table>
                                    <tr>
                                        <td>Official Receipt: <span class="o_info" id="or_number"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Certificate of Registration: <span class="o_info" id="cr_number"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Plate Number: <span class="o_info" id="plate_number"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Brand: <span class="o_info" id="brand"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Model: <span class="o_info" id="model"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-md-center" style="margin-top: 20px;">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-12" style="text-align: center;">
                                <h5 id="page_title">Attendance Logs</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="table_logs" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Date In</th>
                                            <th>Time In</th>
                                            <th>Date Out</th>
                                            <th>Time Out</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL QR START -->
    <div id="report-incident-modal" class="lead_modal" data-izimodal-group="" data-izimodal-loop=""
        data-izimodal-title="Report Incident" data-izimodal-subtitle=" " style="display: none;">
        <div class="row justify-content-center" style="margin-top: 20px;">
            <div class="col-md-10">
                <div class="form-group">
                    <label for="incident_description">Incident Description:</label>
                    <textarea class="form-control" rows="5" id="incident_description"
                        name="incident_description"></textarea>
                </div>
                <button type="button" class="btn btn-primary" style="margin-bottom:20px;float: right;"
                    id="incident_report_submit_btn"><i class="fa fa-floppy-o"></i> Submit</button>
            </div>
        </div>
    </div>
    <!-- MODAL QR END -->
</div>

<script>

    var _ongoing_atl_id = 0;
    var _table_logs = $('#table_logs').DataTable({
        "ordering": false
    });

    $(document).ready(function () {
        var _qr_code = (loadPageVar('qr'));

        if (_qr_code.length > 0) {
            $('#qr_code').val(_qr_code);
            FetchOccupantDetails(_qr_code);
            FetchOccupantLogs(_qr_code);
            $("#qr_code").attr("readonly", true);
        }

        $("#qr_code").focus();
        $(".btn_time").attr("disabled", true);

        $('#qr_code').keypress(function (e) {
            var key = e.which;
            var qr = this.value;
            if (key == 13)  // the enter key code
            {
                FetchOccupantDetails(qr);
                FetchOccupantLogs(qr);
                $("#qr_code").attr("readonly", true);
            }
        });

        $('#time_in_btn').click(function (e) {
            run_waitMe('ios', '#body-container');
            $.ajax({
                method: 'GET',
                url: '{{ url("scan/occupant/in") }}',
                data: {
                    'qr_code': $('#qr_code').val(),
                },
                success: function (response) {
                    // console.log(response);

                    if (response == "success_time_in") {
                        iziToast.success({
                            title: 'Success:',
                            message: ' Occupant is successfully timed-in.',
                            position: 'bottomCenter',
                            titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
                        });

                        $('#time_in_btn').attr("disabled", true);
                        $('#time_out_btn').attr("disabled", false);

                        FetchOccupantLogs($('#qr_code').val());
                    } else if (response == "error_time_in") {
                        iziToast.error({
                            title: 'Error:',
                            message: ' Failure for occupant to time-in.',
                            position: 'bottomCenter',
                            titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
                        });
                    } else if (response == "parking_full") {
                        iziToast.warning({
                            title: 'Warning:',
                            message: ' Failure for occupant to time-in. Parking is currently full.',
                            position: 'bottomCenter',
                            titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
                        });

                        $("#time_group_btn").css("display", "none");
                        $("#reserve_slot_btn").css('display', 'block');
                    } else if (response == "occupant_deactivated") {
                        iziToast.warning({
                            title: 'Warning:',
                            message: ' Failure for occupant to time-in. Occupant\'s account is deactived.',
                            position: 'bottomCenter',
                            titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
                        });
                    } else if (response == "invalid_occupant_queue") {
                        iziToast.warning({
                            title: 'Warning:',
                            message: ' Failure for occupant to time-in. Invalid queued occupant. Please check the list of pending reservation.',
                            position: 'bottomCenter',
                            titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
                        });
                    }

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
        });

        $('#time_out_btn').click(function (e) {
            run_waitMe('ios', '#body-container');
            $.ajax({
                method: 'GET',
                url: '{{ url("scan/occupant/out") }}',
                data: {
                    'atl_id': _ongoing_atl_id,
                },
                success: function (response) {
                    // console.log(response);

                    if (response == "success_time_out") {
                        iziToast.success({
                            title: 'Success:',
                            message: ' Occupant is successfully timed-out.',
                            position: 'bottomCenter',
                            titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
                        });

                        $('#time_in_btn').attr("disabled", false);
                        $('#time_out_btn').attr("disabled", true);

                        FetchOccupantLogs($('#qr_code').val());
                    } else if (response == "error_time_out") {
                        iziToast.error({
                            title: 'Error:',
                            message: ' Failure for occupant to time-out.',
                            position: 'bottomCenter',
                            titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
                        });
                    }

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
        });

        $('#reserve_slot_btn').click(function (e) {
            run_waitMe('ios', '#body-container');
            $.ajax({
                method: 'GET',
                url: '{{ url("scan/occupant/reserve") }}',
                data: {
                    'qr_code': $('#qr_code').val(),
                },
                success: function (response) {
                    // console.log(response);

                    $('#reserve_slot_btn > button').attr("disabled", true);
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
                    }

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

        $("#report_incident_btn").click(function () {
            $('#report-incident-modal').iziModal('open');
        });

        $("#incident_report_submit_btn").click(function () {
            ReportIncident();
        });
    });

    function FetchOccupantDetails(qr_code) {
        run_waitMe('ios', '#body-container');
        $.ajax({
            method: 'GET',
            url: '{{ url("scan/fetch-occupant-details") }}',
            data: {
                'qr_code': qr_code,
            },
            dataType: 'json',
            success: function (response) {
                var d = response.details;

                $('#qrcode').html(response.qr_code);

                $("#occupant_type").text(d.oct_name);
                $("#name").text(d.occ_lastname + ", " + d.occ_firstname + " " + (d.occ_middlename.charAt(0).toUpperCase()) + ".");
                $("#student_number").text(d.occ_student_number);
                $("#course").text(d.occ_course);
                $("#telephone").val(d.occ_telephone);
                $("#contact").text(d.occ_telephone + " | " + d.occ_phone_number);
                $("#address").text(d.occ_address);

                $("#or_number").text(d.omi_or_number);
                $("#cr_number").text(d.omi_cr_number);
                $("#plate_number").text(d.omi_plate_number);
                $("#brand").text(d.omi_brand);
                $("#model").text(d.omi_model);

                var data_uri = "{{asset('public/img/occupant')}}" + "/" + d.occ_id + ".png?" + new Date().getTime();
                $("#image").attr("src", data_uri);

                if (d.occ_account_status == "deactivated") {
                    $("#account_deactivated_btn").css('display', 'block');
                    $("#time_group_btn").css("display", "none");
                }


                //for ending loading
                $('#body-container').waitMe('hide');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                $("#clear_btn").click();
                //for ending loading
                $('#body-container').waitMe('hide');
            }
        });
    }

    function FetchOccupantLogs(qr_code) {
        run_waitMe('ios', '#body-container');
        $.ajax({
            method: 'GET',
            url: '{{ url("scan/fetch-occupant-logs") }}',
            data: {
                'qr_code': qr_code,
            },
            dataType: 'json',
            success: function (response) {
                var logs = response.logs;
                _ongoing_atl_id = response.ongoing_log_id;

                if (response.ongoing_log) {
                    $('#time_in_btn').attr("disabled", true);
                    $('#time_out_btn').attr("disabled", false);
                } else {
                    $('#time_in_btn').attr("disabled", false);
                    $('#time_out_btn').attr("disabled", true);
                }
                $('#report_incident_btn').css("display", "block");

                _table_logs.clear();
                for (var i = 0; i < logs.length; i++) {
                    var date_in = moment(logs[i]['atl_date_in'] + " " + logs[i]['atl_time_in']).format('MMMM DD, YYYY');
                    var time_in = moment(logs[i]['atl_date_in'] + " " + logs[i]['atl_time_in']).format('h:mm:ss A');
                    var date_out = moment(logs[i]['atl_date_out'] + " " + logs[i]['atl_time_out']).format('MMMM DD, YYYY');
                    var time_out = moment(logs[i]['atl_date_out'] + " " + logs[i]['atl_time_out']).format('h:mm:ss A');

                    _table_logs.row.add([
                        date_in == "Invalid date" ? "" : date_in,
                        time_in == "Invalid date" ? "" : time_in,
                        date_out == "Invalid date" ? "" : date_out,
                        time_out == "Invalid date" ? "" : time_out,
                        logs[i]['atl_status'].substr(0, 1).toUpperCase() + logs[i]['atl_status'].substr(1)
                    ]).draw(false);
                }

                //for ending loading
                $('#body-container').waitMe('hide');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                $("#clear_btn").click();
                //for ending loading
                $('#body-container').waitMe('hide');
            }
        });

        $("#clear_btn").click(function (e) {
            window.location.href = "{{url('scan')}}";
        });
    }

    function ReportIncident() {
        run_waitMe('ios', '#report-incident-modal');
        $.ajax({
            method: 'GET',
            url: '{{ url("scan/occupant/report-incident") }}',
            data: {
                'qr_code': $('#qr_code').val(),
                'description': $("#incident_description").val(),
            },
            success: function (response) {
                // console.log(response);

                if (response == "success_report_incident") {
                    iziToast.success({
                        title: 'Success:',
                        message: ' Incident is successfully reported.',
                        position: 'bottomCenter',
                        titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
                    });
                } else if (response == "error_report_incident") {
                    iziToast.error({
                        title: 'Error:',
                        message: ' Failure for report an incident.',
                        position: 'bottomCenter',
                        titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
                    });
                } else if (status == "invalid_email") {
                    iziToast.error({
                        title: 'Error:',
                        message: ' Failure for report an incident. Invalid email address.',
                        position: 'bottomCenter',
                        titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
                    });
                }
                $('#report-incident-modal').iziModal('close');
                $("#incident_description").val("");

                //for ending loading
                $('#report-incident-modal').waitMe('hide');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                //for ending loading
                $('#report-incident-modal').waitMe('hide');
            }
        });
    }
</script>