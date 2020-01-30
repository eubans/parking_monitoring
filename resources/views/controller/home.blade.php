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
                <button type="button" class="btn btn-primary" id="reserve_slot_btn" value="reserve" disabled>RESERVE SLOT</button>
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
    <div class="col-lg-5" style="margin-bottom: 20px;">
    </div>
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
        
        getParkingStatus();
        if(_user_type != 2){
            getOngoingOccupants();
            getPendingReservations();
            getQueuedReservationCount();
        }else{
            getOccupantQueueNumber();
        }

        setInterval(function () {
            getParkingStatus();
            if(_user_type != 2){
                getOngoingOccupants();
                getPendingReservations();
                getQueuedReservationCount();
            }else{
                getOccupantQueueNumber();
            }
        }, 5000);

        $("#reserve_slot_btn").on('click',function (e) {
            $rsv_id = this.value.split("_")
            if(this.value == "reserve")
                reserveSlot();
            else
                cancelReservation($rsv_id[1]);
        })
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
                // console.log(JSON.stringify(jqXHR));
                // console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
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
                // console.log(JSON.stringify(jqXHR));
                // console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
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
                if(response.ctr != 0){
                    $("#reserve_slot_btn").removeClass("btn-primary");
                    $("#reserve_slot_btn").addClass("btn-danger");
                    $("#reserve_slot_btn").text("CANCEL RESERVATION");
                    $("#reserve_slot_btn").val("cancel_"+response.rsv_id);
                }else{
                    $("#reserve_slot_btn").removeClass("btn-danger");
                    $("#reserve_slot_btn").addClass("btn-primary");
                    $("#reserve_slot_btn").text("RESERVE SLOT");
                    $("#reserve_slot_btn").val("reserve");
                }
                //for ending loading
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // console.log(JSON.stringify(jqXHR));
                // console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
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
                console.log(logs);

                _table_occ.clear().draw();
                for (var i = 0; i < logs.length; i++) {
                    var date_in = moment(logs[i]['atl_date_in'] + " " + logs[i]['atl_time_in']).format('MMMM DD, YYYY');
                    var time_in = moment(logs[i]['atl_date_in'] + " " + logs[i]['atl_time_in']).format('h:mm:ss A');

                    _table_occ.row.add([
                        logs[i]['oct_name'],
                        logs[i]['occ_lastname'] + ", " + logs[i]['occ_firstname'] + " " + (logs[i]['occ_middlename'].charAt(0).toUpperCase()) + ".",
                        logs[i]['omi_plate_number'],
                        date_in == "Invalid date" ? "" : date_in,
                        time_in == "Invalid date" ? "" : time_in,
                        '<a href="' + "{{url('scan?qr=')}}" + logs[i]['occ_qr_code'] + '" type="button" class="btn btn-primary btn-sm" title="Go to Scan" style="float:right;margin-right: 10px;color:#fff;"><i class="fa fa-qrcode"></i></a >'
                    ]).draw(false);
                }

                //for ending loading
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // console.log(JSON.stringify(jqXHR));
                // console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
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
                console.log(rsv);

                _table_rsv.clear().draw();
                for (var i = 0; i < rsv.length; i++) {
                    var reserve_datetime = moment(rsv[i]['rsv_datetime']).format('MMMM DD, YYYY h:mm:ss A');

                    _table_rsv.row.add([
                        i + 1,
                        reserve_datetime == "Invalid date" ? "" : reserve_datetime,
                        rsv[i]['oct_name'],
                        rsv[i]['occ_lastname'] + ", " + rsv[i]['occ_firstname'] + " " + (rsv[i]['occ_middlename'].charAt(0).toUpperCase()) + ".",
                        rsv[i]['rsv_notify_ctr'],
                        '<a href="' + "{{url('scan?qr=')}}" + rsv[i]['occ_qr_code'] + '" type="button" class="btn btn-primary btn-sm" title="Go to Scan" style="float:right;margin-right: 10px;color:#fff;"><i class="fa fa-qrcode"></i></a >'
                    ]).draw(false);
                }

                //for ending loading
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // console.log(JSON.stringify(jqXHR));
                // console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                //for ending loading
            }
        });
    }

    function reserveSlot() {
        run_waitMe('ios', '#body-container');
        $("#reserve_slot_btn").attr("disabled",true);
        $.ajax({
            method: 'GET',
            url: '{{ url("occupant-reserve-slot") }}',
            success: function (response) {
                console.log(response);
                
                if (response == "success_reservation") {
                    iziToast.success({
                        title: 'Success:',
                        message: ' Occupant is successfully reserved.',
                        position: 'bottomCenter',
                    });
                } else if (response == "error_reservation") {
                    iziToast.error({
                        title: 'Error:',
                        message: ' Failure for occupant to reserve.',
                        position: 'bottomCenter',
                    });
                    $('#reserve_slot_btn').attr("disabled", false);
                } else if (response == "occupant_deactivated") {
                    iziToast.warning({
                        title: 'Warning:',
                        message: ' Failure for occupant to reserve. Occupant\'s account is deactived.',
                        position: 'bottomCenter',
                    });
                } else if (response == "occupant_reservation_exist") {
                    iziToast.error({
                        title: 'Error:',
                        message: ' Failure for occupant to reserve. Occupant have existing reservation.',
                        position: 'bottomCenter',
                    });
                } else if (response == "reservation_invalid_not_full") {
                    iziToast.warning({
                        title: 'Warning:',
                        message: ' Invalid to reserve a slot. Parking slot is not full.',
                        position: 'bottomCenter',
                    });
                }
                
                getQueuedReservationCount();
                getOccupantQueueNumber();
                $('#body-container').waitMe('hide');
                $("#reserve_slot_btn").attr("disabled",false);
                
                //for ending loading
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                //for ending loading
                $('#body-container').waitMe('hide');
                $("#reserve_slot_btn").attr("disabled",false);
            }
        });
    }

    function cancelReservation(id) {
        run_waitMe('ios', '#body-container');
        $("#reserve_slot_btn").attr("disabled",true);
        $.ajax({
            method: 'GET',
            url: '{{ url("occupant-cancel-reservation") }}',
            data: {
                'id': id,
            },
            success: function (response) {
                console.log(response); 
                
                if (response == "success_cancellation") {
                    iziToast.success({
                        title: 'Success:',
                        message: ' Occupant reservation successfully cancelled.',
                        position: 'bottomCenter',
                    });
                } else if (response == "error_cancellation") {
                    iziToast.error({
                        title: 'Error:',
                        message: ' Failure to cancel occupant reservation.',
                        position: 'bottomCenter',
                    });
                }
                
                getQueuedReservationCount();
                getOccupantQueueNumber();
                $('#body-container').waitMe('hide');
                $("#reserve_slot_btn").attr("disabled",false);
                
                //for ending loading
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                //for ending loading
                $('#body-container').waitMe('hide');
                $("#reserve_slot_btn").attr("disabled",false);
            }
        });
    }
</script>