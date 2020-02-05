<style>
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
</style>

<link href="{{ asset('public/themes/default/assets/css/main.css') }}" rel="stylesheet">
<div class="sidenav">
    <div class="login-main-text">
        <img src="{{ asset('public/img/logo.png') }}" style="margin-bottom: 20%;">
        <h2>Parking Logs System<br> Forgot Password Page</h2>
        <p>Let's change your password, </p>
        <h5>{{$account}}</h5>
    </div>
</div>
<div class="main">
    <div class="col-md-6 col-sm-12">
        <div class="login-form">
            {!! Form::open(['url' => 'forgot-password/change-forgotten-password']) !!}
            <input type="hidden" name="account" value="{{$account}}">
            <div class="form-group required">
                <label for="new_password">New Password:</label>
                <div class="input-group" id="show_hide_new_password">
                    <input type="password" class="form-control" placeholder="Enter New Password"
                        id="new_password" autocomplete="new-password" name="new_password"
                        value="{{ old('new_password') }}" aria-describedby="basic-addon1" required>
                    <div class="input-group-append" style="padding: 0;">
                        <span class="fa fa-eye-slash fa-lg input-group-text" aria-hidden="true"></span>
                    </div>
                </div>
            </div>
            <div class="form-group required">
                <label for="confirm_password">Confirm Password:</label>
                <div class="input-group" id="show_hide_confirm_password">
                    <input type="password" class="form-control" placeholder="Please Confirm Password"
                        id="confirm_password" autocomplete="new-password" name="confirm_password"
                        value="{{ old('confirm_password') }}" aria-describedby="basic-addon1" required>
                    <div class="input-group-append" style="padding: 0;">
                        <span class="fa fa-eye-slash fa-lg input-group-text" aria-hidden="true"></span>
                    </div>
                </div>
            </div> 
            <button type="submit" class="btn btn-black">Change Password</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

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

        var status = "{{session('status')}}";
        // alert(status);

        if (status == "error_password_not_match") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to change password. Password does not match.',
                position: 'bottomCenter',
                titleSize: '30px',
                titleLineHeight: '70px',
                messageSize: '20px',
                messageLineHeight: '70px',
            });
        }else if (status == "error_save") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to change password.',
                position: 'bottomCenter',
                titleSize: '30px',
                titleLineHeight: '70px',
                messageSize: '20px',
                messageLineHeight: '70px',
            });
        }
    });
</script>