<style>
    .card-header {
        padding: .75rem;
    }
    .form-control[readonly] {
        background-color: #fff;
        opacity: 1;
    }
</style>
<link rel="stylesheet" href="{{ asset('public/css/jquery.timepicker.min.css')}}">
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-12">
                <h4>Global Variables</h4>
            </div>
        </div>
    </div>
    {!! Form::open(['url' =>
    'settings/global-variables/save','id'=>'form_submit','data-smk-icon'=>'glyphicon-remove-sign'])
    !!}
    <div class="container" style="padding: 20px 35px;">
        <div class="row">
            <div class="col-md-4">
                <div class="row" style="padding-left: 5px;">
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label for="parking_slot">Parking Slot:</label>
                            <input type="number" class="form-control" placeholder="Enter Parking Slot" id="parking_slot"
                                value="{{$parking_slot}}" name="parking_slot" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label for="reservation_time_limit">Reservation Time Limit (Minute):</label>
                            <input type="number" class="form-control" placeholder="Enter Parking Slot" id="reservation_time_limit"
                                value="{{$reservation_time_limit}}" name="reservation_time_limit" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label for="parking_closing_time">Parking Closing Time:</label>
                            <input type="text" class="form-control timepicker" placeholder="Enter Parking Closing Time" id="parking_closing_time"
                                value="{{$parking_closing_time}}" name="parking_closing_time" required readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label for="enable_email">Enable Email:</label>
                            <select class="form-control" id="enable_email" name="enable_email" required>
                                <option value="1" {{$enable_email == 1 ? "selected" : "" }}>Yes</option>
                                <option value="0" {{$enable_email == 0 ? "selected" : "" }}>No</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row" style="padding-left: 5px;">
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label for="enable_sms">Enable SMS:</label>
                            <select class="form-control" id="enable_sms" name="enable_sms" required>
                                <option value="1" {{$enable_sms == 1 ? "selected" : "" }}>Yes</option>
                                <option value="0" {{$enable_sms == 0 ? "selected" : "" }}>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label for="enable_automatic_closing_sms_blast">Enable Automatic Closing SMS Blast:</label>
                            <select class="form-control" id="enable_automatic_closing_sms_blast" name="enable_automatic_closing_sms_blast" required>
                                <option value="1" {{$enable_automatic_closing_sms_blast == 1 ? "selected" : "" }}>Yes</option>
                                <option value="0" {{$enable_automatic_closing_sms_blast == 0 ? "selected" : "" }}>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label for="enable_automatic_disabling_of_guest">Enable Automatic Disabling of Guest:</label>
                            <select class="form-control" id="enable_automatic_disabling_of_guest" name="enable_automatic_disabling_of_guest" required>
                                <option value="1" {{$enable_automatic_disabling_of_guest == 1 ? "selected" : "" }}>Yes</option>
                                <option value="0" {{$enable_automatic_disabling_of_guest == 0 ? "selected" : "" }}>No</option>
                            </select>
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
</div>
<script src="{{ asset('public/js/jquery.timepicker.min.js')}}"></script>
<script>
    $(document).ready(function () {
        var status_parking_slot = "{{session('status')}}";
        // alert(status);

        if (status_parking_slot == "success_save") {
            iziToast.success({
                title: 'Success:',
                message: ' Global Variables are successfully updated.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status_parking_slot == "error_save") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to update Global Variables.',
                position: 'bottomCenter',
                titleSize: '15px',
                titleLineHeight: '35px',
                messageSize: '15px',
                messageLineHeight: '35px',
            });
        } else if (status_parking_slot == "error_invalid_parking_slot") {
            iziToast.error({
                title: 'Error:',
                message: ' Global Variables are successfully updated. Parking slot is currently not equal or higher than the ongoing occupant parked.',
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
        
        $('.timepicker').timepicker();
    });
</script>