<style>
#header-nav { 
    background-color: #003007 !important;
}
</style>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-end fixed-top" id="header-nav">
    <a class="navbar-brand" href="{{ url('home') }}"> <img src="{{ asset('public/img/logo.png') }}" class="img-circle" style="width: 35px;height: 35px;object-fit: cover; ">
     Parking Monitoring System</a>
    <span class="ml-auto mr-1"></span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ url('home') }}"><i class="fa fa-home"></i> Home</a>
            </li>
            @if(session('USER_TYPE_ID') != 2)
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ url('scan') }}"><i class="fa fa-qrcode"></i> Scan</a>
            </li>
            @endif
            @if(session('USER_TYPE_ID') != 2)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user"></i> Reservation
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ url('reservation') }}">Pending</a>
                    <a class="dropdown-item" href="{{ url('reservation/logs') }}">Logs</a>
                </div>
            </li>
            @endif
            @if(session('USER_TYPE_ID') != 2)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user"></i> Occupants
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ url('occupant') }}">List</a>
                    <a class="dropdown-item" href="{{ url('occupant/attendance-logs') }}">Attendance Logs</a>
                </div>
            </li>
            @endif
            @if(session('USER_TYPE_ID') == 2)
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ url('occupant/attendance-logs') }}">
                    <i class="fa fa-user"></i> Attendance Logs
                </a>
            </li>
            @endif
            @if(session('USER_TYPE_ID') == 3)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cogs"></i> Settings
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ url('settings/user/list') }}">User Set-up</a>
                    <a class="dropdown-item" href="{{ url('settings/global-variables') }}">Global Variables</a>
                </div>
            </li> 
            @endif
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img id="image_avatar" src="{{Session::get('USER_AVATAR_PATH')}}" class="img-circle"
                        alt="{{Session::get('USER_FULLNAME')}}" style="width: 30px;height: 30px;object-fit: cover;">
                    {{Session::get('USER_NAME')}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="left: -20px;">
                    @if(session('USER_TYPE_ID') != 2)
                    <a class="dropdown-item" href="{{ url('user-settings') }}">User Settings</a>
                    @else
                    <a class="dropdown-item" href="{{ url('user-settings') }}">Change Password</a>
                    @endif
                    <a class="dropdown-item" href="{{ url('logout') }}">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<script>
    function toggleDropdown(e) {
        const _d = $(e.target).closest('.dropdown'),
            _m = $('.dropdown-menu', _d);
        setTimeout(function () {
            const shouldOpen = e.type !== 'click' && _d.is(':hover');
            _m.toggleClass('show', shouldOpen);
            _d.toggleClass('show', shouldOpen);
            $('[data-toggle="dropdown"]', _d).attr('aria-expanded', shouldOpen);
        }, e.type === 'mouseleave' ? 100 : 0);
    }

    $(document).ready(function () {
        $('body')
            .on('mouseenter mouseleave', '.dropdown', toggleDropdown)
            .on('click', '.dropdown-menu a', toggleDropdown);
    });
</script>