<style>
    .card-header {
        padding: .75rem;
    }
</style>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-12">
                <h4>Global Variables</h4>
            </div>
        </div>
    </div>
    {!! Form::open(['url' =>
    'settings/global-variables/parking-slot/save','id'=>'form_submit','data-smk-icon'=>'glyphicon-remove-sign'])
    !!}
    <div class="container" style="padding: 20px 35px;">
        <div class="row">
            <div class="col-md-4">
                <div class="row" style="padding-left: 5px;">
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label for="student_number">Parking Slot:</label>
                            <input type="number" class="form-control" placeholder="Enter Parking Slot" id="parking_slot"
                                value="{{$parking_slot}}" name="parking_slot" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" id="submit_button" style="float:right;margin: 5px -5px;"
                    onclick="confirm('Are you sure to continue?')">
                    <i class="fa fa-floppy-o"></i> Save
                </button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<script>
    $(document).ready(function () {
        var status_parking_slot = "{{session('status_parking_slot')}}";
        // alert(status);

        if (status_parking_slot == "success_parking_slot_update") {
            iziToast.success({
                title: 'Success:',
                message: ' Parking Slot is successfully updated.',
                position: 'bottomCenter',
                titleSize: '30px',
                titleLineHeight: '70px',
                messageSize: '20px',
                messageLineHeight: '70px',
            });
        } else if (status_parking_slot == "error_parking_slot_update") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to update Parking Slot.',
                position: 'bottomCenter',
                titleSize: '30px',
                titleLineHeight: '70px',
                messageSize: '20px',
                messageLineHeight: '70px',
            });
        } else if (status_parking_slot == "error_invalid_parking_slot") {
            iziToast.error({
                title: 'Error:',
                message: ' Failure to update Parking Slot. Parking slot is currently not equal or higher than the ongoing occupant parked.',
                position: 'bottomCenter',
                titleSize: '30px',
                titleLineHeight: '70px',
                messageSize: '20px',
                messageLineHeight: '70px',
            });
        }
    });
</script>