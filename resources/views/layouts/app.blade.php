<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
{{--    <link rel="stylesheet" href="{{ mix('css/app.css') }}">--}}
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
</head>
<body class="bg-light">
<div id="app">
    @yield('content')
</div>
</body>
</html>
