<style>
    .card-header {
        padding: .75rem;
    }

    .container .row .col-md-6 .row div {
        padding-left: 5px;
        padding-right: 5px;
    }

    .container .row .col-md-6 .row div .form-group {
        margin-bottom: 5px;
    }

    #show_hide_password span {
        vertical-align: middle;
    }

    #show_hide_password span::before {
        vertical-align: middle;
        font-size: 1rem;
    }

    #show_hide_password {
        cursor: pointer;
    }
</style>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-4">
                <h4 id="page_title">Occupant Registration</h4>
            </div>
            <div class="col-sm-8">
                <button type="button" class="btn btn-primary" style="float:right;display: none;" id="show_qr_btn">
                    <i class=" fa fa-qrcode"></i> Show Occupant Card
                </button>
                {!! Form::open(['url' =>
                'occupant/profile/toggle-status','id'=>'form_toggle_status','data-smk-icon'=>'glyphicon-remove-sign'])
                !!}
                <button type="submit" class="btn" style="float:right;display: none;margin-right: 10px;"
                    id="toggle_status_btn" name="status"></button>
                <input type="hidden" class="toggle_occ_id" name="id">
                {!! Form::close() !!}
                @if(session('USER_TYPE_ID') == 3)
                {!! Form::open(['url' =>
                'occupant/profile/toggle-login','id'=>'form_toggle_login','data-smk-icon'=>'glyphicon-remove-sign'])
                !!}
                <button type="submit" class="btn" style="float:right;display: none;margin-right: 10px;"
                    id="toggle_login_btn" name="login"></button>
                <input type="hidden" id="toggle_use_id" name="use_id">
                <input type="hidden" class="toggle_occ_id" name="occ_id">
                {!! Form::close() !!}
                @endif
                <a type="button" class="btn btn-primary" style="float:right;display: none;margin-right: 10px;"
                    id="scan_btn">
                    <i class="fa fa-print"></i> Go to Scan
                </a>
            </div>
        </div>
    </div>
    {!! Form::open(['url' => 'occupant/registration/save','id'=>'form_submit','data-smk-icon'=>'glyphicon-remove-sign'])
    !!}
    <div class="container" style="padding: 20px 35px;">
        <div class="row">
            <div class="col-md-6">
                <div class="row" style="margin-bottom: 5px;">
                    <div class="col-lg-12">
                        <h5>Account Details</h5>
                    </div>
                </div>
                <div class="row" style="padding-left: 5px;">
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label for="occupant_type">Occupant Type</label>
                            <select class="form-control" id="occupant_type" name="occupant_type" required>
                                @foreach($occupant_type as $type)
                                <option value="{{$type->oct_id}}">{{$type->oct_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" placeholder="Enter Username" id="username"
                                name="username" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" class="form-control" placeholder="Enter Password" id="password"
                                    autocomplete="new-password" name="password" readonly
                                    aria-describedby="basic-addon1">
                                <div class="input-group-append" style="padding: 0;">
                                    <span class="fa fa-eye-slash fa-lg input-group-text" aria-hidden="true"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 5px;margin-top: 15px;">
                    <div class="col-lg-12">
                        <h5>Occupant Information</h5>
                    </div>
                </div>
                <div class="row" style="padding-left: 5px;">
                    <div class="col-md-7">
                        <div class="form-group required">
                            <label for="student_number">Student Number:</label>
                            <input type="text" class="form-control" placeholder="Enter Student Number"
                                id="student_number" name="student_number" required>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group required">
                            <label for="course">Course:</label>
                            <input type="text" class="form-control" placeholder="Enter Course" id="course" name="course"
                                required>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-left: 5px;">
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label for="lastname">Lastname:</label>
                            <input type="text" class="form-control" placeholder="Enter Lastname" id="lastname"
                                name="lastname" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label for="firstname">Firstname:</label>
                            <input type="text" class="form-control" placeholder="Enter Firstname" id="firstname"
                                name="firstname" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="middlename">Middlename:</label>
                            <input type="text" class="form-control" placeholder="Enter Middlename" id="middlename"
                                name="middlename">
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-left: 5px;">
                    <div class="col-md-5">
                        <div class="form-group required">
                            <label for="birth_date">Date of birth:</label>
                            <input type="date" class="form-control" placeholder="Enter Date of Birth" id="birth_date"
                                name="birth_date" required>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group required">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" placeholder="Enter Email" id="email" name="email"
                                required>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-left: 5px;">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telephone">Telephone:</label>
                            <input type="text" class="form-control" placeholder="Enter Telephone" id="telephone"
                                name="telephone">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label for="phone_number">Phone Number:</label>
                            <input type="text" class="form-control" placeholder="Enter Phone Number" id="phone_number"
                                name="phone_number" required>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-left: 5px;">
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" placeholder="Enter Address" id="address"
                                name="address" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row" style="margin-bottom: 5px;">
                    <div class="col-lg-12">
                        <h5>Parents Information</h5>
                    </div>
                </div>
                <div class="row" style="padding-left: 5px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="mother_name">Mother Fullname:</label>
                            <input type="text" class="form-control" placeholder="Enter Mother Fullname" id="mother_name"
                                name="mother_name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mother_occupation">Occupation:</label>
                            <input type="text" class="form-control" placeholder="Enter Occupation"
                                id="mother_occupation" name="mother_occupation">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mother_contact">Contact Number:</label>
                            <input type="text" class="form-control" placeholder="Enter Contact Number"
                                id="mother_contact" name="mother_contact">
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-left: 5px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="father_name">Father Fullname:</label>
                            <input type="text" class="form-control" placeholder="Enter Father Fullname" id="father_name"
                                name="father_name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="father_occupation">Occupation:</label>
                            <input type="text" class="form-control" placeholder="Enter Occupation"
                                id="father_occupation" name="father_occupation">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="father_contact">Contact Number:</label>
                            <input type="text" class="form-control" placeholder="Enter Contact Number"
                                id="father_contact" name="father_contact">
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 5px;margin-top: 15px;">
                    <div class="col-lg-12">
                        <h5>Motorcycle Information</h5>
                    </div>
                </div>
                <div class="row" style="padding-left: 5px;">
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label for="or_number">Official Receipt:</label>
                            <input type="text" class="form-control" placeholder="Enter OR Number" id="or_number"
                                name="or_number" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label for="cr_number">Certificate of Registration:</label>
                            <input type="text" class="form-control" placeholder="Enter CR Number" id="cr_number"
                                name="cr_number" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label for="plate_number">Plate Number:</label>
                            <input type="text" class="form-control" placeholder="Enter Plate Number" id="plate_number"
                                name="plate_number" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label for="brand">Brand:</label>
                            <input type="text" class="form-control" placeholder="Enter Brand" id="brand" name="brand"
                                required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label for="model">Model:</label>
                            <input type="text" class="form-control" placeholder="Enter Model" id="model" name="model"
                                required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" id="submit_button" style="float:right;margin: 5px -5px;"
                    onclick="confirm('Are you sure to continue?')">
                    <i class="fa fa-floppy-o"></i> Save
                </button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <!-- MODAL QR START -->
    <div id="select-qr-modal" class="lead_modal" data-izimodal-group="" data-izimodal-loop=""
        data-izimodal-title="Occupant Card" data-izimodal-subtitle=" " style="display: none; text-align: center;">
        <!-- <div id="qrcode" style="text-align: center;"></div> -->
        <div class="row table-responsive" id="qr_card_div" style="padding: 20px;">
            <style>
                .table td {
                    padding: 1px;
                    vertical-align: middle;
                    text-align: left;
                }
            </style>
            <table class="table table-bordered" style="width: 600px;border: 2px solid #000 !important;margin: 0 auto;">
                <tr>
                    <td width="30%">
                        <h5>IETI Occupant Card</h5>
                    </td>
                    <td width="70%" colspan="2">Name: <span id="card_name" style="font-weight: bold;"></span></td>
                </tr>
                <tr>
                    <td rowspan="6" width="20%" style="vertical-align: middle;">
                        <div id="qrcode" style="text-align: center;"></div>
                    </td>
                    <td>Type: <span id="card_occupant_type" style="font-weight: bold;"></span>
                    </td>
                    <td>Date Issued: <span id="card_date_issued" style="font-weight: bold;"></span></td>
                </tr>
                <tr>
                    <td colspan="2">Official Receipt: <span id="card_or_number" style="font-weight: bold;"></span></td>
                </tr>
                <tr>
                    <td colspan="2">Certificate of Registration: <span id="card_cr_number"
                            style="font-weight: bold;"></span></td>
                </tr>
                <tr>
                    <td colspan="2">Plate Number: <span id="card_plate_number" style="font-weight: bold;"></span></td>
                </tr>
                <tr>
                    <td colspan="2">Brand: <span id="card_brand" style="font-weight: bold;"></span></td>
                </tr>
                <tr>
                    <td colspan="2">Model: <span id="card_model" style="font-weight: bold;"></span></td>
                </tr>
            </table>
        </div>
        <button id="btnQRCardPrint" class="btn btn-light btn-outline-dark" style="margin-bottom:20px;"><i
                class="fa fa-print"></i> Print
            Card</button>
    </div>
    <!-- MODAL QR END -->
</div>

<script>
    $(document).ready(function () {

        var _id = (loadPageVar('id'));

        $('#select-qr-modal').iziModal({
            headerColor: '#23282E',
            width: '90%',
            overlay: true,
            overlayClose: false,
            overlayColor: 'rgba(0, 0, 0, 0.4)',
            transitionIn: 'bounceInDown',
            transitionOut: 'bounceOutDown',
        });

        if (window.location.pathname.split("/").pop() == "profile") {
            $("#page_title").html("Occupant Profile");
            $("#occupant_type").attr("disabled", true);
            $("#submit_button").html('<i class="fa fa-floppy-o"></i> Update');

            $("#show_qr_btn").css('display', 'block');
            $("#scan_btn").css('display', 'block');
            $("#form_submit").attr('action', $("#form_submit").attr('action') + '?id=' + _id);

            run_waitMe('ios', '#body-container');
            $.ajax({
                method: 'GET',
                url: '{{ url("occupant/profile/fetch") }}',
                data: {
                    'id': _id,
                },
                dataType: 'json',
                success: function (response) {
                    var d = response.details;

                    if (d.length < 0) {
                        window.location.href = "{{url('occupant/registration')}}";
                    }

                    $("#occupant_type").val(d.occ_type);
                    $("#username").val(d.use_username);
                    $("#password").val(d.use_password);

                    $("#student_number").val(d.occ_student_number);
                    $("#student_number").attr("disabled", true);
                    $("#course").val(d.occ_course);
                    $("#lastname").val(d.occ_lastname);
                    $("#firstname").val(d.occ_firstname);
                    $("#middlename").val(d.occ_middlename);
                    $("#birth_date").val(d.occ_date_of_birth);
                    $("#email").val(d.occ_email_address);
                    $("#telephone").val(d.occ_telephone);
                    $("#phone_number").val(d.occ_phone_number);
                    $("#address").val(d.occ_address);

                    $("#mother_name").val(d.ocp_mother_name);
                    $("#mother_occupation").val(d.ocp_mother_occupation);
                    $("#mother_contact").val(d.ocp_mother_contact);
                    $("#father_name").val(d.ocp_father_name);
                    $("#father_occupation").val(d.ocp_father_occupation);
                    $("#father_contact").val(d.ocp_father_number);

                    $("#or_number").val(d.omi_or_number);
                    $("#cr_number").val(d.omi_cr_number);
                    $("#plate_number").val(d.omi_plate_number);
                    $("#brand").val(d.omi_brand);
                    $("#model").val(d.omi_model);

                    $('#occupant_type').change();

                    $(".toggle_occ_id").val(d.occ_id);

                    if (d.occ_account_status == 'active') {
                        $("#toggle_status_btn").addClass('btn-danger');
                        $("#toggle_status_btn").html('<i class="fa fa-toggle-off"></i> Deactivate Account');
                    } else {
                        $("#toggle_status_btn").addClass('btn-success');
                        $("#toggle_status_btn").html('<i class="fa fa-toggle-on"></i> Activate Account');
                    }
                    $("#toggle_status_btn").val(d.occ_account_status);
                    $("#toggle_status_btn").css('display', 'block');

                    if (d.use_status == 'active') {
                        $("#toggle_login_btn").addClass('btn-danger');
                        $("#toggle_login_btn").html('<i class="fa fa-toggle-off"></i> Deactivate Login');
                    } else {
                        $("#toggle_login_btn").addClass('btn-success');
                        $("#toggle_login_btn").html('<i class="fa fa-toggle-on"></i> Activate Login');
                    }
                    $("#toggle_use_id").val(d.use_id);
                    $("#toggle_login_btn").val(d.use_status);
                    $("#toggle_login_btn").css('display', 'block');

                    $("#scan_btn").attr('href', "{{url('scan?qr=')}}" + d.occ_qr_code);

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

                    //for ending loading
                    $('#body-container').waitMe('hide');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    //for ending loading
                    window.location.href = "{{url('occupant/registration')}}";
                    $('#body-container').waitMe('hide');
                }
            });
        }

        $("#show_hide_password span").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password span').addClass("fa-eye-slash");
                $('#show_hide_password span').removeClass("fa-eye");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password span').removeClass("fa-eye-slash");
                $('#show_hide_password span').addClass("fa-eye");
            }
        });

        $("#show_qr_btn").click(function () {
            $('#select-qr-modal').iziModal('open');
        });

        var status = "{{session('status')}}";
        // alert(status);

        if (status == "success_save") {
            iziToast.success({
                title: 'Success:',
                message: ' Occupant details successfully saved.',
                position: 'bottomCenter',
            });
        } else if (status == "error_save") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to save occupant details.',
                position: 'bottomCenter',
            });
        } else if (status == "success_change_status") {
            iziToast.success({
                title: 'Success:',
                message: ' Occupant account status successfully changed.',
                position: 'bottomCenter',
            });
        } else if (status == "error_change_status") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to change Occupant account status.',
                position: 'bottomCenter',
            });
        } else if (status == "error_ongoing_log") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to change Occupant account status due to an ongoing attendance log.',
                position: 'bottomCenter',
            });
        } else if (status == "error_save") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to save occupant details.',
                position: 'bottomCenter',
            });
        } else if (status == "success_change_login") {
            iziToast.success({
                title: 'Success:',
                message: ' Occupant login access successfully changed.',
                position: 'bottomCenter',
            });
        } else if (status == "error_change_login") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to change Occupant login access.',
                position: 'bottomCenter',
            });
        }

        $('#occupant_type').on('change', function (e) {
            if (this.value != 1) {
                $("#student_number").attr("disabled", true);
                $("#course").attr("disabled", true);
            } else {
                $("#student_number").attr("disabled", false);
                $("#course").attr("disabled", false);
            }
        });


        $("#btnQRCardPrint").on('click', function (e) {
            $("#qr_card_div").printThis();
        });
    });
</script>