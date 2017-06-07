<!doctype html>
<html class="no-js" lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">

    <title>Laravel</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet" type="text/css">
    <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
    </script>
    @stack('var')

</head>
<body>

    {{-- content --}}
    <main id="wrapper">
        <div id="app" style="opacity: 0;" v-bind:class="{ active: isActive }">
            @yield('app')
        </div>
    </main>

    {{-- scripts --}}
    <script async src="{{ asset('js/app.js') }}"></script>
</body>
</html>