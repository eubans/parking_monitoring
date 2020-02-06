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

    #show_hide_old_password span {
        vertical-align: middle;
    }

    #show_hide_old_password span::before {
        vertical-align: middle;
        font-size: 1rem;
    }

    #show_hide_old_password {
        cursor: pointer;
    }

    #show_hide_new_password span {
        vertical-align: middle;
    }

    #show_hide_new_password span::before {
        vertical-align: middle;
        font-size: 1rem;
    }

    #show_hide_new_password {
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

    .avatar-upload {
        position: relative;
        max-width: 205px;
        margin: 10px;
    }

    .avatar-upload .avatar-edit {
        position: absolute;
        right: 32px;
        z-index: 1;
        top: 10px;
    }

    .avatar-upload .avatar-edit input {
        display: none;
    }

    .avatar-upload .avatar-edit input+label {
        display: inline-block;
        width: 34px;
        height: 34px;
        margin-bottom: 0;
        border-radius: 100%;
        background: #ffffff;
        border: 1px solid #adadad;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
        cursor: pointer;
        font-weight: normal;
        transition: all 0.2s ease-in-out;
    }

    .avatar-upload .avatar-edit input+label:hover {
        background: #f1f1f1;
        border-color: #d6d6d6;
    }

    .avatar-upload .avatar-edit input+label:after {
        content: "\f040";
        font-family: 'FontAwesome';
        color: #757575;
        position: absolute;
        top: 5px;
        left: 0;
        right: 0;
        text-align: center;
        margin: auto;
        font-size: 16px;
    }

    .avatar-upload .avatar-preview {
        width: 150px;
        height: 150px;
        position: relative;
        border-radius: 100%;
        border: 1px solid #d2d2d2;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        margin: 0 auto;
    }

    .avatar-upload .avatar-preview>div {
        width: 100%;
        height: 100%;
        border-radius: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }

    .disabled_input {
        pointer-events: none;
        cursor: not-allowed;
        opacity: .5;
    }
</style>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-12">
                <h4 id="page_title">User Settings</h4>
            </div>
        </div>
    </div>
    {!! Form::open(['url' => 'user-settings/save','id'=>'form_submit','data-smk-icon'=>'glyphicon-remove-sign'])
    !!}
    <div class="container" style="padding: 20px 35px;">
        <div class="row">
            @if(session('USER_TYPE_ID') != 2)
            <div class="col-md-7">
                <div class="row" style="margin-bottom: 5px;">
                    <div class="col-lg-4">
                        <h5>Users Details</h5>
                    </div>
                    <div class="col-sm-8">
                        <button type="button" class="btn btn-dark btn-sm" style="float:right;"
                            id="toggle_change_details_btn" value="true"><i class="fa fa-toggle-off"></i> Change
                            Details</button>
                        <button type="button" class="btn btn-dark btn-sm" style="float:right;margin-right: 5px;"
                            id="toggle_change_avatar_btn" value="true"><i class="fa fa-toggle-off"></i> Change
                            Profile Picture</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="padding-left: 0;">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="avatar-upload disabled_input">
                                    <div class="avatar-edit">
                                        <input type='file' id="imageUpload" name="imageUpload"
                                            accept=".png, .jpg, .jpeg" disabled />
                                        <label for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview"
                                            style="background-image: url({{Session::get('USER_AVATAR_PATH')}});">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6" style="padding: 0;">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" placeholder="Enter Username"
                                            id="username" name="username" value="{{ $user->use_username }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group required">
                                        <label for="lastname">Lastname:</label>
                                        <input type="text" class="form-control" placeholder="Enter Lastname"
                                            id="lastname" name="lastname"
                                            value="{{ $user->usd_lastname or old('lastname') }}" required disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label for="firstname">Firstname:</label>
                            <input type="text" class="form-control" placeholder="Enter Firstname" id="firstname"
                                name="firstname" value="{{ $user->usd_firstname or  old('firstname') }}" required
                                disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="middlename">Middlename:</label>
                            <input type="text" class="form-control" placeholder="Enter Middlename" id="middlename"
                                name="middlename" value="{{ $user->usd_middlename or  old('middlename') }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group required">
                            <label for="phone_number">Phone Number:</label>
                            <input type="text" class="form-control" placeholder="Enter Phone Number" id="phone_number"
                                value="{{ $user->usd_contact_number or  old('phone_number') }}" name="phone_number"
                                required disabled>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group required">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" placeholder="Enter Email" id="email" name="email"
                                value="{{ $user->usd_email or  old('email') }}" required disabled>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-md-5">
                <div class="row" style="margin-bottom: 5px;">
                    <div class="col-lg-6">
                        <h5>Change Password</h5>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-dark btn-sm" style="float:right;"
                            id="toggle_change_password_btn" value="true"><i class="fa fa-toggle-off"></i> Change
                            Password</button>
                    </div>
                </div>
                <div class="row" style="padding-left: 5px;">
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label for="old_password">Old Password:</label>
                            <div class="input-group" id="show_hide_old_password">
                                <input type="password" class="form-control" placeholder="Enter Old Password"
                                    id="old_password" autocomplete="new-password" name="old_password"
                                    value="{{ old('old_password') }}" aria-describedby="basic-addon1" required disabled>
                                <div class="input-group-append" style="padding: 0;">
                                    <span class="fa fa-eye-slash fa-lg input-group-text" aria-hidden="true"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label for="new_password">New Password:</label>
                            <div class="input-group" id="show_hide_new_password">
                                <input type="password" class="form-control" placeholder="Enter New Password"
                                    id="new_password" autocomplete="new-password" name="new_password"
                                    value="{{ old('new_password') }}" aria-describedby="basic-addon1" required disabled>
                                <div class="input-group-append" style="padding: 0;">
                                    <span class="fa fa-eye-slash fa-lg input-group-text" aria-hidden="true"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label for="confirm_password">Confirm Password:</label>
                            <div class="input-group" id="show_hide_confirm_password">
                                <input type="password" class="form-control" placeholder="Please Confirm Password"
                                    id="confirm_password" autocomplete="new-password" name="confirm_password"
                                    value="{{ old('confirm_password') }}" aria-describedby="basic-addon1" required
                                    disabled>
                                <div class="input-group-append" style="padding: 0;">
                                    <span class="fa fa-eye-slash fa-lg input-group-text" aria-hidden="true"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary" id="submit_button" style="float:right;margin: 5px -5px;">
                    <i class="fa fa-floppy-o"></i> Save
                </button>
                <button class="btn btn-danger" type="button" onclick="window.location.href='{{url('user-settings')}}';"
                    style="float:right;margin: 5px 10px;"><i class="fa fa-times"></i> Reset</button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
