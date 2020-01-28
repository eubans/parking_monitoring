<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-end fixed-top">
    <a class="navbar-brand" href="{{ url('home') }}">Parking Monitoring System</a>
    <span class="ml-auto mr-1"></span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ url('home') }}"><i class="fa fa-home"></i> Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ url('scan') }}"><i class="fa fa-qrcode"></i> Scan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#"><i class="fa fa-calendar"></i>
                    Reservation</a>
            </li>
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
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ url('home') }}"><i class="fa fa-cogs"></i> Settings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ url('logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
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
        }, e.type === 'mouseleave' ? 200 : 0);
    }

    $(document).ready(function () {
        $('body')
            .on('mouseenter mouseleave', '.dropdown', toggleDropdown)
            .on('click', '.dropdown-menu a', toggleDropdown);
    });
</script>