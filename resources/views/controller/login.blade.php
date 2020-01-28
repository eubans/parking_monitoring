<link href="{{ asset('public/themes/default/assets/css/main.css') }}" rel="stylesheet">
<div class="sidenav">
    <div class="login-main-text">
        <h2>Parking Monitoring System<br> Login Page</h2>
        <p>Login or register from here to access.</p>
    </div>
</div>
<div class="main">
    <div class="col-md-6 col-sm-12">
        <div class="login-form">
            {!! Form::open(['url' => 'login/action']) !!}
            <div class="form-group">
                <label>User Name</label>
                <input type="text" class="form-control" placeholder="User Name" name="username">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
            <button type="submit" class="btn btn-black">Login</button>
            <button type="submit" class="btn btn-secondary">Register</button>
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
            });
        }
    });
</script>