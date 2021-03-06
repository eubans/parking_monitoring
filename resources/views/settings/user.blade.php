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

    #show_hide_confirm_password span {
        vertical-align: middle;
    }

    #show_hide_confirm_password span::before {
        vertical-align: middle;
        font-size: 1rem;
    }

    #show_hide_confirm_password {
        cursor: pointer;
    }

    @media (max-width: 930px) {
        #toggle_change_password_btn{
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
            <div class="col-sm-12">
                <h4 id="page_title">User Registration</h4>
            </div>
        </div>
    </div>
    <div class="container" style="padding: 20px 35px;">
        <div class="row">
            <div class="col-md-9">
                <div class="row" style="margin-bottom: 5px;">
                    <div class="col-lg-6">
                        <h5>Users Details</h5>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-dark btn-sm" style="float:right;"
                            id="toggle_change_password_btn" value="true"><i class="fa fa-toggle-off"></i> Change
                            Password</button>
                        @if(session('USER_TYPE_ID') == 3)
                        {!! Form::open(['url' =>
                        'settings/user/toggle-status','id'=>'form_toggle_status','data-smk-icon'=>'glyphicon-remove-sign'])
                        !!}
                        <button type="submit" class="btn btn-sm" style="float:right;display: none;margin-right: 10px;"
                            id="toggle_status_btn" name="status"></button>
                        <input type="hidden" id="toggle_user_id" name="use_id">
                        {!! Form::close() !!}
                        @endif
                    </div>
                </div>
                {!! Form::open(['url' => 'settings/user/save','id'=>'form_submit','data-smk-icon'=>'glyphicon-remove-sign'])
                !!}
                <div class="row" style="padding-left: 5px;">
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label for="user_type">User Type</label>
                            <select class="form-control" id="user_type" name="user_type" required>
                                <option value="" disabled selected>Please select user type</option>
                                <option value="1">Admin</option>
                                <option value="4">Attendant</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" placeholder="Enter Username" id="username"
                                name="username" value="{{ old('username') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label for="password">Password:</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" class="form-control" placeholder="Enter Password" id="password"
                                    autocomplete="new-password" name="password" value="{{ old('password') }}"
                                    aria-describedby="basic-addon1" required>
                                <div class="input-group-append" style="padding: 0;">
                                    <span class="fa fa-eye-slash fa-lg input-group-text" aria-hidden="true"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label for="confirm_password">Confirm Password:</label>
                            <div class="input-group" id="show_hide_confirm_password">
                                <input type="password" class="form-control" placeholder="Please Confirm Password"
                                    id="confirm_password" autocomplete="new-confirm_password" name="confirm_password"
                                    value="{{ old('confirm_password') }}" aria-describedby="basic-addon1" required>
                                <div class="input-group-append" style="padding: 0;">
                                    <span class="fa fa-eye-slash fa-lg input-group-text" aria-hidden="true"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label for="lastname">Lastname:</label>
                            <input type="text" class="form-control" placeholder="Enter Lastname" id="lastname"
                                name="lastname" value="{{ old('lastname') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label for="firstname">Firstname:</label>
                            <input type="text" class="form-control" placeholder="Enter Firstname" id="firstname"
                                name="firstname" value="{{ old('firstname') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="middlename">Middlename:</label>
                            <input type="text" class="form-control" placeholder="Enter Middlename" id="middlename"
                                name="middlename" value="{{ old('middlename') }}">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group required">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" placeholder="Enter Email" id="email" name="email"
                                value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="col-md-5">
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
                <button type="submit" class="btn btn-primary" id="submit_button" style="float:right;margin: 5px -5px;">
                    <i class="fa fa-floppy-o"></i> Save
                </button>
                <button class="btn btn-danger" type="button" onclick="window.location.href='{{url('settings/user')}}';"
                    style="float:right;margin: 5px 10px;"><i class="fa fa-times"></i> Reset</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        var _id = (loadPageVar('id'));

        $('#phone_number').on('keypress', function (key) {
            if (key.charCode < 48 || key.charCode > 57) return false;
            if (this.value.length > 9) return false;
        });

        if (_id !== null && _id !== "" ) {
            $("#page_title").html("Administrator Profile");
            $("#submit_button").html('<i class="fa fa-floppy-o"></i> Update');

            // $("#show_qr_btn").css('display', 'block');
            // $("#scan_btn").css('display', 'block');
            $("#form_submit").attr('action', $("#form_submit").attr('action') + '?id=' + _id);

            run_waitMe('ios', '#body-container');
            $.ajax({
                method: 'GET',
                url: '{{ url("settings/user/fetch-details") }}',
                data: {
                    'id': _id,
                },
                dataType: 'json',
                success: function (response) {
                    var d = response;

                    if (!response) {
                        window.location.href = "{{url('settings/user')}}";
                    }

                    $("#user_type").val(d.ust_id);

                    $("#username").val(d.use_username);
                    $("#username").attr("disabled", true);
                    $("#password").attr("disabled", true);
                    $("#confirm_password").attr("disabled", true);

                    $("#lastname").val(d.usd_lastname);
                    $("#firstname").val(d.usd_firstname);
                    $("#middlename").val(d.usd_middlename);
                    $("#email").val(d.usd_email);
                    $("#phone_number").val(d.usd_contact_number);

                    $("#toggle_change_password_btn").css("display","unset");
                    $("#user_type").attr("disabled",true);

                    $("#toggle_user_id").val(d.use_id);
                    if (d.use_status == 'active') {
                        $("#toggle_status_btn").addClass('btn-danger');
                        $("#toggle_status_btn").html('<i class="fa fa-toggle-off"></i> Deactivate User');
                    } else {
                        $("#toggle_status_btn").addClass('btn-success');
                        $("#toggle_status_btn").html('<i class="fa fa-toggle-on"></i> Activate User');
                    }
                    $("#toggle_status_btn").val(d.use_status);
                    $("#toggle_status_btn").css('display', 'block');

                    //for ending loading
                    $('#body-container').waitMe('hide');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    //for ending loading
                    window.location.href = "{{url('settings/user')}}";
                    $('#body-container').waitMe('hide');
                }
            });
        }

        $("#toggle_change_password_btn").on('click', function (event) {
            // console.log(this.value);

            if (this.value == 'true') {
                $("#toggle_change_password_btn").removeClass('btn-dark');
                $("#toggle_change_password_btn").addClass('btn-primary');
                $("#toggle_change_password_btn").html('<i class="fa fa-toggle-on"></i> Change Password');
                this.value = 'false';

                $("#password").attr("disabled", false);
                $("#confirm_password").attr("disabled", false);
            } else {
                $("#toggle_change_password_btn").removeClass('btn-primary');
                $("#toggle_change_password_btn").addClass('btn-dark');
                $("#toggle_change_password_btn").html('<i class="fa fa-toggle-off"></i> Change Password');
                this.value = 'true';

                $("#password").attr("disabled", true);
                $("#confirm_password").attr("disabled", true);
            }
        });

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

        $("#show_hide_confirm_password span").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_confirm_password input').attr("type") == "text") {
                $('#show_hide_confirm_password input').attr('type', 'password');
                $('#show_hide_confirm_password span').addClass("fa-eye-slash");
                $('#show_hide_confirm_password span').removeClass("fa-eye");
            } else if ($('#show_hide_confirm_password input').attr("type") == "password") {
                $('#show_hide_confirm_password input').attr('type', 'text');
                $('#show_hide_confirm_password span').removeClass("fa-eye-slash");
                $('#show_hide_confirm_password span').addClass("fa-eye");
            }
        });

        var status = "{{session('status')}}";
        // alert(status);

        if (status == "error_password_not_match") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to save user details. Password does not match.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status == "error_username_taken") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to save user details. Username has been already taken.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status == "success_save") {
            iziToast.success({
                title: 'Success:',
                message: ' User details is successfully saved.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status == "error_save") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to save user details.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status == "success_change_status") {
            iziToast.success({
                title: 'Success:',
                message: ' User login access successfully changed.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status == "error_change_status") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to change User login access.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status == "invalid_email") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to save new user. Invalid email address.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status == "change_status_invalid_email") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to change User login access. Invalid email address.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        }

        $('#form_submit').submit(function (event) {
            event.preventDefault(); //this will prevent the default submit
            $.confirm({
                title: 'Confirmation',
                content: 'Are you sure to continue?',
                buttons: {
                    confirm: function () {
                        $('#form_submit').unbind('submit').submit(); // continue the submit unbind preventDefault
                    },
                    cancel: function () {
                        //
                    },
                }
            });
        });
    });
</script>