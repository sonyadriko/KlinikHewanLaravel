<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title')</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.ico') }}" />

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">

    <style>
        .card-title {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            height: 3em;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .card a {
            display: inline-block;
            text-decoration: underline;
            text-decoration-color: initial;
            text-decoration-thickness: initial;
        }
    </style>

    @yield('styles')
</head>

<body class="dashboard">
    <div id="main-wrapper">
        @include('layouts.header2')
        @include('layouts.sidebar2')

        <!-- Content -->
        @yield('content')

    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/basic-table/jquery.basictable.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/basic-table-init.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>

    @yield('scripts')
</body>

</html>
