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

    .iziModal {
        z-index: 99999 !important;
    }

    @media (max-width: 930px) {
        #show_qr_btn{
            margin-bottom: 10px !important;
        }
        #toggle_status_btn{
            margin-right: 0 !important;
        }
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

                @if(session('USER_TYPE_ID') == 1 || session('USER_TYPE_ID') == 3)
                {!! Form::open(['url' =>
                'occupant/profile/toggle-status','id'=>'form_toggle_status','data-smk-icon'=>'glyphicon-remove-sign'])
                !!}
                <button type="submit" class="btn" style="float:right;display: none;margin-right: 10px;"
                    id="toggle_status_btn" name="status"></button>
                <input type="hidden" class="toggle_occ_id" name="id">
                {!! Form::close() !!}
                @endif

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

                @if(session('USER_TYPE_ID') == 3 || session('USER_TYPE_ID') == 4)
                <a type="button" class="btn btn-primary" style="float:right;display: none;margin-right: 10px;"
                    id="scan_btn">
                    <i class="fa fa-print"></i> Go to Scan
                </a>
                @endif
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
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label for="occupant_type">Occupant Type</label>
                            <select class="form-control" id="occupant_type" name="occupant_type" required>
                                @foreach($occupant_type as $type)
                                <option value="{{$type->oct_id}}">{{$type->oct_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" placeholder="Enter Username" id="username"
                                name="username" readonly>
                        </div>
                    </div>
                    <div class="col-md-4" style="display:none">
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
                                id="student_number" name="student_number" required value="{{ old('student_number') }}">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group required">
                            <label for="course">Course:</label>
                            <input type="text" class="form-control" placeholder="Enter Course" id="course" name="course"
                                required value="{{ old('course') }}">
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-left: 5px;">
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label for="lastname">Lastname:</label>
                            <input type="text" class="form-control" placeholder="Enter Lastname" id="lastname"
                                name="lastname" required value="{{ old('lastname') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label for="firstname">Firstname:</label>
                            <input type="text" class="form-control" placeholder="Enter Firstname" id="firstname"
                                name="firstname" required value="{{ old('firstname') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="middlename">Middlename:</label>
                            <input type="text" class="form-control" placeholder="Enter Middlename" id="middlename"
                                name="middlename" value="{{ old('middlename') }}">
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-left: 5px;">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="birth_date">Date of birth:</label>
                            <input type="date" class="form-control" placeholder="Enter Date of Birth" id="birth_date"
                                name="birth_date" value="{{ old('birth_date') }}">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group required">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" placeholder="Enter Email" id="email" name="email"
                                required value="{{ old('email') }}">
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-left: 5px;">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telephone">Telephone:</label>
                            <input type="text" class="form-control" placeholder="Enter Telephone" id="telephone"
                                name="telephone" value="{{ old('telephone') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label for="phone_number">Phone Number:</label>
                            <div class="input-group" style="padding:0;">
                                <div class="input-group-prepend" style="padding: 0;">
                                    <span class="input-group-text" id="basic-addon2">+63</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Enter Phone Number"
                                    id="phone_number" name="phone_number" required value="{{ old('phone_number') }}"
                                    aria-label="Enter Phone Number" aria-describedby="basic-addon2"
                                    autocomplete="new-phone-number">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-left: 5px;">
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" placeholder="Enter Address" id="address"
                                name="address" required value="{{ old('address') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row" style="margin-bottom: 5px;">
                    <div class="col-lg-12">
                        <h5>Occupant Photo</h5>
                    </div>
                </div>
                <div class="row" style="padding-left: 5px;">
                    <div class="col-md-12" style="text-align: center;">
                        <div id="my_camera" style="margin: 0 auto;"></div>
                        <input type="hidden" name="base64_image" id="base64_image" required>
                        <button type="button" class="btn btn-secondary" style="margin: 5px -5px;display: none;"
                            onClick="takeSnapshot()" id="take_snap_btn">
                            <i class="fa fa-camera"></i> Take Snapshot
                        </button>
                        <button type="button" class="btn btn-dark" style="margin: 5px -5px;" onClick="renderCamera()"
                            id="try_again_snap_btn">
                            <i class="fa fa-plus-circle"></i> New photo
                        </button>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 5px;">
                    <div class="col-lg-12">
                        <h5>Guardian Information</h5>
                    </div>
                </div>
                <div class="row" style="padding-left: 5px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="guardian_name">Fullname:</label>
                            <input type="text" class="form-control" placeholder="Enter Guardian Fullname"
                                id="guardian_name" name="guardian_name" value="{{ old('guardian_name') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="guardian_">Occupation:</label>
                            <input type="text" class="form-control" placeholder="Enter Occupation"
                                id="guardian_occupation" name="guardian_occupation"
                                value="{{ old('guardian_occupation') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="guardian_contact">Contact Number:</label>
                            <input type="text" class="form-control" placeholder="Enter Contact Number"
                                id="guardian_contact" name="guardian_contact" value="{{ old('guardian_contact') }}">
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
                                name="or_number" required value="{{ old('or_number') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label for="cr_number">Certificate of Registration:</label>
                            <input type="text" class="form-control" placeholder="Enter CR Number" id="cr_number"
                                name="cr_number" required value="{{ old('cr_number') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label for="plate_number">Plate Number:</label>
                            <input type="text" class="form-control" placeholder="Enter Plate Number" id="plate_number"
                                name="plate_number" required value="{{ old('plate_number') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label for="brand">Brand:</label>
                            <input type="text" class="form-control" placeholder="Enter Brand" id="brand" name="brand"
                                required value="{{ old('brand') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label for="model">Model:</label>
                            <input type="text" class="form-control" placeholder="Enter Model" id="model" name="model"
                                required value="{{ old('model') }}">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" id="submit_button" style="float:right;margin: 5px -5px;">
                    <i class="fa fa-floppy-o"></i> Save
                </button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <!-- MODAL QR START -->
    <div id="select-qr-modal" class="lead_modal" data-izimodal-group="" data-izimodal-loop=""
        data-izimodal-title="Occupant Card" data-izimodal-subtitle=" " style="display: none; text-align: center; ">
        <div class="row">
            <div class="col-sm-8">
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
                <button id="btnQRCardPrint" class="btn btn-light btn-outline-dark" style="margin-bottom:20px;"><i
                        class="fa fa-print"></i> Print
                    Card</button>
            </div>
            <div class="col-sm-4">
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
                </div><button id="btnQRStickerPrint" class="btn btn-light btn-outline-dark"
                    style="margin-bottom:20px;"><i class="fa fa-print"></i> Print
                    QR Sticker</button>
            </div>
        </div>
    </div>
    <!-- MODAL QR END -->
</div>

<script>
    $(document).ready(function () {

        var _id = (loadPageVar('id'));

        $('#select-qr-modal').iziModal({
            headerColor: '#23282E',
            width: '80%',
            overlay: true,
            overlayClose: false,
            overlayColor: 'rgba(0, 0, 0, 0.4)',
            transitionIn: 'bounceInDown',
            transitionOut: 'bounceOutDown',
        });

        $('#phone_number').on('keypress', function (key) {
            if (key.charCode < 48 || key.charCode > 57) return false;
            if (this.value.length > 9) return false;
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

                    $("#guardian_name").val(d.ocg_name);
                    $("#guardian_occupation").val(d.ocg_occupation);
                    $("#guardian_contact").val(d.ocg_contact);

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
                        if (d.oct_name != "Guest") {
                            $("#toggle_login_btn").addClass('btn-success');
                            $("#toggle_login_btn").html('<i class="fa fa-toggle-on"></i> Activate Login');
                        } else {
                            $("#toggle_login_btn").addClass('btn-success');
                            $("#toggle_login_btn").attr('disabled', true);
                            $("#toggle_login_btn").html('<i class="fa fa-toggle-on"></i> Activate Login');
                        }
                    }
                    $("#toggle_use_id").val(d.use_id);
                    $("#toggle_login_btn").val(d.use_status);
                    $("#toggle_login_btn").css('display', 'block');

                    $("#scan_btn").attr('href', "{{url('scan?qr=')}}" + d.occ_qr_code);

                    $('#qrcode').html(response.qr_code);

                    $("#card_occupant_type").text(d.oct_name);
                    $("#card_name").text(d.occ_lastname + ", " + d.occ_firstname + " " + ((d.occ_middlename == null || d.occ_middlename == "") ? "" : d.occ_middlename.charAt(0).toUpperCase() + "."));
                    var date_issued = moment().format('MMMM DD, YYYY');
                    $("#card_date_issued").text(date_issued == "Invalid date" ? "" : date_issued);
                    $("#card_or_number").text(d.omi_or_number);
                    $("#card_cr_number").text(d.omi_cr_number);
                    $("#card_plate_number").text(d.omi_plate_number);
                    $("#card_brand").text(d.omi_brand);
                    $("#card_model").text(d.omi_model);

                    $('#qr_sticker_code').html(response.qr_sticker_code);
                    $('#sticker_qr_serial').html(d.occ_qr_code);

                    var data_uri = "{{asset('public/img/occupant')}}" + "/" + d.occ_id + ".png?" + new Date().getTime();
                    document.getElementById('my_camera').innerHTML =
                        '<img id="imageprev" src="' + data_uri + '"/>';
                    $("#card_image").attr("src", data_uri);

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
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status == "error_save") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to save occupant details.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status == "success_change_status") {
            iziToast.success({
                title: 'Success:',
                message: ' Occupant account status successfully changed.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status == "error_change_status") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to change Occupant account status.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status == "error_ongoing_log") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to change Occupant account status due to an ongoing attendance log.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status == "error_save") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to save occupant details.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status == "success_change_login") {
            iziToast.success({
                title: 'Success:',
                message: ' Occupant login access successfully changed.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status == "error_change_login") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to change Occupant login access.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status == "error_username_taken") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to save occupant details. Email for username is already taken.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status == "invalid_email") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to save occupant details. Invalid email address.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status == "change_status_invalid_email") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to change Occupant login access. Invalid email address.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status == "change_occupant_status_invalid_email") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to change Occupant account status. Invalid email address.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
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

        $("#btnQRStickerPrint").on('click', function (e) {
            $("#qr_sticker_div").printThis();
        });

        $('#form_submit').submit(function (event) {
            event.preventDefault(); //this will prevent the default submit
            $.confirm({
                title: 'Confirmation',
                content: 'Are you sure to continue?',
                buttons: {
                    confirm: function () {
                        if (!$("#imageprev").length) {
                            iziToast.error({
                                title: 'Error:',
                                message: ' Occupant photo is required.',
                                position: 'bottomCenter',
                                titleSize: '15px',
                                titleLineHeight: '35px',
                                messageSize: '15px',
                                messageLineHeight: '35px',
                            });
                        } else {
                            $("#base64_image").val(getBase64Image(document.getElementById("imageprev")));
                            $('#form_submit').unbind('submit').submit(); // continue the submit unbind preventDefault
                        }
                    },
                    cancel: function () {
                        //
                    },
                }
            });
        });
    });

    function takeSnapshot() {
        $("#take_snap_btn").css("display", "none");
        $("#try_again_snap_btn").css("display", "unset");

        Webcam.snap(function (data_uri) {
            document.getElementById('my_camera').innerHTML =
                '<img id="imageprev" src="' + data_uri + '"/>';
            var base64image = document.getElementById("imageprev").src;
            // base64image = base64image.split(';')[1];
            $("#base64_image").val(base64image);
        });
    }

    function renderCamera() {
        $("#take_snap_btn").css("display", "unset");
        $("#try_again_snap_btn").css("display", "none");
        $("#base64_image").val("");
        $("#my_camera").html("");

        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'png',
            jpeg_quality: 90
        });
        Webcam.attach('#my_camera');
    }

    function getBase64Image(img) {
        var canvas = document.createElement("canvas");
        canvas.width = img.width;
        canvas.height = img.height;
        var ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0);
        var dataURL = canvas.toDataURL("image/png");
        return dataURL;
        // return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
    }
</script>