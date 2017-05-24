<!doctype html>
<html class="no-js" lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">

    <title>Laravel</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
        window.activeIndex = '{{ request("index") }}';
    </script>

</head>
<body>

    {{-- content --}}
    <main id="wrapper">
        <div id="app">
            @yield('app')
        </div>
    </main>

    {{-- scripts --}}
    <script async src="{{ asset('js/app.js') }}"></script>
</body>
</html>