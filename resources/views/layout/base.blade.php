<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} @hasSection('title')- @yield('title') @endif</title>
    <link rel="stylesheet" type="text/css" href="{{ mix('build/css/app.css') }}">
    @stack('headEnd')
</head>
<body class="background-light">
@stack('bodyStart')
@yield('page')

<script src="{{ mix('build/js/app.js')  }}"></script>
@stack('bodyEnd')
</body>
</html>