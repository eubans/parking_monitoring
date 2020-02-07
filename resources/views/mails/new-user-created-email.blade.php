<h1>Congratulations {{$send_mail->fullname}}</h1>
<h2>You now have an account on IETI Parking Logs System.</h2>
<p>Please login to this website: {{url('login')}}</p>
<br />
<p><b>This is your user access</b></p>
<p>Username: <b>{{$send_mail->username}}</b> </p>
<p>Password: <b>{{$send_mail->password}}</b> </p>
<br />
<p>We recommend you to change your password for the first time you logon.</p>
<p>Thanks,</p>
<p>IETI Parking Logs System</p>