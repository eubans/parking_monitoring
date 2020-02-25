<link href="{{ asset('public/themes/default/assets/css/main.css') }}" rel="stylesheet">
<div class="sidenav">
    <div class="login-main-text">
        <img src="{{ asset('public/img/logo.png') }}" style="margin-bottom: 20%;">
        <h2>Parking Logs System<br> Login Page</h2>
        <p>Login from here to access.</p>
    </div>
</div>
<div class="main">
    <div class="col-md-6 col-sm-12">
        <div class="login-form">
            {!! Form::open(['url' => 'login/action']) !!}
            <div class="form-group">
                <label>Username:</label>
                <input type="text" class="form-control" placeholder="User Name" name="username">
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
            <button type="submit" class="btn btn-black">Login</button>
        <a href="{{url('forgot-password')}}" type="button" class="btn btn-outline-dark">Forgot Password</a>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var error = (loadPageVar('error'));

        if(error=="1"){
            iziToast.error({
                title: 'Failed to Login',
                message: "Invalid Username/Password",
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        }else if(error=="2"){
            iziToast.error({
                title: 'Failed to Login',
                message: "Account is deactivated. Please contact the adminitrator.",
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        }

        var status = (loadPageVar('status'));
        if (status=="cp"){
            iziToast.success({
                title: 'Success',
                message: "Password is successfully changed.",
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        }
    });
</script>