</div>

<script>
    function uploadProfilePicture() {
        // e.preventDefault();
        var formData = new FormData($('#form_submit')[0]);

        run_waitMe('ios', '.avatar-upload');

        $.ajax({
            url: '{{ url("user-settings/upload") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                iziToast.success({
                    title: 'Success:',
                    message: ' User profile picture is successfully uploaded.',
                    position: 'bottomCenter',
                    titleSize: '30px',
                    titleLineHeight: '70px',
                    messageSize: '20px',
                    messageLineHeight: '70px',
                });
                $('#image_avatar').removeAttr('src');
                $("#image_avatar").removeAttr("src").attr("src", response + new Date().getTime());
                //for ending loading
                $('.avatar-upload').waitMe('hide');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                //for ending loading
                $('.avatar-upload').waitMe('hide');
            }
        });
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
                uploadProfilePicture();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function () {

        $("#toggle_change_password_btn").on('click', function (event) {

            if (this.value == 'true') {
                $("#toggle_change_password_btn").removeClass('btn-dark');
                $("#toggle_change_password_btn").addClass('btn-primary');
                $("#toggle_change_password_btn").html('<i class="fa fa-toggle-on"></i> Change Password');
                this.value = 'false';

                $("#old_password").attr("disabled", false);
                $("#new_password").attr("disabled", false);
                $("#confirm_password").attr("disabled", false);
            } else {
                $("#toggle_change_password_btn").removeClass('btn-primary');
                $("#toggle_change_password_btn").addClass('btn-dark');
                $("#toggle_change_password_btn").html('<i class="fa fa-toggle-off"></i> Change Password');
                this.value = 'true';

                $("#old_password").attr("disabled", true);
                $("#new_password").attr("disabled", true);
                $("#confirm_password").attr("disabled", true);
            }
        });

        $("#toggle_change_details_btn").on('click', function (event) {

            if (this.value == 'true') {
                $("#toggle_change_details_btn").removeClass('btn-dark');
                $("#toggle_change_details_btn").addClass('btn-primary');
                $("#toggle_change_details_btn").html('<i class="fa fa-toggle-on"></i> Change Details');
                this.value = 'false';

                $("#lastname").attr("disabled", false);
                $("#firstname").attr("disabled", false);
                $("#middlename").attr("disabled", false);
                $("#email").attr("disabled", false);
                $("#phone_number").attr("disabled", false);
            } else {
                $("#toggle_change_details_btn").removeClass('btn-primary');
                $("#toggle_change_details_btn").addClass('btn-dark');
                $("#toggle_change_details_btn").html('<i class="fa fa-toggle-off"></i> Change Details');
                this.value = 'true';

                $("#lastname").attr("disabled", true);
                $("#firstname").attr("disabled", true);
                $("#middlename").attr("disabled", true);
                $("#email").attr("disabled", true);
                $("#phone_number").attr("disabled", true);
            }
        });

        $("#toggle_change_avatar_btn").on('click', function (event) {

            if (this.value == 'true') {
                $("#toggle_change_avatar_btn").removeClass('btn-dark');
                $("#toggle_change_avatar_btn").addClass('btn-primary');
                $("#toggle_change_avatar_btn").html('<i class="fa fa-toggle-on"></i> Change Profile Picture');
                this.value = 'false';

                $(".avatar-upload").removeClass('disabled_input');
                $("#imageUpload").attr('disabled', false);
            } else {
                $("#toggle_change_avatar_btn").removeClass('btn-primary');
                $("#toggle_change_avatar_btn").addClass('btn-dark');
                $("#toggle_change_avatar_btn").html('<i class="fa fa-toggle-off"></i> Change Profile Picture');
                this.value = 'true';

                $(".avatar-upload").addClass('disabled_input');
                $("#imageUpload").attr('disabled', true);
            }
        });

        $("#show_hide_old_password span").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_old_password input').attr("type") == "text") {
                $('#show_hide_old_password input').attr('type', 'password');
                $('#show_hide_old_password span').addClass("fa-eye-slash");
                $('#show_hide_old_password span').removeClass("fa-eye");
            } else if ($('#show_hide_old_password input').attr("type") == "password") {
                $('#show_hide_old_password input').attr('type', 'text');
                $('#show_hide_old_password span').removeClass("fa-eye-slash");
                $('#show_hide_old_password span').addClass("fa-eye");
            }
        });

        $("#show_hide_new_password span").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_new_password input').attr("type") == "text") {
                $('#show_hide_new_password input').attr('type', 'password');
                $('#show_hide_new_password span').addClass("fa-eye-slash");
                $('#show_hide_new_password span').removeClass("fa-eye");
            } else if ($('#show_hide_new_password input').attr("type") == "password") {
                $('#show_hide_new_password input').attr('type', 'text');
                $('#show_hide_new_password span').removeClass("fa-eye-slash");
                $('#show_hide_new_password span').addClass("fa-eye");
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

        $("#imageUpload").change(function () {
            if (this.files[0].name.match(/.(jpg|jpeg|png)$/i)) {
                readURL(this);
            } else {
                iziToast.error({
                    title: 'Error:',
                    message: ' Failure to uploader user profile picture. File not supported.',
                    position: 'bottomCenter',
                    titleSize: '30px',
                    titleLineHeight: '70px',
                    messageSize: '20px',
                    messageLineHeight: '70px',
                });
            }
        });

        var status = "{{session('status')}}";
        // alert(status);

        if (status == "error_password_not_match") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to save user details. Password does not match.',
                position: 'bottomCenter',
                titleSize: '30px',
                titleLineHeight: '70px',
                messageSize: '20px',
                messageLineHeight: '70px',
            });
        } else if (status == "error_invalid_old_password") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to save user details. Invalid Old Password.',
                position: 'bottomCenter',
                titleSize: '30px',
                titleLineHeight: '70px',
                messageSize: '20px',
                messageLineHeight: '70px',
            });
        } else if (status == "success_save") {
            iziToast.success({
                title: 'Success:',
                message: ' User details is successfully saved.',
                position: 'bottomCenter',
                titleSize: '30px',
                titleLineHeight: '70px',
                messageSize: '20px',
                messageLineHeight: '70px',
            });
        } else if (status == "error_save") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to save user details.',
                position: 'bottomCenter',
                titleSize: '30px',
                titleLineHeight: '70px',
                messageSize: '20px',
                messageLineHeight: '70px',
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