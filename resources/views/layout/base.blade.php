<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="icon" href="<?php echo asset('favicon.ico'); ?>">
    <link rel="icon" href="<?php echo asset('icon.svg'); ?>" type="image/svg+xml">
    <link rel="apple-touch-icon" href="<?php echo asset('apple-touch-icon.png'); ?>">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} @hasSection('title')- @yield('title')@endif</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('build/css/app.css') }}">
    @stack('headEnd')
</head>
<body x-data :class="$store.darkMode.on && 'dark-theme'">
    @include('sweetalert::alert')
    @stack('bodyStart')
    @yield('page')
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>--}}
    <script src="{{ mix('build/js/app.js')  }}"></script>
    @stack('bodyEnd')
</body>
</html>
