<style>
    table.dataTable thead .sorting,
    table.dataTable thead .sorting_asc,
    table.dataTable thead .sorting_desc {
        background: none;
    }

    #table_paginate .pagination li {
        padding: 1px;
    }

    .card-header {
        padding: .75rem;
    }
</style>

<div class="card" style="font-size:small;">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <h4>Occupant List</h4>
            </div>
            <div class="col-6" style="text-align: right;">
                <a href="{{ url('occupant/registration') }}" class="btn btn-primary" title="Open" style="float: right;">
                    New Occupant
                </a>
            </div>
        </div>
    </div>
    <div class="container" style="padding: 20px;">
        <div class="table-responsive">
            <table id="table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Occupant Type</th>
                        <th>Student Number</th>
                        <th>Fullname</th>
                        <th>Course</th>
                        <th>Contact</th>
                        <th>Plate Number</th>
                        <th>Status</th>
                        <th>Login</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($occupants as $occupant)
                    <tr>
                        <td>{{$occupant->oct_name}}</td>
                        <td><strong>{{$occupant->occ_student_number}}</strong></td>
                        <td>
                            {{$occupant->occ_lastname . ", " . $occupant->occ_firstname . ", " . strtoupper($occupant->occ_middlename[0]) . ". "}}
                        </td>
                        <td>{{$occupant->occ_course}}</td>
                        <td>{{$occupant->occ_phone_number . " | " . $occupant->occ_telephone}}</td>
                        <td>{{$occupant->omi_plate_number}}</td>
                        <td>{{ucfirst($occupant->occ_account_status)}}</td>
                        <td>{{ucfirst($occupant->use_status)}}</td>
                        <td style="text-align: center;">
                            <a href="{{url('occupant/profile?id=') . $occupant->occ_id}}" type="button"
                                class="btn btn-primary btn-sm" title="Open">
                                <i class="fa fa-external-link"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#table').DataTable({
            "ordering": false
        });
    });
</script>