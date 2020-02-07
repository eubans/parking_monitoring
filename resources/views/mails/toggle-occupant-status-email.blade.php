<h1>Your occupant account status has been changed by the administrator.</h1>
<br/>
<p>This is your current occupant account status: <b>{{ucfirst($send_mail->status)}}</b> </p>
@if($send_mail->status == "active")
    <p>You can now login and use the reservation.</p>
@else 
    <p>Don't worry you can still login, but you can't use the reservation.</p>
@endif
<p>Please contact the IETI Parking Logs System Administrator for any concern.</p>
<br />
<p>Thanks,</p>
<p>IETI Parking Logs System</p>