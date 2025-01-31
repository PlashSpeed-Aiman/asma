<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Asma</title>
    @if (app()->environment('local'))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <script src="{{ mix('js/app.js') }}"></script>
    @endif
</head>
<body>
 <div id="app">
     @include('shared._nav')
     @yield('content')
 </div>
</body>
</html>
