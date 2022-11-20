<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body class="h-100">
<div class="d-flex h-100" style="flex-flow: column; overflow: auto">
    <div class="d-flex flex-grow-0 flex-shrink-1">
        <div class="flex-grow-1 flex-shrink-1" style="flex-basis: auto">
            @include('layouts.header')
        </div>
    </div>
    <div class="d-flex flex-grow-1 flex-shrink-1 m-0">
        @include('layouts.sidenav')
        <div class="d-flex col-md-9 col-xl-10">
            @yield('content')
        </div>
{{--        <div class="d-flex col-md-9 col-xl-10 position-relative">--}}
{{--                <div class="h-100 start-0 end-0 top-0 bottom-0 position-absolute flex-column d-flex">--}}
{{--                    <div style="overflow-y: auto;">--}}
{{--                        @yield  ('content')--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--        </div>--}}
    </div>
</div>
</body>
</html>
