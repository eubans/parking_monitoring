<!DOCTYPE html>
<html>
    <head>
        <title>{!! Theme::get('title') !!}</title>
        <meta charset="utf-8">
        <meta name="keywords" content="{!! Theme::get('keywords') !!}">
        <meta name="description" content="{!! Theme::get('description') !!}">
        
        <link href="{{ asset('public/plugin/bootstrap-4.4.1-dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('public/css/font_awesome_all.css') }}" rel="stylesheet">
        <link href="{{ asset('public/css/iziModal.min.css') }}" rel="stylesheet">
        <link href="{{ asset('public/css/iziToast.min.css') }}" rel="stylesheet">

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
        
        {!! Theme::asset()->styles() !!}
        {!! Theme::asset()->scripts() !!}

        <link rel="shortcut icon" href="{{ asset('public/img/favicon.ico') }}">

        <script src="{{ asset('public/js/jquery-3.4.1.min.js') }}/"></script>
        <script src="{{ asset('public/plugin/bootstrap-4.4.1-dist/js/bootstrap.min.js') }}/"></script>
        <script src="{{ asset('public/js/popper.min.js') }}/"></script>
        <script src="{{ asset('public/js/iziModal.min.js') }}/"></script>
        <script src="{{ asset('public/js/iziToast.min.js') }}/"></script>
        <script src="{{ asset('public/js/main.js') }}/"></script>

    </head>
    <body>
        {!! Theme::partial('header') !!}

        <div class="container">
            {!! Theme::content() !!}
        </div>

        {!! Theme::partial('footer') !!}

        {!! Theme::asset()->container('footer')->scripts() !!}
    </body>
</html>
