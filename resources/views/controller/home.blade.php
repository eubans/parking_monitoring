<style>
    table.dataTable thead .sorting,
    table.dataTable thead .sorting_asc,
    table.dataTable thead .sorting_desc {
        background: none;
    }

    #table_occ_paginate .pagination li {
        padding: 1px;
    }
</style>

<div class="row">
    <div class="col-lg-5" style="text-align: center;margin-bottom: 20px;">
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
        <div class="card" style="margin-top: 20px;">
            <div class="card-header" style="text-align: center;">
                <div class="row">
                    <div class="col-12">
                        <h5>Login User Details</h5>
                    </div>
                </div>
            </div>
            <div class="container" style="padding: 25px;vertical-align: middle;">
                <div class="row">
                    <div class="col-12" style="text-align: center;">
                        <img id="image_avatar" src="{{Session::get('USER_AVATAR_PATH')}}" class="img-circle"
                            alt="{{Session::get('USER_FULL_NAME')}}"
                            style="width: 100px;height: 100px;background-color: #fff;object-fit: cover;">
                    </div>
                    <div class="col-12" style="text-align: left;">
                        <span>Username: <strong>{{Session::get('USER_NAME')}}</strong></span><br>
                        <span>Name: <strong>{{Session::get('USER_FULLNAME')}}</strong></span> <br>
                        <span>Type: <strong>{{Session::get('USER_TYPE')}}</strong></span> <br>
                        <span>Email: <strong>{{Session::get('USER_EMAIL')}}</strong></span> <br>
                        <span>Contact Number: <strong>{{Session::get('USER_CONTACT')}}</strong></span> <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7" style="margin-bottom: 20px;font-size: small;">
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
    <div class="col-lg-5" style="margin-bottom: 20px;">
    </div>
</div>

<script>
    var _table_occ = "";
    $(document).ready(function () {
        _table_occ = $('#table_occ').DataTable({
            "ordering": false,
            "autoWidth": false,
            responsive: true
        });

        getParkingStatus();
        getOngoingOccupants();

        setInterval(function () {
            getParkingStatus();
        }, 5000);
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

    function getOngoingOccupants() {
        $.ajax({
            method: 'GET',
            url: '{{ url("get-ongoing-occupants") }}',
            dataType: 'json',
            success: function (response) {
                var logs = response;
                console.log(logs);


                _table_occ.clear();
                for (var i = 0; i < logs.length; i++) {
                    var date_in = moment(logs[i]['atl_date_in'] + " " + logs[i]['atl_time_in']).format('MMMM DD, YYYY');
                    var time_in = moment(logs[i]['atl_date_in'] + " " + logs[i]['atl_time_in']).format('h:mm:ss A');

                    _table_occ.row.add([
                        logs[i]['oct_name'],
                        logs[i]['occ_lastname'] + ", " + logs[i]['occ_firstname'] + " " + (logs[i]['occ_middlename'].charAt(0).toUpperCase()) + ".",
                        logs[i]['omi_plate_number'],
                        date_in == "Invalid date" ? "" : date_in,
                        time_in == "Invalid date" ? "" : time_in,
                        '<a href="'+ "{{url('scan?qr=')}}"+logs[i]['occ_qr_code'] + '" type="button" class="btn btn-primary btn-sm" title="Go to Scan" style="float:right;margin-right: 10px;color:#fff;"><i class="fa fa-qrcode"></i></a >'
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
</script>