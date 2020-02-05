<link href="{{ asset('public/themes/default/assets/css/main.css') }}" rel="stylesheet">
<div class="sidenav">
    <div class="login-main-text">
        <img src="{{ asset('public/img/logo.png') }}" style="margin-bottom: 20%;">
        <h2>Parking Logs System<br> Forgot Password Page</h2>
        <p>Let's get you into your account.</p>
        <p>Tell us your email address.</p>
    </div>
</div>
<div class="main">
    <div class="col-md-6 col-sm-12">
        <div class="login-form">
            {!! Form::open(['url' => 'forgot-password/send-verification-code']) !!}
            <div class="form-group">
                <label>Email Address:</label>
                <input type="email" class="form-control" placeholder="Email Address" name="email" required>
            </div>
            <button type="button" class="btn btn-danger" onclick='window.location = "login"'>Back</button>
            <button type="submit" class="btn btn-black">Continue</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<script>
    $( document ).ready(function() { 

        var status = "{{session('status')}}";
        if (status == "emailnotexist") {
            iziToast.error({
                title: 'Error',
                message: 'Sorry, we don\'t recognize that email address',
                position: 'bottomCenter',
                titleSize: '30px',
                titleLineHeight: '70px',
                messageSize: '20px',
                messageLineHeight: '70px',
            });
        }

    });
</script>