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

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <h4>Administrator List</h4>
            </div>
            <div class="col-6" style="text-align: right;">
                <a href="{{ url('settings/user') }}" class="btn btn-primary" title="Open" style="float: right;">
                    New Administrator
                </a>
            </div>
        </div>
    </div>
    <div class="container" style="padding: 20px;">
        <table id="table" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->use_username}}</td>
                    <td>
                        {{$user->usd_lastname . ", " . $user->usd_firstname . ", " . strtoupper($user->usd_middlename[0]) . ". "}}
                    </td>
                    <td>{{$user->usd_email}}</td>
                    <td>{{$user->usd_contact_number}}</td>
                    <td>{{ucfirst($user->use_status)}}</td>
                    <td style="text-align: center;">
                        <a href="{{url('settings/user?id=') . $user->use_id}}" type="button"
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

<script>
    $(document).ready(function () {
        $('#table').DataTable({
            "ordering": false
        });
    });
</script>