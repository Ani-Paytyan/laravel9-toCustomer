<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} @hasSection('title')- @yield('title') @endif</title>
    <link rel="stylesheet" type="text/css" href="{{ mix('build/css/app.css') }}">
    @stack('headEnd')
</head>
<body class="background-light">

<div class="loader-wrapper" id="loading" style="display: none;">
    <div class="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>

@include('sweetalert::alert')
@include('layout.partials.modal')
@stack('bodyStart')
@yield('page')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="{{ mix('build/js/app.js')  }}"></script>
@stack('bodyEnd')
</body>
</html>
