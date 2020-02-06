<!DOCTYPE html>
<html>
    <head>
        <title>{!! Theme::get('title') !!}</title>
        <meta charset="utf-8">
        <meta name="keywords" content="{!! Theme::get('keywords') !!}">
        <meta name="description" content="{!! Theme::get('description') !!}">

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
        <link rel="icon" href="{!! asset('public/img/favicon.ico') !!}"/>
        
        <link href="{{ asset('public/plugin/bootstrap-4.4.1-dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ url('public/plugin/font-awesome/css/font-awesome.min.css')}}">
        <link href="{{ asset('public/css/iziModal.min.css') }}" rel="stylesheet">
        <link href="{{ asset('public/css/iziToast.min.css') }}" rel="stylesheet">
        <link href="{{ asset('public/themes/main/assets/css/main.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/plugin/DataTables/datatables.min.css') }}"/>
        <link href="{{ asset('public/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/css/waitMe.min.css')}}">
        <link rel="stylesheet" href="{{ asset('public/css/jquery-confirm.min.css')}}">

        <!-- DATATABLE STYLE EXPORT START -->
        <link rel="stylesheet" type="text/css" href="{{ asset('public/plugin/DataTables/jquery.dataTables.min.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('public/plugin/DataTables/Buttons-1.5.1/css/buttons.dataTables.min.css')}}"/>
        <!-- DATATABLE STYLE EXPORT END -->

        {!! Theme::asset()->styles() !!}
        {!! Theme::asset()->scripts() !!}

        <link rel="shortcut icon" href="{{ asset('public/img/favicon.ico') }}">

        <script src="{{ asset('public/js/jquery-3.4.1.min.js') }}/"></script>
        <script src="{{ asset('public/plugin/bootstrap-4.4.1-dist/js/bootstrap.min.js') }}/"></script>
        <script src="{{ asset('public/js/popper.min.js') }}/"></script>
        <script src="{{ asset('public/js/iziModal.min.js') }}/"></script>
        <script src="{{ asset('public/js/iziToast.min.js') }}/"></script>
        <script src="{{ asset('public/js/main.js') }}/"></script>
        <script src="{{ asset('public/js/waitMe.min.js')}}"></script>
        <script src="{{ asset('public/js/bootstrap-show-password.min.js')}}"></script>
        <script src="{{ asset('public/plugin/jquery-qrcode-master/jquery.qrcode.min.js')}}"></script>
        <script src="{{ asset('public/js/moment.js')}}"></script>

        <!-- DATATABLE SCRIPT EXPORT START -->
        <script src="{{ asset('public/plugin/DataTables/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('public/plugin/DataTables/Select-1.2.5/js/dataTables.select.min.js')}}"></script>
        <script src="{{ asset('public/plugin/DataTables/Buttons-1.5.1/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{ asset('public/plugin/DataTables/JSZip-2.5.0/jszip.min.js')}}"></script>
        <script src="{{ asset('public/plugin/DataTables/pdfmake-0.1.32/pdfmake.min.js')}}"></script>
        <script src="{{ asset('public/plugin/DataTables/pdfmake-0.1.32/vfs_fonts.js')}}"></script>
        <script src="{{ asset('public/plugin/DataTables/Buttons-1.5.1/js/buttons.html5.min.js')}}"></script>
        <script src="{{ asset('public/plugin/DataTables/Buttons-1.5.1/js/buttons.print.js')}}"></script>       
        <script src="{{ asset('public/plugin/DataTables/filterDropDown.min.js')}}"></script>
        <!-- DATATABLE SCRIPT EXPORT END -->

        <script src="{{ asset('public/js/dataTables.bootstrap4.min.js') }}/"></script>
        <script src="{{ asset('public/plugin/printThis/printThis.js')}}"></script>
        <script src="{{ asset('public/plugin/webcamjs/webcam.min.js')}}"></script>
        <script src="{{ asset('public/js/jquery-confirm.min.js')}}"></script>
    </head>
    <body>
        {!! Theme::partial('header') !!}

        <div class="container" id="body-container">
            {!! Theme::content() !!}
        </div>

        {!! Theme::partial('footer') !!}

        {!! Theme::asset()->container('footer')->scripts() !!}
    </body>
</html>
