<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Asma</title>
    @if (app()->environment('local'))
        @vite(['resources/css/app.css'])
    @else
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @endif
</head>
<body>
 <div id="app">
     <meta name="csrf-token" content="{{ csrf_token() }}">
     @include('shared._nav')
     @yield('content')
 </div>
 @if (app()->environment('local'))
     @vite(['resources/js/app.js'])
     @else
     <script src="{{ asset() }}"></script>
 @endif
 @stack('scripts')
</body>
</html>
